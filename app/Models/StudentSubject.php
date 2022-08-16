<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    use HasFactory;

    protected $table = "student_subject";

    protected $fillable = [
        'point',
        'student_id',
        'subject_id',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
