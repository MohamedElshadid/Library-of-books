<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lease extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = ['user_id','book_id','date'];
    protected $guarded = ['expire_date'];


}
