<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Course::where('is_active',true)->filter($request->all())
            ->with(['organization', 'field', 'type'])
            ->simplePaginate(6);
        return response()->json([
            'message'=> 'success',
            'data' => CourseResource::collection($data),
            'status'=>true,
            'count'=>Course::where('is_active',true)->count(),
        ]);
    }

    public function show($id, Request $request)
    {
        $course = Course::where('is_active',true)->find($id);
        if (!$course) {
            return response()->json([
                'message'=> 'Course not found',
                'status'=>false,
                'data' => null,
            ], 404);
        }
        return response()->json([
            'message'=> 'success',
            'data' => new CourseResource($course),
            'status'=>true,
        ]);
    }
}
