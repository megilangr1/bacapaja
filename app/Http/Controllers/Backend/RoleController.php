<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::orderBy('id', 'ASC')->get();
        return view('backend.role.index', compact('role'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50'
        ]);

        try {
            $role = Role::firstOrCreate([
                'name' => $request->name
            ]);

            session()->flash('success', 'Data Role di-Tambahkan!');
            return redirect(route('role.index'));
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan !');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            session()->flash('success', 'Data Role di-Hapus!');
            return redirect(route('role.index'));
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan! Error');
            return redirect()->back();
        }
    }
}
