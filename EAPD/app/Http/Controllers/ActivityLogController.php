<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ActivityLogController extends Controller
{
    //
    protected $table;
    protected $model;


    public function __construct()
    {
        $this->model = ActivityLog::class;
        $this->table = [
              ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
              ['name' => 'user_name', 'display' => awtTrans('المستخدم'), 'data' => 'user_name', 'orderable' => 'true', 'searchable' => 'true'],
              ['name' => 'action', 'display' => awtTrans('الإجراء'), 'data' => 'action', 'orderable' => 'true', 'searchable' => 'true'],
              ['name' => 'model_type', 'display' => awtTrans('الموديل'), 'data' => 'model_type', 'orderable' => 'true', 'searchable' => 'true'],
              ['name' => 'changes', 'display' => awtTrans('التغييرات'), 'data' => 'changes', 'orderable' => 'false', 'searchable' => 'false'],
              ['name' => 'created_at', 'display' => awtTrans('تاريخ الإنشاء'), 'data' => 'created_at', 'orderable' => 'true', 'searchable' => 'false'],

        ];
    }
    public function index(Request $request)
    {  
        
        $this->table = [
        // ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
        ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
        ['name' => 'user_name', 'display' => awtTrans('المستخدم'), 'data' => 'user_name', 'orderable' => 'true', 'searchable' => 'true'],
        ['name' => 'action', 'display' => awtTrans('الإجراء'), 'data' => 'action', 'orderable' => 'true', 'searchable' => 'true'],
        ['name' => 'model_type', 'display' => awtTrans('الموديل'), 'data' => 'model_type', 'orderable' => 'true', 'searchable' => 'true'],
        ['name' => 'changes', 'display' => awtTrans('التغييرات'), 'data' => 'changes', 'orderable' => 'false', 'searchable' => 'false'],
        ['name' => 'created_at', 'display' => awtTrans('تاريخ الإنشاء'), 'data' => 'created_at', 'orderable' => 'true', 'searchable' => 'false'],
    ];


    $table_rows = $this->table;
    $active = $this->active ?? 'logs';
    $route = $this->route ?? 'activity_logs';

    return view('activity_logs.index', compact('table_rows', 'active', 'route'));

    }

    public function datatable()
    {  
        $request = request();
            //    $model = $this->model::where('election_role_id',0)->role('admin');
        $model = ActivityLog::query();
        if ($request->filled('from') && $request->filled('to')) {
                $model->whereBetween('created_at', [
                    $request->input('from') . ' 00:00:00',
                    $request->input('to') . ' 23:59:59'
                ]);
            }

        return DataTables::of($model)
        ->editColumn('action', function ($model) {
                if($model->action == 'created')
                {
                    return awtTrans('created');
                }else if($model->action == 'updated')
                {
                    return awtTrans('updated');
                }else{
                    return awtTrans('deleted');
                }
            })
            ->editColumn('created_at', function ($model) {
              return $model->created_at->format('M d, Y h:i A');
            })
            ->editColumn('model_type', function ($model) {
                 return $modelAliases[$model->model_type] ?? class_basename($model->model_type);
            })
           ->editColumn('changes', function($model) {
            return '<a href="'.route('activity_logs.show', $model->id).'" class="btn btn-sm btn-primary">
                <i class="fa fa-eye"></i>
            </a>';
        })
        ->rawColumns(['changes','model_type'])->make(true);
    }

    public function show($id)
    {
        $data = ActivityLog::findOrFail($id);
        return view('activity_logs.pages.show',['changes'=>$data]);
    }
}