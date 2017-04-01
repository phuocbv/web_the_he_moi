<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\User;
use Lang;
use Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface 
{
    public function model()
    {
        return User::class;
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    private function findUser($data)
    {
        return User::findUser($data)->first();
    }

    public function validate($data, $ruleName)
    {
        return $this->model->validate($data, $ruleName);
    }

    public function findOrCreateUser($provider, $user)
    {   
        $data = $user->email ? $user->email : $user->id;

        $authUser = $this->findUser($data);

        if ($authUser) {
            return $authUser;
        }

        $facebookId = null;
        $googleId = null;
        $twitterId = null;

        switch ($provider) {
            case 'facebook':
                $facebookId = $user->id;
                break;
            case 'google':
                $googleId = $user->id;
                break;
            case 'twitter':
                $twitterId = $user->id;
                break;
            default:
                break;
        }

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'is_active' => true,
            'facebook_id' => $facebookId,
            'google_id' => $googleId,
            'twitter_id' => $twitterId
        ];

        return $this->create($data);
    }

    public function login($data)
    {
        $this->validate($data, 'login');

        if (auth()->attempt([
            'email' => $data['email'], 
            'password' => $data['password']
        ])) {
            if (!auth()->user()->is_active) {
                Auth::logout();

                return back()->with('warning', Lang::get('register.please.active'));
            }
            if (auth()->user()->is_admin) {
                return redirect('/admin/users');
            }
            
            return redirect()->to('/');
        }
        
        return back()->with('warning', Lang::get('login.wrong'));
    }
}
