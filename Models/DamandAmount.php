<?php

namespace App\Models;

use App\Models\User;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DamandAmount extends Model
{
    use HasFactory;
    protected $fillable = [
        'medicine_id',
        'count',
        'status',
        'repository_id',
    ];

    // علاقة مع الدواء
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
    public function repository()
    {
        return $this->belongsTo(User::class);
    }
}
