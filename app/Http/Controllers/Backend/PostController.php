<?php

namespace App\Http\Controllers\Backend;

use File;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\IncomingSearch;
use App\Post;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::orderBy('id', 'DESC')->get();
        return view('backend.post.index', compact('post'));
    }

    public function create()
    {
        $category = Category::orderBy('name', 'ASC')->get();
        return view('backend.post.create', compact('category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:50',
            'sub' => 'required|string|max:100',
            'content' => 'required|string',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
						'category_id' => 'required|string|exists:categories,id',
						'terms' => 'nullable'
        ]);

				$imgName = '';

        try {
            $imgName = 'art-'.time().'.'.$request->photo->getClientOriginalExtension();

						DB::beginTransaction();

            $file = $request->file('photo')->storeAs('public/post', $imgName);

            DB::table('posts')->insert([
                'title' => $request->judul,
                'subtitle' => $request->sub,
                'content' => $request->content,
                'image' => $imgName,
                'category_id' => $request->category_id
            ]);

						$post_id = DB::getPdo()->lastInsertId();

						for ($i=0; $i < count($request->terms); $i++) { 
								if ($request->terms[$i] != "") {
										DB::table('incoming_searches')->insert([
												'post_id' => $post_id,
												'search' => $request->terms[$i]
										]);
								}
						}

						DB::commit();

            session()->flash('success', 'Artikel di-Buat!');
            return redirect(route('artikel.index'));
        } catch (\Exception $e) {
						DB::rollBack();
            if(File::exists('storage/post/'.$imgName)) {
                File::delete('storage/post/'.$imgName);
            }
            session()->flash('error', 'Terjadi Kesalahan ! Error (PS01)');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $cry = $this->crypt($id);
        try {
						$post = Post::findOrFail($cry);
						$terms = $post->incomingsearch;
            $category = Category::orderBy('name', 'ASC')->get();
            return view('backend.post.edit', compact('post', 'category', 'terms'));
        } catch (\Exception $e) {
            session()->flash('Terjadi Kesalahan ! Error (PE02)');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:50',
            'sub' => 'required|string|max:100',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
            'category_id' => 'required|string|exists:categories,id'
        ]);

        $cry = $this->crypt($id);
        try {
            $post = Post::findOrFail($cry);

						$imgName = $post->image;
						if ($request->hasFile('photo')) {
							$imgName = 'art-'.time().'.'.$request->photo->getClientOriginalExtension();
						}

						DB::beginTransaction();

						DB::table('posts')->where('id', '=', $cry)->update([
							'title' => $request->judul,
							'subtitle' => $request->sub,
							'content' => $request->content,
							'image' => $imgName,
							'category_id' => $request->category_id
						]);

						DB::table('incoming_searches')->where('post_id', '=', $cry)->delete();

						for ($i=0; $i < count($request->terms); $i++) { 
							if ($request->terms[$i] != "") {
									DB::table('incoming_searches')->insert([
											'post_id' => $cry,
											'search' => $request->terms[$i]
									]);
							}
						}

						DB::commit();

            if ($request->hasFile('photo')) {
                if (File::exists('storage/post/'.$imgName)) {
                    File::delete('storage/post/'.$imgName);
                }
                $file = $request->file('photo')->storeAs('public/post', $imgName);
            }

            session()->flash('success', 'Perubahan Artikel di-Simpan!');
            return redirect(route('artikel.index'));
        } catch (\Exception $e) {
						DB::rollback();
            session()->flash('Terjadi Kesalahan ! Error (PU02)');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $cry = $this->crypt($id);
        try {
            $post = Post::findOrFail($cry);
            $img = $post->image;
            if(File::exists('storage/post/'.$img)) {
                File::delete('storage/post/'.$img);
            }
						$terms = IncomingSearch::where('post_id', '=', $cry)->delete();
						$post->delete();
            session()->flash('success', 'Artikel Berhasil di-Hapus!');
            return redirect(route('artikel.index'));

        } catch (\Exception $e) {
						dd($e);
            session()->flash('error', 'Terjadi Kesalahan ! Error (PD02)');
            return redirect()->back();
        }
    }

    public function publish(Request $request, $id)
    {
        $cry = $this->crypt($id);
        try {
            $post = Post::findOrFail($cry);
            if ($post->publish == '0') {
                $publish = '1';
                session()->flash('info', 'Artikel di-Publikasi!');
            } else {
                $publish = '0';
                session()->flash('error', 'Artikel di-Matikan!');
            }

            $post->update([
                'publish' => $publish,
                'published_at' => date('Y-m-d H:i:s')
            ]);
            return redirect(route('artikel.index'));
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan ! Error (PP02)');
            return redirect()->back();
        }
    }

    public function crypt($id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
            return $decrypted;
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            session()->flash('Terjadi Kesalahan ! Error (PCry02)');
            return redirect()->back();
        }
    }
}
