<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produk;

class HomeController extends Controller
{
    //
    public function index()
    {
        //latest paginate 10 -> membatasi data yang ditampilkan 10
        $produks = Produk::latest()->paginate(10);
        //Memanggil view index, kemudian parsing data ke view menggunakan helper compact
        return view('produk.home', compact('produks'));
    }
}
