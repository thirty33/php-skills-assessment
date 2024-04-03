<?php

namespace FmTod\Quotes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [
        'author',
        'quote'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
