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
                            @foreach ($product as $prod)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">{{ $prod->name_product }}</h6>
                                        <span class="mb-2 text-xs">Id: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{ $prod->id }}</span></span>
                                        <span class="mb-2 text-xs">Kecepatan: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{ $prod->speed }}</span></span>
                                        <span class="mb-2 text-xs">Harga: <span
                                                class="text-dark ms-sm-2 font-weight-bold">Rp
                                                {{ $prod->price }}</span></span>
                                        <span class="text-xs">Bandwith: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{ $prod->bandwith }}</span></span>
                                        <span class="text-xs">
                                            Qr:
                                            @if ($prod->foto)
                                                <a href="{{ asset('storage/foto_produk/' . $prod->foto) }}" target="_blank">
                                                    <span class="text-dark ms-sm-2 font-weight-bold">Lihat Foto</span>
                                                </a>
                                            @else
                                                <span class="text-dark ms-sm-2 font-weight-bold">Tidak Ada QR Code</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <form action="{{ route('produk.hapus', $prod->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="far fa-trash-alt me-2"></i>Delete
                                            </button>
                                        </form>
                                        <a class="btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalEdit{{ $prod->id }}"
                                            href="{{ route('produk.edit', $prod->id) }}">
                                            <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit
                                        </a>
                                    </div>
                                </li>

                                {{-- modal edit --}}
                                <div class="modal fade" id="exampleModalEdit{{ $prod->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card card-plain">
                                                    <div class="card-header pb-0 text-left">
                                                        <h3 class="font-weight-bolder text-primary ">
                                                            Edit Produk</h3>
                                                    </div>
                                                    <form id="edit_produk_form"
                                                        action="{{ route('produk.update', $prod->id) }}" method="POST"
                                                        role="form text-left">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="card-body pb-3">
                                                            <label>Nama Produk</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Nama" aria-label="Name" name="name_product"
                                                                    value="{{ $prod->name_product }}"
                                                                    aria-describedby="name-addon">
                                                            </div>
                                                            <label>Kecepatan</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Kecepatan" aria-label="Name" name="speed"
                                                                    value="{{ $prod->speed }}"
                                                                    aria-describedby="name-addon">
                                                            </div>
                                                            <label>Harga</label>
                                                            <div class="input-group mb-3">
                                                                <input type="number" class="form-control"
                                                                    placeholder="Harga" aria-label="Name" name="price"
                                                                    value="{{ $prod->price }}"
                                                                    aria-describedby="name-addon">
                                                            </div>
                                                            <label>Banwith</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control"
                                                                    placeholder="bandwith" aria-label="Name" name="bandwith"
                                                                    value="{{ $prod->bandwith }}"
                                                                    aria-describedby="name-addon">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn bg-primary text-light">Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal tambah --}}
        <div class="modal fade" id="exampleModalTambah" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalSignTitle" aria-hidden="true">
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
                                        <input type="text" class="form-control" placeholder="Nama Produk"
                                            name="name_product" id="name_product" required>
                                    </div>
                                    <label for="speed">Kecepatan</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Kecepatan"
                                            name="speed" id="speed" required>
                                    </div>
                                    <label for="price">Harga</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Harga" name="price"
                                            id="price" required>
                                    </div>
                                    <label for="bandwith">Bandwith</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Bandwith"
                                            name="bandwith" id="bandwith" required>
                                    </div>
                                    <label for="foto">Foto</label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="foto" id="foto"
                                            required>
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
