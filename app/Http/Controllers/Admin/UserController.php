<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface as UserInterface;
use Lang;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return redirect()->back()->with([
                'flash_message', Lang::get('admin.user.not_search_user'),
                'flash_level' => 'danger'
            ]);
        } else {
            $user->is_active = $user->is_active ? false : true;
            $user->save();

            return redirect()->back()->with([
                'flash_message' => Lang::get('admin.user.update_user_success'),
                'flash_level' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return redirect()->back()->with([
                'flash_message', Lang::get('admin.user.not_search_user'),
                'flash_level' => 'danger'
            ]);
        } else {
            $user->delete();
            
            return redirect()->back()->with([
                'flash_message' => Lang::get('admin.user.delete_success'),
                'flash_level' => 'success'
            ]);
        }
    }
}
