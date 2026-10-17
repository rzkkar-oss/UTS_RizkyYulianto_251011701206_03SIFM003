<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('bike')->latest('id')->get();

        return view('rentals.index', compact('rentals'));
    }

    public function create(Bike $bike)
    {
        if (! $bike->available) {
            return redirect()->route('bikes.show', $bike)
                ->with('error', 'Sepeda ini sedang disewa dan belum tersedia.');
        }

        return view('rentals.create', [
            'bike'    => $bike,
            'methods' => Rental::PAYMENT_METHODS,
        ]);
    }

    public function store(Request $request, Bike $bike)
    {
        $data = $request->validate([
            'renter_name'    => ['required', 'string', 'max:100'],
            'renter_phone'   => ['required', 'regex:/^\+?[0-9\s\-]{8,16}$/'],
            'start_date'     => ['required', 'date', 'after_or_equal:today'],
            'days'           => ['required', 'integer', 'min:1', 'max:30'],
            'payment_method' => ['required', Rule::in(array_keys(Rental::PAYMENT_METHODS))],
        ], [
            'renter_name.required'      => 'Nama penyewa wajib diisi.',
            'renter_name.max'           => 'Nama penyewa maksimal 100 karakter.',
            'renter_phone.required'     => 'Nomor HP wajib diisi.',
            'renter_phone.regex'        => 'Format nomor HP tidak valid (8–16 digit, boleh diawali +).',
            'start_date.required'       => 'Tanggal mulai sewa wajib diisi.',
            'start_date.date'           => 'Tanggal tidak valid.',
            'start_date.after_or_equal' => 'Tanggal mulai tidak boleh sebelum hari ini.',
            'days.required'             => 'Jumlah hari sewa wajib diisi.',
            'days.integer'              => 'Jumlah hari harus berupa angka.',
            'days.min'                  => 'Minimal sewa 1 hari.',
            'days.max'                  => 'Maksimal sewa 30 hari.',
            'payment_method.required'   => 'Pilih metode pembayaran.',
            'payment_method.in'         => 'Metode pembayaran tidak valid.',
        ]);

        $rental = DB::transaction(function () use ($data, $bike) {
            $locked = Bike::whereKey($bike->id)->lockForUpdate()->first();

            if (! $locked || ! $locked->available) {
                return null;
            }

            do {
                $code = 'SWA-' . now()->format('ymd') . '-' . strtoupper(Str::random(4));
            } while (Rental::where('rental_code', $code)->exists());

            $rental = Rental::create([
                'rental_code'    => $code,
                'bike_id'        => $locked->id,
                'renter_name'    => $data['renter_name'],
                'renter_phone'   => $data['renter_phone'],
                'start_date'     => $data['start_date'],
                'days'           => (int) $data['days'],
                'total_price'    => $locked->rent_price * (int) $data['days'],
                'payment_method' => $data['payment_method'],
                'status'         => 'aktif',
            ]);

            $locked->update(['available' => false]);

            return $rental;
        });

        if (! $rental) {
            return redirect()->route('bikes.show', $bike)
                ->with('error', 'Maaf, sepeda ini baru saja disewa orang lain.');
        }

        return redirect()->route('rentals.show', $rental)
            ->with('success', 'Pemesanan berhasil! Simpan kode sewa Anda.');
    }

    public function show(Rental $rental)
    {
        $rental->load('bike');

        return view('rentals.show', compact('rental'));
    }

    public function finish(Rental $rental)
    {
        if ($rental->status === 'aktif') {
            DB::transaction(function () use ($rental) {
                $rental->update(['status' => 'selesai']);
                Bike::whereKey($rental->bike_id)->update(['available' => true]);
            });
        }

        return redirect()->route('rentals.index')
            ->with('success', 'Sewa ' . $rental->rental_code . ' ditandai selesai. Sepeda tersedia lagi.');
    }
}