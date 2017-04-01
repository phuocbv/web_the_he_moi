<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;

use Lang;
use Hash;
use App\Helpers\MyFuncs;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:32',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|min:10|max:11|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'remember_token' => Hash::make($data['email']),
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Register new user
     *
     * @param  array  $data
     * @return User
     */
    public function register(Request $request)
    {
        $input = $request->only('name', 'email', 'phone', 'password', 'password_confirmation');
        $validator = $this->validator($input);

        if ($validator->passes()) {
            $user = $this->create($input)->toArray();
            $user['link'] = $this->createToken($user);
            MyFuncs::sendEmail([
                'view' => 'auth.activation',
                'data' => $user,
                'email' => $user['email'],
                'subject' => Lang::get('register.mail.subject')
            ]);

            return redirect()->to('login')->with('success', Lang::get('register.please.check.mail'));
        }
        return back()->with('errors', $validator->errors());
    }

    /**
     * userActivation for user Activation Code
     *
     * @param  array  $data
     * @return User
     */
    public function userActivation($id, $token)
    {
        $user = User::findUser($id)->first();
        if ($user && $this->createToken($user) == $token) {
            if ($user->is_active) {
                return redirect()->to('login')->with('success', Lang::get('register.already.actived'));
            }
            $user->update(['is_active' => true]);
            return redirect()->to('login')->with('success', Lang::get('register.success.actived'));       
        }
        return redirect()->to('login')->with('warning', Lang::get('register.invalid.token'));
    }

    public function createToken($data)
    {
        return md5($data['email'] . $data['name'] . $data['remember_token']);
    }
}
