<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    use HasFactory;


    /**
     * A profile belongs to a member.
     *
     * @return mixed
     */
    public function member()
    {
        return $this->hasMany(\App\Models\Member::class);
    }
}
