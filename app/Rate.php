<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use SoftDeletes;

    protected $primaryKey = array('user_id', 'book_id');
    public $incrementing = false;
    protected $fillable = ['user_id','book_id','rate'];


}
