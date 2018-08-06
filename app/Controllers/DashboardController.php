<?php 

    namespace App\Controllers;

    use App\Models\Comment;
    use App\Models\News;
    use App\Models\User;


    class DashboardController extends Controller {
        
        function home($requst, $response) {
            return $this->view->render($response, 'dashboardHome.twig');
        }

        function myComments($requst, $response, $args) {
            $comments = Comment::where('autor_id', $args['user_id'])->orderBy('id', 'desc')->get();
            $titles = array();
            foreach($comments as $comment) {
                $result = News::find($comment['article_id'])->first();
                array_push($titles, $result['title']);
            }

            if(!empty($comments)) {

                return $this->view->render($response, 'myComments.twig', ['comments' => $comments, 'titles' => $titles]);

            }
            return False;
        }

        function users($request, $response) {
            $users = User::all();

            return $this->view->render($response, 'users.twig', ['users'=> $users]);
        }

        function listNews($request, $response) {
            $news  = News::all();

            return $this->view->render($response, 'dashboardNews.twig', ['news' => $news]);
        }
    }




?>