<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;


class UserConutroller extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['data' => $users], 200);


    }

    public function mail($id)
    {
        $user = User::find($id);
        $code = str::random(5);

        Mail::to("$user->email")->send(new testMail($code, $user));


    }

    public function checkmail(Request $request, user $user)
    {
        return response()->json(['data' => session()->all()], 200);

    }

    public function store(Request $request)
    {

        try {


            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required']);


            $user = User::create($validatedData);

            $token = $user->createToken('user')->accessToken;
            return response()->json(['token' => $token], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }

    }

}
