<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
class Post extends Model
{
	use SoftDeletes;
	use Searchable;

	protected $fillable=['title','contents','status','category_id','featured','slug','user_id'];

	protected $dates=['deleted_at'];

	/**
	    * Get the index name for the model.
	    *
	    * @return string
	    */
	   public function searchableAs()
	   {
	       return 'posts_index';
	   }
	   /**
        * Get the indexable data array for the model.
        *
        * @return array
        */
       public function toSearchableArray()
       {
           $array = $this->toArray();

           // Customize array...

           return $array;
       }


	public function getFeaturedAttribute($featured)
	{
		return asset($featured);
	}
    public function category(){


    	return $this->belongsTo('App\Category');
    }
	public  function tags(){
		return $this->belongsToMany('App\Tag','post_tag');
	}
	public  function user()
	{
		return $this->belongsTo('App\User');
	}
}
