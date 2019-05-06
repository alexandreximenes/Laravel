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
        return response()->json(['data' => $users ], 200);
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

           return response()->json(["data" => $user], 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json(["data" => $user], 200);
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
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

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
                return response()->json(['error' => "Only verified users can modify the admin field", 'code' => 409], 409);
            endif;

            $user->admin = $request->admin;
        endif;

        if(!$user->isDirty()):
            return response()->json(['error' => "You need to specify a differente value to update", 'code' => 422], 422);
        endif;

        $user->save();
        return response()->json(['data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if(!is_null($user)):
            $user->delete();
            return response()->json(['data' => $user], 200);
        else:
            return response()->json(['error' => "User not found", 'code' => 404], 404);
        endif;

    }
}
