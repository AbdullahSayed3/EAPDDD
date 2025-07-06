<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
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
 public function __construct(FAQ $model)
    {
        
        $this->middleware('can:show_faq')->only(['index', 'show']);
        $this->middleware('can:create_faq')->only(['create', 'store']);
        $this->middleware('can:edit_faq')->only(['edit', 'update']);
        $this->middleware('can:delete_faq')->only(['delete']);
        
        $this->active = awtTrans('الأسئلة الشائعة');
        $this->view = 'faqs.';
        $this->route = 'faqs';
        $this->form = \App\Forms\FaqForm::class;
        $this->edit_form = \App\Forms\EditFaqFrom::class;

        $this->model = $model;
        $this->title = 'faqs';
        $this->keys = [
            'question',
            'answer',
        ];
        $this->table = [
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'question', 'display' => awtTrans('السوال'), 'data' => 'question', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'answer', 'display' => awtTrans('الاجابة'), 'data' => 'answer', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'is_active', 'display' => awtTrans('نشط؟'), 'data' => 'is_active', 'orderable' => 'true', 'searchable' => 'true'],
          
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
        foreach(config('lang') as $lang){
            if(isset($data['question_'.$lang]) && isset($data['answer_'.$lang])){
                $this->model->create([
                    'question'=>$data['question_'.$lang],
                    'answer'=>$data['answer_'.$lang],
                    'code'=>$lang,
                    'is_active'=>true
                ]);    
            }
        }
       
        // $model = $this->model::create($data);
        flash(awtTrans('Faq Added Successfully'))->success();
        return redirect(route($this->route.'.create'));
    }

    public function edit(int $id, FormBuilder $formBuilder)
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash('Can`t find this value')->error();

            return redirect(route($this->route . '.index'));
        }
        $form = $formBuilder->create($this->edit_form, [
            'method' => 'PUT',
            'model' => $model->toArray(),                              // Not passed to view, just used in form class
            'url' => route($this->route . '.update', [$model['id']]),
        ], ['id' => $model->id]);

        $form_title = 'Edit ' . $this->title;
        $active = $this->active;
        $route = $this->route;
        return view($this->view . '.edit_from', compact('form', 'form_title', 'active', 'route', 'model'));
    }


    public function update(int $id, FormBuilder $formBuilder)
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash('Can`t find this value')->error();

            return redirect(route($this->route.'.index'));
        }

        $form = $formBuilder->create($this->edit_form, [], ['id' => $model->id]);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $data = $request->all();
        if(!isset($request->is_active))
        {
            $data['is_active'] = 0;
        }
        $data['is_active'] =  true;
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
        })->editColumn('is_active', function ($model) {
            return $model->is_active ? '<span class="badge bg-success">'.awtTrans('نعم').'</span>' : '<span class="badge bg-danger">'.awtTrans('لا').'</span>';
        })
        ->rawColumns(['action','is_active'])->make(true);
    }

}
