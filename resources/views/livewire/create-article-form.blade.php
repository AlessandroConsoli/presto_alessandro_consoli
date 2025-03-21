<form class="bg-body-tertiary shadow rounded p-5 my-5" wire:submit="store">
    @if (session()->has('success'))
        <div class="alert alert-success text-center">
            {{session('success')}}
        </div>
    @endif
    <div class="mb-3">
        <label for="title" class="form-label">Titolo:</label>
        <input type="text" id="title" 
            class="form-control @error('title') is-invalid @enderror" wire:model.live.debounce.150ms="title">
        @error('title')
            <p class="fst-italic text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descrizione:</label>
        <textarea id="description" cols="30" rows="10" 
            class="form-control @error('description') is-invalid @enderror" wire:model.live.debounce.150ms="description"></textarea>
        @error('title')
            <p class="fst-italic text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Prezzo in €</label>
        <input type="text" id="price" 
            class="form-control @error('price') is-invalid @enderror" wire:model.live.debounce.150ms="price">
        @error('title')
            <p class="fst-italic text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-3">
        <select id="category" wire:model.blur="category"
            class="form-control @error('category') is-invalid @enderror">
            <option label disabled> Seleziona una categoria </option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('title')
            <p class="fst-italic text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-dark">Crea</button>
    </div>
</form>
