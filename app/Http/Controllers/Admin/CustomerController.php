<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')->latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        $rooms = \App\Models\Room::where('status', 'available')->get();
        return view('admin.customers.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'room_id' => ['required', 'exists:rooms,id'],
            'duration' => ['required', 'integer', 'min:1'],
        ]);

        // Generate dummy email since it's required by default User model but not used
        $dummyEmail = $request->username . '@kosbulinda.local';

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $dummyEmail,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'is_active' => true,
        ]);

        // Handle Booking Creation
        $room = \App\Models\Room::findOrFail($request->room_id);
        $startDate = now();
        $endDate = now()->addMonths((int) $request->duration);
        $totalPrice = $room->price * $request->duration;

        \App\Models\Booking::create([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_price' => $totalPrice,
            'payment_status' => 'pending', // Default pending until paid
            'status' => 'active',
        ]);

        // Update Room Status
        $room->update(['status' => 'full']);

        return redirect()->route('admin.customers.index')->with('success', 'Akun Pelanggan berhasil dibuat.');
    }

    public function edit(string $id)
    {
        $customer = User::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, string $id)
    {
        $customer = User::findOrFail($id);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Rules\Password::defaults()];
        }

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            // Update dummy email if username changes to keep it consistent
            'email' => $request->username . '@kosbulinda.local',
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $customer->update($data);

        return redirect()->route('admin.customers.index')->with('success', 'Akun Pelanggan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Akun Pelanggan berhasil dihapus.');
    }

    public function toggleStatus(string $id)
    {
        $customer = User::findOrFail($id);
        $customer->is_active = !$customer->is_active;
        $customer->save();

        $status = $customer->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Akun Pelanggan berhasil $status.");
    }
}
