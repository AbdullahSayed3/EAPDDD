<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UploadTrait;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class TeamController extends Controller
{
     //
    use UploadTrait;
    protected $active;

    protected $view;

    protected $route;

    protected $form;

    protected $model;

    protected $title;

    protected $keys;

    protected $table;

    protected $wrapper_class;
     public function __construct(Team $model)
    {
        
        $this->middleware('can:show_teams')->only(['index', 'show']);
        $this->middleware('can:create_teams')->only(['create', 'store']);
        $this->middleware('can:edit_teams')->only(['edit', 'update']);
        $this->middleware('can:delete_teams')->only(['delete']);
        
        $this->active = trans('awt.teams');
        $this->view = 'teams.';
        $this->route = 'teams';
        $this->form = \App\Forms\TeamForm::class;
        $this->model = $model;
        $this->title = 'teams';
        $this->keys = [
            'title',
            'image',
        ];
        $this->table = [
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'name', 'display' => trans('awt.name'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'image', 'display' => trans('awt.صورة'), 'data' => 'image', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'job', 'display' => trans('awt.job'), 'data' => 'job', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'is_active', 'display' => trans('awt.نشط؟'), 'data' => 'is_active', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'is_main', 'display' => trans('awt.وزير'), 'data' => 'is_main', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'action', 'display' => trans('awt.العمليات'), 'data' => 'action', 'orderable' => 'false', 'searchable' => 'false'],
        ];
        $this->wrapper_class = 'form-group';
    }

     public function index()
    {
         $active = $this->active;
        $table_rows = $this->table;
        $route = $this->route;
        return view($this->view.'.index', compact('active', 'table_rows', 'route'));
   }
    public function create(FormBuilder $formBuilder){
        $form = $formBuilder->create($this->form, [
            'method' => 'POST',
            'url' => route($this->route.'.store'),
        ]);
        $form_title = 'Add '.$this->title;
        $active = $this->active;
        $route = $this->route;
        return view($this->view.'.form', compact('form', 'form_title', 'active', 'route'));
    
    }

     public function store(FormBuilder $formBuilder)
    {

        $form = $formBuilder->create($this->form);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $data = $request->all();
         if(!isset($request->is_active))
        {
            $data['is_active'] = 0;
        }
          if(!isset($request->is_main))
        {
            $data['is_main'] = 0;
        }

        if(isset($request->is_main))
        {
             $is_main = Team::where('is_main',true)->exists();
             if($is_main)
             {
                flash(awtTrans('تم تعين ملف وزير من قبل من فضلك قم بالغاء التنشيط'))->error();
                return redirect()->back();
             }
        }
       
        if(isset($data['image'])){
            $data['image'] = $this->uploadFile($data['image'], 'teams_file');
        }
        $model = $this->model::create($data);
     
        flash(awtTrans('Team Member Added Successfully'))->success();
        return redirect(route($this->route.'.create'));
    }

    public function edit(int $id, FormBuilder $formBuilder)
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash('Can`t find this value')->error();

            return redirect(route($this->route . '.index'));
        }
        $form = $formBuilder->create($this->form, [
            'method' => 'PUT',
            'model' => $model->toArray(),                              // Not passed to view, just used in form class
            'url' => route($this->route . '.update', [$model['id']]),
        ], ['id' => $model->id]);

        $form_title = 'Edit ' . $this->title;
        $active = $this->active;
        $route = $this->route;
        return view($this->view . '.form', compact('form', 'form_title', 'active', 'route', 'model'));
    }


    public function update(int $id, FormBuilder $formBuilder)
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash('Can`t find this value')->error();

            return redirect(route($this->route.'.index'));
        }

        $form = $formBuilder->create($this->form, [], ['id' => $model->id]);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $data = $request->all();
        if(!isset($request->is_active))
        {
            if(! $model->is_main)
            {
                $data['is_active'] = 0;
            }else{
                flash(awtTrans('لا يمكن الغاء تفعيل بيانات السيد الوزير '),'error');
                return redirect()->back();
            }
        }
        
          if(!isset($request->is_main))
        {
            $data['is_main'] = 0;
        }
       if(isset($data['image'])){
            $data['image'] = $this->uploadFile($data['image'], 'teams_file');
       
        }

        
        if(isset($request->is_main) && $request->is_main == true)
        {
            if(! $model->is_main)
            {
                $is_main = Team::where('is_main',true)->exists();
                if($is_main)
                {
                   flash(awtTrans('تم تعين ملف وزير من قبل من فضلك قم بالغاء التنشيط'),'error');
                   return redirect()->back();
                }

            }
             
        }
        
        // return $data;
        
        $model->update($data);
        
        flash(awtTrans('Edited'))->success();

        return redirect(route($this->route.'.index', ['id' => $id]));
    }
    
    public function delete(int $id)
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash('Can`t find this value')->error();

            return redirect(route($this->route.'.index'));
        }

        if($model->is_main == true)
        {
           return response()->json([
                'success' => false,
                'message' => awtTrans( "Can't delete minister data"),
                'error' => true
            ], 400); 
        }

        if ($model->image) {
            $this->deleteFile($model->image, 'uploads/teams_file');
        }

        $model->delete();
        flash(trans('main.rows_deleted_successfully'))->success();
        return redirect(route($this->route.'.index'));
    }

      public function datatable()
    {

        $model = $this->model::query();

        return DataTables::of($model)
        ->addColumn('action', function ($model) {
            $data = '<a href="'.route($this->route.'.edit', [$model->id]).'" style="    margin-right: 10px;" class="btn btn-sm btn-primary"><i class="vl_pencil"></i>'.trans('main.edit').'</a>';
            $data .= '<a data-delete-url="'.route($this->route.'.delete', [$model->id]).'" style="    margin-right: 10px;" class="btn btn-sm btn-danger delete-row text-white"><i class="vl_recycle-bin"></i>'.trans('main.delete').'</a>';

            return $data;
        })->editColumn('is_active', function ($model) {
            return $model->is_active ? '<span class="badge bg-success">'.awtTrans('نعم').'</span>' : '<span class="badge bg-danger">'.awtTrans('لا').'</span>';
        })->addColumn('name', function ($model) {
            return App::getLocale() == 'en' ? $model->name_en : $model->name_ar;
        })
        ->addColumn('job', function ($model) {
            return App::getLocale() == 'en' ? $model->job_en : $model->job_ar;
        })
         ->editColumn('image',function($model){
            return '<img src="'.asset('uploads/teams_file/'.$model->image).'" style="width: 50px; height: 50px; border-radius: 50%;" alt="'.$model->title.'">';
        })
         ->editColumn('is_main',function($model){
            return $model->is_main ? '<span class="badge bg-success">'.awtTrans('نعم').'</span>' : '<span class="badge bg-danger">'.'-'.'</span>';
        })
        ->rawColumns(['action','image','is_active','is_main','name','job'])->make(true);
    }

}
