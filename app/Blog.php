<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

	protected $fillable = ['title','content','club','link','created_at','updated_at'];

}
