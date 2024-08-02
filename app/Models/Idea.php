<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $with = [
        'user:id,name,image',
        'comments.user',
    ];

    protected $fillable = [
        'user_id',
        'content',

    ];

    // protected $guarded = [
    //     'id',
    //     'created_at',
    //     'updated_at',
    // ];
    // Makes it so these columns aren't allowed to be filled by the user

    public function comments(){
        return $this->hasMany(comment::class);
    } // Defines 1 to many relationship

    public function user(){
        return $this->belongsTo(User::class);
    } // Defines many to 1 relationship

    public function likes(){
        return $this->belongsToMany(User::class,'idea_like')->withTimestamps();
    }

}
