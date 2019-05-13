<?php

namespace App\Http\Controllers\User;

//use App\HttpStatus;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->showAll($users, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6:confirmed',
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::genetateVerificatinCode();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);

        return $this->showOne($user, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function show($id)
    public function show(User $user)
    {
        //$user = User::findOrFail($id);
        return $this->showOne($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
     public function update(Request $request, User $user)
    {
        //$user = User::findOrFail($id);

//        dd($user);

        $rules =  [
            'email' => 'email|unique:users, email, ' .$user->id,
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
        ];

        $this->validate($request, $rules);

        if($request->has('name')):
            $user->name = $request->name;
        endif;

        if($request->has('email') && $user->email != $request->email):
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::genetateVerificatinCode();
            $user->email = $request->email;
        endif;

        if($request->has('password')):
            $user->password = bcrypt($request->password);
        endif;

        if($request->has('admin')):
            if(!$user->isVerified()) :
                return $this->errorResponde("Only verified users can modify the admin field", 409);
            endif;

            $user->admin = $request->admin;
        endif;

        if(!$user->isDirty()):
            return $this->errorResponde("You need to specify a differente value to update", 422);
        endif;

        $user->save();
        return $this->showOne($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy($id)
    public function destroy(User $user)
    {
        //$user = User::findOrFail($id);

        if(!is_null($user)):
            $user->delete();
            return $this->showOne($user, 200);
        else:
            return $this->errorResponde("User not found", 404);
        endif;

    }
}
