<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meow extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    /**
     * Get the User who owns this Meow
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
