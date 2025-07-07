<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'video',
        'discipline',
        'year',
        'favoris',
        'created_at',
    ];

    protected $attributes = [
        'favoris' => false,
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    
    public function getVideoAttribute($value)
    {
        if (str_contains($value, 'youtube.com/watch?v=')) {
            return preg_replace('/^.*watch\?v=([a-zA-Z0-9_-]+).*$/', 'https://www.youtube.com/embed/$1', $value);
        }

        if (str_contains($value, 'youtu.be/')) {
            return preg_replace('/^.*youtu\.be\/([a-zA-Z0-9_-]+).*$/', 'https://www.youtube.com/embed/$1', $value);
        }

        return $value;
    }

    public function disciplineName()
    {
        return [
            1 => 'blackball',
            2 => 'carambole',
            3 => 'snooker', 
            4 => 'americain',
        ][$this->discipline] ?? 'club';
    }
}
