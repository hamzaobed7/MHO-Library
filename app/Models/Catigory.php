<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catigory extends Model
{
    protected $table="catygories";
    protected $primaryKey="id";
    protected $fillable = [
        'type',
        'description',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }
}
