<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    //
    public function index()
    {
        $data = Partner::latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'Partners retrieved successfully',
            'data' => PartnerResource::collection($data),
            'count'=>$data->count()
        ], 200);
    }
}
