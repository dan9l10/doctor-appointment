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
        'city',
        'DOB',
        'weight',
        'rise',
        'created_at',
        'updated_at ',
        'remember_token',
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



}
