<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produk;

use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //latest paginate 10 -> membatasi data yang ditampilkan 10
        $produks = Produk::latest()->paginate(10);
        //Memanggil view index, kemudian parsing data ke view menggunakan helper compact
        return view('produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'storage'   => 'required',
            'harga'     => 'required',
            'foto'      => 'required|image|mimes:png,jpg,jpeg',
        ]);
    
        //upload image
        $foto = $request->file('foto');
        $foto->storeAs('public/produks', $foto->hashName());

        $produk = Produk::create([
            'nama'      => $request->nama,
            'storage'   => $request->storage,
            'harga'     => $request->harga,
            'foto'     => $foto->hashName(),
        ]);
    
        if($produk){
            //redirect dengan pesan sukses
            return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('produk.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'storage'   => 'required',
            'harga'     => 'required',
        ]);
    
        //get data Produk by ID
        $produk = Produk::findOrFail($produk->id);
    
        if($request->file('foto') == "") {
    
            $produk->update([
                'nama'      => $request->nama,
                'storage'   => $request->storage,
                'harga'     => $request->harga,
            ]);
    
        } else {
    
            //hapus old image
            Storage::disk('local')->delete('public/produks/'.$produk->foto);
    
            //upload new image
            $foto = $request->file('foto');
            $foto->storeAs('public/produks', $foto->hashName());
    
            $produk->update([
                'foto'     => $foto->hashName(),
                'nama'      => $request->nama,
                'storage'   => $request->storage,
                'harga'     => $request->harga,
            ]);
    
        }
    
        if($produk){
            //redirect dengan pesan sukses
            return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('produk.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        Storage::disk('local')->delete('public/produks/'.$produk->foto);
        $produk->delete();

        if($produk){
            //redirect dengan pesan sukses
            return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('produk.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
