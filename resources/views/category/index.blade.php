@extends('layouts.app')

@section('title', 'Kategori')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
   <div class="row">
      <div class="col-lg-12">

        <x-card>
          <x-slot name="header">
            <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
          </x-slot>

          <form class="d-flex justify-content-between">
            <x-dropdown-table />
            <x-filter-table />
          </form>

          <x-table>
            <x-slot name="thead">
              <th width="5%">No</th>
              <th>Nama</th>
              <th width="25%">Jumlah Project</th>
              <th width="15%"><div class="fas fa-cog"></div></th>
            </x-slot>

              @foreach ($category as $key => $item)
                  <tr>
                    <td><x-number-table :key="$key" :model="$category" /></td>
                    <td>{{ $item->name }}</td>
                    <td>0</td>
                    <td>
                      <form action="{{ route('category.destroy', $item->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <a href="{{ route('category.edit', $item->id) }}" class="btn btn-link text-info"><i class="fas fa-edit"></i></a>
                          <button class="btn btn-link text-danger" onclick="return confirm('Data akan dihapus?')"><i class="fas fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
              @endforeach
          </x-table>
          
          <x-pagination-table :model="$category" />
        </x-card>

      </div>
   </div>
   
@endsection
   
<x-toast />
