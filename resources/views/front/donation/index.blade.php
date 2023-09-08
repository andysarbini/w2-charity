@extends('layouts.front')

@section('title', 'Semua Kategori')

@push('css')
    <style>
        .form-control.control-lg {
            height: calc(1.5em + 1rem + 2px);
            padding: 0.5rem 1rem;
            line-height: 1.5;
            border-radius: 0.3rem;
        }

        .kategori .card {
            border: 0;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .1) !important;
            transition: .5s;
        }
        .kategori .card:hover,
        .kategori .card:focus {
            transform: translateY(-5-px);
        }

        .page-item .page-link {
            background: transparent;
            border-radius: .35rem;
            border: none;
            padding: .75rem 1rem;
            font-weight: 700;
            font-size: .9rem;
            color: #454545;
        }
        .page-item.disabled .page-link {
            background: transparent;
        }
        .page-item.active .page-link {
            z-index: 3;
            color: #ffffff;
            background: var(--primary);
            border-color: var(--primary);
        }
    </style>
@endpush
    
@section('content')
    {{-- Banner --}}
    <div class="banner bg-charity2">
        <div class="container">
            <h2 class="fa-2x text-white">Semua Kategori</h2>
        </div>
    </div>

    {{-- Kategori --}}
    <div class="tentang-kami bg-white">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    <h5>Halo #orang baik</h5>
                    <p>Pilih Campaign yang ingin Anda bantu</p>
                </div>
                <div class="col-lg-4">
                    {{-- @dd(request()->categories) --}}
                        <form action="{{ url('/donation') }}" class="form-group" method="GET">
                            <select name="categories[]" id="categories" class="select2" multiple required style="width: 100%;" onchange="$(this.form).submit()">
                                @foreach ($category as $key => $item)
                                    <option value="{{ $key }}" {{ request()->has('categories') && in_array($key, request()->categories) ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach            
                            </select>
                        </form>
                     
                </div>    
                
                @foreach ($campaign as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="card mt-4">
                            <div class="rounded-top" style="height: 200px; overflow: hidden;">
                                @if (Storage::disk('public')->exists($item->path_image))
                                    <img src="{{ Storage::disk('public')->url($item->path_image) }}" alt="..." class="card-img-top">
                                @else
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/0a/Standing_jaguar.jpg" class="card-img-top" alt="...">
                                @endif
                            </div>
                            <div class="card-body p-2">
                                <div class="d-flex justify-content-between text-dark">
                                    <p class="mb-0">Terkumpul: <strong>{{ format_uang($item->nominal) }}</strong></p>
                                    <p class="mb-0">Goal: <strong>{{ format_uang($item->goal) }}</strong></p>
                                </div>
                            </div>
                            <div class="card-body p-2 border-top">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text">{{ Str::limit($item->short_description, 100, ' ...') }}</p>
                            </div>
                            <div class="card-footer p-2">
                                <a href="{{ url('/donation/'. $item->id) }}" class="btn btn-primary d-block rounded">
                                    <i class="fas fa-donate"></i>
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>

        <div class="paginasi pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <x-pagination-card :model="$campaign" />
                    </div>
                </div>
            </div>
        </div>
    </div>     
@endsection

@includeIf('includes.select2', ['placeholder' => 'Semua kategori'])