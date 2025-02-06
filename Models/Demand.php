<?php

namespace App\Models;

use App\Models\User;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demand extends Model
{
    use HasFactory;
    protected $fillable = [
        'medicine_id',
        'count',
        'status',
        'patient_id',
    ];

    // علاقة مع الدواء
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
    public function patient()
    {
        return $this->belongsTo(User::class);
    }
}
