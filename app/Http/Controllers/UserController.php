<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface as UserInterface;

class UserController extends Controller
{

    private $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('user.edit');
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
        if ($this->userRepository->getCurrentUser()->id == $id) {
            $data = $request->only('name', 'phone', 'avatar');
            if ($this->userRepository->getCurrentUser()->validate($data, 'update')) {
                $this->userRepository->update($data, $id);
            }
        }
        
        return view('errors.error')->withErrors($this->userRepository->getCurrentUser()->valid());
    }

}
