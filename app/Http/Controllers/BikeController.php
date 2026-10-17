<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    /** Halaman beranda */
    public function home()
    {
    $featured = Bike::orderByDesc('available')->orderBy('id')->take(4)->get();

    $stats = [
        'total'     => Bike::count(),
        'available' => Bike::where('available', true)->count(),
        'types'     => Bike::distinct()->count('type'),
        'min_price' => Bike::min('rent_price'),
    ];

    $slides = Bike::orderBy('id')->get();   // <-- BARIS BARU

    return view('home', compact('featured', 'stats', 'slides'));   // <-- tambah 'slides'
    }

    /** Halaman daftar sepeda (+ filter tipe & pencarian merek) */
    public function index(Request $request)
    {
        $types = Bike::select('type')->distinct()->orderBy('type')->pluck('type');

        $query = Bike::query();

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('q')) {
            $query->where('brand', 'like', '%' . $request->input('q') . '%');
        }

        $bikes = $query->orderBy('id')->get();

        return view('bikes.index', compact('bikes', 'types'));
    }

    /** Halaman detail sepeda */
    public function show(Bike $bike)
    {
        $related = Bike::where('id', '!=', $bike->id)
            ->where('type', $bike->type)
            ->take(3)
            ->get();

        if ($related->count() < 3) {
            $related = Bike::where('id', '!=', $bike->id)->inRandomOrder()->take(3)->get();
        }

        return view('bikes.show', compact('bike', 'related'));
    }
}
