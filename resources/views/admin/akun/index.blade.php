@extends('layouts.master')

@section('sidebar')
    @include('inc.admin.sidebar')
@endsection

@section('content')
<div>
    <h1>Admin</h1>
    <p class="p-2"><a href="{{route('admin..index')}}">admin</a> / akun </p>
</div>
<div class="bg-white p-5">
    @include('inc.messages')
    
    <a href="{{route('admin.akun.create')}}">
        <button type="button" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah Admin</button>
    </a>
    <table class="table bg-white mb-5">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Dibuat </th>
            <th scope="col" class="text-center">Edit </th>
            <th scope="col" class="text-center">Hapus </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($akuns as $akun)
            <tr>
              <td>{{$akun->id}}</td>
              <td>{{$akun->name}}</td>
              <td>{{$akun->email}}</td>
              <td>{{$akun->created_at}}</td>
              <td class="text-center">
                  <a href="{{route('admin.akun.edit', $akun->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit Admin">
                    <button class="btn btn-primary ">  
                      <i class="fas fa-pen"></i> 
                    </button>
                  </a>
              </td>
              <td class="text-center">
                <form action="{{route('admin.akun.destroy', $akun->id)}}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus Admin"> 
                      <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
            </tr>
          @endforeach
        </tbody>
    </table> 
</div>
@endsection