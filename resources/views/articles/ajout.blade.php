<x-header title="Ajouter un Article" active="repertoire">

    <x-slot name="style">
        <style>
            .asterisk{
            font-size: 20px;
            color: red;
        }
        
        </style>
    </x-slot>

@if ($errors->any())
    <div class="alert alert-danger">
        formulaire mal rempli
    </div>
@endif

<div class=" alert alert-info" >
    <blockquote class="blockquote text-center .bg-secondary">
         les champs avec  <span class="asterisk"> * </span> sont obligatoires
   </blockquote>
</div>

<form action="{{route('storeProduct')}}" method="post" enctype="multipart/form-data" class="container" id="container">
    @csrf
    <div class="row alim-items-center mt-3 ">
        <div class="mt-3 col-auto my-1 ">
            <label for="nomArticle " >nom de l'article </label> <span class="asterisk"> * </span>
            <input type="text" class="form-control @error('nomArticle')  is-invalid  @enderror" value=" {{old('nomArticle')}} " name="nomArticle" id="nomArticle">
            @error('nomArticle')
                <div  class="invalid-feedback">
                    
                    {{ $errors->first("nomArticle") }}
                </div>
            @enderror
        </div>
        <div class="drag-area form-group files color col-sm-3 my-1">
            <label for="photo">photos de l'article</label> <span class="asterisk"> * </span>
            <input v-pre id="photo"  multiple name="photo[]" accept="image/*" class="photos @error('photo')  is-invalid  @enderror "  type="file" multiplename="photo"label="glissez les images de l'article " help="glisser vos fichier pour le visualiser" is="drop-files"/>
            @error('photo')
                <div  class="invalid-feedback">
                    {{ $errors->first("photo") }}
                </div>
            @enderror
        </div>  
    </div>
    <div class="row align-items-center mt-3">
        <div class="mt-3 col-auto my-1 ">
            <label for="etat " >Etat de l'article </label> <span class="asterisk"> * </span>
            <input type="text"  class="form-control @error('etat')  is-invalid  @enderror" value=" {{old('etat')}} " name="etat" id="etat">
                @error('etat')
                <div  class="invalid-feedback">
                    {{ $errors->first("etat") }}
                </div>
            @enderror
        </div>
        <div class="mt-3 col-auto my-1 ">
            <label for="prix" >prix de l'article </label> <span class="asterisk"> * </span>
            <input type="number"  class="form-control @error('prix')  is-invalid  @enderror" value=" {{old('prix')}} " name="prix" id="prix">
            @error('prix')
            <div  class="invalid-feedback">
                {{ $errors->first("prix") }}
            </div>
        @enderror
        </div>
        <div class="col-sm-3 my-1 input-group pt-4" style="width: auto; ">
                <div class="input-group-prepend">
                    <label class="input-group-text">Catégorie</label>
                </div>
                    <select required class="custom-select @error('categorie')  is-invalid  @enderror" name="categorie">
                            @error('categorie') <option selected value="{{old('categorie')}}">{{old('categorie')}}</option> @enderror
                            <option value="vehicule">véhicules</option>
                            <option value="immobilier">immobilier</option>
                            <option value="Maison">Maison</option>
                            <option value="electronique">electronique</option>
                            <option value="vetement">vêtements</option>
                            <option value="chaussure">chaussure</option>
                            <option value="mode">mode</option>
                            <option value="animaux">animaux</option>
                            <option value="autres">autres</option>
                            <option value="fournitures">fournitures</option>
                            <option value="agroalimentaire">agroalimentaire</option>
                    </select>
        </div>
    </div>
    
    <div class="col-auto my-1  ">
        <label for="description">Desciption </label><span class="asterisk"> * </span>
        <textarea name="description"  class="form-control @error('description')  is-invalid  @enderror" id="description" rows="3" >{{old("description")}}</textarea>
            @error('description')
            <div  class="invalid-feedback">
                {{ $errors->first("description") }}
            </div>
        @enderror
    </div>
    <div id="app">
        <div id="detail">
            <h5>Details</h5>
                <div class="row alim-items-center mt-3 " id="original">
                    <div class="mt-3 col-auto my-1 ">
                            <label >type  </label> 
                            <input type="text" class="form-control" name="typeProduit[]" >
                    </div>
                    <div class="mt-3 col-auto my-1 ">
                            <label for="valeur"> valeur</label> 
                            <input type="text" class="form-control" name="valeur[]">
                    </div>
                    <div class="mt-3 col-auto my-1">
                        <span class="btn btn-danger supprimer" @click.prevent="deleteDetail"   > x Supprimer </span>

                    </div>
                </div>
        </div>
            <div id="mesBouttons">
                <span class="btn btn-secondary " @click.prevent="addDetails" id="ajout"> + Rajouter </span>
            </div>
    <div class="text-center form-group ml-50 mt-5  " style="width=100%">
      <input type="submit" class="btn btn-primary px-4" value="enregistrer">
    </div>
</form>

</div>

</x-header>


<script type="module" src="//unpkg.com/@grafikart/drop-files-element"></script>


