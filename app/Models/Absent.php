<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    use HasFactory;
    protected $table='absent';
    protected $fillable = ['studentId','classesId','leaveDate','reason','status'];
    public function student(){
        return $this->hasMany(Student::class,'studentId','id');
    }
    public function class()
    {
        return $this->belongsTo(Classes::class, 'classesId');
    }
    public $timestamps = false;
}
