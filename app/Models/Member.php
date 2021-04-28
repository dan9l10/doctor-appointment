<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Fillable fields for a Member.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'id_card',
        'id_spec',
        'phone',
        'male',
        'address',
        'avatar',
        'city',
        'DOB',
        'weight',
        'rise',
        'price',
        'experience',
    ];
    /**
     * A profile belongs to a user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * A profile belongs to a times.
     *
     * @return mixed
     */
    public function times()
    {
        return $this->hasManyThrough(Time::class, Appointment::class,'doc_id','appointment_id')->where('times.status','=','0');
    }
    /**
     * A profile belongs to a appointment.
     *
     * @return mixed
     */
    public function appointments(){
        return $this->hasMany(Appointment::class,'doc_id');
    }
    /**
     * A profile belongs to a specials.
     *
     * @return mixed
     */
    public function specials(){
        return $this->belongsTo(Special::class,'id_spec');
    }
    /**
     * A member has many to a meet.
     *
     * @return mixed
     */
    public function getMeetsForDoctor(){
        return $this->hasMany(Meet::class,'id_doc');
    }
    /**
     * A member has many to a meet.
     *
     * @return mixed
     */
    public function getMeetsForPatient(){
        return $this->hasMany(Meet::class,'id_user');
    }


}
