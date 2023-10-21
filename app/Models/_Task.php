<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class _Task extends Model
// class Post extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'status'
    ];
}
