<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderCancelled;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->authorizeResource(Order::class, 'order');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(?string $locale, Order $order)
    {
        return view(
            'front.orders.show',
            [
                'order' => $order,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(?string $locale, Request $request, Order $order)
    {
        $order->status = 'cancelled';
        $order->save();
        // $owner = $order->restaurant->user;
        // $owner->notify(new OrderCancelled($order));
        return back()->with('warning', 'Order cancelled');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
