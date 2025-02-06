<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewDemand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'patient_id',
    ];


    public function patient()
    {
        return $this->belongsTo(User::class);
    }
}
