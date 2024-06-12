<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Student extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    /**
 * The attributes that are mass assignable.
 *
 * @var array
 */
 protected $fillable = [
    'firstname','lastname', 'email', 'password','address','birthday','gender','phonenumber'
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden= [
        'password',
    ];
    public $timestamps = false;

    public function classes(){
        return $this->hasMany(Classes::class, 'teacherId', 'id');
       }
    public function attendance(){
        return $this->hasMany(Attendances::class,'studentId', 'id');
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollments::class);
    }

}
