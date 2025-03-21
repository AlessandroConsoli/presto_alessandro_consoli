<x-layout>
    <div class="container-fluid text-center bg-body-tertiary">
        <div class="row vh-80 body-bg justify-content-center align-items-center">
            @if (session()->has('message'))
            <div class="alert alert-success text-center shadow rounded w-50 mt-5">
            {{session('message')}}
            </div>
            @endif
            @if (session()->has('errorMessage'))
            <div class="alert alert-danger text-center shadow rounded w-50 mt-5">
            {{session('errorMessage')}}
            </div>
            @endif
            <div class="col-12">
                <h1 class="display-1 mt-custom">Presto.it</h1>
                <div class="my-3">
                    @auth
                        <a class="btn btn-dark" href="{{route('article.create')}}">Pubblica un articolo</a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="row body-bg height-custom justify-content-center align-items-center py-5">
            <div>
                <h2 class="my-5">Articoli recenti</h2>
            </div>
            @forelse ($articles as $article)
                <div class="col-12 col-md-3">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12">
                    <h3 class="text-center">
                        Nessun articolo presente in archivio
                    </h3>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>