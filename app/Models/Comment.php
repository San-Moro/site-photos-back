<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'message', 'photo_id'];
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
