<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function author(){
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function usersbooks(){
        return $this->belongsToMany(User::class, 'user_books');
    }

//    Accessors
    public function getcreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('y.m.d');
    }

    public function scopeSearch($query, $searchTerm){
        return $query->where('title', 'like', '%' . $searchTerm . '%')->
        orwhere('description', 'like', '%'.$searchTerm.'%');
    }

//    Mutators
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtoupper($value);
    }
}
