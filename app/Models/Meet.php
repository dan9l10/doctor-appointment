<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_doc', 'id_user', 'time', 'date', 'complaint', 'diagnosis', 'status', 'created_at', 'updated_at',
    ];
    /**
     * A meet.
     *
     * @return mixed
     */
    public function times()
    {
        return $this->belongsTo(Time::class,'time');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class,'id_doc','id');
    }
}
