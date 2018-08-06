<?php 

 namespace App\Controllers;

 use App\Models\Comment;
 use App\Models\Reply;

 class CommentController extends Controller {

    function comments() {
        $results = Comment::orderBy('id', 'desc')->get();
        return $results; 
    }

    function replies() {
        $results = Reply::get();
       return $results;
    }

    function addComment($request, $response) {
        Comment::create([
            'article_id' => $request->getParam('article_id'),
            'writer_id' => $request->getParam('writer_id'),
            'comment' => $request->getParam('comment'),
        ]);
        $article_id = $request->getParam('article_id');
        return $response -> withRedirect("/news/preview/$article_id");
    }

    function editComment($request, $response, $args) {
        $prev_value = Comment::find($args['id'])->select('comment')->first();

        return $this->view->render($response, 'editComment.twig', ['prev_value' => $prev_value, 'id'=>$args['id']]);
    }

    function delete($request, $response, $args) {
        Comment::where('id', $args['id'])->delete();
        $id = $args['userId'];
        return $response->withRedirect("/dashboard/comments/$id");
    }

 }





?>