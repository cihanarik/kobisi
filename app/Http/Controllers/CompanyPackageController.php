<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyPackage;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class CompanyPackageController extends Controller
{

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

    public function create(Request $request)
    {
        if ($request->isJson()) {
            $validator = Validator::make($request->all(), [
                'company_id' => 'required|integer',
                'package_id' => 'required|integer',
                'cycle' => 'in:monthly,yearly',
                'start_date' => 'date',
                'end_date' => 'date'
            ], [
                'package_id.required' => "package_id boş bırakılmamalıdır.",
                'company_id.required' => "company_id boş bırakılmamalıdır.",
                'company_id.integer' => "company_id numerik olmalıdır.",
                'package_id.integer' => "package_id numerik olmalıdır.",
                'period.in' => 'Paket döngüsü yanlış.'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()]);
            }

            if (!Package::where('id', $request->get('package_id'))->exists()) {
                return response()->json(['status' => 'error', 'message' => 'Veritabanında ' . $request->get('package_id') . " id numaralı bir kayıt bulunamadı."]);
            }

            if (!Company::where('id', $request->get('company_id'))->exists()) {
                return response()->json(['status' => 'error', 'message' => 'Veritabanında ' . $request->get('company_id') . " id numaralı bir şirket bulunamadı."]);
            }

            if (CompanyPackage::where('company_id', $request->get('company_id'))->exists()) {
                return response()->json(['status' => 'info', 'message' => 'Veritabanında bu şirkete ait bir paket zaten kayıtlıdır.']);
            }

            try {
                if ($request->get('start_date') && $request->get('end_date')) {
                    $company_package = CompanyPackage::create([
                        'package_id' => $request->get('package_id'),
                        'company_id' => $request->get('company_id'),
                        'cycle' => "custom",
                        'start_date' => Carbon::parse($request->get('start_date')),
                        'end_date' => Carbon::parse($request->get('end_date'))
                    ]);
                } else {

                    $company_package = CompanyPackage::create([
                        'package_id' => $request->get('package_id'),
                        'company_id' => $request->get('company_id'),
                        'cycle'      => $request->get('cycle'),
                        'start_date' => Carbon::now(),
                        'end_date'   => $request->get('cycle') == 'monthly' ? Carbon::now()->addMonth() : Carbon::now()->addYear()
                    ]);
                }
                return response()->json([
                        'status' => 'success',
                        'message' => [
                            'start_date' => $company_package->start_date,
                            'end_date' => $company_package->end_date,
                            'package' => Package::find($request->get('package_id'))
                        ]
                    ]
                );
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    }
}
