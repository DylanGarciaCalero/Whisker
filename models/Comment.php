<?php

class Comment extends BaseModel {

    protected $table = 'comments';
    protected $pk = 'id';

    public function getShortContent () {
        return substr($this->content, 0, 100);
    }

    public static function createComment( $comment ) {
        global $db;
        
        $sql = "INSERT INTO `comments` (`user_id`, `post_id`, `message`, `createdAt`)
        VALUES (:userid, :postid, :message, :createdAt)";
    
        $stmnt = $db->prepare($sql);
        $stmnt->execute( 
            [
                ':userid' => $comment->userid,
                ':postid' => $comment->postid,
                ':message' => $comment->message,
                ':createdAt' => $comment->createdAt
            ]
         );
    
        return $db->lastInsertId();
    }

    public static function deleteComment( int $id ) {
        global $db;
        
        $sql = 'DELETE FROM `comments` WHERE `id` = :p_id';
    
        $stmnt = $db->prepare($sql);
        $stmnt->execute([ ':p_id' => $id ]);
    
        return $db->lastInsertId();
    }

    public static function deleteCommentByUser( int $id ) {
        global $db;
        
        $sql = 'DELETE * FROM `comments` WHERE `user_id` = :p_id';
    
        $stmnt = $db->prepare($sql);
        $stmnt->execute([ ':p_id' => $id ]);
    
        return $db->lastInsertId();
    }
}