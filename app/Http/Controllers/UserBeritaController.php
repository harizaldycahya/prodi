<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserBeritaController extends Controller
{
    public function index($bahasa)
    {
        // DATA NAVBAR

        if ($bahasa == 'en') {

            $beritas = DB::table('beritas')->where('bahasa', 'english')->get();
            $menus = DB::table('menus')->where('menus.bahasa', 'english')->orderBy('menus.urutan')->get();
        } else {

            $beritas = DB::table('beritas')->where('bahasa', 'indonesia')->get();
            $menus = DB::table('menus')->where('menus.bahasa', 'indonesia')->orderBy('menus.urutan')->get();
        }

        $contents = DB::table('contents')
            ->leftJoin('menus', 'contents.menu_id', 'menus.id')
            ->orderBy('contents.urutan')
            ->get();

        // DATA NAVBAR END

        return view('user.berita.index')
            ->with('beritas', $beritas)
            ->with('menus', $menus)
            ->with('contents', $contents)
            ->with('bahasa', $bahasa);
    }

    public function show($bahasa, $konten)
    {
        // DATA NAVBAR
        if ($bahasa == 'en') {
            $menus = DB::table('menus')->where('menus.bahasa', 'english')->orderBy('menus.urutan')->get();
        } else {
            $menus = DB::table('menus')->where('menus.bahasa', 'indonesia')->orderBy('menus.urutan')->get();
        }

        $contents = DB::table('contents')
            ->leftJoin('menus', 'contents.menu_id', 'menus.id')
            ->orderBy('contents.urutan')
            ->get();
        // DATA NAVBAR END

        $berita = DB::table('beritas')
            ->where('beritas.judul', $konten)
            ->get()
            ->first();

        return view('user.berita.show')
            ->with('berita', $berita)
            ->with('menus', $menus)
            ->with('contents', $contents)
            ->with('bahasa', $bahasa);
    }
}