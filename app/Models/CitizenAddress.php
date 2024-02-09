<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitizenAddress extends Model
{
    use HasFactory;
    protected $fillable = ['address', 'postcode', 'city_id', 'region_id', 'municipality_id'];
}
