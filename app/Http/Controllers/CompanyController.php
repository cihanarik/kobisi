<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class CompanyController extends Controller
{


    public function create(Request $request)
    {
        if ($request->isJson()) {

            $validator = Validator::make($request->all(), [
                'site_url' => 'required',
                'name' => 'required|max:100',
                'lastname' => 'required|max:100',
                'company_name' => 'required',
                'email' => 'required|email|max:250',
                'password' => 'required|min:8|max:20'
            ], [
                'site_url.required' => 'Lütfen site adresini boş bırakmayınız.',
                'name.required' => 'Lütfen isim alanını boş bırakmayınız.',
                'lastname.required' => 'Lütfen soyisim alanını boş bırakmayınız.',
                'company_name.required' => 'Lütfen şirket ismi alanını boş bırakmayınız.',
                'email.email' => 'Lütfen eposta adresinizi doğru formatta yazınız.',
                'password' => 'Lütfen şifre alanını boş bırakmayınız'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'info', 'message' => $validator->errors()]);
            }
            if (Company::where('email', $request->get('email'))->exists()) {
                return response()->json(['status' => 'error', 'message' => $request->get('email') . ' bu eposta adresi mzaten kayıtlıdır.'], 500);
            }

            try {
                $company = Company::create([
                    'site_url' => $request->get('site_url'),
                    'name' => $request->get('name'),
                    'lastname' => $request->get('lastname'),
                    'company_name' => $request->get('company_name'),
                    'email' => $request->get('email'),
                    'password' => bcrypt($request->get('password')),
                    'token' => base64_encode($request->get('email') . "-" . $request->get('site_url')),
                    'status' => 1
                ]);
                return response()->json(['status' => 'success', 'message' => ['token' => $company->token, 'company_id' => $company->id]]);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        } else {
            return response()->json(['status' => 'info', 'message' => 'Gönderdiğiniz veri formatı "application/json" olmalıdır.']);
        }
    }


    public function companies(Request $request)    // All Countries
    {
        $auth =  $request->header('Authorization');
        if($auth) {
            $key = ApiKey::where("key", $auth)->where('status', 1)->first();
            if ($key) {
                $result = Company::select([
                    "id",
                    "name",
                    "lastname",
                    "email",
                    "company_name",
                    "site_url",
                    "status",
                ])->where('status', 1)->get();
                return Response::json(["data" => $result]);
            }else{
                return Response::json([
                    'status' => false,
                    'code' => 6,
                    'message' => 'Code 6: Api Key not found',
                ], 401);
            }
        }else{
            return Response::json([
                'status' => false,
                'message' => '"Authorization" key not provided in the request Header',
            ], 401);
        }
    }

    public function company($tip, $company_id)    // All Countries
    {

        $result = Company::select([
            "id",
            "name",
            "lastname",
            "email",
            "company_name",
            "site_url",
            "status",
        ])->where('id', $company_id)->where('status',1)->get();
        return Response::json(["data" => $result]);
    }

    public function company_package($tip, $company_id)
    {
        return response()->json(['status' => 'success', 'message' => Company::where('id', $company_id)->where('status',1)
            ->with(['company_package.package'])->get()]);
    }


}
