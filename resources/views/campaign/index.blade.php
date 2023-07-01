@extends('layouts.app')

@section('title', 'Project')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Projects</li>
@endsection

@section('content')
   <div class="row">
      <div class="col-lg-12">

        <x-card>
          <x-slot name="header">
            <a href="{{ route('campaign.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
          </x-slot>

          <form class="d-flex justify-content-between">
            <x-dropdown-table />
            <x-filter-table />
          </form>

          <x-table>
            <x-slot name="thead">
              <th width="5%">No</th>
              <th></th>
              <th>Deskripsi</th>
              <th>Tgl. Publish</th>
              <th>Status</th>
              <th>Author</th>
              <th width="15%"><div class="fas fa-cog"></div></th>
            </x-slot>

              
          </x-table>
          
          
        </x-card>

      </div>
   </div>
   
@endsection

<x-toast />
@includeIf('includes.datatable')
   
