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
                    <div class="form-group">
                        <select name="" id="" class="form-control control-lg">
                            <option disabled selected>Semua Kategori</option>
                        </select>
                     </div>
                </div>    
                
                @for ($i = 0; $i < 6; $i++)
                    <div class="col-lg-4 col-md-6">
                        <div class="card mt-4">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body p-2">
                                <div class="d-flex justify-content-between text-dark">
                                    <p class="mb-0">Terkumpul: <strong>1jt</strong></p>
                                    <p class="mb-0">Goal: <strong>10jt</strong></p>
                                </div>
                            </div>
                            <div class="card-body p-2 border-top">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Lorem impus dolor sit amet</p>
                            </div>
                            <div class="card-footer bg-light p-2">
                                <a href="" class="btn btn-primary d-block rounded">
                                    <i class="fas fa-donate"></i>
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>    

    <div class="paginasi pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <nav aria-label="...">
                        <ul class="pagination mb-0">
                          <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">&laquo;</a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item active">
                            <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#">&raquo;</a>
                          </li>
                        </ul>
                      </nav>
                </div>
            </div>
        </div>
    </div>
@endsection