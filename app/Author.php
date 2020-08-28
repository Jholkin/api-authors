<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author
{
    protected $fillable = [
        'name', 'email', 'github', 'twitter', 'location', 'latest_article_published'
    ];

    protected $hidden = [];
}