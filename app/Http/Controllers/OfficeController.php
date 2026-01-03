<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the offices.
     */
    public function index()
    {
        $offices = Office::paginate(15);
        return view('offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new office.
     */
    public function create()
    {
        return view('offices.create');
    }

    /**
     * Store a newly created office in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'officeCode' => 'required|string|max:10|unique:offices',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:50',
            'addressLine1' => 'required|string|max:50',
            'addressLine2' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:50',
            'country' => 'required|string|max:50',
            'postalCode' => 'nullable|string|max:15',
            'territory' => 'nullable|string|max:10',
        ]);

        Office::create($validated);

        return redirect()->route('offices.index')->with('success', 'Office created successfully.');
    }

    /**
     * Display the specified office.
     */
    public function show(Office $office)
    {
        return view('offices.show', compact('office'));
    }

    /**
     * Show the form for editing the specified office.
     */
    public function edit(Office $office)
    {
        return view('offices.edit', compact('office'));
    }

    /**
     * Update the specified office in storage.
     */
    public function update(Request $request, Office $office)
    {
        $validated = $request->validate([
            'officeCode' => 'required|string|max:10|unique:offices,officeCode,' . $office->officeCode . ',officeCode',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:50',
            'addressLine1' => 'required|string|max:50',
            'addressLine2' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:50',
            'country' => 'required|string|max:50',
            'postalCode' => 'nullable|string|max:15',
            'territory' => 'nullable|string|max:10',
        ]);

        $office->update($validated);

        return redirect()->route('offices.show', $office)->with('success', 'Office updated successfully.');
    }

    /**
     * Remove the specified office from storage.
     */
    public function destroy(Office $office)
    {
        $office->delete();

        return redirect()->route('offices.index')->with('success', 'Office deleted successfully.');
    }
}
