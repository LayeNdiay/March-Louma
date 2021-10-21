 <x-header title="Consulter un Article" active="repertoire">
<x-slot name="style">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
</x-slot>
@php
    $urlModifier = route('editMyProduct',['slugUser' => Auth::user()->slugUser,'slugArticle'=> $article->slugArticle]);
@endphp

<div style="text-align: center;">
    <a href="{{$urlModifier}}"  >
        <img height="50px" style="margin-right:20px;" width="50px" src="{{Storage::url('user/edit.svg')}}" alt="">
    </a>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <div id="app">
                    <carousel>
                        @foreach ($photos as $photo)
                            
                            <carousel-slide>
                            <img src="{{Storage::url($photo->path)}}" class="image-responsive" height="500px" width="100%">
                            </carousel-slide>
                        @endforeach

                    </carousel>
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">{{$article->nomArticle}}</h1>
                <div class="fs-5 mb-5">
                    <div><strong>Catégorie</strong> {{$categorie->nomCategorie}}</div>
                    <div><strong>Etat</strong> {{$article->etatArticle}}</div>
                    <div><strong>Prix</strong> {{$article->prixArticle}}</div>
                    <h4 class="mt-2">Détails</h4>
                    @foreach ($details as $detail)
                   <div><strong>{{$detail->type}}</strong>  {{$detail->valeur}}</div>
                    @endforeach
                </div>
                    <h4>Description</h4>
                <p class="lead">{!! nl2br(htmlspecialchars($article->descriptionArticle))!!} </p>
               
            </div>
        </div>
    </div>
</section>
@guest
<div class="  px-5 d-flex justify-content-start" style="height: 100px; background-color:rgb(192, 194, 223);">
    <img src="{{Storage::url('user/avatar.jpg')}}" style="height: 100px; object-fit: contain;"   class=" img-responsive  rounded-circle" alt="">
    <div class="px-5 pt-4 d-grid">
        <h4  > nom</h4>
        <div style="width: 500px;" class=" d-flex justify-content-arround">
            <div class="mx-2"><strong>tel</strong> : $40.0lvddsf0</div>
        <div><strong>email</strong> : $40.0qdfcbvdqsvfqvdshfvqn0</div>
        </div>
    </div>
</div>
@endguest

</x-header>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

</body>
</html>



<script src="{{asset("/js/app.js")}}"></script>
