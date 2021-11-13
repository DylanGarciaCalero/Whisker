<?php

class Profile extends BaseModel {

    protected $table = 'profiles';
    protected $pk = 'id';

    public function getShortContent () {
        return substr($this->content, 0, 100);
    }

    public static function createProfile( $profile ) {
        global $db;
        
        $sql = "INSERT INTO `profiles` (`user_id`, `firstname`, `lastname`, `city`,`zipcode`, `street`,`nr`, `phone`)
        VALUES (:userid, :firstname, :lastname, :city, :zipcode, :street, :nr, :phone)";
        console_log($sql);
        $stmnt = $db->prepare($sql);
        $stmnt->execute( 
            [
                ':userid' => $profile->userid,
                ':firstname' => $profile->firstname,
                ':lastname' => $profile->lastname,
                ':city' => $profile->city,
                ':zipcode' => $profile->zipcode,
                ':street' => $profile->street,
                ':nr' => $profile->nr,
                ':phone' => $profile->phone
            ]
         );
    
        return $db->lastInsertId();
    }
}