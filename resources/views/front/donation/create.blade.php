@extends('layouts.front')

@section('title', $campaign->title)
    
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form action="" method="post">
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
                                    <input type="number" class="form-control" name="nominal" placeholder="Masukkan nominal donasi" value="0">
                                </div>

                                <div class="alert alert-primary mt-3">
                                    Donasi mulai dari Rp. berapapun dengan Dompet Kebaikan.
                                </div>

                                @if (auth()->user()->hasRole('admin'))
                                    <div class="form-group">
                                        <label for="user_id">Donatur</label>
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option value="" disabled selected>Pilih donatur</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">098989898</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="anonim" name="anonim">
                                            <label for="anonim" class="custom-control-label">Sembunyikan nama saya (Anonim)</label>
                                        </div>
                                    </div>
                                @else
                                    <input type="text" name="user_id" value="{{ auth()->id() }}">
                                    <div class="form-group">
                                        <label for="">098989898</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="anonim" name="anonim">
                                            <label for="anonim" class="custom-control-label">Sembunyikan nama saya (Anonim)</label>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="form-group">
                                    <textarea name="support" id="support" rows="4" class="form-control" placeholder="Tulis dukungan atau doa untuk penggalangan dana ini. Contoh: Semoga cepat sembuh, ya!"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection