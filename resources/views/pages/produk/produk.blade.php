@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'produk'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div id="alert">
                        @include('components.alert')
                    </div>
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">

                            <p class="mb-0">Daftar Produk</p>
                            <button type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                                data-bs-target="#exampleModalTambah">
                                Tambah Produk
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            @foreach ($product as $product)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">{{ $product->name_product }}</h6>
                                        <span class="mb-2 text-xs">Id: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{ $product->id }}</span></span>
                                        <span class="mb-2 text-xs">Kecepatan: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{ $product->speed }}</span></span>
                                        <span class="mb-2 text-xs">Harga: <span
                                                class="text-dark ms-sm-2 font-weight-bold">Rp
                                                {{ $product->price }}</span></span>
                                        <span class="text-xs">Bandwith: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{ $product->bandwith }}</span></span>
                                        <span class="text-xs">
                                            Qr:
                                            @if ($product->foto)
                                                <a href="{{ asset('storage/foto_produk/' . $product->foto) }}"
                                                    target="_blank">
                                                    <span class="text-dark ms-sm-2 font-weight-bold">Lihat Foto</span>
                                                </a>
                                            @else
                                                <span class="text-dark ms-sm-2 font-weight-bold">Tidak Ada QR Code</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="ms-auto text-end">
                                        {{-- <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                            href="{{ route('produk.hapus', $product->id) }}"
                                            onclick="event.preventDefault();
                                                 if (confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name_product }}?')) {
                                                     document.getElementById('produk.hapus-{{ $product->id }}').submit();
                                                 }">
                                            <i class="far fa-trash-alt me-2"></i>Delete
                                        </a> --}}
                                        <form action="{{ route('produk.hapus', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="far fa-trash-alt me-2"></i>Delete
                                            </button>
                                        </form>
                                        <a class="btn btn-link text-dark px-3 mb-0"
                                            href="{{ route('produk.edit', $product->id) }}"><i
                                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal tambah --}}
    <div class="modal fade" id="exampleModalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-primary text-gradient">Tambah Produk</h3>
                        </div>
                        <div class="card-body pb-3">
                            <form role="form text-left" id="produk.tambah" method="POST"
                                action="{{ route('produk.tambah') }}" enctype="multipart/form-data">
                                @csrf
                                <label for="name_product">Nama Produk</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nama Produk" name="name_product"
                                        id="name_product" required>
                                </div>
                                <label for="speed">Kecepatan</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Kecepatan" name="speed"
                                        id="speed" required>
                                </div>
                                <label for="price">Harga</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="Harga" name="price"
                                        id="price" required>
                                </div>
                                <label for="bandwith">Bandwith</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Bandwith" name="bandwith"
                                        id="bandwith" required>
                                </div>
                                <label for="foto">Foto</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="foto" id="foto" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn bg-gradient-primary">Tambah</button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    @include('layouts.footers.auth.footer')
    </div>
@endsection
