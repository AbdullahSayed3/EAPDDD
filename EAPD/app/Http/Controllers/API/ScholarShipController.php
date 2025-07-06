<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScholarShipResource;
use App\Models\Scholarships;
use Illuminate\Http\Request;

class ScholarShipController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Scholarships::filter($request->all())->where('is_active',true)->with(['field', 'learners'])->simplePaginate(6);
        return response()->json([
            'status' => true,
            'message' => 'Scholarships retrieved successfully',
            'data' => ScholarShipResource::collection($data),
            'count'=> Scholarships::filter($request->all())->where('is_active',true)->count(),
        ]);
    }

    public function show($id, Request $request)
    {
        $scholarship = Scholarships::find($id);
        if (!$scholarship) {
            return response()->json([
                'status' => false,
                'message' => 'Scholarship not found',
                'data'=>null
            ], 404);
        }
        $lang = $request->header('Accept-Language') ?? 'en';
        $lang = in_array($lang, ['ar', 'en', 'fr']) ? $lang : 'en';
        $total = $scholarship->learners->count();
        $male = $scholarship->learners->where('gender', 'male')->count();
        $female = $scholarship->learners->where('gender', 'female')->count();

        return response()->json([
            'status' => true,
            'message' => 'Scholarship retrieved successfully',
            'data' => new ScholarShipResource($scholarship),
            'gender_statistics' => [
                'total' => $total,
                'male_count' => $male,
                'female_count' => $female,
                'male_percentage' => $total > 0 ? round(($male / $total) * 100, 2) : 0,
                'female_percentage' => $total > 0 ? round(($female / $total) * 100, 2) : 0,
            ],
            'country_statistics' => [
                'total'=> $scholarship->learners->count(),
                'countries' => $scholarship->learners->groupBy('nationality')->map(function ($learners, $country) use ($scholarship) {
                    return [
                        'country' => getCountry($country),
                        'count' => $learners->count(),
                        'percentage' => round(($learners->count() / $scholarship->learners->count()) * 100, 2),
                    ];
                })->values(),

            ],
        ]);
    }
    
}
