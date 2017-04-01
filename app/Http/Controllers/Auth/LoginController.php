<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Repositories\Contracts\UserRepositoryInterface as UserInterface;
use Auth;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    private $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->userRepository = $userRepository;
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
 
    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $authUser = $this->userRepository->findOrCreateUser($provider, $user);
            Auth::login($authUser, true);
        } catch (Exception $e) {
            return redirect('auth/' . $provider);
        }
 
        return redirect('/');
    }

    protected function login(Request $request)
    {
        $data = $request->only('email', 'password');
        
        return $this->userRepository->login($data);
    }

    public function logout(Request $request)
    {
        $cart = collect(session()->get('cart'));

        $destination = \Auth::logout();

        if (!config('cart.destroy_on_logout')) {
            $cart->each(function($rows, $identifier) {
                session()->put('cart.' . $identifier, $rows);
            });
        }

        return redirect()->to($destination);
    }
}
