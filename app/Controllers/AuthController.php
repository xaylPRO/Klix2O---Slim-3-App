<?php 

    namespace App\Controllers;

    use App\Models\User;


    class AuthController extends Controller {

        function getLogin($request, $response){
            return $this->view->render($response, 'login.twig');
        }

        function postLogin($request, $response){
            $username = $request -> getParam('username');
            $password = $request -> getParam('password');
            $status = $this->auth->verify($username, $password);
            if($status) {
                return $response->withRedirect('/');
            }
            return $response->withRedirect('/login');
        }


        function getRegister($request, $response) {
            return $this->view->render($response, 'register.twig');
        }

        function postRegister($request, $response){
            $existing_users = User::where('username',$request->getParam('username'))->first();
            $existing_emails = User::where('email',$request->getParam('email'))->first();
            if($request->getParam('password') == $request->getParam('passwordConf')) {

                if(!empty($existing_users)) if($existing_users['username'] == $request->getParam('username')) return False;
                if(!empty($existing_emails)) if($existing_emails['email'] == $request->getParam('email')) return False;
                
                User::create([
                    'username' => $request->getParam('username'),
                    'password' => $request->getParam('password'),
                    'email' => $request->getParam('email'),
                    'fName' => $request->getParam('fName'),
                    'lName' => $request->getParam('lName')
                ]);

                return $response->withRedirect("/login");
            }
        }
        function dashboardTest($request, $response) {
            return $this->view->render($response, 'templates/dashboard.twig');
        }

        function getEdit($request, $response, $args) {
            $result = User::where('id', $args['id'])->first();

            return $this->view->render($response, "edituser.twig", ["result" => $result]);
        }

        function postEdit($request, $response) {
            User::where('id', $request->getParam('id'))->update(['username' => $request->getParam('username'), 'fName' => $request->getParam('fName'), 'lName' => $request->getParam('lName'), 'password' => $request->getParam('password'), 'email' => $request->getParam('email'), 'status' => $request->getParam('status')]);
            return $response->withRedirect("/dashboard/users");
        }

        function deleteUser($request, $response, $args){
            User::where('id', $request->getParam('id'))->delete();
            return $response->withRedirect("/dashboard/users");
        }

    }







?>