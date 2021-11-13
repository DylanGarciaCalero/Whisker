<?php

class RegisterController extends BaseController {

    protected function index () {
        $this->loadView();
        $user_id = $_GET['id'] ?? 0;
        if($user_id) {
            $user = new User();
            $profile = new Profile();
            $user->getById($user_id);
        }
        else {
            $user = new User();
            $profile = new Profile();
        };

        if( isset($_POST['submit']) ) {
            
            $valid = true;
            $user->email = trim( $_POST['email'] );
            if ($_POST['password'] !== $_POST['passwordV']) {
                $valid = false;
                echo " 
                    <div class='fail'>
                        <p>Passwords do not match - Please try again</p>
                    </div>" ;   
            }
            $user->password = password_hash( $_POST['password'], PASSWORD_DEFAULT );
            date_default_timezone_set('Europe/Brussels');
            $user->createdAt = date('l jS \of F Y h:i:s A');
            $user->updatedAt = date('l jS \of F Y h:i:s A');

            $profile->firstname = trim( $_POST['firstname'] );
            $profile->lastname = trim( $_POST['lastname'] );
            $profile->city = trim( $_POST['city'] );
            $profile->zipcode = trim( $_POST['zipcode'] );
            $profile->street = trim( $_POST['street'] );
            $profile->nr = trim( $_POST['nr'] );
            $profile->phone = trim( $_POST['phone'] );

            if( empty($user->email) || empty($user->password)) {
                $valid = false;
            }

            if ( !$user_id && $user->emailExists( $user->email ) ) {
                echo " 
                    <div class='fail'>
                        <p>EmailAdress is already in use - Please use another emailadress</p>
                    </div>" ;   
                $valid = false;
            }

            if($valid) {
                if($user_id) {
                    echo "Successfully updated user nr. $user_id";

                } else {
                    $user_id = User::createUser($user);
                    $profile->userid = $user_id;
                    Profile::createProfile($profile);
                    
                    header('Location: /login');
                }
            }
            else {
                //give feedback
                echo '- Error';
            }

        }
    }
}