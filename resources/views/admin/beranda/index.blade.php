@extends('layouts.satucol')

@section('content')
<div class="row">
    <div class="col-xl-9">
      <h1>Beranda</h1>
      <p class="p-2"><a href="{{route('admin..index')}}">admin</a> / beranda </p>
    </div>
    <div class="col-xl-3 mt-5 pl-5">
      @if (Request::segment(3) == 'english')
        <a href="{{route('admin.beranda.index', 'indonesia')}}">
          <button type="button" class="btn mb-3 mr-3"><i class="fas fa-book"></i> Indonesia </button>
        </a>
        <a href="{{route('admin.beranda.index', 'english')}}">
            <button type="button" class="btn btn-dark mb-3"><i class="fas fa-book"></i> English</button>
        </a>
      @else
        <a href="{{route('admin.beranda.index', 'indonesia')}}">
          <button type="button" class="btn btn-dark mb-3 mr-3"><i class="fas fa-book"></i> Indonesia </button>
        </a>
        <a href="{{route('admin.beranda.index', 'english')}}">
            <button type="button" class="btn mb-3"><i class="fas fa-book"></i> English</button>
        </a>
      @endif
      
    </div>
</div>
<div class="bg-white p-5">
    @include('inc.messages')
    <div>
      <h2 >Slider</h2>
    </div>
    <hr>
    <div id="sliderIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @foreach ($sliders as $slider)
          <li data-target="#sliderIndicators" data-slide-to="0" class="active"></li>
        @endforeach
      </ol>
      <div class="carousel-inner">
      @foreach ($sliders as $key => $slider)
        <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
            <img style="height: 100vh;" class="d-block w-100" src="{{ URL::asset('storage/slider') }}/{{$slider->gambar}}" alt="First slide">
            <div class="carousel-caption d-none d-md-block mb-5">
                <h1 class="font-1 display-5">{{$slider->title}}</h1>
                <p style="margin-bottom: 15em;">{{$slider->caption}}</p>
            </div>
        </div>
      @endforeach
        
      </div>
      <a class="carousel-control-prev" href="#sliderIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#sliderIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <hr class="mb-5">
    <a href="{{route('admin.slider.create')}}">
        <button type="button" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah Slider</button>
    </a>
    <table class="table bg-white mb-5">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Gambar</th>
            <th scope="col">Judul</th>
            <th scope="col">Caption</th>
            <th scope="col">Tanggal Dibuat</th>
            <th scope="col" class="text-center">Edit </th>
            <th scope="col" class="text-center">Hapus </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sliders as $slider)
            <tr>
              <td>{{$slider->gambar}}</td>
              <td>{{$slider->title}}</td>
              <td>{{$slider->caption}}</td>
              <td>{{$slider->created_at}}</td>
              <td class="text-center">
                  <a href="{{route('admin.slider.edit', $slider->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit Menu">
                    <button class="btn btn-primary "> 
                      <i class="fas fa-pen"></i> 
                    </button>
                  </a>
              </td>
              <td class="text-center">
                <form action="{{route('admin.slider.destroy', $slider->id)}}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus Menu"> 
                      <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
            </tr>
          @endforeach
        </tbody>
    </table> 
    
</div>
<div style="min-height: 10vh"></div>
<div class="bg-white p-5">
    <div class="row">
      <h2 >Konten Beranda</h2>
      <a class="ml-auto" href="{{route('admin.beranda.konten.edit', $berandakonten->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit Menu">
        <button class="btn btn-primary "> 
          EDIT KONTEN <i class="fas fa-pen"></i> 
        </button>
      </a>
    </div>
    
    <hr>
    <div class="container-fluid mt-5 mb-5">
      <div class="container p-5">
        <div class="ml-5 mr-5 mb-3 text-left">
          <h1 style=" font-weight:bolder;" class="text-left d-inline-block font-1 mb-3" >{{$berandakonten->judul}}</h1>
          <br>
          <p class="text-left d-inline-block font-1" >
            {!! $berandakonten->konten !!}
          </p>
        </div>
        <div class="row ml-5 mr-5">
          <a href="{{$berandakonten->url}}" class="text-blue" style="border-bottom: 3px inset #FAD02C; text-decoration: none;">
            <p class="text-left d-inline-block font-1" style=" font-weight:bold;" >Lihat Selengkapnya</p>
          </a>
        </div>
      </div>
    </div>
    
</div>
@endsection