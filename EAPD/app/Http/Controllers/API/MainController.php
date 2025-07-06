<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Aid;
use App\Models\Course;
use App\Models\Expert;
use App\Models\Learners;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function getCount()
    {
        return response()->json([
            'status' => true,
            'message' => 'Count retrieved successfully',
            'data' => [
                'courses_count' => Course::count(),
                'expertes_count' => Expert::count(),
                'student_count'=> Learners::count(),
                'aid_count'=>Aid::count()
            ]
        ], 200);
    }
}
