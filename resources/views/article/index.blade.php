<x-layout>
    <div class="container-fluid text-center bg-body-tertiary">
        <div class="row vh-100 body-bg justify-content-center align-items-center">
            <div class="col-12">
                <h1 class="display-1">Archivio articoli</h1>
                <div class="my-5">
                    @auth
                        <a class="btn btn-dark" href="{{route('article.create')}}">Inserisci un articolo</a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="row body-bg height-custom justify-content-center align-items-center py-5">
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
    <div class="d-flex justify-content-center">
        <div>
            {{$articles->links()}}
        </div>
    </div>
</x-layout>