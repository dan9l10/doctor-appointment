<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analyzes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path','meet_id'
    ];
    /**
     * Analyzes belongs to meets.
     *
     * @return mixed
     */
    public function meet()
    {
        return $this->belongsTo(Meet::class);
    }
}
