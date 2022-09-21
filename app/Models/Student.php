<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $datas = ['deleted_at'];
    protected $fillable = [
        'name',
        'email',
        'phone',
        'avatar',
        'address',
        'birthday',
        'gender',
        'faculty_id',
    ];
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class,'student_subject','student_id','subject_id')->withPivot('point');
    }
}
