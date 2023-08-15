@extends('layouts.front')

@section('title', 'DARURAT! Peduli Korban Gempa Banten')

@push('css')
    <style>
        .daftar-donasi.nav-pills .nav-link.active,
        .daftar-donasi.nav-pills .show>.nav-link {
        background: transparent;
        color: var(--dark);
        border-bottom: 3px solid var(--blue);
        border-radius: 0;
      }
    </style>
@endpush
    
@section('content')
    {{-- Banner --}}
    <div class="banner bg-charity2">
        <div class="container">
            <h2 class="fa-2x text-white">DARURAT! Peduli Korban Gempa Banten</h2>
        </div>
    </div>

    {{-- Detail --}}
    <div class="detail bg-white">
        <div class="container py-5">
            <div class="row justify-content-between">
                <div class="col-lg-8">
                    <div class="f-flex align-items-center">
                        <div class="img rounded-circle" style="width: 60px; overflow:hidden">
                            <img src="{{ asset('AdminLTE/dist/img/user1-128x128.jpg') }}" alt="" class="w-100">
                        </div>
                        <div class="ml-3">
                            <strong class="d-block">Username</strong>
                            <small class="text-muted">20 September 2021</small>
                        </div>
                    </div>
                        <div class="thumbnail rounded mt-4" style="overflow: hidden">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/0/0a/Standing_jaguar.jpg" alt="" class="w-100">
                        </div>
    
                        <div class="body mt-4">
                            <h5>Creating Something New</h5>
                            <p>The phrase "Lorem ipsum dolor sit amet consectetuer" appears in Microsoft Word online Help. This phrase has the appearance of an intelligent Latin idiom. Actually, it is nonsense.</p>
                            <p>A 1994 issue of "Before & After" magazine traces "Lorem ipsum ..." to a jumbled Latin version of a passage from de Finibus Bonorum et Malorum, a treatise on the theory of ethics written by Cicero in 45 B.C. The passage "Lorem ipsum ..." is taken from text that reads, "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit ...," which translates as, "There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."</p>
                            
                            <h5>More Information</h5>
                            <p>Although the phrase is nonsense, it does have a long history. The phrase has been used for several centuries by typographers to show the most distinctive features of their fonts. It is used because the letters involved and the letter spacing in those combinations reveal, at their best, the weight, design, and other important features of the typeface.</p>
                            <p>During the 1500s, a printer adapted Cicero's text to develop a page of type samples. Since then, the Latin-like text has been the printing industry's standard for fake, or dummy, text. Before electronic publishing, graphic designers had to mock up layouts by drawing in squiggled lines to indicate text. The advent of self-adhesive sheets preprinted with "Lorem ipsum" gave a more realistic way to indicate where text would go on a page.</p>
                        
                            <div class="kategori border-top pt-3">
                                <a href="#" class="badge badge-primary p-2 rounded-pill">Korban Banjir</a>
                            </div>

                            <hr class="d-lg-none d-block">
                        
                    </div>  
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-0">
                        <h1 class="font-weight-bold">Rp. {{ format_uang(3000000) }}</h1>
                        <p class="font-weight-bold">Terkumpul dari Rp. {{ format_uang(10000000) }}</p>
                        <div class="progress" style="height: .3rem;">
                            <div class="progress-bar" role="progressbar" style="width: 7%" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <p>7% tercapai</p>
                            <p>3 bulan lagi</p>
                        </div>

                        <div class="donasi mt-2 mb-4">
                            <button class="btn btn-primary btn-lg btn-block">Donasi Sekarang</button>
                        </div>

                        <h4 class="font-weight-bold">Donatur (3)</h4>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                              <button class="nav-link active" id="pills-waktu-tab" data-toggle="pill" data-target="#pills-waktu" type="button" role="tab" aria-controls="pills-waktu" aria-selected="true">Waktu</button>
                            </li>
                            <li class="nav-item">
                              <button class="nav-link" id="pills-jumlah-tab" data-toggle="pill" data-target="#pills-jumlah" type="button" role="tab" aria-controls="pills-jumlah" aria-selected="false">Jumlah</button>
                            </li>
                            
                          </ul>
                          <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-waktu" role="tabpanel" aria-labelledby="pills-waktu-tab">
                                @for ($i = 0; $i < 5; $i++)
                                    <div @if ($i > 0) class="mt-1"                                        
                                    @endif>
                                        <p class="font-weight-bold mb-0">User</p>
                                        <p class="font-weight-bold mb-0">Rp. {{  format_uang(100000) }}</p>
                                        <p class="text-muted mb-0">{{ tanggal_indonesia(date('Y-m-d H:i:s') )}}</p>
                                    </div>
                                @endfor
                            </div>
                            <div class="tab-pane fade" id="pills-jumlah" role="tabpanel" aria-labelledby="pills-jumlah-tab">...</div>
                          </div>
                    </div>
                </div>          
            </div>
        </div>
    </div>
    
@endsection