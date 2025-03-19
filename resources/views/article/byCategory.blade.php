<x-layout>
    <div class="container-fluid text-center bg-body-tertiary">
        <div class="row vh-60 body-bg justify-content-center align-items-center">
            <div class="col-12">
                <h1 class="display-1 mt-custom">Archivio categoria</h1>
                <h2 class="display-2">" {{$category->name}} "</h2>
                <div class="mt-5">
                    @auth
                        <a class="btn btn-dark" href="{{route('article.create')}}">Inserisci un articolo</a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="row body-bg height-custom justify-content-center align-items-center py-5">
            @forelse ($articles as $article)
                <div class="col-12 col-md-3 mt-5">
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
</x-layout>