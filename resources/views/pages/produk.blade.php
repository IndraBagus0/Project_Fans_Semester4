@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'produk'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">List Produk</p>
                            <button type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                                data-bs-target="#exampleModalTambah">
                                Tambah Produk
                            </button>
                            {{-- <button type="submit" class="btn btn-primary btn-sm ms-auto">Tambah Produk</button> --}}
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            @foreach ($produk as $row)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">{{ $row->nama_produk }}</h6>
                                        <span class="mb-2 text-xs">Id: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{ $row->id }}</span></span>
                                        <span class="mb-2 text-xs">Kecepatan: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{ $row->kecepatan }}</span></span>
                                        <span class="mb-2 text-xs">Harga: <span
                                                class="text-dark ms-sm-2 font-weight-bold">Rp
                                                {{ $row->harga_produk }}</span></span>
                                        <span class="text-xs">Bandwith: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{ $row->bandwith }}</span></span>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                        <a class="btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalEdit" href="javascript:;"><i
                                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal edit --}}
        <div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nama :</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Rp :</span>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Kecepatan :</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Bandwith :</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn bg-gradient-primary">Edit</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal tambah --}}
        <div class="modal fade" id="exampleModalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nama :</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Rp :</span>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Kecepatan :</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Bandwith :</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn bg-gradient-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
