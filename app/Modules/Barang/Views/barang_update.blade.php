@extends('layouts.app')

@section('main')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <p class="kt-eyebrow mb-1">Entry Management</p>
                <h3 class="mb-0">Form Edit {{ $title }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">{{ $title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Edit {{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card kt-form-card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="fa fa-info-circle text-primary"></i>
                <span>Form Edit Data {{ $title }}</span>
            </div>
            <div class="card-body">
                @include('include.flash')
                <form class="form form-horizontal" action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                    <div class="form-body">
                        @csrf @method('patch')
                        @foreach ($forms as $key => $field)
                            <div class="row mb-3">
                                <div class="col-md-3 text-sm-start text-md-end pt-2">
                                    <label>{{ $field['label'] }}</label>
                                </div>
                                <div class="col-md-9 form-group">
                                    <x-dynamic-field :name="$key" :field="$field" />
                                    @error($key)
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                        <div class="row mb-3" id="gambar-preview-row" style="display:none;">
                            <div class="col-md-3 text-sm-start text-md-end pt-2">
                                <label>Preview Gambar</label>
                            </div>
                            <div class="col-md-9 form-group">
                                <img id="gambar-preview" src="{{ $barang->gambar ? asset('storage/barang/'.$barang->gambar) : '' }}" alt="Preview" style="max-width:220px; border-radius:8px; display:block;" />
                            </div>
                        </div>
                        <div class="offset-md-3 ps-2 pt-2 d-flex gap-2">
                            <button class="btn btn-primary icon icon-left" type="submit"><i class="fa fa-arrow-right"></i> Simpan</button>
                            <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                  </div>
                </form>
                <script>
                    (function(){
                        const input = document.querySelector('input[type=file][name=gambar]');
                        if(!input) return;
                        input.setAttribute('accept', 'image/*');
                        const previewRow = document.getElementById('gambar-preview-row');
                        const previewImg = document.getElementById('gambar-preview');
                        if(previewImg && previewImg.src) previewRow.style.display = 'block';
                        input.addEventListener('change', function(e){
                            const file = this.files && this.files[0];
                            if(!file) { previewRow.style.display = 'none'; return; }
                            const url = URL.createObjectURL(file);
                            previewImg.src = url;
                            previewRow.style.display = 'block';
                        });
                    })();
                </script>
            </div>
        </div>

    </section>
</div>
@endsection
