<nav class="shadow navbar fixed-top navbar-expand-lg bg-body-tertiary border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Presto.it</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('homepage')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('article.index')}}">Archivio articoli</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sfoglia le categorie
          </a>
          <ul class="dropdown-menu">
            @foreach ($categories as $category)
                <li>
                  <a href="{{route('article.byCategory', ['category' => $category])}}" class="dropdown-item text-capitalize text-custom">{{$category->name}}</a>
                </li>
                @if (!$loop->last)
                    <hr class="dropdown-divider">
                @endif
            @endforeach
          </ul>
        </li>
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ciao, {{Auth::user()->name}}!
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item text-custom" href="{{route('logout')}}" 
              onclick="event.preventDefault(); document.getElementById('form-logout').submit();"
              >logout</a>
              <form 
              action="{{route('logout')}}"
              method="POST"
              id="form-logout"
              class="d-none"
              >
              @csrf
            </form>
          </li>
          <li>
            <a href="{{route('article.create')}}" class="dropdown-item text-custom">Crea un articolo</a>
          </li>
        </ul>
      </li>      
      @else
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Ciao!
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item text-custom" href="{{route('login')}}">Login</a></li>
          <li><a class="dropdown-item text-custom" href="{{route('register')}}">Registrati</a></li>
        </ul>
      </li>      
      @endauth
      </ul>
    </div>
  </div>
</nav>