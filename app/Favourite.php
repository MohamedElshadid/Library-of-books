<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favourite extends Model
{
    use SoftDeletes;

    protected $primaryKey = array('user_id', 'book_id');
    public $incrementing = false;
    protected $fillable = ['user_id','book_id'];




}
