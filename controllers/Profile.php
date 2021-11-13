<?php

class ProfileController extends BaseController {

    protected function index () {
        $this->loadView();
        $cookie = $_COOKIE["usercookie"]? $_COOKIE["usercookie"]: null;
        if ($cookie) {
            $posts = Post::GetByUserId($cookie);
            $count = count($posts);
            $profileInfo = Profile::getProfileById($cookie);
            $userInfo = User::getById($cookie);

            echo "
                <div class='your_posts profile_info'>
                    <div>
                        <h2> Your profile </h2>
                        <p> Your email: $userInfo->email</p>
                        <p> Created at: $userInfo->createdAt</p>
                        <p> Updated at: $userInfo->updatedAt</p>
                    </div>
                    <div>
                        <p>Your firstname: $profileInfo->firstname</p>
                        <p>Your lastname: $profileInfo->lastname</p>
                        <p>Your phone number: $profileInfo->phone</p>
                        <p>Your zipcode: $profileInfo->zipcode</p>
                        <p>Your city: $profileInfo->city</p>
                        <p>Your street: $profileInfo->street</p>
                        <p>Your number: $profileInfo->nr</p>
                    </div>
                </div>";
            echo "
            <div class='your_posts'>
                <h2> Your posts </h2>
                <p>$count posts</p>
            </div>";
            foreach ($posts as $value) {
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
                        <h3>By $value->user_id</h3>
                        <h3>Created on $value->createdAt</h3>
                        <h2>in the area of $value->zipcode $value->city </h2>
                    </a>
                </div>";
                } 
            } else {
            echo "<a href='/login'>Log in to view posts</a>";
        }
    }
}