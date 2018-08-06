<?php 


    namespace App\Auth;
    use App\Models\User;    
    class Auth {

        function check() {
            return isset($_SESSION['userId']);
        }

        function user() {
            if(isset($_SESSION['userId'])){
                return User::find($_SESSION['userId']);
            }
        }

        function logout($request, $response) {
            session_destroy();
            return $response->withRedirect("/");
        }

        function getBack() {
            header("Location: /");
        }



        function verify($username, $password) {
            $user = User::where('email', $username)->first();
            if(!$user) {
                return False;
            }

            if(!($user->password == $password)) {
                return False;
            }
            $_SESSION['userId'] = $user->id;
            return True;
        }
    }




?>