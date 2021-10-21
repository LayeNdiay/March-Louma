<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>



    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        transition:all .2s linear;
        font-family: Arial, Helvetica, sans-serif;
        text-decoration:none;

    }
  
    .content{
        min-height:130vh;
        
    }
    header .header-1{
        display: flex;
        align-items:center;
        justify-content: space-between;
        background:#fff;
        width:100%;
        padding:10px 20px;
    }

    header .header-1 .logo{
        color:crimson;
        font-size:25px;
    }
    header .header-1 form{
        display:flex;
    }
    header .header-1 form #search1{
        height:40px;
        width:300px;
        
        background:none;
        outline: none;
        border:2px solid crimson;
        color:#333;
        padding: 0 10px;
        font-size:17px;
    }
    header .header-1 form label{
        height:40px;
        width:60px;
        background: crimson;
        cursor:pointer;
        line-height:40px;
        text-align:center;
        font-size:20px;
    }

    header .header-1  p{
        margin-left:15px;
        margin-top:5px;
        color:#333;

    }

    header .header-1  p a{
        color:#333;
        text-decoration:none;
    }

    header .header-1  strong{
        width:150px;
        text-align:center;
        color:white;
        height:40px;
        padding:10px 0px 10px 0px;
        background:crimson;
        border-radius:5px;
    }

    header .header-1  strong a{
        color:#fff;
        margin-top:10px;
        text-decoration:none;
    }


    header .header-1 form label:hover{
        color:#fff8;
    }
    

    /** media queries */

    @media (max-width:991px) {
        header .header-1 form #search{
            width:100%;

        }
    }






    @media (max-width:900px) {
        header .header-1 {
            flex-flow:column;
            
        }
        header .header-1 form{
        padding-top:10px;

        }
        header .header-1 form p{

        }
    }


    header .header-2{
        display: flex;
        align-items:center;
        justify-content: space-between;
        background:crimson;
        width:100%;
        padding:10px 20px;
    }

    header .header-2 .navbar ul{
        display: flex;
        align-items:center;
        justify-content: space-between;
        list-style:none;

    }

    header .header-2 .navbar ul li{
        margin:10px;

    }

    header .header-2 .navbar ul a{
        color:#fff;
        font-size:20px;
    }
    header .header-2 .navbar ul a:hover{
        color:#fff8;
    }
    

    header .header-2 .icons a{
        font-size:20px;
        color:#fff;
        margin:10px;

    }
    header .header-2 .icons a:hover{
        color:#fff8;

    }
    #menu{
        font-size:30px;
        color:#fff;
        cursor:pointer;
        display:none;
    }

    header .header-2 .sticky{
        position:fixed;
        top:0;
        left: 0;
        box-shadow:0 3px 5px #333;
    }


    @media (max-width:768px) {
        header .header-2 #menu{
            display:block;

        }

        header .header-2 .navbar{
            position:fixed;
            top:-1000px;
            left:50%;
            transform:translate(-50%, -50%);
            opacity: 0;
        }

        header .header-2 .navbar ul{
            flex-flow:column;
            width:250px;
            border-radius:5px;
            padding:30px 10px;
            background: crimson;
            box-shadow: 0 0 0 100vh rgba(0,0,0.5),
                        0 3px 5px #000;
        }

        header .header-2 .navbar ul li{
            width:100%;
            text-align:center;

        }
        header .header-2 .navbar ul li a{
            font-size:25px;
            display:block;
        }
        header .header-2 .navbar .nav-toggle{
            top:50%;
            opacity: 1;
        }
    }
    .active
    {
        background-color:#fff8;

    }

    .footer{
        background-color: #212F3D;
                color: white;
                margin-top: -50px;
                
    }
</style>
{{$style}}
</head>


