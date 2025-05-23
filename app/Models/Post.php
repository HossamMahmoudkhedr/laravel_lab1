<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'enabled',
        'user_id',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
