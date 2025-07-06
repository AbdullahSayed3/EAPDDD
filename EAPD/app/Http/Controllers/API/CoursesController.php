<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function countAll(){
        $courses = Course::all();
        $count = $courses->count();
        return response()->json([
            'status' => true,
            'message' => 'Courses count retrieved successfully',
            'count' => $count
        ],200);
    }

    public function coursesTraniEgypt()
    {
        $traningCourses = Application::where('country','EG')->count();
        return response()->json([
            'status' => true,
            'message' => 'Training courses in Egypt count retrieved successfully',
            'count' => $traningCourses
        ], 200);
    }
}
