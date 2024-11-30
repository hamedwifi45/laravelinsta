<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'bio',
        'privateaccont',
        'image',
        'email',
        'password',
        'description'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function commets(){
        return $this->hasMany(Comnet::class);
    }
    public function sug_user(){
        $following = auth()->user()->following()->wherePivot('confirm' , true)->get();
        return User::all()->diff($following)->except(auth()->id())->shuffle()->take(10); 
    }
    public function likes(){
        return $this->belongsToMany(Post::class , 'likes');
    }
    public function following(){
        return $this->belongsToMany(User::class , 'follows' , 'user_id' , 'following_user_id')->withTimestamps()->withPivot('confirm');
    }
    public function followers(){
        return $this->belongsToMany(User::class , 'follows'  , 'following_user_id' , 'user_id')->withTimestamps()->withPivot('confirm');
    }
    public function follow(User $user){
        if ($user->privateaccont) {
            return $this->following()->attach($user );
        }
        else{
            return $this->following()->attach($user , ['confirm' => true]);
        }
        
    }
    public function unfollow(User $user){
        return $this->following()->detach($user);
    }
    public function ispending(User $user){
        return $this->following()->where('following_user_id' , $user->id)->where('confirm' , false)->exists();
    }   
    public function isfollowers(User $user){
        return $this->followers()->where('user_id' , $user->id)->where('confirm' , true)->exists();
    }
    public function isfollowing(User $user){
        return $this->following()->where('following_user_id' , $user->id)->where('confirm' , true)->exists();
    }

}
