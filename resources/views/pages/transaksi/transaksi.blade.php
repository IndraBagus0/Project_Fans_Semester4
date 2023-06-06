@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Transaksi'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">

            <div class="card mb-4">
                <div>
                    <div class="card-header pb-0">
                        <h6>Transaksi</h6>
                    </div>
                    <div id="alert">
                        @include('components.alert')
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No
                                    </th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama
                                    </th>


                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Alamat
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Bukti Pembayaran
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ubah Produk
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 1)
                                @foreach ($customer as $user)
                                <tr class="customer-item" data-name="{{ strtolower($user->name) }}">
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $no++ }}</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $user->address }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                @if ($user->image)
                                                <a href="{{ asset('images/' . $user->image) }}" target="_blank">
                                                    <span class="text-dark ms-sm-2 font-weight-bold">Lihat
                                                        Foto</span>
                                                </a>
                                                @else
                                                <span class="text-dark ms-sm-2 font-weight-bold">Tidak Ada QR
                                                    Code</span>
                                                @endif

                                            </div>
                                    </td>

                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="dropdown">
                                                <form action="{{ route('ubah.produk', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <button class="btn btn-link text-primary px-3 mb-0" type="button"
                                                        id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        {{ $user->product->name_product }}
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        @foreach ($products as $product)
                                                        <li>
                                                            <button class="dropdown-item" type="submit"
                                                                name="selected_product" value="{{ $product->id }}">
                                                                {{ $product->name_product }}
                                                            </button>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <form id="status-form-{{ $user->id }}"
                                            action="{{ route('transaksi.edit', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="dropdown">
                                                <a class="btn btn-link text-primary text-gradient px-3 mb-0"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-pencil-alt text-dark me-2"></i>
                                                    Konfirmasi
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="event.preventDefault(); document.getElementById('status-{{ $user->id }}').value = 'active'; 
                                                                    document.getElementById('status-form-{{ $user->id }}').submit();">
                                                            Aktifkan
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <input type="hidden" name="status" id="status-{{ $user->id }}"
                                                value="{{ $user->status }}">
                                        </form>
                                        <form id="hapus-form-{{ $user->id }}"
                                            action="{{ route('pelanggan.hapus', $user->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Ambil elemen input dan tombol filter
    var inputFilter = document.getElementById('filter-name');
    var customerRows = document.getElementsByClassName('customer-item');

    // Tambahkan event listener untuk input filter
    inputFilter.addEventListener('input', function() {
        var filterValue = inputFilter.value.toLowerCase().trim();

        // Loop melalui setiap baris data pelanggan
        for (var i = 0; i < customerRows.length; i++) {
            var customerRow = customerRows[i];
            var customerName = customerRow.dataset.name.toLowerCase();

            // Cek apakah nama pelanggan mengandung nilai filter
            if (customerName.includes(filterValue)) {
                customerRow.style.display = 'table-row'; // Tampilkan baris data pelanggan
            } else {
                customerRow.style.display = 'none'; // Sembunyikan baris data pelanggan
            }
        }
    });
</script>
@endsection