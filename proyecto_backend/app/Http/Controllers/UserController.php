<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $inputs["password"] = Hash::make(trim($request->password));
        $e = User::create($inputs);
        return response()->json(
            [
                "data" => $e,
                "message" => "User created successfully"
            ]
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $e = User::find($id);
        if(isset($e)){
            return response()->json(
                [
                    "data" => $e,
                    "message" => "User found"
                ]
                );
        }else{
            return response()->json(
                [
                    "data" => null,
                    "message" => "User not found"
                ]
                );
        }
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
        $e = User::find($id);
        if(isset($e)){
            $e->first_name = $request->first_name;
            $e->last_name = $request->last_name;
            $e->email = $request->email;
            $e->password = Hash::make($request->password);
            if($e->save()){
                return response()->json(
                    [
                        "data" => $e,
                        "message" => "User updated successfully"
                    ]
                    );
            }else{
                return response()->json(
                    [
                        "error" => true,
                        "message" => "User not updated"
                    ]
                    );
            }
        }else{
            return response()->json(
                [
                    "error" => true,
                    "message" => "User not found"
                ]
                );
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
        $e = User::find($id);
        if(isset($e)){
           $res = User::destroy($id);
           if($res){
               return response()->json(
                   [
                       "data" => $e,
                       "message" => "User deleted successfully"
                   ]
                   );
           }else{
               return response()->json(
                   [
                       "error" => true,
                       "message" => "User not deleted"
                   ]
                   );
           }
        }else{
            return response()->json(
                [
                    "error" => true,
                    "message" => "User not found"
                ]
                );
        }
}
}
