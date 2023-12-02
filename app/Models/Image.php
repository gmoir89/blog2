<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path']; // Add this line

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
