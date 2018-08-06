<?php 

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Comment extends Model {
        protected $table='comments';

        protected $fillable = [
            'article_id',
            'autor_id',
            'comment'
        ];
    }








?>