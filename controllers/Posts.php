<?php

class PostsController extends BaseController {

    protected function index () {
        $cookie = $_COOKIE["usercookie"]? $_COOKIE["usercookie"]: null;
        if ($cookie) {
            $this->loadView();
            $posts =  Post::getAll();
            $profiles = Profile::getAll();
            //echo json to the output
            $count = count($posts);
            echo "
            <div class='your_posts'>
                <h2> All posts </h2>
                <p>$count posts</p>
            </div>";
            foreach ($posts as $value) {
                foreach($profiles as $profile) {
                    if ($value->user_id == $profile->user_id) {
                        if ($value->animal == "1") {
                            $animal = "../images/cat.png";
                        } else {
                            $animal = "../images/dog.png";
                        }
        
                        if ($value->type == "1") {
                            $type = "lost";
                            $color = "post_red";
                        } else {
                            $type = "found";
                            $color = "post_green";
                        }
                        echo "
                        <div class='$value->id post_item'>
                            <a href='posts/detail/$value->id'>
                                <p class='post_status $color'>$type</p>
                                <img class='animalpicture' src='$animal'>
                                <h2>Title</h2>
                                <h3>$value->title</h3>
                                <h2>Description:</h2>
                                <p>$value->description</p>
                                <h4>By $profile->firstname</h3>
                                <h4>Posted on $value->createdAt</h3>
                                <h2 class='loc'>in the area of $value->zipcode $value->city </h2>
                            </a>
                        </div>";
                    } else {

                    }
                }    
            }
        } else {
            echo "<a href='/login'>Log in to view posts</a>";
        }

    }

    protected function detail ($params) {
        $this->loadView();
        $cookie = $_COOKIE["usercookie"]? $_COOKIE["usercookie"]: null;
        if ($cookie) {
            echo "
            <div class='your_posts'>
                <h2> Post detail </h2>
            </div>";
            $post = Post::getById($params[0]);
            if ($post->animal == "1") {
                $animal = "../../images/cat.png";
            } else {
                $animal = "../../images/dog.png";
            }
            if ($cookie == $post->user_id) {
                $delete = '<button type="submit" name="submit">delete post</button>';
            } else {
                $delete = null ;
            }
            if ($post->type == "1") {
                $type = "lost";
                $color = "post_red";
            } else {
                $type = "found";
                $color = "post_green";
            }
            
            echo "
            <div class='$post->id post_item'>
                    <p class='post_status $color'>$type</p>
                    <img class='animalpicture' src='$animal'>
                    <h2>Title</h2>
                    <h3>$post->title</h3>
                    <h2>Description:</h2>
                    <p>$post->description</p>
                    <h4>By $post->id</h3>
                    <h4>Created on $post->createdAt</h3>
                    <h2 class='loc'>in the area of $post->zipcode $post->city </h2>
                    <form method='POST' class='post_delete'>
                        <input type='hidden' name='postid' value='$post->id'></input>
                        $delete
                    </form>
            </div>
            <div class='your_posts'>
                <h2> Comments </h2>
            </div>
            <div>
                <form method='POST' class='post_comment'>
                    <input type='hidden' name='postid' value='$params[0]'></input>
                    <input type='hidden' name='userid' value='$cookie'></input>
                    <textarea type='textarea' name='commentdata'></textarea>
                    <button type='submit' name='comment'>comment!</button>
                </form>
            </div>";

            $comments = Comment::getAll();

            foreach($comments as $comment) {
                if ($comment->post_id == $params[0]) {
                    if ($comment->user_id == $cookie) {
                        $deleteComment = "<button type='submit' name='delete'>delete comment</button>";
                    } else {
                        $deleteComment = null;
                    }
    
                    echo "
                    <div class='$comment->id comment'>
                        <p>$comment->message</p>
                        <p>Posted by: $comment->user_id</p>
                        <p>At:$comment->createdAt</p>
                        <form method='POST' class='comment_delete'>
                            <input type='hidden' name='commentid' value='$comment->id'></input>
                            $deleteComment
                        </form>
                    </div>
                    ";
                }
            }
        } else {
            echo "<a href='/login'>Log in to view posts</a>";
        }

        $post = new Post();

        if( isset($_POST['submit']) ) {

            $valid = true;
            
            $post->postid = trim($_POST["postid"]);

            if($valid) {
                Post::deletePost($post->postid);
                header('Location: /posts');
            }
            else {
                //give feedback
                echo '- Error';
            }

        }

        if( isset($_POST['comment']) ) {

            $valid = true;
            $comment = new Comment();

            $comment->userid = $cookie;
            $comment->postid = trim($_POST["postid"]);
            date_default_timezone_set('Europe/Brussels');
            $comment->createdAt = date('l jS \of F Y h:i:s A');
            $comment->message = trim($_POST["commentdata"]);
            console_log($comment->message);
            
            if($valid) {
                $comment_id = Comment::createComment($comment);
                header('Location: /posts/detail/'.$comment->postid);
            }
            else {
            }
        }

        if( isset($_POST['delete']) ) {

            $valid = true;
            $comment->commentid = trim($_POST["commentid"]);
            if($valid) {
                Comment::deleteComment($comment->commentid);
                header('Location: /posts/detail/'.$params[0]);
            }
            else {
                //give feedback
                echo '- Error';
            }

        }
    }
}