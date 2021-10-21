<x-header active="acceuil" title="connexion" >
<x-slot name="style">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
    
        body {
            background: #E1EBEC;
            font-family: 'Poppins', sans-serif;
        }
    
        .row {
            width: 900px;
            border: none;
            border-radius: 0;
            box-sizing: border-box
        }
    
        .lcol {
            background: linear-gradient(to bottom, rgba(26, 111, 118, 1) 50%, rgba(40, 30, 101, 1) 100%, rgba(125, 185, 232, 1) 100%);
            height: 550px;
            padding: 0 35px
        }
    
        .rcol {
            background: #fff;
            padding: 80px;
            height: 550px
        }
    
        span.txt {
            color: #17C296
        }
    
        .greeting {
            padding-top: 200px;
            padding-right: 90px
        }
    
        h6.mt-3 {
            padding-right: 115px
        }
    
        .footer {
            margin-top: 220px
        }
    
        .footer span {
            color: #B0A1E2;
            font-size: 9px;
            cursor: pointer
        }
    
        .fab {
            color: #EDEDF5;
            font-size: 10px;
            margin-right: 20px;
            padding-top: 3px;
            cursor: pointer
        }
    
        h2.heading {
            font-weight: bold
        }
    
        .form-control {
            border: none;
            border-radius: 0px;
            border-bottom: 1px solid #F2F2F2
        }
    
        .form-control::placeholder {
            font-size: 13px;
            color: #C2C2CC
        }
    
        .form-control:focus {
            box-shadow: none;
            border-bottom: 1px solid #F2F2F2
        }
    
        .fone input {
            padding-left: 20px
        }
    
        .fone {
            position: relative
        }
    
        .fone .fas {
            position: absolute;
            left: 0;
            top: 5px;
            padding: 8px 0px;
            color: #C2C2CC;
            font-size: 12px
        }
    
        .fone .image {
            position: absolute;
            left: 275px;
            top: 0px;
            cursor: pointer
        }
    
        .form-check-input {
            margin-top: 10px
        }
    
        .form-check-label {
            font-size: 9px;
            color: #C2C2CC
        }
    
        .btn-success {
            padding: 7px 40px;
            background: #11C892;
            border: none;
            border-radius: 30px;
            font-size: 9px
        }
    
        .btn-success:hover {
            background: #11C892
        }
    
        .btn-success:focus {
            box-shadow: none
        }
    
        u {
            cursor: pointer
        }
    
        p.exist {
            font-size: 9px;
            color: #C2C2CC
        }
    
        p.exist span {
            cursor: pointer;
            color: #ABA5D3
        }
    
        @media screen and (max-width: 993px) {
            .fone .image {
                position: absolute;
                left: 180px
            }
    
            .footer {
                margin-top: 170px
            }
        }
    
        @media screen and (max-width: 768px) {
            .row {
                width: 450px
            }
    
            .rcol {
                padding: 60px 180px 60px 60px
            }
        }
    
        @media screen and (max-width: 420px) {
            .rcol {
                padding: 60px 50px 60px 50px
            }
    
            .footer {
                margin-top: 140px
            }
        }
        }
    </style>
</x-slot>

<div class="container d-flex justify-content-center">
    <div class="row my-5">
        <div class="col-md-6 text-left text-white lcol">
            <div class="greeting">
                <h3>Welcome to <span class="txt">Marche Louma</span></h3>
            </div>
            <h6 class="mt-3">Tous vendre tous acheté...</h6>
            <div class="footer">
                <div class="socials d-flex flex-row justify-content-between text-white">
                    <div class="d-flex flex-row"><i class="fab fa-linkedin-in"></i><i class="fab fa-facebook-f"></i><i class="fab fa-twitter"></i></div> <span>Marché Louma Sen Marché Digital </span> <span>&copy; 2021 Dream Team</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 rcol">
            <form class="sign-up" method="POST" action="{{ route('login') }}">
              @csrf
                <h2 class="heading mb-4">Connexion</h2>
                
                <div class="form-group fone mt-2">
                     <i class="fas fa-envelope"></i> 
                     <input  id="inputEmail" type="email" placeholder="Email address" name="email" value="{{old('email')}}" required autofocus  class="form-control rounded-pill border-0 shadow-sm px-4">
                </div> <br>
                <div class="form-group fone mt-2"> 
                    <i class="fas fa-lock"></i> 
                    <input id="inputPassword" type="password" placeholder="Password" name="password"
                                required autocomplete="current-password" class="form-control rounded-pill border-0 shadow-sm px-4 text-danger"> <br>
                    
                </div>  <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Souvenez-vous de moi') }}</span> <br> <br>
                    <button type="submit" class="btn btn-danger btn-block text-uppercase mb-2 rounded-pill shadow-sm">Connexion</button>

                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('mot de passe oublié?') }}
                    </a>
                @endif
            </form> 
            <p class="exist mt-4">Vous n'avez pas encore un compte? <span><a href="/register">S'inscrire</a></span></p>
        </div>
    </div>
</div>
</x-header>
    
</body>
</html>