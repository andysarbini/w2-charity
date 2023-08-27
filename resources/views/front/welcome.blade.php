@extends('layouts.front')

@section('title', 'Mari Kita Saling Berbagi')
    
@push('css')
    <style>
        /* Jumbotron */
        .jumbotron {
            height: 87.5vh;
            background-image: url('{{ asset("/img/bgcharity1.jpg") }}');
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 0;
        }
        .jumbotron .bg-white-50:hover {
            background: rgb(255, 255, 255, .15);
        }
        @media (max-width: 575.98.px) {
            .jumbotron .btn.rounded {
                width: 100% !important;
            }
            .jumbotron .display-4 {
                font-size: 42px;
            }
        }
        
        /* Info Campaign */
        @media (max-width: 575.98px) {
            .info-campaign .fa-2x.text {
                font-size: 24px;
            }
        }

        /* Dana Tersalurkan */
        .dana-tersalurkan .card {
            border:0;
            box-shadow: 0 1rem 3rem rgb(0, 0, 0, .1) !important;
            transition: 1s;
        }

        .dana-tersalurkan .card:hover,
        .dana-tersalurkan .card:focus {
            transform: translateY(-5-px);
        }

        /* Galang Dana2 */
        @media (max-width: 575.98px) {
            .galang-dana2 .fa-3x {
                font-size: 32px;
            }
            .galang-dana2 h3 {
                font-size: 18px;
            }
        }

    </style>
@endpush

@section('content')
    {{-- Jumbotron --}}
    <div class="jumbotron d-flex justify-content-center align-items-center mb-0">
        <div class="shadow-sm p-3 bg-white-50 rounded">
            <div class="card p-4 border text-center">
                <h1 class="display-4 font-weight-bold">GALANG DANA</h1>
                <p class="lead text-capitalize mt-3">Untuk hal yang anda perjuangkan demi kemanusiaan</p>
                <a href="" class="btn btn-primary btn-lg rounded w-50 m-auto">Galang Dana Sekarang</a>
            </div>
        </div>
    </div>

    {{-- Info Campaign --}}
        <div class="info-campaign bg-dark">
            <div class="container text-white py-5">
                <div class="row text-center">
                    <div class="col-lg-3 col-md-6">
                        <p class="icon">
                            <i class="fas fa-smile fa-4x"></i>
                        </p>
                        <p class="fa-2x font-weight-bold">4</p>
                        <p class="fa-2x text mb-0 text-uppercase">Donatur</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <p class="icon">
                            <i class="fas fa-rocket fa-4x"></i>
                        </p>
                        <p class="fa-2x font-weight-bold">4</p>
                        <p class="fa-2x text mb-0 text-uppercase">Misi Sukses</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <p class="icon">
                            <i class="fas fa-user-plus fa-4x"></i>
                        </p>
                        <p class="fa-2x font-weight-bold">4</p>
                        <p class="fa-2x text mb-0 text-uppercase">Relawan</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <p class="icon">
                            <i class="fas fa-globe fa-4x"></i>
                        </p>
                        <p class="fa-2x font-weight-bold">4</p>
                        <p class="fa-2x text mb-0 text-uppercase">Project</p>
                    </div>
                </div>
            </div>
        </div>
    {{-- Dana Tersalurkan --}}
    <div class="dana-tersalurkan">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="fa-3x mb-4">Dana Tersalurkan</h2>
                    <h3 class="font-weight-normal mb3">
                        Jika Anda dapat bergaung dengan kami sekarang, <br>
                        maka semakin banyak yang terbantu
                    </h3>
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

    {{-- Galang Dana2 --}}
    <div class="galang-dana2 bg-white">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="fa-3x mb-4">GALANG DANA DI W2-CHARITY</h2>
                    <h3 class="font-weight-normal mb-4">
                        Dari menolong anggota keluarga, hingga membangun jembatan di desa, <br>
                        ribuan orang telah menggunakan w2-charity untuk galang dana.
                    </h3>
                    <a href="" class="btn btn-primary bnt-lg rounded m-auto">Galang Dana Sekarang</a>
                </div>
            </div>
        </div>
    </div>
@endsection