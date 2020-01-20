<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'comments';

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
    protected $fillable = ['text', 'post_id', 'user_id'];

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function scopeSortByDate($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
