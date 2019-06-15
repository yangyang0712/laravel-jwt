<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class JwtCheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::query()->where('email', $request->username)->first();
        $header = $request->header('authorization', null);
        if (!$header) {
            exit(json_encode('没有签名', JSON_UNESCAPED_UNICODE));
        }
        if ($user->token != md5($header.$request->username)) {
            exit(json_encode('请核对签名', JSON_UNESCAPED_UNICODE));
        }
        if ((time() - strtotime($user->updated_at)) / 60 > env('JWT_TTL')) {
            exit(json_encode('签名已经过期请重新获取', JSON_UNESCAPED_UNICODE));
        }
        return $next($request);
    }
}
