<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $totalOrders = Order::where('user_id', $user->id)->count();
        $totalSpent = Order::where('user_id', $user->id)->sum('total');
        $addressCount = Address::where('user_id', $user->id)->count();
        $recentOrders = Order::where('user_id', $user->id)
                            ->latest()
                            ->limit(5)
                            ->get();

        return view('admin.users.show', compact(
            'user',
            'totalOrders',
            'totalSpent',
            'addressCount',
            'recentOrders'
        ));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // Only allow admin status change if it's not the current user
        if ($request->has('is_admin') && $user->id !== Auth::id()) {
            $data['is_admin'] = true;
        } elseif ($user->id !== Auth::id()) {
            $data['is_admin'] = false;
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
                        ->with('success', 'Utilizator actualizat cu succes!');
    }

    public function destroy(User $user)
    {
        // Don't allow deleting yourself
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Nu poți șterge propriul cont!');
        }

        // Don't allow deleting other admins
        if ($user->is_admin) {
            return back()->with('error', 'Nu poți șterge un administrator!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                        ->with('success', 'Utilizator șters cu succes!');
    }
}
