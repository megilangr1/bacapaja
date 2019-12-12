<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('id', 'ASC')->get();
        return view('backend.category.index', compact('category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:30|unique:categories'
        ]);

        try {
            $category = Category::firstOrCreate([
                'name' => $request->name
            ]);

            session()->flash('success', 'Berhasil Menambah Data Kategori!');
            return redirect(route('kategori.index'));
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan ! Error (KS01)');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
            try {
                $edit = Category::findOrFail($decrypted);
                $category = Category::orderBy('id', 'ASC')->get();
                return view('backend.category.index', compact('edit', 'category'));
            } catch (\Exception $e) {
                session()->flash('error', 'Terjadi Kesalahan ! Error (KE02)');
                return redirect()->back();
            }
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            session()->flash('error', 'Terjadi Kesalahan ! Error (KE01)');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:30|unique:categories'
        ]);

        try {
            $decrypted = Crypt::decrypt($id);
            try {
                $category = Category::findOrFail($decrypted);
                $category->update([
                    'name' => $request->name
                ]);

                session()->flash('success', 'Berhasil Menyimpan Perubahan!');
                return redirect(route('kategori.index'));
            } catch (\Throwable $th) {
                session()->flash('error', 'Terjadi Kesalahan ! Error (KU02)');
                return redirect()->back();
            }

        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            session()->flash('error', 'Terjadi Kesalahan ! Error (KU01)');
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
            try {
                $category = Category::findOrFail($decrypted);
                $category->delete();
                return redirect(route('kategori.index'));
            } catch (\Exception $e) {
                session()->flash('error', 'Terjadi Kesalahan ! Error (KD02)');
                return redirect()->back();
            }

        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            session()->flash('error', 'Terjadi Kesalahan ! Error (KD01)');
            return redirect()->back();
        }
    }
}
