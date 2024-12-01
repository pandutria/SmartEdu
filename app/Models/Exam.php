<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'created_at',
        'due_date',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
