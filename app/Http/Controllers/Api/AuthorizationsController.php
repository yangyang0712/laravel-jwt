<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthorizationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Reader\Xls\MD5;

class AuthorizationsController extends Controller
{
    public function store(AuthorizationRequest $request)
    {
        $username = $request->username;
        $credentials['email'] = $username;
        $credentials['password'] = $request->password;
        if (!$token = \Auth::guard('api')->attempt($credentials)) {
            return '用户名或密码错误';
        }
        $email_token = md5($token . $request->username);
        User::query()->where('email', $username)->update(['token' => $email_token]);
        return response()->json(
            [
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'expires_in'   => \Auth::guard('api')->factory()->getTTL() * 60
            ]
        );
    }

    public function update(Request $request)
    {
        $username = $request->username;

        $token = \Auth::guard('api')->refresh();
        User::query()->where('email', $username)->update(['token' => $token]);
        return response()->json(['token' => $token]);
    }

    public function destroy()
    {
        \Auth::guard('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
