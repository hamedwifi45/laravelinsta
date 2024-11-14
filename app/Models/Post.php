<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['description','image','slug','user_id'];
    public function owner(){
        return $this->belongsTo(User::class , 'user_id');
    }
    public function comnet(){
        return $this->hasMany(Comnet::class);
}
}