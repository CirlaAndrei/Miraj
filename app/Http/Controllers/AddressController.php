<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses;
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'county' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $address = new Address($request->all());
        $address->user_id = Auth::id();

        // If this is the first address, make it default
        if (Auth::user()->addresses()->count() === 0) {
            $address->is_default = true;
        }

        $address->save();

        return redirect()->route('profile')->with('success', 'Adresa a fost adăugată cu succes!');
    }

    public function edit(Address $address)
    {
        // Check if address belongs to user
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        return view('addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'nullable|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'county' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $address->update($request->all());

        return redirect()->route('profile')->with('success', 'Adresa a fost actualizată cu succes!');
    }

    public function destroy(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $address->delete();

        return redirect()->route('profile')->with('success', 'Adresa a fost ștearsă!');
    }

    public function setDefault(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        // Remove default from all other addresses
        Auth::user()->addresses()->update(['is_default' => false]);

        // Set this one as default
        $address->is_default = true;
        $address->save();

        return redirect()->route('profile')->with('success', 'Adresa principală a fost actualizată!');
    }
}
