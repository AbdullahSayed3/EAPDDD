<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\JobType;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class JobTypeController extends Controller
{
    //
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
 public function __construct(JobType $model)
    {
        
        $this->middleware('can:show_jobs')->only(['index', 'show']);
        $this->middleware('can:create_jobs')->only(['create', 'store']);
        $this->middleware('can:edit_jobs')->only(['edit', 'update']);
        $this->middleware('can:delete_jobs')->only(['delete']);
        
        $this->active = 'jobs_types';
        $this->view = 'job_types.';
        $this->route = 'job_types';
        $this->form = \App\Forms\JobTypeForm::class;

        $this->model = $model;
        $this->title = 'job_types';
        $this->keys = [
           '*'
        ];
        $this->table = [
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'name_en', 'display' => awtTrans('name_en'), 'data' => 'name_en', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'name_ar', 'display' => awtTrans('name_ar'), 'data' => 'name_ar', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'name_fr', 'display' => awtTrans('name_fr'), 'data' => 'name_fr', 'orderable' => 'true', 'searchable' => 'true'],       
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
        
        $model = $this->model->create($data);
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

        // if(!isset($request->is_active))
        // {
        //     $data['is_active'] = 0;
        // }
        // if($data['image'] != null)
        // {
        //     $data['image'] = $this->uploadFile($data['image'], 'jobs_file');
        // }
        // $odata['is_active'] =  true;
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
        })
        ->rawColumns(['action'])->make(true);
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

}
