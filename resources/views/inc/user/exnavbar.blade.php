<nav class="navbar navbar-expand-lg navbar-custom pr-5 pl-5 pt-3 pb-4">
    <a class="navbar-brand" href="/id">
      <img width="50" src="{{asset('logo/logo.png')}}" alt="">
    </a>
    <a class="navbar-brand" href="/id">
      <small>MAGISTER MANAJEMEN <br> UNIVERSITAS BENGKULU</small>
    </a>
    <button class="navbar-toggler text-white"  type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
      {{-- <span class="navbar-toggler-icon"></span> --}}
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto" style="font-size: smaller;">
        @if (Request::segment(1) == 'en')
          <li class="nav-item">
            @if (Request::segment(2) == null)
                <a class="nav-link active text-white" style="text-transform: uppercase;
                border-bottom:  2px inset #FAD02C;
                margin-bottom:  -2px;" 
                href="{{route('user.index', $bahasa)}}">Home</a>
              @else
                <a class="nav-link" style="text-transform: uppercase;" href="{{route('user.index', $bahasa)}}">Home</a>
              @endif
            
          </li>
        @else
          <li class="nav-item">
            @if (Request::segment(2) == null)
                <a class="nav-link active text-white" style="text-transform: uppercase;
                border-bottom:  2px inset #FAD02C;
                margin-bottom:  -2px;" 
                href="{{route('user.index', $bahasa)}}">Beranda</a>
              @else
                <a class="nav-link" style="text-transform: uppercase;" href="{{route('user.index', $bahasa)}}">Beranda</a>
              @endif
            
          </li>
        @endif

        
        @foreach ($menus as $menu)
          
          <li class="nav-item dropdown">
            @if (Request::segment(2) == $menu->menu)
              <a class="nav-link dropdown-toggle active text-white" 
              style="text-transform: uppercase;
                    border-bottom:  2px inset #FAD02C;
                    margin-bottom:  -2px;" 
              href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 {{$menu->menu}}
              </a>
            @else
              <a class="nav-link dropdown-toggle" style="text-transform: uppercase;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{$menu->menu}}
              </a>
            @endif
            
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @if ($menu->menu == 'Penelitian' || $menu->menu == 'penelitian')
              <a class="dropdown-item" href="{{route('user.artikeldosen.index', ['id', 'artikeldosen'])}}">Artikel Dosen</a>
                <a class="dropdown-item" href="{{route('user.artikeldosen.index', ['id', 'tesis'])}}">Tesis</a>
                <a class="dropdown-item" href="{{route('user.artikeldosen.index', ['id', 'disertasi'])}}">Disertasi</a>
                @endif
                @if ($menu->menu == 'Research' || $menu->menu == 'research')
                <a class="dropdown-item" href="{{route('user.artikeldosen.index', ['en', 'artikeldosen'])}}">Lecturer Articles</a>
                  <a class="dropdown-item" href="{{route('user.artikeldosen.index', ['en', 'tesis'])}}">Thesis</a>
                  <a class="dropdown-item" href="{{route('user.artikeldosen.index', ['en', 'disertasi'])}}">Dissertation</a>
                @endif 
                @foreach ($contents as $content)
                  @if ($content->menu_id == $menu->id)
                    <a class="dropdown-item" href="{{route('user.content', [$bahasa, $menu->menu , $content->judul])}}">{{$content->judul}}</a>
                  @endif
                @endforeach
            </div>
          </li>
        @endforeach

        @foreach ($menutunggals as $menutunggal)
          <li class="nav-item">
            @if (Request::segment(2) == $menutunggal->judul)
            <a class="nav-link active" 
            style="text-transform: uppercase;
                      border-bottom:  2px inset #FAD02C;
                      margin-bottom:  -2px;" 
            href="{{route('user.menutunggal.index', [$bahasa,$menutunggal->judul])}}">{{$menutunggal->judul}}</a>
              @else
              <a class="nav-link" style="text-transform: uppercase;" href="{{route('user.menutunggal.index', [$bahasa,$menutunggal->judul])}}">
                {{$menutunggal->judul}}</a>
              @endif
          </li>
        @endforeach

        @if (Request::segment(1) == 'en')
          <li class="nav-item">
            @if (Request::segment(2) == 'berita')
            <a class="nav-link active" 
            style="text-transform: uppercase;
                      border-bottom:  2px inset #FAD02C;
                      margin-bottom:  -2px;" 
            href="{{route('user.berita.index', [$bahasa, 'berita'])}}">News</a>
              @else
              <a class="nav-link" style="text-transform: uppercase;" href="{{route('user.berita.index',  [$bahasa, 'berita'])}}">News</a>
              @endif
          </li>
        @else
          <li class="nav-item">
            @if (Request::segment(2) == 'berita')
            <a class="nav-link active" 
            style="text-transform: uppercase;
                      border-bottom:  2px inset #FAD02C;
                      margin-bottom:  -2px;" 
            href="{{route('user.berita.index', [$bahasa, 'berita'])}}">Berita</a>
              @else
              <a class="nav-link" style="text-transform: uppercase;" href="{{route('user.berita.index',  [$bahasa, 'berita'])}}">Berita</a>
              @endif
          </li>
        @endif
      </ul>
    </div>
</nav>