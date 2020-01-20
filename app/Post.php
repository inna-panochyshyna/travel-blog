<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Eloquent\Uploadable;

class Post extends Model
{
    use Uploadable;
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'posts';
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'text', 'user_id', 'category_id', 'photo'];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function categories() 
    {
        return $this->belongsTo('App\Category','category_id');
    }
    
    public function user()
    { 
        return $this->belongsTo('App\User','user_id');
    }
    
    
    public function scopeSortByDate($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
	
	/**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
}
