<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('id', 'ASC')->get();
        $role = Role::orderBy('id', 'ASC')->get();
        return view('backend.user.index', compact('user','role'));
    }

    public function create()
    {
        $role = Role::orderBy('id', 'ASC')->get();
        return view('backend.user.create', compact('role'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,name'
        ]);

        try {
            $user = User::firstOrCreate([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $user->assignRole($request->role);

            session()->flash('success', 'Berhasil Menambah Data Pengguna Baru!');
            return redirect(route('user.index'));
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan ! Error -> (D01)');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
            try {
                $edit = User::findOrFail($decrypted);
                $role = Role::orderBy('id', 'ASC')->get();
                $user = User::orderBy('id', 'ASC')->get();

                return view('backend.user.index', compact('user','role', 'edit'));
            } catch (\Exception $e) {
                session()->flash('error', 'Terjadi Kesalahan ! Error (D02)');
                return redirect()->back();
            }
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            session()->flash('error', 'Terjadi Kesalahan ! Error (D01)');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|exists:users',
            'password' => 'nullable|confirmed',
            'role' => 'required|string|exists:roles,name'
        ]);

        try {
            $decrypted = Crypt::decrypt($id);
            try {
                $user = User::findOrFail($decrypted);

                $password = $user->password;
                if ($request->password != null) {
                    $password = bcrypt($request->password);
                }

                $user->update([
                    'name' => $request->name,
                    'password' => $password
                ]);
                $user->assignRole($request->role);

                session()->flash('success', 'Berhasil Mengubah Data Pengguna!');
                return redirect(route('user.index'));
            } catch (\Exception $e) {
                session()->flash('error', 'Terjadi Kesalahan ! Error (D02)');
                return redirect()->back();
            }
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            session()->flash('error', 'Terjadi Kesalahan ! Error (D01)');
            return redirect()->back();
        }

    }

    public function destroy(Request $request, $id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
            try {
                $user = User::findOrFail($decrypted);
                $user->delete();

                session()->flash('success', 'Data Pengguna Berhasil di-Hapus!');
                return redirect(route('user.index'));
            } catch (\Exception $e) {
                session()->flash('error', 'Terjadi Kesalahan ! Error (D02)');
                return redirect()->back();
            }
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            session()->flash('error', 'Terjadi Kesalahan ! Error (D01)');
            return redirect()->back();
        }
    }
}
