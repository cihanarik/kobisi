<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use App\Models\Company;
use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tip = $request->route('tip');

        if ($tip == "json" || $tip == "xml" || $tip == "yaml") {
            $contenttype = $request->header('Content-Type');
            $accept = $request->header('Accept');
            $token = $request->header('Token');
            $authorization = $request->header('Authorization');
            if ($contenttype != "application/json") return Response::json([
                'status' => false,
                'code' => '4',
                'message' => '"Content-Type" not provided in the request Header.',
            ], 401);
            if ($accept != "application/json") return Response::json([
                'status' => false,
                'code' => '5',
                'message' => '"Accept" not provided in the request Header.',
            ], 401);



            if($token !="") {
                $key = Company::where("token", $token)->where('status',1)->first();
            }else{
                $key = ApiKey::where("key", $authorization)->where('status',1)->first();
            }

            if (!$key) return Response::json([
                'status' => false,
                'message' => 'Code 6: Api Key not found',
            ], 401);
            return $next($request);
        }

        return Response::json([
            'status' => false,
            'code' => '3',
            'message' => 'Response Type Not Allowed eg. JSON or XML must be included in the URL.',
        ], 401);
    }
}
