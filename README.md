

                                APPUNTI LEZIONI

Per clonare un progetto: 

     1 dal terminale posizionarsi sulla cartella del progetto
      ed inserire il comando git clone link_ssh_copiato_da_git_hub   nome_del_nuovo_progetto
     2 scollegare dalla vecchia repository con il comando
      git remote remove origin 
     3 creare una nuova repository e collegare il progetto
     4 creare il nuovo file env con il comando
      cp .env.example .env
     5 lanciare il comando per installare composer
      composer i
     6 modificare il file .env inserendo i valori per il database
     7 creare la chiave univoca con il comando
      php artisan key:gen
     8 installare npm con il comando
      npm i 
      oppure installare bootstrap ed npm insieme con il comando
      npm i bootstrap
     9 lanciare il server php artisan serve
    10 lanciare npm run dev





Comandi per avviare un nuovo progetto con laravel 11  

1 composer create-project --prefer-dist laravel/laravel nome-del-tuo-progetto "11" 

2 winpty mysql -u <il tuo username> -p poi inserisci la password 

3 create database <nome del database>; 

4 exit 

5 Collegare il database a table plus 
           Name = Nome che visualizzeremo su Table Plus
           Host = localhost
           Port = 3306
           user = root (o comunque quella scelta in fase di creazione dell'account mysql)
           password = root (o comunque quella scelta in fase di creazione dell'account mysql)
           Database = nome del database da collegare
           cliccare su connect

6 php atisan migrate

7 npm install bootstrap

8 php artisan serve

9 in app.js e app.css inserire gli import di bootstrap 
     NB: Le modifiche al CSS saranno applicate solo dopo aver attiva VITE (STEP 11) 
           PER CSS
           @import 'bootstrap'; 
           @import './style.css';
           PER JS
           import './bootstrap';
           import 'bootstrap';

10 creare i componenti layout e navbar (eventualmente il footer)

11 nel layout inserire il @vite
      All'interno di <head> e subito sotto <title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])    

12 Impostare la rotta per la welcome
   Creare un PublicController con il comando  php artisan make:controller PublicController
   Spostare la Funzione 'welcome' da web.php a PublicController 'aggiungendo public ed il nome della funzione'
   Modificare la rotta su web.php aggiungendo controller funzione e nome rotta 
  <Route::get('/', [PublicController::class, 'welcome'])->name('welcome');>
   Modificare il tasto Home della navbar inserendo il link della rotta 
   <href="{{route('welcome')}}">

13 Creare il modello con il controller e la migrazione (ad esempio per degli articoli)
  a     lanciare il comando 

        "php artisan make:model Nome_modello -mc"  (in questo caso Article -mc)

  b     Aprire il modello appena creato (si trova dentro il percorso app\Models) in questo caso Article.php
        ed inseriamo il tratto <HasFactory> ed i <fillable>

            use HasFactory;

            protected $fillable = [
                'title', 'body', 'img', 'user_id'
            ];

  c     Aprire la nuova migrazione creata al punto "a" 
        ed inserire i table fillable nella funzione up tra $table->id() e table->timestamps()

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->string('title');
            $table->longText('body');
            $table->string('img')->nullable();

  d     Lanciare la migrazione (testare per sicurezza anche la rollback "php artisan migrate:rollback")

14 Installare fortify (per gestire login e registrazione degli utenti) 
  a     Seguire la guida su  <https://laravel.com/docs/11.x/fortify#installation>
  b     Lanciare  <composer require laravel/fortify>   
  b     per installare le dipendenze di PHP Lanciare  <php artisan fortify:install>       
  c     lanciare nuovamente  <php artisan migrate>
  d     entrare all'interno del percorso <App\Providers\FortifyServiceProvider.php> ed inserire 
  e     all'interno della funzione boot (in fondo) le seguenti stringhe: 
  
            Fortify::registerView(function () {
                    return view('auth.register');
                });

            Fortify::loginView(function () {
                    return view('auth.login');    
                });

     (link dove prendere le stringhe)     https://laravel.com/docs/11.x/fortify#registration
     
  f    In views creare la cartella <auth> e la vista <register.blade.php>
  g    All'interno della vista register inserire i components di layout ed un container dove inserire un form
       Per vedere la rotta creata da fortify lanciare <php artisan route:list>
  h    Aggiungere un tasto alla navbar per aprire la vista register e linkare con <href="{{route('register')}}">
  i    aggiungere al form della vista register:    
              <action="{{route('register')}}"
              method="POST">
       e fuori dal tag <form> inserire il csrf   token

  l     Impostare i campi del form [Nome, Email, Password, Conferma Password]
  m     aggiungere il campo <name=> all'interno di <input> e chiamare con lo stesso nome <for=> e <id=>
        attenzione a "<conferma password>" che dovra obbligatoriamente avere valore <name=password_confirmation>
  n     aprire il file <fortify.php> all'interno della cartella config, cercare la stringa 

        'home' => '/home',
   _     e modificarla in 

        'home' => '/', 
   _     in modo da far funzionare il reindirizzamento dopo la registrazione

  o     Aggiungere un tasto <Logout> alla navbar che sarà un form con <action> <logout>, <metodo> <post> 
        ed un <button> di tipo  <submit>

              <li class="nav-item">
                  <form 
                  action="{{route('logout')}}" 
                  method="POST">
                  @csrf                    
                      <button class="nav-link" type="submit">Logout</button>
                  </form>
              </li>

  p     Sul form della vista register impostare il tasto registrati ed il link alla vista di login 
        un esempio:
                <div>
                    <button type="submit" class="btn btn-secondary">Registrati</button>
                </div>
                <div>
                    <p class="pt-4">Hai già un account? <a href="{{route('login')}}">Fai il login</a></p>
                </div>

  q     Creare la vista <login> all'interno della cartella <auth> ed inserire un form con i campi <email>, <password> ed <accedi>
        suggerimento: copia tutta la vista <register> e cancellare e modificare quello che serve
        ecco un esempio:
        <x-layout>
          <x-container>
            <h1 class="pt-5">Accedi al tuo account</h1>
          </x-container>    
          <x-container>
            <form
            class="shadow rounded-2 p-4"
            action="{{route('login')}}"
            method="POST"
            >
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <x-container>
                    <div>
                        <button type="submit" class="btn btn-secondary">Accedi</button>
                    </div>
                    <div>
                        <p class="pt-4">Non hai ancora un account? <a href="{{route('register')}}">Registrati</a></p>
                    </div>
                </x-container>
            </form>
          </x-container>    
        </x-layout>

  r     Aggiungere alla navbar le regole per visualizzare i tasti in base all'autenticazione

                @auth

                @else
                    
                @endauth

  -    all'interno di @auth inserire un dropdown oppure il pulsante login, stessa cosa su @else con dropdown o con il pulsante
       registrati. Ad esempio:

                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Ciao, {{Auth::user()->name}}!
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{route('logout')}}" 
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

  s     <!--! arrivato al minuto 00:32:00 Video Selfwork - CRUD Livewire  -->

15 In web.php impostiamo la rotta per la <create>
      Route::get('/create', [ArticleController::class, 'create'])->name('article.create');

  -   Il nome ->name('article.create') comporta che venga creata la cartella article come sottocartella di <views>

16 Andare su ArticleController ed aggiungere la logica per far funzionare la rotta

       public function create(){
           return view('article.create');
       }
   
17 Impostare il front-end della vista <create.blade.php> 
    a) Inserire la parte superiore che sarà il titolo della pagina
    b) Inserire il componente form con <Livewire>


  -    <LIVEWIRE CREARE UN COMPONENTE> 

    Documentazione: <https://livewire.laravel.com/docs/quickstart>  

  -  1 Installare usando il comando:   composer require livewire/livewire 

  -  2 Creare il componente <ArticleCreate> usando il comando
      php artisan make:livewire ArticleCreate

  -  3 Aprire il percorso <app\Livewire\ArticleCreate.php> inseriamo gli <attributi pubblici>
       e se abbiamo intenzione di caricare una immagine inseriamo anche il tratto <WithFileUploads>
       Inoltre impostiamo l'array di regole $rules = [] per gli elementi obbligatori 
       ed i messaggi di errore $messages = [] 
       (suggerimento se la regola è solamente una si può utilizzare la sintassi: 
       < '*.required'=> 'il campo :attribute è obbligatorio' >   )
       
       ad esempio:
  
    class ArticleCreate extends Component
    {
        use WithFileUploads;

        public $title;
        public $body;
        public $user_id;
        public $img;

        protected $rules = [
            'title' => 'required',
            'body' => 'required'
        ];

        protected $messages = [
            '*.required'=> 'il campo :attribute è richiesto!'
        ];

        public function render()
        {
            return view('livewire.article-create');
        }
    }

  -  4 Sotto i $messages impostiamo la funzione <articleStore> 
       a) associare l'attributo pubblico user_id all'id dell'utente autenticato 
       b) impostare il controllo per l'immagine
       c) inserire la stringa di creazione dell'articolo <Article::create([])> per la mass assigment

        Article::create([
            'title'=>$this->title,
            'body'=>$this->body,
            'user_id'=>$this->user_id,
            'img' => !$this->img ? null : $this->img->store('public/img') 
        ]);
        <L'ultima stringa si traduce con: se l'utente non ha inserito l'immagine assegna valore null, 
        <altrimenti salvala nel percorso storage/public/img

      d) Sempre dentro articleStore creiamo la redirect per l'avvenuto inserimento
         <return redirect()->route('welcome')->with('successMessage', 'Articolo creato!');

    -5 Andare nella vista create.blade.php e richiamare il componente livewire con la sintassi 
       <livewire:article-create>

    -6 Impostare il front-end della vista article-create.blade.php in questo caso si tratterà di un form che gestirà immagini
      quindi avrà attributo enctype= "multipart/form-data" e conterrà le regole per gestire gli errori
      ad esempio:

      <div>
          <form enctype="multipart/form-data">
              @csrf
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{$error}}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <div class="mb-3">
                  <label for="title" class="form-label">Nome:</label>
                  <input type="text" id="title" class="form-control" wire:model="title">
              </div>
              <div class="mb-3">
                  <label for="body" class="form-label">Descrizione:</label>
                  <textarea id="body" cols="30" rows="10" class="form-control" wire:model="body"></textarea>
              </div>
              <div class="mb-3">
                  <label for="img">Inserisci una immagine</label>
                  <input type="file" class="form-control" wire:model="img">
              </div>
              <x-container>
                  <button type="submit" class="btn btn-primary">Crea</button>
              </x-container>
          </form>
      </div>


    -7 Inserire il link nella navbar per la rotta create

    -8 Assegnare il middleware alla rotta article.create  ->middleware('auth');

    -9 Creiamo un componente che gestirà i messaggi di avvenuta creazione e di errore
       flash-messages.blade.php

       ad esempio:

       <div>
          @if (@session()->has('successMessage'))
              <div class="alert alert-success">
                  <h3 class="text-center">
                      {{section('successMessage')}}
                  </h3>
              </div>    
          @endif
          @if (@session()->has('errorMessage'))
              <div class="alert alert-danger">
                  <h3 class="text-center">
                      {{section('errorMessage')}}
                  </h3>
              </div>    
          @endif
      </div>

    -10 Colleghiamo la cartella storage al progetto con il comando
        php artisan storage:link

    -11 Rendiamo disponibile il componente flash-messages alla vista <welcome>


    -12 Creaiamo il nuovo componente livewire che ci permetterà di visualizzare tutti i nostri articolo
        attraverso il comando <php artisan make:livewire ArticleIndex>

    -13 richiamiamo il componente in una nuova vista oppure in una di quelle già create
        <livewire:article-index>
        ed andiamo a gestire la logica presente nel percorso <app\Livewire\ArticleIndex.php>
        questa volta direttamente all'interno della funzione <render> andremo ad inserire la chiamata per tutti gli articoli
        ordinati per data di creazione. <Importante passare anche la variabile alla vista quindi>:
        
        class ArticleIndex extends Component
        {
            public function render()
            {
                $articles = Article::all()->sortByDesc('created_at');
                return view('livewire.article-index', compact('articles'));
            }
        }

    -14 Andiamo a gestire il front-end del componente <article-index.blade.php>
        inseriamo un @foreach in modo da ciclare gli articoli che passeremo alla vista
        ad esempio: 

                <div class="container d-flex justify-content-around min-vh-100">
                    <div class="row col-12">
                        @foreach ($articles as $article)
                        <div class="col-12 col-md-4 mb-5">
                            <div class="card mx-auto" style="width: 18rem;">
                                <img src="{{!$article->img ? 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg' : Storage::url($article->img)}}" class="card-img-top cardImgCustom" alt="Immagine dell'articolo {{$article->title}}">
                                <div class="card-body d-flex justify-content-center bg-card-custom">
                                    <div>
                                        <h5 class="card-title">{{$article->title}}</h5>
                                        <div class="justify-content-center">
                                            <div class="col-12 d-flex justify-content-center mb-3">
                                                <a href="#" class="btn btn-success">Vai all'articolo completo</a>
                                            </div>
                                        </div>
                                    </div>        
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

    -15 Creaiamo la rotta per poter modificare l'articolo:
        sarà una rotta di tipo get e parametrica ed aggiungeremo anche il middleware in modo da renderla disponibile solo all'utente loggato.

        Route::get('/edit/{article}', [ArticleController::class, 'edit'])->name('article.edit')->middleware('auth');

    -16 Apriamo <app\Http\Controllers\ArticleController.php 
     -  ed aggiungiamo la funzione edit che abbiamo appena citato nella nuova rotta creata al punto 15

    -17 Creiamo la vista della rotta article.edit
        all'interno della cartella resources\views\article creiamo il file <edit.blade.php>
        e gestiamo la parte front-end della vista. 
        In questo caso mi servirà un form che mi faccia vedere gli elementi dell'articolo
        Suggerimento basta riciclare il form della vista "create" 
        e cambiare il componente livewire con quello che creeremo tra poco
        Inoltre aggiungo un controllo per permettere di modificare l'articolo solo all'utente che lo ha creato

                @auth
                    @if (Auth::id() == $article->user->id)
                        <a href="{{route('article.edit', compact('article'))}}" class="btn btn-warning">Modifl'articolo</a>
                    @endif
                @endauth

       -IMPORTANTE!!!!!!   
        -1) Occorre impostare le relazioni tra user_id ed article_id altrimenti si avrà un errore
           Per farlo occorre andare sul <modello Article.php> ed inserire subito sotto i fillable, la funzione:

                public function user(){
                    return $this->belongsTo(User::class);
                }

       -2)  Spostarsi sul <modello user.php> ed aggiungere la funzione articles con hasMany:

                public function articles(){
                    return $this->hasMany(Article::class);
                }

    -18 Creaiamo il componente livewire per gestire la funzione edit Utilizzando il comando 
        <php artisan make:livewire ArticleEdit>

      - Apriamo il componente appena creato e sistemiamo la parte front-end
        Suggerimento: Anche in questo caso potremo copiare il contenuto dal componente article-create.blade.php
        Per evitare errori momentaneamente però togliamo la funzione dalla stringa del form
        <form enctype="multipart/form-data" wire:submit.prevent="">    <-------- la imposteremo tra poco

    -19 Andiamo ad impostare la logica su app\Livewire\ArticleEdit.php
        Aggiungiamo il tratto <use WithFileUploads;>
        ed aggiungiamo gli attributi pubblici della classe:

        use WithFileUploads;
        public $article;
        public $title;
        public $body;
        public $img;
        public $old_img;

       -Subito sotto Aggiungiamo il metodo di livewire <mount> che servirà ad impostare quali dati vogliamo che siano  
        già presenti dentro al form al caricamento della pagina

    -20 Andiamo su edit.blade.php ed aggiorniamo il componente livewire inserendo il nuovo article-edit ma questa volta
        dovremo aggingere anche il dato da passare quindi la stringa diventa
        <livewire:article-edit :article="$article">            
        </livewire:article-edit>

    -21 Se voglio aggiungere al form anche una piccola anteprima dell'immagine salvata potremo aggiungere questo div: 
        <div class="mb-3">
            @if ($article->img)
                <p class="h5">Immagine attuale:</p>
                <img src="{{Storage::url($article->img)}}" alt="Immagine di {{$article->title}}" width="150">
            @else   
            <p class="text-center fst-italic fw-bold">Attualmente l'articolo non contiene immagini</p>             
            @endif
        </div>

    -22 Andiamo su <app\Livewire\ArticleEdit.php> e prima della funzione mount inseriamo la funzione per la modifica

            public function articleUpdate(){
                $this->article->update([
                    'title'=>$this->title,
                    'body'=>$this->body
                ]);

                if ($this->img) {
                    $this->article->update([
                        'img'=>$this->img->store('img', 'public')
                    ]);
                    if ($this->old_img) {
                        Storage::delete($this->old_img);
                    }
                    $this->reset('img');
                }
                return redirect()->route('welcome')->with('successMessage', 'Articolo aggiornato!');
            }

    -23 A questo punto possiamo aggiungere il riferimento alla funzione nel form 
        <form enctype="multipart/form-data" wire:submit.prevent="articleUpdate">

    -24 Impostiamo la rotta per poter visualizzare l'articolo completo (andiamo su web.php)

        Route::get('/show/{article}', [ArticleController::class, 'show'])->name('article.show')->middleware('auth');
       -"A discrezione" anche questa rotta potrebbe essere resa disponibile solo per gli utenti loggati

    -25 Andiamo su app\Http\Controllers\ArticleController.php ed impostiamo la funzione che restituirà la vista

        public function show(Article $article){
            return view('article.show', compact('article'));
        }

    -26 Creiamo la vista show.blade.php dentro la cartella resources\views\article
        Impostiamo il front-end. Ad esempio:

    <x-layout>
        <div class="container">
            <div class="row justify-content-center align-items-center my-5">
                <div class="col-12">
                    <h1 class="text-center display-5">Dettagli dell'articolo {{$article->title}}</h1>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                    <img src="{{$article->img ? Storage::url($article->img) : 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg'}}" alt="Immagine dell'articolo {{$article->title}}" class="mx-auto img-fluid rounded shadow" width="400">
                </div>
            </div>
            <div class="col-12 col-md-6 justify-content-center">
                <p class="fs-5">{{$article->body}}</p>
                <p class="text-muted">Scritto da: {{$article->user->name}} </p>
                <p class="text-muted">Ultima revisione: {{$article->user->updated_at}} </p>
            </div>
            @auth
            @if (Auth::id() == $article->user->id)
                <div class="row mt-5">
                    <div class= "d-flex justify-content-center mb-2">
                        <a href="{{route('article.edit', compact('article'))}}" class="btn btn-warning">Modifica l'articolo</a>
                    </div>
                    <div class= "d-flex justify-content-center mb-2">
                        <a href="{{route('article.edit', compact('article'))}}" class="btn btn-danger">Elimina l'articolo</a>
                    </div>
                </div>
            @endif
        @endauth        
        </div>
    </x-layout>

       -Ed aggiungiamo la rotta ad article-index.blade.php in modo da far funzionare il pulsante che avevamo lasciato vuoto
        Importante occorre anche passare il dato quindi 
        
        {{route('article.show', compact('article'))}}

    -27 Creiamo il nouvo componente livewire per cancella gli articoli con il comando
        php artisan make:livewire ArticleDelete

       -ed andiamo a gestire la logica su app\Livewire\ArticleDelete.php ad esempio: 

            public function deleteArticle(){
                if ($this->article->user->id == Auth::id()) {
                    $articleName = $this->article->title;
                    if ($this->article->img != null) {
                        Storage::delete($this->article->img);
                    }
                    $this->article->delete();
                    return redirect()->route('welcome')->with('successMessage', 'Articolo "' . $articleName .  '" eliminato');
                } else {
                    return redirect()->route('welcome')->with('errorMessage', 'Non disponi delle autorizzazioni per cancellare questo articolo');
                }
            }

    -28 Passiamo a gestire il front-end
        inseriamo la stringa
        <button wire:click="deleteArticle" class="btn btn-danger">Elimina l'articolo</button>


    

        









     
       












                              LIVEWIRE CREARE UN COUNTER                   
                  Documentazione:     https://livewire.laravel.com/docs/quickstart  

      -  1 Installare usando il comando:   composer require livewire/livewire 

      -  2 Lanciare il comando per creare il component "counter" php artisan make:livewire counter 

      -  3 Richiamare all'interno della vista che ci interessa il nuovo componente "counter" appena creato 
          usando la sintassi:   livewire:nome-del-componente, in questo caso:  livewire:counter  
          oppure con @livewire('counter')  
          Importante!!!  Un component livewire può contenere al sul interno un solo <div></div> contenente altri div  

      - 4 Aprire il controller all'interno della cartella app\Livewire\Counter ed inserire le stringhe contenenti 
          gli attributi suggeriti nella documentazione:<https://livewire.laravel.com/docs/quickstart>  



      public $count = 1;
        
      public function increment()
      {
          $this->count++;
      }
  
      public function decrement()
      {
          $this->count--;
      }
  
      public function render()
      {
          return view('livewire.counter');
      }


      IMPORTANTE!!!! Qualsiasi attributo pubblico dichiarato nel componente backend livewire sarà subito disponibile al componente frontend livewire tramite blade sintax   
      in questo caso: {{$count}}

    -  5 Continuando a seguire la documentazione ci creiamo i due pulsanti per incrementare e decrementare
          <button wire:click="increment">+</button>
          <button wire:click="decrement">-</button>
          Questo tipo di azioni che modificano un attributo pubblico fanno automaticamente scattare il render del componente
          Minuto 00:53:00 della lezione Livewire 



