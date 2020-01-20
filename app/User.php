<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
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
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $relations = ['posts', 'comments'];

    public function posts()
    {
        return $this->hasMany('App\Post', 'user_id')->sortByDate();
    }
  
    public function comments()
    {
        return $this->hasMany('App\Comment', 'user_id')->sortByDate();
    }

    public function scopeSortByDate($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function isAdmin()
    {
        $role = $this->role;
        if($role == 'admin') {
            return true;
        }
        return false;
    }
}