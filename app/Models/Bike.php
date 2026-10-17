<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $table = 'bikes';

    // Tabel sesuai soal tidak memakai created_at / updated_at
    public $timestamps = false;

    protected $fillable = ['brand', 'type', 'rent_price', 'gear_count', 'image', 'available'];

    protected $casts = [
        'rent_price' => 'integer',
        'gear_count' => 'integer',
        'available'  => 'boolean',
    ];

    /** URL gambar; jika file belum ada di public/assets/images, pakai placeholder. */
    public function getImageUrlAttribute(): string
    {
        $path = 'assets/images/' . $this->image;

        if ($this->image && file_exists(public_path($path))) {
            return asset($path);
        }

        return asset('assets/images/bike-placeholder.svg');
    }

    /** Contoh: Rp 75.000 */
    public function getPriceLabelAttribute(): string
    {
        return 'Rp ' . number_format($this->rent_price, 0, ',', '.');
    }

    /** Contoh: #003 */
    public function getCodeAttribute(): string
    {
        return '#' . str_pad((string) $this->id, 3, '0', STR_PAD_LEFT);
    }
}
