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
                            @foreach ($product as $row)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">{{ $row->name_product }}</h6>
                                        <span class="mb-2 text-xs">Id: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{ $row->id }}</span></span>
                                        <span class="mb-2 text-xs">Kecepatan: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{ $row->speed }}</span></span>
                                        <span class="mb-2 text-xs">Harga: <span
                                                class="text-dark ms-sm-2 font-weight-bold">Rp
                                                {{ $row->price }}</span></span>
                                        <span class="text-xs">Bandwith: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{ $row->bandwith }}</span></span>
                                    </div>
                                    <div class="ms-auto text-end">
                                        {{-- <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                            href="{{ route('produk.hapus', $row->id) }}"
                                            onclick="event.preventDefault();
                                                 if (confirm('Apakah Anda yakin ingin menghapus produk {{ $row->name_product }}?')) {
                                                     document.getElementById('produk.hapus-{{ $row->id }}').submit();
                                                 }">
                                            <i class="far fa-trash-alt me-2"></i>Delete
                                        </a> --}}
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                            onclick="return confirm('Are you sure?')"
                                            href="{{ route('produk.hapus', $row->id) }}"><i
                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                        <a class="btn btn-link text-dark px-3 mb-0"
                                            data-bs-toggle="modal{{ $row->id }}" data-bs-target="#exampleModalEdit"
                                            href="{{ route('produk.edit', $row->id) }}"><i
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
        <div class="modal fade" id="exampleModalEdit{{ $row->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">

                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h3 class="font-weight-bolder text-primary text-gradient">Edit Produk</h3>
                            </div>
                            <form action="{{ route('produk.tambah.update', $row->id) }}"
                                method="POST"role="form text-left">
                                @csrf
                                @method('POST')
                                <div class="card-body pb-3">
                                    <label>Nama Produk</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Nama" aria-label="Name"
                                            name="name_product" value="{{ old('name_product', $row->name_product) }}"
                                            aria-describedby="name-addon">
                                    </div>
                                    <label>Kecepatan</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Kecepatan" aria-label="Name"
                                            name="speed" value="{{ old('speed', $row->speed) }}"
                                            aria-describedby="name-addon">
                                    </div>
                                    <label>Harga</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Harga" aria-label="Name"
                                            name="price" value="{{ old('price', $row->price) }}"
                                            aria-describedby="name-addon">
                                    </div>
                                    <label>Banwith</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="bandwith" aria-label="Name"
                                            name="bandwith" value="{{ old('bandwith', $row->bandwith) }}"
                                            aria-describedby="name-addon">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn bg-gradient-primary">Edit</button>
                                </div>
                            </form>
                        </div>

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
                                    action="{{ route('produk.tambah') }}">
                                    @csrf
                                    <label>Nama Produk</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Nama Produk"
                                            name="name_product" id="name_product" aria-label="Name"
                                            aria-describedby="name-addon" required>
                                    </div>
                                    <label>Kecepatan</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Kecepatan"
                                            name="speed" id="speed" required aria-label="Name"
                                            aria-describedby="name-addon">
                                    </div>
                                    <label>Harga</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Harga" aria-label="Name"
                                            name="price" id="price" required aria-describedby="name-addon">
                                    </div>
                                    <label>Banwith</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="bandwith"
                                            name="bandwith" id="bandwith" required aria-label="Name"
                                            aria-describedby="name-addon">
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(function() {
                $(document).on('click', '#hapus ', function(e) {
                    e.preventDefault();
                    var link = $(this).attr("href");
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    })
                })

            }

        )
    </script> --}}
@endsection
