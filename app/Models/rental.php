<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    public const PAYMENT_METHODS = [
        'Tunai'         => 'Bayar saat ambil',
        'Transfer Bank' => 'BCA / Mandiri / BRI',
        'QRIS'          => 'Semua e-wallet',
        'GoPay'         => 'E-wallet',
        'OVO'           => 'E-wallet',
        'DANA'          => 'E-wallet',
    ];

    protected $fillable = [
        'rental_code', 'bike_id', 'renter_name', 'renter_phone',
        'start_date', 'days', 'total_price', 'payment_method', 'status',
    ];

    protected $casts = [
        'start_date'  => 'date',
        'days'        => 'integer',
        'total_price' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'rental_code';
    }

    public function bike(): BelongsTo
    {
        return $this->belongsTo(Bike::class);
    }

    public function getTotalLabelAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    public function getStartLabelAttribute(): string
    {
        return $this->start_date->copy()->locale('id')->translatedFormat('d F Y');
    }

    public function getEndLabelAttribute(): string
    {
        return $this->start_date->copy()->addDays($this->days)->locale('id')->translatedFormat('d F Y');
    }
}