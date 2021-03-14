<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    /**
     * A time has many meets.
     *
     * @return mixed
     */
    public function meets()
    {
        return $this->hasMany(Meet::class, 'time');
    }
}
