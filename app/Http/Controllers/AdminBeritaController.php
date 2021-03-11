<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Path\To\DOMdocument;
use Intervention\Image\ImageManagerStatic as Image;

class AdminBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $beritas = DB::table('beritas')->get();
        return view('admin.berita.index')->with('beritas', $beritas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('thumbnail')) {
            $thumbnailName = time() . $request->file('thumbnail')->getClientOriginalName();
            $request->file('thumbnail')->move(public_path('storage/berita/'), $thumbnailName);
        } else {
            $thumbnailName = 'default.png';
        }

        if (!empty($request->konten)) {
            $storage = 'storage/content';
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($request->konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
            libxml_clear_errors();
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $img) {
                $src = $img->getAttribute('src');
                if (preg_match('/data:image/', $src)) {
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $group);
                    $mimetype = $group['mime'];
                    $fileNameContent = uniqid();
                    $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                    $filepath = ("$storage/$fileNameContentRand.$mimetype");
                    $image = Image::make($src)
                        ->encode($mimetype, 100)
                        ->save(public_path($filepath));
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                    $img->setAttribute('class', 'img-fluid');
                }
            }
        }

        $berita = new Berita();
        $berita->judul = $request->input('judul');
        $berita->thumbnail = $thumbnailName;
        $berita->kategori = $request->input('kategori');
        $berita->bahasa = $request->input('bahasa');
        if (!empty($request->konten)) {
            $berita->konten = $dom->saveHTML();
        } else {
            $berita->konten = " - ";
        }


        $berita->penulis = Auth::user()->name;
        $berita->save();

        return redirect()->route('admin.berita.index')->with('success', 'berita berhasil dibuat !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($judul)
    {
        $berita = DB::table('beritas')
            ->where('beritas.judul', $judul)
            ->get()
            ->first();

        return view('admin.berita.show')->with('berita', $berita);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berita = DB::table('beritas')
            ->where('beritas.id', $id)
            ->get()
            ->first();

        return view('admin.berita.edit')->with('berita', $berita);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('thumbnail')) {
            $thumbnailName = time() . $request->file('thumbnail')->getClientOriginalName();
            $request->file('thumbnail')->move(public_path('storage/berita/'), $thumbnailName);
        } else {
            $thumbnailName = 'default.png';
        }

        if (!empty($request->konten)) {
            $storage = 'storage/content';
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($request->konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
            libxml_clear_errors();
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $img) {
                $src = $img->getAttribute('src');
                if (preg_match('/data:image/', $src)) {
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $group);
                    $mimetype = $group['mime'];
                    $fileNameContent = uniqid();
                    $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                    $filepath = ("$storage/$fileNameContentRand.$mimetype");
                    $image = Image::make($src)
                        ->encode($mimetype, 100)
                        ->save(public_path($filepath));
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                    $img->setAttribute('class', 'img-fluid');
                }
            }
        }

        $berita = Berita::find($id);
        $berita->judul = $request->input('judul');
        $berita->kategori = $request->input('kategori');
        $berita->bahasa = $request->input('bahasa');
        $berita->thumbnail = $thumbnailName;
        if (!empty($request->konten)) {
            $berita->konten = $dom->saveHTML();
        } else {
            $berita->konten = " - ";
        }
        $berita->penulis = Auth::user()->name;
        $berita->save();

        return redirect()->route('admin.berita.index')->with('success', 'berita berhasil diedit !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = Berita::find($id);
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'berita berhasil dihapus !!');
    }
}