<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {
    protected $table = 'replies';

    protected $fillable = [
        'writer_id',
        'base_id',
        'comment'
    ];
}






?>