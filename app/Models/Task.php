<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $table = 'task';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category_id',
        'priority',
        'is_completed',
        'due_date',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   

}
