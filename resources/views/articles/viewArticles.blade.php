@php
    $titre  = $visite === false ? $active : $visite->name;
@endphp

<x-header title="{{ $titre }}" active="{{$active}}">
<x-slot name="style">
  <style>
    #boite
    {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height:100%;
      display: flex;
      justify-content: center;
      background-color: rgba(255, 2555, 255, 0.9);
    }
    #boiteMessage
    {
      background-color: white;
      margin: auto;
      width: 300px;
      border: 2px solid;
      text-align: center
    }
    .lightbox__close
    {
      position: fixed;
      font-family:  sans-serif;
      top: 20px;
      right: 20px;
      font-size: 70px;
      color: rgba(211, 20, 20, 0.438);
      transition : transform 0.7s;
      background-color: transparent;
    }
    .lightbox__close:hover,.lightbox__btn:hover
    {
        cursor: pointer;
        transform: scale(1.2);
    }
    .responsiveUserImage
      {
        height: 250px; 
        object-fit: contain;
      }
      .responsiveUerDiv
      {
        width: 60%;
        margin-left:20%;
        justify-content: center;
      }
    @media (max-width:900px)
    {
      .responsiveUserImage
      {
        height: 100px;
        width: 100px;
      }
      .responsiveUerDiv
      {
        width: 100%;
        margin: 0;
        justify-content: left;
        overflow:scroll;
      }
    }
  
  </style>
</x-slot>
@if ($active === "search")
    @if (count($articles) === 0 )
    <div class="alert alert-info text-center">
      Aucun article trouvé
    </div>
    @else
    @if (count($articles) === 1)
    <div class="alert alert-info text-center">
      {{count($articles)}} arrticle trouvé
    </div>
    @else
    <div class="alert alert-info text-center">
      {{count($articles)}} arrticles  trouvés
    </div>
    @endif
    @endif
@endif
@if ($visite)
   <div class="flex responsiveUerDiv" >
      <div class=" d-flex " style=" background-color:rgba(246, 246, 240, 0.986);">
        <div>
          <img src="{{Storage::url($visite->path)}}"   class="responsiveUserImage  " alt="">
        </div>
        <div class="ps-4" >
              <h4> {{ $visite->name }}</h4> 
              <div class="mt-3"><strong>tel</strong> : {{ $visite->telephone }}</div>
              <div class="mt-3"><strong>email</strong> : {{ $visite->email }}</div>
              <div class="mt-3"><strong>Nombres d'annonces</strong> : {{count($articles) }}</div>
          </div>
      </div>
   </div>
@endif

@if ($vide)
<div class="text-center my-5">
    Il n'existe pas d'articles pour cette catégorie
  </div>    

@else
<main role="main">  
    <div class="container py-5  ">

      <div class="row container">
@foreach ($articles as $key => $article)
        <div class="col-md-4 " style="width:260px; height:260px mb-3"  >
           <a style="text-decoration: none;color:rgba(31, 31, 28)" href="{{route('ViewProduct',['slugUser' => $article->user()->get()->first()->slugUser,'slugArticle'=> $article->slugArticle])}}">  

            <div class="card mb-4 box-shadow " >
                <div style="background-color: rgba(0, 0, 0, 0.486); ">
                        <img class="card-img-top img-responsive " style="object-fit: contain;"  src="{{Storage::url($path[$key][0]->path)}}" height="200px" width="200px"  alt="Card image cap">
                </div>
                <div class="card-body " style="font-size: 17px">
                        <pre> {{ $article->nomArticle }}  </pre>
                        <pre style="color:rgb(67, 59, 190)"> {{number_format($article->prixArticle,0,","," ")}}</pre>  
                </div>
            </div>

           </a>
        </div>
@endforeach

      </div>
      
    </div>
   
</main>
@endif


</x-header>

</body>
</html>