<?php

class LoginController extends BaseController {

    protected function index () {
        $this->loadView();
        $user_id = $_GET['id'] ?? 0;
        if($user_id) {
            $user = new User();
            $user->getById($user_id);
        }
        else {
            $user = new User();
        };

        if( isset($_POST['submit']) ) {
            
            $valid = true;
            $user->email = trim( $_POST['email'] );
            $user->password = password_hash( $_POST['password'], PASSWORD_DEFAULT );

            $email = $user->email;
            
            
            if( empty($user->email) || empty($user->password)) {
                $valid = false;
            }

            if ( !$user_id && $user->emailExists( $user->email ) ) {

                if (password_verify($_POST['password'], $user->passwordIsCorrect($email))) {
                    $valid = true;
                } else {
                    echo " 
                    <div class='fail'>
                        <p>Wrong password - Please try again</p>
                    </div>" ;
                    $valid = false;
                }
            } else {
                $valid = false;
                echo " 
                <div class='fail'>
                    <p>This Emailadress does not exist</p>
                </div>" ;   
            }

            if($valid) {
                if ($email == "admin@whisker.be") {
                    $connectedUser = $user->getConnectedUserId($email);
                    setcookie("usercookie", "admin", time()+3600);
                    header('Location: /dashboard');
                } else {
                    $connectedUser = $user->getConnectedUserId($email);
                    setcookie("usercookie", $connectedUser, time()+3600);
                    header('Location: /');
                }
            }
            else {
                //give feedback
                echo '- Error';
            }

        }
    }
    
}