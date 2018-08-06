<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class News extends Model {
        protected $table = 'news';

        protected $fillable = [
            'title',
            'category',
            'content',
            'titleImage',
            'writerId'
        ];
    }


?>