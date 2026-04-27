<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardOrderController extends Controller
{
    protected $statuses = [
        'pending', 'preparing', 'completed', 'cancelled'
    ];
    public function __construct() {
        $this->authorizeResource(Order::class, 'order');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurantId = request()->input('restaurant');
        $customerId = request()->input('customer');
        $from = request()->input('from');
        $to = request()->input('to');

        // $orders = Order::with(['restaurant', 'user'])->latest()->paginate(10);
        $orders = Order::filter($restaurantId, $customerId, $from, $to)->latest()->paginate(10);
        $restaurants = Restaurant::all();
        $users = User::customers()->orderBy('name')->get();
        return view(
            'dashboard.orders.index',
            [
                'orders' => $orders,
                'restaurants' => $restaurants,
                'users' => $users,
            ]
        );
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
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order->load(['orderItems.menuItem']);

        return view(
            'dashboard.orders.edit',
            [
                'order' => $order,
                'statuses' => $this->statuses,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in($this->statuses)]
        ]);
        $order->status = $data['status'];
        $order->save();
        return back()->with('status', 'Order status updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
