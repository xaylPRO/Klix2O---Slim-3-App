<?php 

    namespace App\Controllers;

    use App\Models\News;

    class NewsController extends Controller {
        protected $categories;

        function getNews() {
            $news = News::all();
            return $news;

        }

        function displayNews($request, $response) {
            $this->categories = News::select('category')->distinct()->get();
            $news = News::orderBy('id','desc')->get();
            return $this->view->render($response, 'news.twig', ['news' => $news, 'categories' => $this->categories]);
        }

        function Breaking(){
            $result = News::orderBy('id', 'desc')->first();
            return $result;
        }


        function addNews($request, $response){
            if(News::create([
                'title' => $request->getParam('title'),
                'content' => $request->getParam('content'),
                'category' => $request->getParam('category'),
                'writerId' => $request->getParam('writerId')
            ])) {
                return $response->withRedirect("/");
            }
        }

        function preview($request, $response, $args) {

            $result = News::where('id', $args['id'])->first();

            return $this->view->render($response, 'preview.twig', ['result' => $result]);
        }

        function byCategory($request, $response, $args) {
            $this->categories = News::select('category')->distinct()->get();
            $results = News::where('category', $args['category'])->get();
            return $this->view->render($response, 'news.twig', ['news' => $results, 'categories' => $this->categories]); 
        }

        function editArticle($request, $response, $args) {
            $result = News::where('id', $args['id'])->first();

            return $this->view->render($response, "editNews.twig", ["result" => $result]);
        }

        function updateArticle($request, $response) {
            News::where('id', $request->getParam('id'))->update(['title' => $request->getParam('title'), 'content' => $request->getParam('content'), 'category' => $request->getParam('category')]);
            return $response->withRedirect("/dashboard/news");
        }

        function deleteArticle($request, $response, $args) {
            $query = News::where('id', $args['id'])->delete();
            if($query) return $response->withRedirect("/dashboard/news");
        }

        function getAdd($request, $response) {
            return $this->view->render($response, 'addNews.twig');
        }

    }





?>