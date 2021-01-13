@extends('layout/main')

@section('title','Produk Terbaru')

@section('container')   

    <div class="container mt-5">
    
        <div class="row row-cols-1 row-cols-md-4 g-4">
        <!-- Harus Taroh sini foreachnya agar layout grid card bisa sesuai class diatas ( 1 baris 4 item) -->
        @foreach ($produks as $produk)
        <div class="col" >

            <!-- h-100 biar semua card heightnya sama (100)-->
            <div class="card h-100" >
            <img src="{{ Storage::url('public/produks/'.$produk->foto) }}" class="img-fluid">
            <div class="card-body">
                <h5 class="card-title">{{ $produk->nama }}</h5>
                <p class="card-text" >Storage : {{ $produk->storage }}</p>
            </div>
            <div class="card-footer">
                <medium class="text-muted" >Harga :  IDR {{ $produk->harga }}</medium>
            </div>
            
            </div>
        </div>
        @endforeach
        </div>
    </div>
    
@endsection