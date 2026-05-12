<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $primaryKey = 'ISBN';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'ISBN',
        'category_id',
        'name',
        'price',
        'publication_date',
    ];
    protected $guarded = ['quantity','available_quantity'];

   public function category()
{
    return $this->belongsTo(Catigory::class, 'category_id');
}
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'authorbook', 'book_iSBN', 'author_id');
    }
}
