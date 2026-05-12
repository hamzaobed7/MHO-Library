<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class author extends Model
{
    protected $table = 'authors';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'bio','gender','birthdate','birth_date'];
    protected $guarded = ['id'];

function books()
    {
        return $this->belongsToMany(Book::class, 'authorbook', 'author_id', 'book_iSBN');
    }

}

