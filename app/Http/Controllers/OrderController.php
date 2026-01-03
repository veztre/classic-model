<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::paginate(15);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'orderDate' => 'nullable|date',
            'requiredDate' => 'nullable|date',
            'shippedDate' => 'nullable|date',
            'status' => 'nullable|string|max:15',
            'comments' => 'nullable|string',
            'customerNumber' => 'required|integer|exists:customers,customerNumber',
        ]);

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load('customer', 'orderDetails.product');
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'orderDate' => 'nullable|date',
            'requiredDate' => 'nullable|date',
            'shippedDate' => 'nullable|date',
            'status' => 'nullable|string|max:15',
            'comments' => 'nullable|string',
            'customerNumber' => 'required|integer|exists:customers,customerNumber',
        ]);

        $order->update($validated);

        return redirect()->route('orders.show', $order)->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    /**
     * Generate PDF for the specified order.
     */
    public function generatePdf(Order $order)
    {
        $order->load('customer', 'orderDetails.product');

        $pdf = Pdf::loadView('orders.pdf', compact('order'));

        return $pdf->download('order-' . $order->orderNumber . '.pdf');
    }
}
