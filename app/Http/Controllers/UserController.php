<?php

namespace App\Http\Controllers;

use App\Mail\NotifyMail;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\False_;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:5,19',
            'email' => 'email:rfc,dns',
            'password' => 'required|confirmed|string|min:6',
            'img' => 'required|image|size:max:300|dimensions:max_width=200,max_height=300',
        ]);

        $email = $request ->email;


        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $limit = User::all()->count();

        if($limit <= 18) {
                $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

                $res = 'Thank you for registering';

                Mail::to($email)->send(new NotifyMail($res));
                return new JsonResponse([
                    'message'=>"Thank you for registering",
                    'user' => $user,
                ],201);

        }else{
               return response()->json([
                 'message' => "User couldn't registered",
                 'user' => 'The registration limit has been reached'
               ], 422);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
