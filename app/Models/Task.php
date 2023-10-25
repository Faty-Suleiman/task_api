<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Task extends Model

{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'status', 'user_id'
    ];
    protected $status = [
        'pending' => 'Pending',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
    ];

    // public function getStatusAttribute($value)
    // {
    //     return $this->status[$value];
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

};



    

