<?php

namespace App\Http\Controllers\Settings;

use App\Forms\Settings\AidTypeForm;
use App\Forms\Settings\FixedForm;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UploadTrait;
use App\Models\Aid;
use App\Models\AidType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class AidsTypeController extends Controller
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

    /**
     * Websites Controller constructor.
     */
    public function __construct()
    {
        $this->active = awtTrans('انواع المنح');
        $this->view = 'Fixed';
        $this->route = 'aids_types';
        $this->form = AidTypeForm::class;
        $this->model = AidType::class;
        $this->title = 'aids_types';
        $this->keys = [
            'name_ar',
            'name_en',
            'image',
            'parent_id'
        ];
        $this->table = [
            ['name' => 'name_ar', 'display' => trans('awt.name_ar'), 'data' => 'name_ar', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'name_en', 'display' => trans('main.name_en'), 'data' => 'name_en', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'parent_id', 'display' => trans('awt.نوع القافلة الرئيسيي'), 'data' => 'parent_id', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'image', 'display' => trans('main.image'), 'data' => 'image', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'action', 'display' => trans('awt.edit'), 'data' => 'action', 'orderable' => 'false', 'searchable' => 'false'],
        ];
        $this->wrapper_class = 'form-group';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $active = $this->active;
        $table_rows = $this->table;
        $route = $this->route;

        return view($this->view . '.index', compact('active', 'table_rows', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FormBuilder $formBuilder): View
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(FormBuilder $formBuilder): RedirectResponse
    {

        $form = $formBuilder->create($this->form);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $data = $request->only($this->keys);
        if (isset($data['image']) && $data['image'] != null) {
            $data['image'] = $this->uploadFile($data['image'], 'aids_types');
        } else {
            $data['image'] = null;
        }

        $model = $this->model::create($data);
        flash(awtTrans('Value Added Successfully'))->success();

        return redirect(route($this->route . '.create'));

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

        return view($this->view . '.form', compact('form', 'form_title', 'active', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(int $id, FormBuilder $formBuilder): RedirectResponse
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
        $data = $request->only($this->keys);
        if (isset($data['image']) && $data['image'] != null) {
            $data['image'] = $this->uploadFile($data['image'], 'aids_types');
        } else {
            $data['image'] = null;
        }
        $model->update($data);
        flash('Value Edited Successfully')->success();

        return redirect(route($this->route . '.index', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $id): RedirectResponse
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash('Can`t find this value')->error();

            return redirect(route($this->route . '.index'));
        }
        $aid = Aid::where('type_id', $id)->exists();
        if ($aid) {
            flash(awtTrans('can not delete this item'))->error();
            return redirect()->back();
        } else {
            $model->delete();
        }
        flash(trans('main.rows_deleted_successfully'))->success();

        //        flash('Country Deleted Successfully')->success();
        return redirect(route($this->route . '.index'));
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

            $data = '<a href="' . route($this->route . '.show', [$model->id]) . '" style="    margin-right: 10px;" class="btn btn-sm btn-primary"><i class="vl_pencil"></i>' . trans('main.edit') . '</a>';
            $data .= '<a href="' . route($this->route . '.delete', [$model->id]) . '" style="    margin-right: 10px;" class="btn btn-sm btn-danger delete-row"><i class="vl_recycle-bin"></i>' . trans('main.delete') . '</a>';

            return $data;
        })
            ->editColumn('image', function ($model) {
                return '<img src="' . asset('uploads/aids_types/' . $model->image) . '" style="width: 50px; height: 50px; border-radius: 50%;" alt="' . $model->title . '">';
            })

            ->editColumn('parent_id', function ($model) {
                return $model->parent['name_' . App::getLocale()] ?? null;
            })

            ->rawColumns(['action', 'parent_id', 'image'])->make(true);
    }
}
