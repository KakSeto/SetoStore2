@extends('layout/main')

@section('title','Daftar PRODUK')

@section('container')   
   
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('produk.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PRODUK</a>
                        <table class="table table-bordered" style="text-align:center">
                            <thead>
                              <tr>
                                <th scope="col">FOTO</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">STORAGE</th>
                                <th scope="col">HARGA</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($produks as $produk)
                                <tr>
                                    
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/produks/'.$produk->foto) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{ $produk->nama }}</td>
                                    <td>{{ $produk->storage }}</td>
                                    <td>{{ $produk->harga }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('produk.destroy', $produk->id) }}" method="POST">
                                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Produk belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $produks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection