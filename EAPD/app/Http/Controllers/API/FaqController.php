<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    //
    public function index()
    {
        $lang = request()->header('Accept-Language', 'en');
        $data = FAQ::where('code',$lang)->where('is_active',true)->latest()->simplePaginate(6);
        return response()->json([
            'status' => true,
            'message' => 'FAQs retrieved successfully',
            'data' => FaqResource::collection($data),
            'count'=>$data->count()
        ]);

    }
}
