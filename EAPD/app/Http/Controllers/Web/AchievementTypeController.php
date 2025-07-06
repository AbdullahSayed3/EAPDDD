<?php

namespace App\Http\Controllers\Web;

use App\Forms\AchievementTypeForm;
use App\Http\Controllers\Controller;
use App\Models\AchievementType;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class AchievementTypeController extends Controller
{
    protected $active;
    protected $view;
    protected $route;
    protected $form;
    protected $model;

    protected $title;

    protected $keys;

    protected $table;

    protected $wrapper_class;

    /**
     * Websites Controller constructor.
     */
    public function __construct()
    {
         
        $this->middleware('can:show_achivements')->only(['index', 'show']);
        $this->middleware('can:create_achivements')->only(['create', 'store']);
        $this->middleware('can:edit_achivements')->only(['edit', 'update']);
        $this->middleware('can:delete_achivements')->only(['delete']);
       
        $this->active = awtTrans('تصنيفات الإنجازات');
        $this->view = 'achievement_type';
        $this->route = 'achievement_type';
        $this->form = AchievementTypeForm::class;
        $this->model = AchievementType::class;
        $this->title = 'achievement_type';
        $this->keys = [
            'name_ar',
            'name_en',
            'name_fr',
        ];
        $this->table = [
            ['name' => 'name_ar', 'display' => trans('main.name_ar'), 'data' => 'name_ar', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'name_en', 'display' => trans('main.name_en'), 'data' => 'name_en', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'name_en', 'display' => trans('main.name_fr'), 'data' => 'name_fr', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'action', 'display' => trans('main.edit'), 'data' => 'action', 'orderable' => 'false', 'searchable' => 'false'],
        ];
        $this->wrapper_class = 'form-group';

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $active = $this->active;
        $table_rows = $this->table;
        $route = $this->route;

        return view($this->view.'.index', compact('active', 'table_rows', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FormBuilder $formBuilder)
    {

        $form = $formBuilder->create($this->form, [
            'method' => 'POST',
            'url' => route($this->route.'.store'),
        ]);

        $form_title = 'Add '.$this->title;
        $active = $this->active;
        $route = $this->route;

        return view($this->view.'.form', compact('form', 'form_title', 'active', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(FormBuilder $formBuilder)
    {

        $form = $formBuilder->create($this->form);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $data = $request->only($this->keys);

        $model = $this->model::create($data);
        flash(awtTrans('Value Added Successfully'))->success();

        return redirect(route($this->route.'.create'));

        // Do saving and other things...
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, FormBuilder $formBuilder)
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash('Can`t find this value')->error();

            return redirect(route($this->route.'.index'));
        }

        $form = $formBuilder->create($this->form, [
            'method' => 'PUT',
            'model' => $model->toArray(),                              // Not passed to view, just used in form class
            'url' => route($this->route.'.update', [ $model['id']]),
        ], ['id' => $model->id]);

        $form_title = 'Edit '.$this->title;
        $active = $this->active;
        $route = $this->route;

        return view($this->view.'.form', compact('form', 'form_title', 'active', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
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
        $data = $request->only($this->keys);
        $model->update($data);
        flash('Value Edited Successfully')->success();

        return redirect(route($this->route.'.index', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $id)
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash('Can`t find this value')->error();

            return redirect(route($this->route.'.index'));
        }

        $model->delete();
        flash(trans('main.rows_deleted_successfully'))->success();

        //        flash('Country Deleted Successfully')->success();
        return redirect(route($this->route.'.index'));
    }

    /*
     * Countries Datatable
     *
     *
     */
    public function datatable()
    {

        $model = $this->model::query();

        return DataTables::of($model)->addColumn('action', function ($model) {

            $data = '<a href="'.route($this->route.'.show', [$model->id]).'" style="    margin-right: 10px;" class="btn btn-sm btn-primary"><i class="vl_pencil"></i>'.trans('main.edit').'</a>';
            $data .= '<a data-delete-url="'.route($this->route.'.delete', [$model->id]).'" style="    margin-right: 10px;" class="btn btn-sm btn-danger delete-row text-white"><i class="vl_recycle-bin"></i>'.trans('main.delete').'</a>';
            return $data;
        })

            ->rawColumns(['action'])->make(true);
    }


}
