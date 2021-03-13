<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doc_id', 'date', 'created_at','updated_at',
    ];
    /**
     * Appointments has many times.
     *
     * @return mixed
     */
    public function times(){
        return $this->hasMany(Time::class);
    }


}
