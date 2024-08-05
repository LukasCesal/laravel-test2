<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holidays extends Model
{
    use HasFactory;
    protected $table = 'holidays';
    protected $fillable = ['country', 'name', 'day', 'month'];

    public function isHoliday($country, $timestamp){
        
}
}