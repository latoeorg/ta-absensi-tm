<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $items = User::all();
        $list_level = ['SUPERADMIN', 'ADMIN', 'KARYAWAN'];

        return view('pages.user.index', [
            'items' => $items,
            'list_level' => $list_level,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request['password']);

        $check_email = User::where('email', $data['email'])->first();
        if ($check_email) {
            return redirect()->back()->with('error', 'Email sudah terdaftar');
        }

        $check_username = User::where('username', $data['username'])->first();
        if ($check_username) {
            return redirect()->back()->with('error', 'Username sudah terdaftar');
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();

        if ($data['password'] == '') {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $item = User::findOrFail($id);

        if ($item->email != $data['email']) {
            $check_email = User::where('email', $data['email'])->first();
            if ($check_email) {
                return redirect()->back()->with('error', 'Email sudah terdaftar');
            }
        }

        if ($item->username != $data['username']) {
            $check_username = User::where('username', $data['username'])->first();
            if ($check_username) {
                return redirect()->back()->with('error', 'Username sudah terdaftar');
            }
        }

        $item->update($data);
        return redirect()->route('user.index')->with('success', 'Data berhasil diubah');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('pages.user.update-profile', compact('user'));
    }

    public function edit(Request $request, string $id)
    {
        $data = $request->all();

        if ($data['password'] == '') {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $item = User::findOrFail($id);

        if ($item->email != $data['email']) {
            $check_email = User::where('email', $data['email'])->first();
            if ($check_email) {
                return redirect()->back()->with('error', 'Email sudah terdaftar');
            }
        }

        if ($item->username != $data['username']) {
            $check_username = User::where('username', $data['username'])->first();
            if ($check_username) {
                return redirect()->back()->with('error', 'Username sudah terdaftar');
            }
        }

        $item->update($data);
        return redirect('/update-profile');
    }

    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }
}
