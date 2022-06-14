<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use App\Models\MovieType;

class Movie extends Model
{
    use HasFactory;

    // this table does NOT have created_at & updated_at columns
    // = Laravel should not try to update them
    public $timestamps = false;

    public function movieType()
    {
        return $this->belongsTo(MovieType::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
