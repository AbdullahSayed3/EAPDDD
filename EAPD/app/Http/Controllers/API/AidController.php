<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AidResource;
use App\Http\Resources\AidTypeResource;
use App\Models\Aid;
use App\Models\Country;
use Illuminate\Http\Request;

class AidController extends Controller
{
    //
    public function getCountry()
    {
        $lang = request()->header('Accept-Language') ?? 'en';
        $lang = in_array($lang, ['ar', 'en', 'fr']) ? $lang : 'en';
        $countries = Country::select('code', 'name_' . $lang)->simplePaginate(8);
        return response()->json([
            'message' => 'success',
            'data' => $countries,
            'status' => true,
        ]);
    }

    public function getTypes()
    {
        
        $types = \App\Models\AidType::latest()->get();
        return response()->json([
            'message' => 'success',
            'data' => AidTypeResource::collection($types),
            'status' => true,
        ]);
    }

    public function index(Request $request)
    {
        $data = Aid::where('is_active',true)->filter($request->all())->simplePaginate(6);
        return response()->json([
            'message' => 'success',
            'data' => AidResource::collection($data),
            'status' => true,
            'count' => Aid::where('is_active',true)->count(),
        ]);
    }

    public function show($id)
    {
        $aid = Aid::find($id);
        if (!$aid) {
            return response()->json([
                'message' => 'Aid not found',
                'status' => false,
                'data'=>null
            ], 404);
        }
        return response()->json([
            'message' => 'success',
            'data' => new AidResource($aid),
            'status' => true,
        ]);
    }
}
