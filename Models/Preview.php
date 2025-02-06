<?php

namespace App\Models;

use App\Models\User;
use App\Models\Demand;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preview extends Model
{
    use HasFactory;
    protected $fillable = [
        'demand_id',
        'time',
        'preview',
        'patient_id',
        'pharmacist_id',
        'medicine_id'

    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
    public function demand()
    {
        return $this->belongsTo(Demand::class);
    }
    public function patient()
    {
        return $this->belongsTo(User::class);
    }
    public function pharmacist()
    {
        return $this->belongsTo(User::class);
    }
}
