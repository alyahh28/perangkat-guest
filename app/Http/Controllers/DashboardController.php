<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\LembagaDesa;
use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Tidak perlu Auth::check() lagi karena sudah ada middleware
        $stats = [
            'total_perangkat' => PerangkatDesa::count(),
            'total_lembaga' => LembagaDesa::count(),
            'total_rt' => Rt::count(),
            'total_rw' => Rw::count(),
        ];

        return view('pages.dashboard', compact('stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
