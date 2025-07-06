<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UploadTrait;
use App\Http\Resources\JobResource;
use App\Http\Resources\JobTypeResource;
use App\Models\Job;
use App\Models\jobImage;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class JobController extends Controller
{
    use UploadTrait;
      protected $active;

    protected $view;

    protected $route;

    protected $form;
    protected $edit_form;

    protected $model;

    protected $title;

    protected $keys;

    protected $table;

    protected $wrapper_class;
 public function __construct(Job $model)
    {
        
        $this->middleware('can:show_jobs')->only(['index', 'show']);
        $this->middleware('can:create_jobs')->only(['create', 'store']);
        $this->middleware('can:edit_jobs')->only(['edit', 'update']);
        $this->middleware('can:delete_jobs')->only(['delete']);
        
        $this->active = 'jobs';
        $this->view = 'jobs.';
        $this->route = 'jobs';
        $this->form = \App\Forms\JobForm::class;

        $this->model = $model;
        $this->title = 'jobs';
        $this->keys = [
           '*'
        ];
        $this->table = [
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'name', 'display' => awtTrans('الاسم'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'image', 'display' => awtTrans('صور'), 'data' => 'image', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'start_date', 'display' => awtTrans('start_date'), 'data' => 'start_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'end_date', 'display' => awtTrans('end_date'), 'data' => 'end_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'action', 'display' => awtTrans('العمليات'), 'data' => 'action', 'orderable' => 'false', 'searchable' => 'false'],
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
        if($data['image'] != null)
        {
            $data['image'] = $this->uploadFile($data['image'], 'jobs_file');
        }
        $model = $this->model->create($data);
        if(isset($data['job_images'])){
            foreach($data['job_images'] as $image)
            {
                $item = $this->uploadFile($image[0], 'blogs_file');
                jobImage::create([
                    'job_id' => $model->id,
                    'image' => $item,
                ]);
            }
        }
        // foreach(config('lang') as $lang){
        //     if(isset($data['question_'.$lang]) && isset($data['answer_'.$lang])){
        //         $this->model->create([
        //             'question'=>$data['question_'.$lang],
        //             'answer'=>$data['answer_'.$lang],
        //             'code'=>$lang,
        //             'is_active'=>true
        //         ]);    
        //     }
        // }
       
        // $model = $this->model::create($data);
        flash(awtTrans('Added Successfully'))->success();
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
            $data['is_active'] = 0;
        }
        if($data['image'] != null)
        {
            $data['image'] = $this->uploadFile($data['image'], 'jobs_file');
        }

        if(isset($data['job_images'])){
            jobImage::where('job_id', $model->id)->delete(); // Delete old images
            foreach($data['job_images'] as $image)
            {
                $item = $this->uploadFile($image[0], 'jobs_file');
                jobImage::create([
                    'job_id' => $model->id,
                    'image' => $item,
                ]);
            }
        }
        // $data['is_active'] =  true;
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
        // Delete job images
        if ($model->image) {
            $this->deleteFile($model->image, 'uploads/jobs_file');
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
        })
        ->editColumn('image',function($model){
            return '<img src="'.asset('uploads/jobs_file/'.$model->image).'" style="width: 50px; height: 50px; border-radius: 50%;" alt="'.$model->title.'">';
        })
        ->editColumn('name', function ($model) {
                return '<a href="'.route($this->route.'.show', [$model->id]).'">'.$model->name.'</a>';
            })

        ->editColumn('start_date',function($model){
            return $model->start_date ? $model->start_date->format('Y-m-d') : '';
        })->editColumn('end_date',function($model){
            return $model->start_date ? $model->start_date->format('Y-m-d') : '';
    
        })
    
        ->rawColumns(['action','name','start_date','end_date','image','is_active'])->make(true);
    }

    public function show($id)
    {
        $model = $this->model::find($id);
        if (empty($model)) {
            flash('Can`t find this value')->error();
            return redirect(route($this->route.'.index'));
        }
        $active = $this->active;
        $route = $this->route;
        return view($this->view.'.show', compact('model', 'active', 'route'));
    }


    public function getData(Request $request)
    {
        $lang = $request->header('Accept-Language', 'en');
        $query = $this->model->query();
        // if($request->type)
        // {
        //     $query->where('type', $request->type);
        // }
        $data = $query->where('is_active', 1)
            ->where('code', $lang)
            ->with('images')
            ->filter($request->all())
            ->latest()
            ->simplePaginate(6);
        return response()->json([
            'status' => true,
            'message' => awtTrans('تم جلب الوظائف بنجاح'),
            'data' => JobResource::collection($data),
            'count' => Job::count()
        ]);   
    }

    public function getJobById($id)
    {
        $lang = request()->header('Accept-Language', 'en');
        $data = $this->model->where('is_active', 1)
            ->where('code', $lang)
            ->with('images')
            ->findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => awtTrans('تم جلب الوظيفة بنجاح'),
            'data' => new JobResource($data),
        ]);
    }

    public function getJobTypes()
    {
        $data = \App\Models\JobType::get();
        return response()->json([
            'status' => true,
            'message' => awtTrans('تم جلب أنواع الوظائف بنجاح'),
            'data' => JobTypeResource::collection($data),   
        ]);
    }

}
