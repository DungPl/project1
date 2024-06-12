<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Classes;
class Teacher extends Authenticatable
{
    use Notifiable;
    /**
 * The attributes that are mass assignable.
 *
 * @var array
 */
 protected $fillable = [
    'firstname','lastname', 'email', 'password'
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
}
