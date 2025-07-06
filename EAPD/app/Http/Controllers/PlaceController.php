<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\Facades\DataTables;

class PlaceController extends Controller
{
    //     protected $active;

    protected $view;
    protected $active;
    protected $route;
    protected $form;
    protected $edit_form;
    protected $model;
    protected $title;
    protected $keys;
    protected $table;
    protected $wrapper_class;
    public function __construct(Place $model)
    {

        $this->middleware('can:show_place')->only(['index', 'show']);
        $this->middleware('can:create_place')->only(['create', 'store']);
        $this->middleware('can:edit_place')->only(['edit', 'update']);
        $this->middleware('can:delete_place')->only(['delete']);

        $this->active = 'مكان الإنعقاد';
        $this->view = 'places.';
        $this->route = 'places';
        $this->form = \App\Forms\PlaceForm::class;

        $this->model = $model;
        $this->title = 'places';
        $this->keys = [
            'name_en',
            'name_ar',
            'name_fr'
        ];
        $this->table = [
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'name_en', 'display' => App::getLocale() == 'en' ? 'Name in English' : 'الاسم بالانجليزي', 'data' => 'name_en', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'name_ar', 'display' => App::getLocale() == 'en' ? 'Name in Arabic' : 'الاسم عربي', 'data' => 'name_ar', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'name_fr', 'display' => App::getLocale() == 'en' ? 'Name in Franch' : 'الاسم بالفرنسية', 'data' => 'name_fr', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'action', 'display' => App::getLocale() == 'en' ? 'Actions' : 'العمليات', 'data' => 'action', 'orderable' => 'false', 'searchable' => 'false'],
        ];
        $this->wrapper_class = 'form-group';
    }

    public function index()
    {
        $active = $this->active;
        $table_rows = $this->table;
        $route = $this->route;
        return view($this->view . '.index', compact('active', 'table_rows', 'route'));
    }
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create($this->form, [
            'method' => 'POST',
            'url' => route($this->route . '.store'),
        ]);
        $form_title = 'Add ' . $this->title;
        $active = $this->active;
        $route = $this->route;
        return view($this->view . '.form', compact('form', 'form_title', 'active', 'route'));
    }

    public function store(FormBuilder $formBuilder)
    {

        $form = $formBuilder->create($this->form);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $data = $request->all();
        $this->model->create($data);
        // $model = $this->model::create($data);
        flash(awtTrans('Faq Added Successfully'))->success();
        return redirect(route($this->route . '.create'));
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

            return redirect(route($this->route . '.index'));
        }

        $form = $formBuilder->create($this->form, [], ['id' => $model->id]);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $data = $request->all();
        $model->update($data);

        flash(awtTrans('Edited'))->success();

        return redirect(route($this->route . '.index', ['id' => $id]));
    }

    public function delete(int $id)
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash('Can`t find this value')->error();

            return redirect(route($this->route . '.index'));
        }

        $model->delete();
        flash(trans('main.rows_deleted_successfully'))->success();
        return redirect(route($this->route . '.index'));
    }



    public function datatable()
    {

        $model = $this->model::query();

        return DataTables::of($model)
            ->addColumn('action', function ($model) {
                $data = '<a href="' . route($this->route . '.edit', [$model->id]) . '" style="    margin-right: 10px;" class="btn btn-sm btn-primary"><i class="vl_pencil"></i>' . trans('main.edit') . '</a>';
                $data .= '<a data-delete-url="' . route($this->route . '.delete', [$model->id]) . '" style="    margin-right: 10px;" class="btn btn-sm btn-danger delete-row text-white"><i class="vl_recycle-bin"></i>' . trans('main.delete') . '</a>';

                return $data;
            })
            ->rawColumns(['action'])->make(true);
    }
}
