<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\PointTransaction;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function points_details(Request $request)
    {
        $userId = $request->user_id;
        $seller_points_transactions = PointTransaction::with('user_seller', 'listings')  //
            ->where('seller_id', $userId)
            ->get();

        return response()->json([
            'success' => true,
            'seller_points_transactions' => $seller_points_transactions
        ]);
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
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Point $point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Point $point)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Point $point)
    {
        //
    }
}