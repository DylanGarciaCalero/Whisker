<?php

class HomeController extends BaseController {

    protected function index () {
        $this->viewParams['home'] = Post::getAll();
        $this->loadView();
        $currentUser = $_COOKIE["usercookie"] ?? 0;

        $post = new Post();

        if( isset($_POST['post']) ) {

            $valid = true;
            date_default_timezone_set('Europe/Brussels');
            
            $post->userid = $currentUser;
            $post->type = trim($_POST["type"]);
            $post->animal = trim($_POST["animal"]);
            $post->title = trim($_POST["title"]);
            $post->description = trim($_POST["description"]);
            $post->zipcode = trim($_POST["zipcode"]);
            $post->city = trim($_POST["city"]);
            $post->street = trim($_POST["street"]);
            $post->nr = trim($_POST["nr"]);
            $post->createdAt = date('l jS \of F Y h:i:s A');
            $post->updatedAt = date('l jS \of F Y h:i:s A');
           
            if( empty($post->type) || empty($post->animal) || empty($post->title) || empty($post->description) || empty($post->zipcode) || empty($post->city) ) {
                $valid = false;
                echo " 
                    <div class='fail'>
                        <p>Please fill in all required fields</p>
                    </div>" ;  
            }

            if($valid) {
                $post_id = Post::createPost($post);
            }
            else {
                //give feedback
                echo '- Error';
            }

        }
    }
}