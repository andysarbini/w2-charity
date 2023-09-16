@extends('layouts.front')

@section('title', $campaign->title)
    
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form action="{{ url('/donation/'. $campaign->id ) }}" method="post">
                    @csrf

                    <div class="card">
                        <div class="card-body d-flex">
                            <div class="thumbnail rounded w-25" style="overflow: hidden">
                                <div class="thumbnail rounded mt-4" style="overflow: hidden">
                                     @if (Storage::disk('public')->exists($campaign->path_image))
                                        <img src="{{ Storage::disk('public')->url($campaign->path_image) }}" alt="..." class="w-100">
                                    @else
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/0a/Standing_jaguar.jpg" class="w-100" alt="...">
                                    @endif
                                </div>
                            </div>

                                <div class="body ml-3">
                                    <h5>Anda akan berdonasi untuk:</h5>
                                    <p>{{ $campaign->title }}</p>
                                </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="bg-light rounded d-flex align-items-center p-3">
                                <h1 class="font-weight-bold w-25">Rp. </h1>
                                <div class="form-group w-75">
                                    <input type="number" class="form-control @error('nominal') is-invalid
                                    @enderror" name="nominal" placeholder="Masukkan nominal donasi" value="0">
                                    @error('nominal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="alert alert-primary mt-3">
                                Donasi mulai dari Rp. berapapun dengan Dompet Kebaikan.
                            </div>

                            @if (auth()->user()->hasRole('admin'))
                                <div class="form-group">
                                    <label for="user_id">Donatur</label>
                                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid
                                    @enderror select2">
                                        <option disabled selected>Pilih donatur</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}" data-phone="{{ $item->phone }}" >{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0 phone" style="display: none;">
                                    <label></label>                                       
                                </div>
                            @else
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <div class="form-group mb-0">
                                    <label>{{ auth()->user()->phone }}</label>                                       
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="anonim" name="anonim" >
                                    <label for="anonim" class="custom-control-label">Sembunyikan nama saya (Anonim)</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="support" id="support" rows="4" class="form-control" placeholder="Tulis dukungan atau doa untuk penggalangan dana ini. Contoh: Semoga cepat sembuh, ya!"></textarea>
                            </div>
                        </div>
                    </div>
                    

                    <div class="card mt-3">
                        <button class="btn btn-primary btn-block">Lanjutkan Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  
@endsection
<x-toast />

@includeIf('includes.select2')
@push('scripts')
    <script>
        $('[name=user_id]').on('change', function () {
            let value = $(this).val();
            // let phone = $(`[nama=user_id] option[value=${value.phone}]`).;
            // let phone = $(`[nama=user_id] option[value=${value}]`).getAttribute.phone;
            // let phone = $(`[nama=user_id] option[value=${value}]`).getAttribute('data-phone');
            // let phone = $(`[nama=user_id] option[value=${value}]`).find(':selected').data('phone');
            // let phone = $(`[nama=user_id] option[value=${value}]`).elements.find('data-phone');
            // let phone = $(`[nama=user_id] option[value=${value}]`).attr('data-phone'); // undefined
            let phone = $(`[nama=user_id] option[value=${value}]`).data('phone'); // undefined
            // let phone = $(`[name=user_id] option[value=${value}]`)
            // let phone = $(`[name=user_id] option[value=${value}]`).contentEditable; // undefined
            // let phone = $(`[name=user_id] option[value=${value}]`).on('contentEditable'); // gk ngaruh
            // let phone = $(`[name=user_id] option[value=${value}]`).attributes.getNamedItem("data-phone").value; // gk ngaruh
            // let phone = $(`[name=user_id] option[value=${value}]`).prevObject; // gk ngaruh

            $('.phone').show()
            $('.phone').text(phone)
        });
    </script>
@endpush