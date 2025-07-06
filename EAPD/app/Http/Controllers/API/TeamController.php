<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //
    public function index()
    {
        $data = Team::where('is_active',true)->where('is_main',false)->simplePaginate(6);
        $main = Team::where('is_main',true)->latest()->first();
        return response()->json([
            'message' => 'Team retrieved successfully',
            'data' => ['main'=>$main ? new TeamResource($main ) : [],'data'=>TeamResource::collection($data)],
            'count'=>Team::where('is_active',true)->count()
        ]);
    }
}
