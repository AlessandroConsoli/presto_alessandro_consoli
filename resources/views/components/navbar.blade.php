<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Presto.it</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('homepage')}}">Home</a>

                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Ciao, {{Auth::user()->name}}!
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item" href="{{route('logout')}}" 
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
                      <a href="{{route('article.create')}}" class="dropdown-item">Crea un articolo</a>
                    </li>
                    </ul>
                  </li>
          
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Ciao!
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                      <li><a class="dropdown-item" href="{{route('register')}}">Registrati</a></li>
                    </ul>
                  </li>
          
                @endauth
            </ul>
        </div>
    </div>
</nav>