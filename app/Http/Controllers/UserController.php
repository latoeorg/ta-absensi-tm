<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = User::all();
        $list_level = ['SUPERADMIN', 'ADMIN'];

        return view('pages.user.index', [
            'items' => $items,
            'list_level' => $list_level,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }
}
