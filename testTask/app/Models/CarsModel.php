<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarsModel extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'car_id';
    public $timestamps = false;
    use HasFactory;
}
