<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory, HasUlids;

    /**
     * Fillable attributes
     */
    protected $fillable = [
      'name',
      'brand',
      'company',  
      'maintenance_at',
      'fuel_usage_per_hour',
      'category_id'
    ];

    // Change time format to number / utc
    protected $dateFormat = 'U';
}
