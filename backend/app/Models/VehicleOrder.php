<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleOrder extends Model
{
    use HasFactory, HasUlids;

    /**
     * Fillable attributes
     */
    protected $fillable = [
        'driver',
        'company',
        'admin_id',
        'vehicle_id',
        'is_approved',
    ];

    // Change time format to number / utc
    protected $dateFormat = 'U';
}
