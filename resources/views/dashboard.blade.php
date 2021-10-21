<x-header title="acceuil" active="repertoire">

<x-slot name="style">
  <style>
    #boite{
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height:100%;
      display: flex;
      justify-content: center;
      background-color: rgba(255, 2555, 255, 0.9);
    }
    #boiteMessage{
      background-color: white;
      margin: auto;
      width: 300px;
      border: 2px solid;
      text-align: center
    }
    .lightbox__close{
      position: fixed;
      font-family:  sans-serif;
      top: 20px;
      right: 20px;
      font-size: 70px;
      color: rgba(211, 20, 20, 0.438);
      transition : transform 0.7s;
      background-color: transparent;
    }
    .lightbox__close:hover,.lightbox__btn:hover{
        cursor: pointer;
        transform: scale(1.2);
    }
    #link{
      height: 50px;
      text-align: center;
      font-size: 20px;
      border: 1px ;
      box-shadow: 1px 1px 1px 1px  #eee8e8 ;
      padding-top: 0.5rem;
      margin-bottom: 10px;
      margin: 10px  20%;
      color: rgb(132, 156, 236);
      
    }
  </style>
</x-slot>



<div class=" text-center mt-4">
  <h3>Bonjour  <span class="text-primary">{{Auth::user()->name}}</span> </h3>
  <div id="link">
    lien:<span> {{ route(('espaceVendeur'),['slugVendeur' => Auth::user()->slugUser]) }}  </span>
  </div>
  @if($vide)
      <div>
        vous n'avez pas d'articles pour le moment cliquez 
        <a href="{{ route('addProduct') }}">ici</a>
        pour en ajouter
      </div>  
    @endif
</div> 
<main role="main">  
    <div class="container py-5  ">
      <div id="app">

      <div class="row container">
@foreach ($articles as $key => $article)
              
        <div class="col-md-4 " style="width:260px; height:260px mb-3"  >
            <div class="card mb-4 box-shadow " >
                <div style="background-color: rgba(0, 0, 0, 0.486); ">
              <a style="text-decoration: none;color:rgba(31, 31, 28)" href="{{route('ViewProduct',['slugUser' =>Auth::user()->slugUser,'slugArticle'=> $article->slugArticle])}}">  
                <img class="card-img-top img-responsive " style="object-fit: contain;"  src="{{Storage::url($path[$key][0]->path)}}" height="200px" width="200px"  alt="Card image cap">
              </a>

              </div>
              <div class="card-body">
                  <pre> {{ $article->nomArticle }}  </pre>
                  <pre> {{ $article->prixArticle }}</pre>  
                  @php
                                        
                      $urlVoir = route('ViewMyProduct',['slugUser' => Auth::user()->slugUser,'slugArticle'=> $article->slugArticle]);
                      $urlModifier = route('editMyProduct',['slugUser' => Auth::user()->slugUser,'slugArticle'=> $article->slugArticle]);

                  @endphp
                    
                      <div class="d-flex justify-content-between align-items-center">

                        @auth   
                              @if (Auth::user()->id === $article->user_id)
                        <button type="button" onclick="window.location.href='{{$urlModifier}} ' " class="btn btn-sm btn-primary text-white btn-outline-secondary">Modifier</button>
                                
                                <button type="button"  class="btn btn-sm btn-danger open text-white btn-outline-secondary">Supprimer</button>
                                <form  action="{{ route('delete',[$article->slugArticle]) }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                              @endif     
                          @endauth
                  </div>
                
              </div>
            </div>
        </div>
@endforeach

      </div>
      
    </div>
    </div>
   
</main>

<div id="boite"  class="close" hidden >
  <div id="boiteMessage">
    Êtes vous sûr de bien vouloir supprimer cette article 
    <span class="text-danger"> attention cette action est irréversible</span>
    <button  class="btn btn-sm btn-danger"> oui</button>
  </div>
  <div class="lightbox__close close" id="okClose" >X</div>
</div>


</x-header>
<script>

  boite =  document.querySelector("#boite");
  message =  document.querySelector("#boiteMessage");
  okClose =  document.querySelector("#okClose");
  open =  document.querySelectorAll(".open");
  close =  document.querySelectorAll(".close");
  bouttonPressed = null

  open.forEach(element => {
    element.addEventListener("click",function (e) {
      e.preventDefault();
      bouttonPressed = element
      boite.removeAttribute("hidden")
    })
  });
  close.forEach(element => {
    element.addEventListener("click",function (e) {
      e.preventDefault();
      bouttonPressed= null
      e.stopPropagation();
      boite.setAttribute("hidden",true)
    })
    
  });
  message.addEventListener('click',function (e) { 
      e.stopPropagation()
      if(bouttonPressed === null)
      {
        return
      }
      bouttonPressed.parentNode.children[2].submit()
   });


</script>

</body>
</html>