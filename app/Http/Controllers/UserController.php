<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function get($key, $id)
    {
        if ($key == Config::get('app.api')) {

            $user = User::where('steamid', $id)
                ->first();

            $res = 200;

            if (!$user) {
                $userID = User::insertGetId([
                    'steamid' => $id,
                ]);

                $res = 201;

                $user = User::find($userID);
            }
        } else {
            $res = 401;
        }

        return response()->json([
            'code' => $res
        ], $res); // Status code here

    }

    public function updatePoints($key, $id, Request $request)
    {
        if ($key == Config::get('app.api')) {
            $validator = Validator::make($request->all(), [
                'points' => 'required',
            ]);

            if ($validator->fails()) {
                $res = 400;
            } else {

                User::upsert([
                    ['steamid' => $id, 'points' => $request->input('points')]
                ], ['steamid'], ['points']);


                $res = 202;
            }

            return response()->json([
                'code' => $res
            ], $res);
        }
    }
}
