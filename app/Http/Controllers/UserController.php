<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $searchableColumns = ['name', 'email'];

        $data['dataUser'] = User::search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pages.user.index', $data);
    }

    public function create()
    {
        return view('admin.pages.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:100',
            'email'           => 'required|email|unique:users,email',
            'role'            => 'required|in:admin,viewer',
            'password'        => 'required|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'role.required' => 'Role wajib dipilih.',
            'role.in'       => 'Role tidak valid.',
        ]);

        // handle upload
        $imagePath = null;
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        User::create([
            'name'            => $validated['name'],
            'email'           => $validated['email'],
            'role'            => $validated['role'],
            'password'        => Hash::make($validated['password']),
            'profile_picture' => $imagePath,
        ]);

        return redirect()
            ->route('user.index')
            ->with('success', 'Penambahan Data User Berhasil!');
    }

    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);
        return view('admin.pages.user.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'            => 'required|string|max:100',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'role'            => 'required|in:admin,viewer',
            'password'        => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->role  = $validated['role'];

        // update password if provided
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // handle profile picture upload
        if ($request->hasFile('profile_picture')) {

            // delete old file if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // upload new one
            $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user->save();

        return redirect()
            ->route('user.index')
            ->with('success', 'Perubahan Data User Berhasil!');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // delete profile picture if exists
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        return redirect()
            ->route('user.index')
            ->with('success', 'Data User Berhasil Dihapus!');
    }
}
