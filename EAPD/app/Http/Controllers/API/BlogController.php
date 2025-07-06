<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index()
    {
        $lang = request()->header('Accept-Language', 'en');
        $data = Blog::where('is_active', 1)
        ->where('code',$lang)->
            with('images')->latest()->simplePaginate(6);
        return response()->json([
            'status' => true,
            'message' => awtTrans('تم جلب المقالات بنجاح'),
            'data' => BlogResource::collection($data),
            'count'=>Blog::count()
        ]);
    }

    public function show($id)
    {
        // $lang = request()->header('Accept-Language', 'en');
        $data = Blog::where('is_active', 1)->with('images')->findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => awtTrans('تم جلب المقال بنجاح'),
            'data' => new BlogResource($data),
        ]);
    }

    public function latestNew(Request $request)
    {
        $lang = $request->header('Accept-Language') ?? 'en';
        $lang = in_array($lang, ['ar','en', 'fr']) ? $lang : 'en';
       
        $data = Blog::where('code', $lang)->with('images')->orderBy('id', 'desc')->first();
        if($data)
        {
            return response()->json([
                'status' => true,
                'message' => awtTrans('تم جلب المقالات بنجاح'),
                'data' => new BlogResource($data),
            ]);
        }else{
            $data = Blog::latest()->first();
            return response()->json([
                'status' => false,
                'message' => awtTrans('لا توجد مقالات'),
                'data'=> new BlogResource($data),
            ]);
        }
    }

    public function latestfiveNews(Request $request)
    {
        $lang = $request->header('Accept-Language') ?? 'en';
        $lang = in_array($lang, ['ar','en', 'fr']) ? $lang : 'en';
        $data = Blog::where('code',$lang)->with('images')->orderBy('id', 'desc')->take(5)->get();
        if($data->count() > 0)
        {
            return response()->json([
                'status' => true,
                'message' => awtTrans('تم جلب المقالات بنجاح'),
                'data' => BlogResource::collection($data),
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => awtTrans('لا توجد مقالات'),
                'data'=> [],
            ]);
        }
    }
}
