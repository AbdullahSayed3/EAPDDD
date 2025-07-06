<?php

namespace App\Http\Controllers\Settings;

use App\Forms\Settings\SupportMemberForm;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
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
        $this->active = awtTrans('المستخدمين');
        $this->view = 'Fixed';
        $this->route = 'users';
        $this->form = SupportMemberForm::class;
        $this->model = User::class;
        $this->title = 'users';
        $this->keys = ['name', 'email', 'password'];
        $this->table = [
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'name', 'display' => trans('admin.name'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'email', 'display' => trans('admin.email'), 'data' => 'email', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'action', 'display' => trans('admin.action'), 'data' => 'action', 'orderable' => 'false', 'searchable' => 'false'],
        ];
        $this->wrapper_class = 'form-group';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $active = $this->active;
        $title = $this->title;
        $table_rows = $this->table;
        $route = $this->route;

        return view($this->view.'.user', compact('active', 'table_rows', 'route', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FormBuilder $formBuilder): View
    {
        $form = $formBuilder->create($this->form, [
            'method' => 'POST',
            'class' => 'box-body form-element row',
            'url' => route($this->route.'.store'),
        ]);

        $form_title = $this->title;
        $active = $this->active;
        $route = $this->route;

        return view($this->view.'.form', compact('form', 'form_title', 'active', 'route'));
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

        $model = $this->model::create($data);

        if (isset($request->permissions)) {
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $model->syncPermissions($permissionNames);
        } else {
            $model->syncPermissions([]);
        }

        if (isset($request->roles)) {
            $roleIds = is_array($request->roles) ? $request->roles : [$request->roles];
            $roles =Role::whereIn('id', $roleIds)->get();
            $model->syncRoles($roles);
        } else {
            $model->syncRoles([]);
        }
        flash(awtTrans('تم اضافه القيمه بنجاح'))->success();

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
            flash(awtTrans('لم نجد تلك القيمه'))->error();

            return redirect(route($this->route.'.index'));
        }

        $form = $formBuilder->create($this->form, [
            'method' => 'PUT',
            'class' => 'box-body form-element row',
            'model' => $model,                              // Not passed to view, just used in form class
            'url' => route($this->route.'.update', ['id' => $model['id']]),
        ], ['only_view' => true]);

        $form_title = $this->title;
        $active = $this->active;
        $route = $this->route;

        return view($this->view.'.show', compact('model', 'form', 'form_title', 'active', 'route'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, FormBuilder $formBuilder)
    {
        $model = $this->model::find($id);
        if (empty($model)) {
            flash(awtTrans('لم نجد تلك القيمه'))->error();

            return redirect(route($this->route.'.index'));
        }

        $form = $formBuilder->create($this->form, [
            'method' => 'PUT',
            'class' => 'box-body form-element row',
            'model' => $model,                              // Not passed to view, just used in form class
            'url' => route($this->route.'.update', [ $model['id']]),
        ], ['edit' => true]);

        $form_title = $this->title;
        $active = $this->active;
        $route = $this->route;

        return view($this->view.'.form', compact('model', 'form', 'form_title', 'active', 'route'));
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
            flash(awtTrans('لم نجد تلك القيمه'))->error();

            return redirect(route($this->route.'.index'));
        }

        $form = $formBuilder->create($this->form, [], ['edit' => true]);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $data = $request->only($this->keys);
        if ($data['email'] != $model->email) {

            $checkEmail = User::where('email', $data['email'])->first();
            if ($checkEmail) {
                flash(awtTrans('تم استخدام هذا البريد من قبل'))->error();

                return redirect()->back();
            }
        }

        if (! isset($data['password'])) {
            unset($data['password']);
        }
        $model->update($data);
        if (isset($request->permissions)) {
            $model->syncPermissions($request->permissions);

        } else {
            $model->syncPermissions([]);

        }
        if (isset($request->roles)) {
            $roleIds = is_array($request->roles) ? $request->roles : [$request->roles];
            $roles =Role::whereIn('id', $roleIds)->get();
            $model->syncRoles($roles);
        } else {
            $model->syncRoles([]);
        }
        flash(awtTrans('تم تعديل القيمه بنجاح'))->success();

        return redirect(route($this->route.'.edit', [ $id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $id): RedirectResponse
    {
        $model = $this->model::find($id);
        if (empty($model)) {
            flash(awtTrans('لم نجد تلك القيمه'))->error();

            return redirect(route($this->route.'.index'));
        }

        $model->delete();
        flash()->overlay(awtTrans('تم حذف القيمه بنجاح'), $this->title);

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
            $data = '<div class="d-flex justify-content-around flex-wrap">';
            $data .= '<a href="' . route($this->route . '.edit', [$model->id]) . '" class="btn btn-primary"><i class="vl_pencil"></i> ' . awtTrans('تعديل') . '</a>';
            $data .= '<button type="button" class="btn btn-danger delete-row" data-delete-url="' . route($this->route . '.delete', [$model->id]) . '"><i class="vl_recycle-bin"></i> ' . awtTrans('حذف') . '</button>';
            $data .= '</div>';
    
            return $data;
        })->rawColumns(['action'])->make(true);
    }
}