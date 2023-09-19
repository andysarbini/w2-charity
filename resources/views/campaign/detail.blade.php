@extends('layouts.app')

@section('title', 'Project')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('campaigns.index')}}">Project</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

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
   <div class="row">
      <div class="col-lg-8">

        <x-card>
            <x-slot name="header">
                <h3>{{ $campaign->title }}</h3>
              <p class="font-weight-bold mb-0">
                Diposting oleh <span class="text-primary">{{ $campaign->user->name }}</span>
                <small class="d-block">{{ tanggal_indonesia($campaign->publish_date)}} {{ date('H:i', strtotime($campaign->publish_date)) }}</small>  
              </p>  
            </x-slot>            
            {!! $campaign->body !!}
        </x-card>
      </div>

      <div class="col-lg-4">
        <x-card>
          <x-slot name="header">
            <h5 class="card-title">Kategori</h5>
          </x-slot>

          <ul>
            @foreach ($campaign->category_campaign as $item)
                <li>{{ $item->name }}</li>
            @endforeach
          </ul>
        </x-card>
        
        <x-card>
          <x-slot name="header">
            <h5 class="card-title">Gambar Unggulan</h5>
          </x-slot>
          <img src="{{ Storage::disk('public')->url($campaign->path_image) }}" class="img-thumbnail">
        </x-card>
        
        <x-card>
          <h3 class="font-weight-bold">Rp. {{ format_uang(3000000) }}</h3>
          <p class="font-weight-bold">Terkumpul dari Rp. {{ format_uang(10000000) }}</p>
          <div class="progress" style="height: .3rem;">
            <div class="progress-bar" role="progressbar" style="width: 7%" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="d-flex justify-content-between">
            <p>7% tercapai</p>
            <p>3 bulan lagi</p>
          </div>
          
          <h4 class="font-weight-bold">Donatur (3)</h4>
          
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="waktu-tab" data-toggle="tab" data-target="#waktu" type="button" role="tab" aria-controls="waktu" aria-selected="true">Waktu</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="jumlah-tab" data-toggle="tab" data-target="#jumlah" type="button" role="tab" aria-controls="jumlah" aria-selected="false">Profile</button>
            </li>
            
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="waktu" role="tabpanel" aria-labelledby="waktu-tab">
              @for ($i = 0; $i < 5; $i++)
                  <div>
                    <p class="font-weight-bold mb-0">User</p>
                    <p class="font-weight-bold mb-0">Rp. {{  format_uang(100000) }}</p>
                    <p class="text-muted mb-0">{{ tanggal_indonesia(date('Y-m-d H:i:s') )}}</p>
                  </div>
              @endfor
            </div>
            <div class="tab-pane fade" id="jumlah" role="tabpanel" aria-labelledby="jumlah-tab">...</div>
          </div>

          
        </x-card>
      </div>
   </div>  

@endsection
   
