<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'details',
        'compenent',
        'price',
        'count',
        'pharmacist',
        'time'
       

    ];
    public function pharmacy(){
        return $this -> belongsTo(User::class ,'pharmacist' );
    }
}