<body>
<div id="app">

    <header>

        <div class="header-1 ">
            <div style="display: flex;justify-content:space-between; width: 60%">
				
				<div>
					<a href="#" class="logo"> marche Louma</a> 
				</div>				
		       
				<search></search>
			</div>
			@auth
			<div class="d-flex">
				<img src=" {{Storage::url(Auth::user()->path)}} " style="height: 49px; width :50px "   class=" img-responsive  rounded-circle" alt="">
				<div class="dropdown mx-2 mt-2">
					<button class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
						<a class="text-dark"  href="#" >
							{{ Auth::user()->name }}
						</a>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					  <li><a class="dropdown-item " href="{{ route('dashboard') }}">Mes articles</a></li>
					  <li><a class="dropdown-item" href="{{ route('addProduct') }}">ajouter un article</a></li>
					  <div class="dropdown-divider"></div>
					  <li><a class="dropdown-item" href="{{ route('updateInfo',['slugUser'=> Auth::user()->slugUser]) }}">mettre à jour mon compte</a></li>
					  <li><a class="dropdown-item" href="#">se désabonner</a></li>
					  <li> <a class="dropdown-item " href="{{ route('logout') }}"
						onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
							<button class="btn text-danger  btn-sencondary" >se déconnecter</button>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
					</a></li>
					</ul>
				</div>
			</div>	
				
			@endauth
			@guest
            <p> <a href="{{ route('login') }}">se connecter</a>
                /<a  href="{{ route('register') }}">s'inscrire</a>
			</p>
				
			@endguest
            
        </div>

        <div class="header-2">

        <div id="menu" class="fas fa-bars" onclick="navToggle();"> </div>
            <nav class="navbar">
                <ul>
                    <li class=" @if ($active === 'acceuil' ) active @endif">
						<a   onclick="navToggle();" href="/">Acceuil</a>
					</li>
                    @auth
                    <li class=" @if ($active === 'repertoire' ) active @endif">
						<a   onclick="navToggle();" href="/dashboard">Répertoire</a>
					</li>
                    @endauth
                    <li class="@if ( $active === 'immobilier' ) active @endif" >
                        <a    onclick="navToggle();" href=" {{route('ViewCategorie',[ 'nomCategorie' =>'immobilier'])}} " >Immoblier</a>
                    </li>
                    <li class="@if ( $active === 'vehicule' ) active @endif" >
                        <a    onclick="navToggle();" href=" {{route('ViewCategorie',[ 'nomCategorie' =>'vehicule'])}} " >Véhicules</a>
                    </li>
                    <li class="@if ( $active === 'electronique' ) active @endif" >
                        <a    onclick="navToggle();" href=" {{route('ViewCategorie',[ 'nomCategorie' =>'electronique'])}} " >Electronique</a>
                    </li>
                    <li class="@if ( $active === 'vetement' ) active @endif" >
                        <a    onclick="navToggle();" href=" {{route('ViewCategorie',[ 'nomCategorie' =>'vetement'])}} " >Vêtement</a>
                    </li>
                    <li class="@if ( $active === 'chaussure' ) active @endif" >
                        <a    onclick="navToggle();" href=" {{route('ViewCategorie',[ 'nomCategorie' =>'chaussure'])}} " >Chaussures</a>
                    </li>
                    <li class="@if ( $active === 'animaux' ) active @endif" >
                        <a    onclick="navToggle();" href=" {{route('ViewCategorie',[ 'nomCategorie' =>'animaux'])}} " >Animaux</a>
                    </li>
                    <li class="@if ( $active === 'agroalimentaire' ) active @endif" >
                        <a    onclick="navToggle();" href=" {{route('ViewCategorie',[ 'nomCategorie' =>'agroalimentaire'])}} " >Agroalimentaire</a>
                    </li>
                    <li class="@if ( $active === 'fournitures' ) active @endif" >
                        <a    onclick="navToggle();" href=" {{route('ViewCategorie',[ 'nomCategorie' =>'fournitures'])}} " >Fournitures</a>
                    </li>
                    
                    <li class="@if ( $active === 'mode' ) active @endif" >
                        <a    onclick="navToggle();" href=" {{route('ViewCategorie',[ 'nomCategorie' =>'mode'])}} " >Mode</a>
                    </li>
                    <li class="@if ( $active === 'autres' ) active @endif" >
                        <a    onclick="navToggle();" href=" {{route('ViewCategorie',[ 'nomCategorie' =>'autres'])}} " >Autres</a>
                    </li>
                </ul>
            </nav>

        </div>
    </header>

{{$slot}}
</div>
<script src="{{asset("/js/app.js")}}"></script>

<script  src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"> 
        let menu = document.querySelector('#menu');
        let navbar = document.querySelector('.navbar');
        let header2 = document.querySelector('.header-2');

        function navToggle() {
            menu.classList.toggle('fa-times');
            navbar.classList.toggle('nav-toggle');
        }

        window.addEventListener('scroll', function() {
            menu.classList.remove('fa-times');
            navbar.classList.remove('nav-toggle');

            if (window.scrollY > 60) {
                header2.classList.add('stcky');
            } else{
                header2.classList.remove('stcky');
            }
        });
</script>
