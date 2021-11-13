<?php

class DashboardController extends BaseController {

    protected function index () {
        $this->loadView();

        $users = User::getAll();
        $profiles = Profile::getAll();
        $posts = Post::getAll();
        $comments = Comment::getAll();

        console_log($posts);
        console_log($comments);

        $count = count($users);
        echo "
            <div class='your_posts'>
                <h2> Total users: $count </h2>
            </div>
        ";

        foreach ($users as $user) {
            foreach($profiles as $profile){
                if ($user->id == $profile->user_id) {
                    echo "
                    <div class='dashboard_user'>
                        <div class='d_user_information'>
                            <h2>User information:</h2>
                            <p>id: $user->id</p>
                            <p>$user->email</p>
                            <p>$user->createdAt</p>
                            <p>$user->updatedAt</p>
                        </div>
                        <div class='d_profile_information'>
                            <h2>Profile information:</h2>
                            <p>id: $profile->id</p>
                            <p>userid: $profile->user_id</p>
                            <p>$profile->firstname</p>
                            <p>$profile->lastname</p>
                            <p>$profile->city</p>
                            <p>$profile->zipcode</p>
                            <p>$profile->street</p>
                            <p>$profile->nr</p>
                            <p>$profile->phone</p>
                        </div>
                        <form method='POST' class='dashboard_delete'>
                            <input type='hidden' name='userid' value='$user->id'></input>
                            <input type='hidden' name='profileid' value='$profile->id'></input>
                            <button type='submit' name='admindel'>Delete user</button>
                        </form>
                    </div>
                    ";
                }
            }
            
        }

        $postCount = count($posts);
        echo "
            <div class='your_posts'>
                <h2> Total posts: $postCount </h2>
            </div>
        ";

        $commentCount = count($comments);
        echo "
            <div class='your_posts'>
                <h2> Total comments: $commentCount </h2>
            </div>
        ";

        if( isset($_POST['admindel']) ) {

            $valid = true;
            $uid = trim($_POST["userid"]);
            $pid = trim($_POST["profileid"]);

            if($valid) {
                Comment::deleteByUserId($uid);
                Post::deleteByUserId($uid);
                Profile::deleteById($pid);
                User::deleteById($uid);
                header('Location: /dashboard');
            }
            else {
                //give feedback
                echo '- Error';
            }
        }
    }
}