<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ApiBasicAuthenticate
{

    protected $url = [
        '/api/register'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if (!in_array($request->getRequestUri(),$this->url))
        {

            if ($request->hasHeader('authorization'))
            {


              $authArray = explode(' ',$request->header('authorization'));


              $authUP = explode(':',base64_decode($authArray[1]));


              $user = User::query()->where('email',$authUP[0])->firstOrFail();


               if (!Hash::check($authUP[1],$user->password))
               {
                   return \response()->json([
                       'data' => 'password is not correct'
                   ])->setStatusCode(404);
               }

                auth()->login($user);

            }
            else
            {
                return \response()->json([
                    'data' => 'field authorization not found in header'
                ])->setStatusCode(404);
            }
        }
        return $next($request);

    }
}
