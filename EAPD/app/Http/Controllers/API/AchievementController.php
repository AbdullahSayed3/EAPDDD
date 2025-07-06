<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AchievementCountTypeResource;
use App\Http\Resources\AchievementResource;
use App\Http\Resources\AchievementTypeResource;
use App\Models\Achievement;
use App\Models\AchievementType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AchievementController extends Controller
{
    //
    public function getAcievementTypes(Request $request)
    {
        $achievementTypes = AchievementType::simplePaginate(6);
        return response()->json([
            'status' => true,
            'message'=> 'Achievement types retrieved successfully',
            'data' => AchievementTypeResource::collection($achievementTypes),
            'count'=>AchievementType::count(),
        ]);
    }

    public function index(Request $request)
    {
        $achievementTypes = Achievement::filter($request->all())->where('is_active',true)->simplePaginate(6);
        return response()->json([
            'status' => true,
            'message'=> 'Achievement types retrieved successfully',
            'data' => AchievementResource::collection($achievementTypes),
        ]);
    }

    public function show($id)
    {
        $achievement = Achievement::with('achievementType')->find($id);
        if (!$achievement) {
            return response()->json([
                'status' => false,
                'message'=> 'Achievement not found',
                'data'=>null
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message'=> 'Achievement retrieved successfully',
            'data' => new AchievementResource($achievement),
        ]);
    }

    public function getAchievementCountrByType()
    {
        $achievementTypes = AchievementType::withCount(['achievements' => function ($query) {
            $query->where('is_active', true);
        }])->get();

        return response()->json([
            'status' => true,
            'message'=> 'Achievement types with counts retrieved successfully',
            'data' => AchievementCountTypeResource::collection($achievementTypes),
        ]);
    }

    public function getCountOfAchievementsByCountry(Request $request)
    {
         $lang = $request->header('Accept-Language') ?? 'en';
        $lang = in_array($lang, ['ar','en', 'fr']) ? $lang : 'en';
  // Step 1: Get all achievement type names
    $types = DB::table('achievement_types')
        ->pluck('name_'.$lang, 'id')  // [1 => 'health', 2 => 'feed', 3 => 'hanger']
        ->toArray();

    // Step 2: Build SELECT fields dynamically
    $selects = [
        'achievements.country_id',        
    ];

    foreach ($types as $id => $name) {
        // Protect column name with backticks
        $column = str_replace('`', '', $name); // just in case
        $selects[] = DB::raw("COUNT(CASE WHEN achievement_type_id = $id THEN 1 END) as `$column`");
    }

    // Step 3: Final query
    $results = DB::table('achievements')
        ->select($selects)
        ->groupBy('achievements.country_id')
        ->get();
        $results = $results->map(function ($item) {
            $countryCode = $item->country_id;

            // Add enrichment
            $item->country_name = getCountry($countryCode);
            $item->lat = getLatCountry($countryCode);
            $item->lng = getLngCountry($countryCode);

            return $item;
        });
        return response()->json([
            'status' => true,
            'message'=> 'Achievement types with counts retrieved successfully',
            'data' => $results,
        ]);
    }
}
