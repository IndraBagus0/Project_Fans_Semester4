@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Riwayat'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0">Riwayat</p>

                        <a class="btn btn-link text-dark text-sm mb-0 px-0 ms-1s" href="{{ route('export-excel') }}"><i
                                class="fas fa-file-excel text-lg me-1"></i>Excel</a>

                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="d-flex justify-content-end mb-3">
                        <label for="filter-start-date" class="me-2">Start Date:</label>
                        <input type="date" id="filter-start-date" class="form-control" placeholder="yyyy-mm-dd">
                        <label for="filter-end-date" class="ms-2">End Date:</label>
                        <input type="date" id="filter-end-date" class="form-control" placeholder="yyyy-mm-dd">
                    </div>
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
                                        Tanggal Transaksi
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nomor HP
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
                                @foreach ($riwayat as $row)
                                <tr class="customer-item" data-name="{{ strtolower($row->customer->name) }}"
                                    data-date="{{ $row->date_transaction }}">
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
                                                <h6 class="mb-0 text-sm">{{ $row->customer->name }}</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">
                                                    {{ $row->date_transaction }}</h6>

                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Rp {{ $row->total }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $row->customer->phone_number }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $row->customer->address }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="ms-auto text-center">
                                        {{-- <a class="btn btn-link text-dark text-sm mb-0 px-0 ms-1s"
                                                href="{{ route('export-pdf', $row->id) }}"><i
                                            class="fas fa-file-pdf text-lg me-1"></i>PDF</a> --}}
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                            onclick="return confirm('Are you sure want to delete {{ $row->total }} ?')"
                                            href="{{ route('riwayat.hapus', $row->id) }}"><i
                                                class="far fa-trash-alt me-2"></i>Delete</a>
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
    @include('layouts.footers.auth.footer')

</div>
<script>
    // Ambil elemen input dan tombol filter
    var inputFilter = document.getElementById('filter-name');
    var customerRows = document.getElementsByClassName('customer-item');
    var startDateFilter = document.getElementById('filter-start-date');
    var endDateFilter = document.getElementById('filter-end-date');

    // Tambahkan event listener untuk input filter
    inputFilter.addEventListener('input', function () {
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

    function formatDate(dateString) {
      var dateParts = dateString.split('-');
      return dateParts[1] + '/' + dateParts[2] + '/' + dateParts[0];
    }

    function filterByDate() {
      var startDate = startDateFilter.value;
      var endDate = endDateFilter.value;

      for (var i = 0; i < customerRows.length; i++) {
        var customerRow = customerRows[i];
        var transactionDate = customerRow.dataset.date;

        // Mengubah format tanggal dari "yyyy-mm-dd" menjadi "mm/dd/yyyy"
        var formattedStartDate = formatDate(startDate);
        var formattedEndDate = formatDate(endDate);
        var formattedTransactionDate = formatDate(transactionDate);

        if (
          (startDate === '' || formattedStartDate <= formattedTransactionDate) &&
          (endDate === '' || formattedEndDate >= formattedTransactionDate)
        ) {
          customerRow.style.display = 'table-row';
        } else {
          customerRow.style.display = 'none';
        }
      }
    }

    // Tambahkan event listener untuk input tanggal
    startDateFilter.addEventListener('input', filterByDate);
    endDateFilter.addEventListener('input', filterByDate);
</script>
@endsection