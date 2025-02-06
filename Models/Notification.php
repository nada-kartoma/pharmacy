<?php

namespace App\Models;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'medicine_id',
        'message',
        'is_read',
    ];

    // علاقة مع الدواء
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
