<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index()
    {
        $customers = Customer::paginate(15);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customerName' => 'required|string|max:50',
            'contactLastName' => 'nullable|string|max:50',
            'contactFirstName' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'addressLine1' => 'nullable|string|max:50',
            'addressLine2' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:50',
            'postalCode' => 'nullable|string|max:15',
            'country' => 'nullable|string|max:50',
            'creditLimit' => 'nullable|numeric|min:0',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified customer.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'customerName' => 'required|string|max:50',
            'contactLastName' => 'nullable|string|max:50',
            'contactFirstName' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'addressLine1' => 'nullable|string|max:50',
            'addressLine2' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:50',
            'postalCode' => 'nullable|string|max:15',
            'country' => 'nullable|string|max:50',
            'creditLimit' => 'nullable|numeric|min:0',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.show', $customer)->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }

    /**
     * Display orders for a specific customer.
     */
    public function orders(Customer $customer)
    {
        $orders = $customer->orders()->paginate(15);
        return view('customers.orders', compact('customer', 'orders'));
    }
}
