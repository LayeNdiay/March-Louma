<x-header title="Mêttre à jours mon profile" active="repertoire">
<x-slot name="style">
    
</x-slot>
<div class="alert alert-success text-center">
    Modification éffectuer avec success
</div>
<div class="flex justify-center mt-3" style="width: 60%;margin-left:20%">
    <div class="mx-5 d-flex justify-content-space" style="height: 250px; background-color:rgba(246, 246, 240, 0.986);">
      <div>
        <img src="{{Storage::url(Auth::user()->path)}}" style="height: 250px; object-fit: contain;"   class=" img-responsive" alt="">
      </div>
      <div class="ps-3" >
            <h4> {{ Auth::user()->name }}</h4> 
            <div class="mt-3"><strong>tel</strong> : {{ Auth::user()->telephone }}</div>
            <div class="mt-3"><strong>email</strong> : {{ Auth::user()->email }}</div>
        </div>
    </div>
 </div>
</x-header>
</body>
</html>