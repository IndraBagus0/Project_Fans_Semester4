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
                    {{--  --}}
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
