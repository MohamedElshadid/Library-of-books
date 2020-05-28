<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favourite extends Model
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }
    protected $fillable = array('user_id', 'book_id');




}
