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
                                            Email
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Alamat
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Berlanggan
                                        </th>

                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($no = 1)
                                    @foreach ($customer as $user)
                                        <tr>
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
                                                        <h6 class="mb-0 text-sm">{{ $user->email }}</h6>
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
                                                        @if ($user->status == 'active')
                                                            <span class="badge badge-sm bg-gradient-success">active</span>
                                                        @elseif ($user->status == 'non active')
                                                            <span class="badge badge-sm bg-gradient-danger">non
                                                                active</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        @if ($user->subcribe_date)
                                                            <h6 class="mb-0 text-sm">{{ $user->subcribe_date }}</h6>
                                                        @else
                                                            <h6 class="mb-0 text-sm">Belum berlangganan</h6>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <form id="status-form-{{ $user->id }}"
                                                    action="{{ route('pelanggan.edit', $user->id) }}" method="POST">
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
                                                                    onclick="event.preventDefault(); document.getElementById('status-{{ $user->id }}').value = 'active'; document.getElementById('status-form-{{ $user->id }}').submit();">
                                                                    Aktifkan
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('pelanggan.hapus', $user->id) }}"
                                                                    onclick="event.preventDefault(); if (confirm('Apakah Anda yakin ingin menghapus transaksi {{ $user->id }}?')) document.getElementById('hapus-form-{{ $user->id }}').submit()">
                                                                    Hapus Transaksi
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
@endsection
