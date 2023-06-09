@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Daftar Admin'])
<div class="row mt-4 mx-4">
    <div class="col-12">

        <div class="card mb-4">
            <div id="alert">
                @include('components.alert')
            </div>
            <div class="card-header pb-0">
                <h6>Users</h6>
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
                                    Username
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama
                                </th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Email
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Level
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Alamat
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @foreach ($dataUser as $user)
                            <tr class="admin-item" data-name="{{ strtolower($user->name) }}">
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
                                            <h6 class="mb-0 text-sm">{{ $user->username }}</h6>
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
                                            <h6 class="mb-0 text-sm">{{ $user->email }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            @if ($user->roles == '1')
                                            <h6 class="mb-0 text-sm">Super Admin</h6>
                                            @elseif ($user->roles == '2')
                                            <h6 class="mb-0 text-sm"> Admin</h6>
                                            @elseif ($user->roles == '3')
                                            <h6 class="mb-0 text-sm"> Teknisi</h6>
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">

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
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        <form action="{{ route('admin.hapus', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                onclick="return confirm('Are you sure {{ $user->name }}?')">
                                                <i class="far fa-trash-alt me-2"></i>Delete
                                            </button>
                                        </form>
                                    </div>
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
<script>
    // Ambil elemen input dan tombol filter
    var inputFilter = document.getElementById('filter-name');
    var customerRows = document.getElementsByClassName('admin-item');

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