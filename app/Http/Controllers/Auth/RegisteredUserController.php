<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telephone' => ['required', 'integer', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $slug = $this->slugify($request->name ."-". time());
        $path = null;
        $filename=null;
         if (isset($request->photo)) {
         $filename = $slug .'.'. $request->photo->extension();
             $path = $request->photo->storeAs("user",$filename,"public");
         }
         else {
             $path = "user/avatar.jpg" ;
         }
          

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            "path"=>$path,
            'slugUser' => $slug,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public function updateInfo(Request $request,$slugUser)
    {
        if ($slugUser === Auth::user()->slugUser) {
            return view("user.updateprofile",["success"=>false]);
        }
        abort(404);
    }
    public function storeUpdateInfo(Request $request,$slugUser)
    {
        $user = User::where("slugUser",$slugUser)->first();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'telephone' => ['required', 'integer'], 
        ]);
        $path = null;
        $filename=null;
         if (isset($request->photo)) 
         {
            $filename = $slugUser .'-update.'. $request->photo->extension();
             $path = $request->photo->storeAs("user",$filename,"public");
             Storage::disk("public")->delete($user->path);

         }
         else 
         {
             $path = Auth::user()->path ;
         }
          
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            "path"=>$path
        ]);

        return view("user.viewMyupdate");
        
    }
}
