<x-layout>
  <div class="container-fluid text-center bg-body-tertiary">
    <div class="row vh-80 body-bg justify-content-center align-items-center">
      <div class="col-12">
        <h1 class="display-1 mt-custom">Dettagli dell'articolo</h1>
        <div class="my-5">
          @auth
          <a class="btn btn-dark" href="{{route('article.index')}}">Torna all'archivio articoli</a>
          @endauth
        </div>
      </div>
    </div>
    <div class="row height-custom justify-content-center py-5 body-bg">
      <div class="col-12 col-md-6 mb-3">
        @if ($article->images->count() > 0)
        <div id="carouselExampleCaptions" class="carousel slide custom-carousel" data-bs-ride="carousel" data-bs-wrap="true">
          <div class="carousel-indicators">
            @foreach ($article->images as $key => $image)
            <button type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="{{$key}}"
            @if ($loop->first) class="active" aria-current="true" @endif
            aria-label="Slide {{$key + 1}}">
          </button>
          @endforeach
        </div>
        <div class="carousel-inner">
          @foreach ($article->images as $key => $image)
          <div class="carousel-item @if ($loop->first) active @endif">
            <img src="{{ Storage::url($image->path) }}" class="d-block w-100" alt="Immagine {{$key + 1}} dell'articolo {{$article->title}}">
            <div class="carousel-caption d-none d-md-block carousel-text">
              <h5>Immagine {{$key + 1}}</h5>
            </div>
          </div>
          @endforeach
        </div>
        @if ($article->images->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon carousel-text" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon carousel-text" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
        @endif
      </div>
      @else
      <img src="https://picsum.photos/300" alt="Nessuna immagine inserita">
      @endif
    </div>
    
    <div class="col-12 height-custom text-center d-flex align-items-center justify-content-center">
      <div class="col-6">
        <h2 class="my-5">{{$article->title}}</h2>
        <h6 class="my-5 text-center">{{$article->description}}</h4>
          <h5 class="my-5">Prezzo: {{$article->price}}€</h3>
          </div>
        </div>
      </div>
    </div>
  </x-layout>