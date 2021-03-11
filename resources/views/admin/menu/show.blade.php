@extends('layouts.master')

@section('sidebar')
    
@endsection

@section('content')
<div>
    <h1>content</h1>
    <p class="p-2"><a href="{{route('admin..index')}}">admin</a> / <a href="{{route('admin.content.index')}}">content</a> / {{ strtolower($content->judul)}} </p>
</div>
<div class="bg-white p-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <h5>{{$content->judul}}</h5>
                <small>Penulis : {{$content->author}} | Di buat pada : {{$content->created_at}}</small>
            </div>
            <div class="col-xl-4 text-left">
                <a href="{{route('admin.content.edit',$content->judul)}}">
                    <button class="btn btn-success mt-3"> <i class="fas fa-pen"></i> Edit Konten</button>
                </a>
                <a href="#">
                    <button class="btn btn-primary mt-3"> <i class="fas fa-eye"></i> Preview Konten</button>
                </a>
            </div>
            <div class="col-xl-2 text-right">
                <form action="{{route('admin.content.destroy', $content->id)}}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger mt-3"> <i class="fas fa-trash"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
    
    <hr class="mb-5">
    <div>
        {!!$content->kontent!!}
    </div>
</div>
@endsection