<?php

class Post extends BaseModel {

    protected $table = 'posts';
    protected $pk = 'id';

    public function getShortContent () {
        return substr($this->content, 0, 100);
    }

    public static function createPost( $post ) {
        global $db;
        
        $sql = "INSERT INTO `posts` (`user_id`, `type`, `animal`, `title`,`description`, `zipcode`, `city`, `street`, `nr`, `createdAt`, `updatedAt`)
        VALUES (:userid, :type, :animal, :title, :description, :zipcode, :city, :street, :nr, :createdAt, :updatedAt)";
    
        $stmnt = $db->prepare($sql);
        $stmnt->execute( 
            [
                ':userid' => $post->userid,
                ':type' => $post->type,
                ':animal' => $post->animal,
                ':title' => $post->title,
                ':description' => $post->description,
                ':zipcode' => $post->zipcode,
                ':city' => $post->city,
                ':street' => $post->street,
                ':nr' => $post->nr,
                ':createdAt' => $post->createdAt,
                ':updatedAt' => $post->updatedAt
            ]
         );
    
        return $db->lastInsertId();
    }

    public static function deletePost( int $id ) {
        global $db;
        
        $sql = 'DELETE FROM `posts` WHERE `id` = :p_id';
    
        $stmnt = $db->prepare($sql);
        $stmnt->execute([ ':p_id' => $id ]);
    
        return $db->lastInsertId();
    }

    public static function deletePostByUser( int $id ) {
        global $db;
        
        $sql = 'DELETE * FROM `posts` WHERE `user_id` = :p_id';
    
        $stmnt = $db->prepare($sql);
        $stmnt->execute([ ':p_id' => $id ]);
    
        return $db->lastInsertId();
    }
}