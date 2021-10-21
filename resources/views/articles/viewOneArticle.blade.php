<x-header title="{{$article->nomArticle}}" active="{{$categorie->nomCategorie}}">

 
<x-slot name="style">

    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        .user-responsive{
            align-items:center;
            height: 150px;
            width:40%;
            margin-left: 50%
        }
    
        @media only screen and (max-width:900px){
            .user-responsive{
                width: 100%;
                margin: 0 ;
            }
            .lightbox-responsive{
                height: 150px;
                width: 150px;
            }
        }
    </style>
</x-slot>
 
@php
     $user = $article->user()->get()->first();
@endphp
@auth
    @if (Auth::user()->id !== $article->user_id)
    
    <div class="mb-3 d-flex justify-content-center bg-info user-responsive" >
        <img src="{{Storage::url($article->user()->get()->first()->path)}}" style="height: 100px; object-fit: contain;"   class=" img-responsive  rounded-circle" alt="">
        <div class="px-5 pt-4 d-grid">
           <a style="text-decoration: none;color:rgb(14, 106, 212)" href="{{ route(('espaceVendeur'),['slugVendeur' => $article->user()->get()->first()->slugUser]) }}">  <h4  > {{ $user->name }} </h4> </a>
           Vendeur
        </div>
    </div>
    @endif
@endauth
    @guest
    <div class="mb-3 d-flex justify-content-center bg-info user-responsive" >
        <img src="{{Storage::url($article->user()->get()->first()->path)}}" style="height: 100px; object-fit: contain;"   class=" img-responsive  rounded-circle" alt="">
        <div class="px-5 pt-4 d-grid">
           <a style="text-decoration: none;color:rgb(14, 106, 212)" href="{{ route(('espaceVendeur'),['slugVendeur' => $article->user()->get()->first()->slugUser]) }}">  <h4  > {{ $user->name }} </h4> </a>
           Vendeur
        </div>
    </div>
    @endguest
<section class="py-5">
        @auth
            @if (Auth::user()->id === $article->user_id)
            @php
            $urlModifier = route('editMyProduct',['slugUser' => Auth::user()->slugUser,'slugArticle'=> $article->slugArticle]);
        @endphp

        <div style="text-align: center;">
            <a href="{{ $urlModifier }}"  >
                <img height="50px" style="margin-right:20px;" width="50px" src="{{Storage::url('user/edit.svg')}}" alt="">
            </a> 
        </div>
        @endif
        
     @endauth   
    <div class="container px-4 px-lg-5 my-5">
        
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                
                <div id="app">
                    <div class="d-flex  flex-wrap">
                    @foreach ($photos as $photo)
                    
                        <a v-bind:href="'{{Storage::url($photo->path)}}'" v-lightbox >
                            <img v-bind:src="'{{Storage::url($photo->path)}}'"  height="250px" width="200px"  class="lightbox-responsive">
                         </a>
                    @endforeach

                </div>

                </div>
            </div>
            <div class="col-md-6">
                
                <h1 class="display-5 fw-bolder">{{$article->nomArticle}}</h1>
                <div class="px-4 fs-5 mb-5">
                    <div><strong>Catégorie</strong> {{$categorie->nomCategorie}}</div>
                    <div><strong>Etat</strong> {{$article->etatArticle}}</div>
                    <div><strong>Prix</strong> {{number_format($article->prixArticle,0,","," ")}}</div>
                    <div><strong>Nombre de Vue</strong> {{$article->nbreVue}}</div>
                    <div><strong>Ajouter il y'a</strong> {{$durree}}</div>
                    <h4 class="mt-2">Détails</h4>
                    @foreach ($details as $detail)
                            <div class="px-2">
                                 <strong>{{$detail->type}}</strong>  {{$detail->valeur}}
                            </div>
                    @endforeach
                </div>
                    <h3>Description</h3>
                <p class="lead">{!! nl2br(htmlspecialchars($article->descriptionArticle))!!} </p>
               
            </div>
        </div>
    </div>
</section>
<lightbox></lightbox>

<div class="card">
    @comments(['model' => $article])
</div>
</x-header>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

</body>
</html>



