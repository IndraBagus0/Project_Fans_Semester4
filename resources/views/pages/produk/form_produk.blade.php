@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'produk'])
    <div class="row">
        <div class="col-12">
            <form action="{{ isset($produk) ? route('produk.tambah.update', $produk->id) : route('produk.tambah.simpan') }}"
                method="post">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Text</label>
                    <input class="form-control" type="text" value="John Snow" id="example-text-input">
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Text</label>
                    <input class="form-control" type="text" value="John Snow" id="example-text-input">
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Text</label>
                    <input class="form-control" type="text" value="John Snow" id="example-text-input">
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Text</label>
                    <input class="form-control" type="text" value="John Snow" id="example-text-input">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    @include('layouts.footers.auth.footer')
    </div>
@endsection
