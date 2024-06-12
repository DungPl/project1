<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    use HasFactory;
    protected $table='attendances';
    protected $fillable = ['studentId','classesId','attendancedate','present'];
    public function student(){
        return $this->hasMany(Student::class,'studentId','id');
    }
    public function class(){
        return $this->hasMany(Classes::class,'classesId','id');
    }
    public $timestamps = false;
}
