@extends('layouts.front')

@section('title', $campaign->title)

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
            <h2 class="fa-2x text-white">{{ $campaign->title }}</h2>
        </div>
    </div>

    {{-- Detail --}}
    <div class="detail bg-white">
        <div class="container py-5">
            <div class="row justify-content-between">
                <div class="col-lg-8">
                    <div class="f-flex align-items-center">
                        <div class="img rounded-circle" style="width: 60px; overflow:hidden">
                            @if (Storage::disk('public')->exists($campaign->user->path_image)) 
                                <img src="{{ Storage::disk('public')->url($campaign->user->path_image) }}" alt="" class="w-100">
                            @else
                                <img src="{{ asset('AdminLTE/dist/img/user1-128x128.jpg') }}" alt="" class="w-100">
                            @endif
                        </div>
                        <div class="ml-3">
                            <strong class="d-block">{{ $campaign->user->name }}</strong>
                            <small class="text-muted">{{ tanggal_indonesia(\Carbon\Carbon::createFromTimestamp(strtotime($campaign->publish_date))->format('Y-m-d'))}}</small>
                        </div>
                    </div>
                        <div class="thumbnail rounded mt-4" style="overflow: hidden">                     
                            @if (Storage::disk('public')->exists($campaign->path_image))
                                <img src="{{ Storage::disk('public')->url($campaign->path_image) }}" alt="..." class="w-100">
                            @else
                                <img src="https://upload.wikimedia.org/wikipedia/commons/0/0a/Standing_jaguar.jpg" alt="" class="w-100">
                            @endif
                        </div>
    
                        <div class="body mt-4">
                            {!! $campaign->body !!}
                            <div class="kategori border-top pt-3">
                                @if ($campaign->category_campaign)
                                    @foreach ($campaign->category_campaign as $item)
                                        <a href="#" class="badge badge-primary p-2 rounded-pill">{{ $item->name }}</a>
                                    @endforeach
                                @endif
                            </div>

                            <hr class="d-lg-none d-block">
                        
                    </div>  
                </div>

                <div class="col-lg-4">
                    <div class="card p-3 border-0 shadow-0">
                        <h1 class="font-weight-bold">Rp. {{ format_uang($campaign->nominal) }}</h1>
                        <p class="font-weight-bold">Terkumpul dari Rp. {{ format_uang($campaign->goal) }}</p>
                        <div class="progress" style="height: .3rem;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $campaign->nominal / $campaign->goal * 100 }}%" aria-valuenow="{{ $campaign->nominal / $campaign->goal * 100 }}" aria-valuemin="0" aria-valuemax="{{ 100 }}"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <p>{{ $campaign->nominal / $campaign->goal * 100 }}% tercapai</p>
                            <p>3 bulan lagi</p>
                        </div>

                        <div class="donasi mt-2 mb-4">
                            <a href="{{ url('/donation/'. $campaign->id .'/create') }}" class="btn btn-primary btn-lg btn-block">Donasi Sekarang</a>
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