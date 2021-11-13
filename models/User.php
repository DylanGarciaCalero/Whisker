<?php

class User extends BaseModel {

    protected $table = 'users';
    protected $pk = 'id';

    public function getShortContent () {
        return substr($this->content, 0, 100);
    }

    public function emailExists($email) {
        global $db;
        $sql = "SELECT COUNT(email) FROM users WHERE email = ?";
        $stmnt = $db->prepare($sql);
        $stmnt->execute( [ $email ] );
        $numberOfUsers = (int) $stmnt->fetchColumn();
        return ( $numberOfUsers > 0 ) ;
    }

    public function passwordIsCorrect($email) {
        global $db;
        $sql = "SELECT `password` FROM `users` WHERE `email` = '$email' ";
        $stmnt = $db->prepare($sql);
        $stmnt->execute();
        $data = $stmnt->fetch();
        return $data[0] ;
    }

    public function getConnectedUserId($email) {
        global $db;
        $sql = "SELECT `id` FROM `users` WHERE `email` = '$email' ";
        $stmnt = $db->prepare($sql);
        $stmnt->execute();
        $data = $stmnt->fetch();
        return $data[0] ;
    }

    public static function createUser( $user ) {
        global $db;
        foreach($user as $property => &$value) {
            //Transform special chars to html entities 
            //to prevent XSS attack
            if($property != ':pwd') {
                $value = htmlspecialchars($value);
            }
        }
    
        $sql = "INSERT INTO `users` (`email`, `password`, `createdAt`,`updatedAt` )
        VALUES (:email, :pwd, :createdAt, :updatedAt)";
    
        $stmnt = $db->prepare($sql);
        $stmnt->execute( 
            [
                ':email' => $user->email,
                ':pwd' => $user->password,
                ':createdAt' => $user->createdAt,
                ':updatedAt' => $user->updatedAt
            ]
         );
    
        return $db->lastInsertId();
    }
    
    public static function getUser( $user ) {
        
    }
}