<?php

namespace App\Models;

use App\Support\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'cuserial',
        'cuin',
        'seller',
        'pin',
        'amount',
        'vat_percentage',
        'purchase_date',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'status' => Status::class,
    ];
}
