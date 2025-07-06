<?php

namespace App\Http\Controllers\Web;

use App\Forms\Settings\PartnerForm;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UploadTrait;
use App\Models\Partner;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class PartnerController extends Controller
{
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
 public function __construct(Partner $model)
    {
        
        $this->middleware('can:show_partner')->only(['index', 'show']);
        $this->middleware('can:create_partner')->only(['create', 'store']);
        $this->middleware('can:edit_partner')->only(['edit', 'update']);
        $this->middleware('can:delete_partner')->only(['delete']);
        
        $this->active = awtTrans('مجموعات الشركاء');
        $this->view = 'partners.';
        $this->route = 'partners';
        $this->form = \App\Forms\PartnerForm::class;
        $this->model = $model;
        $this->title = 'partners';
        $this->keys = [
            'title',
            'image',
        ];
        $this->table = [
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'title', 'display' => trans('awt.عنوان'), 'data' => 'title', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'image', 'display' => trans('awt.صورة'), 'data' => 'image', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'is_active', 'display' => trans('awt.نشط؟'), 'data' => 'is_active', 'orderable' => 'true', 'searchable' => 'true'],
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
        if($data['image']){
            $data['image'] = $this->uploadFile($data['image'], 'partners');
       // Check if directory exists and is writable
            // $directory = public_path('uploads/teams');
            // if (!is_dir($directory)) {
            //     if (!mkdir($directory, 0755, true)) {
            //         throw new \Exception('Failed to create directory');
            //     }
            // }
        
            // if (!is_writable($directory)) {
            //     throw new \Exception('Directory is not writable');
            // }
            // // Store the file
            // $path = $request->file('image')->store('uploads/teams', 'public');
            // $data['image'] = $path;

        }
        $model = $this->model::create($data);
        flash(awtTrans('Partner Added Successfully'))->success();
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
        if(isset($data['image'])){
            $data['image'] = $this->uploadFile($data['image'], 'partners');
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

        if ($model->image) {
            $this->deleteFile($model->image, 'uploads/partners');
        }
        $model->delete();
        flash(trans('main.rows_deleted_successfully'))->success();
        return redirect(route($this->route.'.index'));
    }

    

    public function datatable()
    {

        $model = $this->model::query();

        return DataTables::of($model)
        ->editColumn('image',function($model){
            return '<img src="'.asset('uploads/partners/'.$model->image).'" style="width: 50px; height: 50px; border-radius: 50%;" alt="'.$model->title.'">';
        })
        ->addColumn('action', function ($model) {

            $data = '<a href="'.route($this->route.'.edit', [$model->id]).'" style="    margin-right: 10px;" class="btn btn-sm btn-primary"><i class="vl_pencil"></i>'.trans('main.edit').'</a>';
            $data .= '<a data-delete-url="'.route($this->route.'.delete', [$model->id]).'" style="    margin-right: 10px;" class="btn btn-sm btn-danger delete-row text-white"><i class="vl_recycle-bin"></i>'.trans('main.delete').'</a>';

            return $data;
        })
        ->editColumn('is_active', function ($model) {
            return $model->is_active ? '<span class="badge bg-success">'.awtTrans('نعم').'</span>' : '<span class="badge bg-danger">'.awtTrans('لا').'</span>';
        })->rawColumns(['action','is_active','image'])->make(true);
    }

}
