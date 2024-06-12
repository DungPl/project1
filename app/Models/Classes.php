<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $fillable = ['classname','classcore','timestart','classroomId','endtime','dayOfWeek'];

    public $timestamps = false;
    public function classroom()
    {
        return $this->hasMany(Classroom::class,'id','classroomId');
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollments::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments', 'class_id', 'student_id');
    }

   

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacherId');
    }
    public function absent()
    {
        return $this->hasMany(Absent::class,'classesId');
    }
}
