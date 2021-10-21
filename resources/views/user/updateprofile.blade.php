<x-header title="Mêttre à jours mon profile" active="repertoire">
<x-slot name="style">
    <style>
    
        @media only screen and (max-width:700px){
            .responsive{
            justify-content: center;
            flex-wrap: wrap;
            }
        }
    </style>
</x-slot>
<div class="d-flex  responsive container mt-4">
    <div>
        <img src="{{Storage::url(Auth::user()->path)}}" height="200px" width="200px" >
    </div>
        <div class="container ">
            <div class="row justify-content-start">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('updateInfo',['slugUser'=>Auth::user()->slugUser]) }}"  enctype="multipart/form-data">
                                @csrf
                                
        
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
        
                                        <div class="col-md-6">
                                            <input id="name"  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->name}}" required autocomplete="name" autofocus  />
        
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        
                                        <div class="col-md-6">
                                            <input id="email"  type="email" class="form-control @error('email') is-invalid @enderror"  name="email" value="{{Auth::user()->email}}" required autocomplete="email">
        
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label for="telephone" class="col-md-4 col-form-label text-md-right">téléphone </label>
        
                                        <div class="col-md-6">
                                            <input id="telephone"  type="tel" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{Auth::user()->telephone}}" required >
        
                                            @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label for="photo" class="col-md-4 col-form-label text-md-right">photo</label>
        
                                        <div class="col-md-6">
                                            <input id="photo" type="file" accept="image/*" class="form-control @error('photo') is-invalid @enderror" name="photo" value=""  >
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="mt-2col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                mettre à jour
                                            </button>
                                        </div>
                                    </div>
                            </form>
    
                        </div>
    
                    </div>
    
                </div>
    
            </div>
            
        </div>
</div>
</x-header>

</body>
</html>