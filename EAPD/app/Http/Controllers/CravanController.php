<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportAid;
use App\Forms\ExpertForm;
use App\Http\Controllers\Traits\UploadTrait;
use App\Models\Aid;
use App\Models\AidSupplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;


class CravanController extends Controller
{
    use UploadTrait;

    protected $active;

    protected $view;

    protected $route;

    protected  $form;

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
        $this->active = 'caravan';
        $this->view = 'cravans';
        $this->route = 'cravans';
        $this->form = ExpertForm::class;
        $this->model = Aid::class;
        $this->title = 'cravans';
        $this->keys = [
            'type_id',
            'country_id',
            'country_org',
            'minister_name',
            'ship_date',
            'arrive_date',
            'cost',
            'notes',
        ];
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'country', 'display' => awtTrans('الدولة'), 'data' => 'country', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'type', 'display' => awtTrans('النوع'), 'data' => 'type', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'ship_date', 'display' => awtTrans('تاريخ الشحن'), 'data' => 'ship_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'cost', 'display' => awtTrans('قيمة المعونة'), 'data' => 'cost', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'country_org', 'display' => awtTrans('الجهة المتلقية بالدولة'), 'data' => 'country_org', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'supplier', 'display' => awtTrans('اسم المورد'), 'data' => 'supplier', 'orderable' => 'true', 'searchable' => 'true'],
        ];
        $this->wrapper_class = 'form-group';

        $this->middleware('can:show_aids')->only(['index', 'show']);
        $this->middleware('can:create_aids')->only(['create', 'store']);
        $this->middleware('can:edit_aids')->only(['edit', 'update']);
        $this->middleware('can:delete_aids')->only(['delete']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'name', 'display' => trans('awt.name'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'is_active', 'display' => trans('awt.نشط؟'), 'data' => 'is_active', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'country', 'display' => awtTrans('الدولة'), 'data' => 'country', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'type', 'display' => awtTrans('النوع'), 'data' => 'type', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'ship_date', 'display' => awtTrans('تاريخ الشحن'), 'data' => 'ship_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'cost', 'display' => awtTrans('قيمة المعونة'), 'data' => 'cost', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'country_org', 'display' => awtTrans('الجهة المتلقية بالدولة'), 'data' => 'country_org', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'supplier', 'display' => awtTrans('اسم المورد'), 'data' => 'supplier', 'orderable' => 'true', 'searchable' => 'true'],
        ];
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
    public function store(FormBuilder $formBuilder)
    {

        $request = request();
        $newData = [];
        $data = $request->all();

        foreach ($request->suppliers as $supplier) {

            $newData[] = ['id' => $supplier['id'], 'details' => nl2br($supplier['details']), 'end_date' => $supplier['end_date'], 'cost' => $supplier['cost']];
        }
        $data['suppliers'] = serialize($newData);
        if (isset($data['image'])) {
            $data['image'] = $this->uploadFile($data['image'], 'aids_file');
        }
        if (isset($data['file'])) {
            $data['file'] = $this->uploadFile($data['file'], 'aids_doc');
        }

        if (! isset($data['is_active'])) {
            $data['is_active'] = 0;
        }

        $data['type_id'] = $request->type_id;
        $data['type'] = 'cravan';
        $model = $this->model::create($data);
        flash(awtTrans('Value Added Successfully'))->success();

        return redirect(route($this->route . '.create'));
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

        return view($this->view . '.show', compact('form', 'form_title', 'active', 'route', 'model'));
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
            flash('Can`t find this value')->error();

            return redirect(route($this->route . '.index'));
        }
        if ($model->suppliers != null) {

            $model->suppliers = unserialize($model->suppliers);
        } else {
            $model->suppliers = [];
        }

        $form = $formBuilder->create($this->form, [
            'method' => 'PUT',
            'model' => $model->toArray(),                              // Not passed to view, just used in form class
            'url' => route($this->route . '.update', [$model['id']]),
        ], ['id' => $model->id]);

        $form_title = 'Edit ' . $this->title;
        $active = $this->active;
        $route = $this->route;

        return view($this->view . '.edit', compact('form', 'form_title', 'active', 'route', 'model'));
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
            flash(awtTrans('Can`t find this value'))->error();

            return redirect(route($this->route . '.index'));
        }

        $request = request();

        $data = $request->all();
        $newData = [];

        foreach ($request->country as $supplier) {

            $newData[] = ['id' => $supplier['id'], 'details' => nl2br($supplier['details']), 'end_date' => $supplier['end_date'], 'cost' => $supplier['cost']];
        }
        $data['suppliers'] = serialize($newData);
        if ($data['image']) {
            $data['image'] = $this->uploadFile($data['image'], 'aids_file');
        }
        if ($data['file']) {
            $data['file'] = $this->uploadFile($data['file'], 'aids_doc');
        }

        if (! isset($data['is_active'])) {
            $data['is_active'] = 0;
        }

        //        $data['suppliers'] = serialize($request->country);
        $model->update($data);
        flash(awtTrans('Value Edited Successfully'))->success();

        return redirect(route($this->route . '.index', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
        $dataArray = filterDatatableGet($_GET);

        $model = $this->model::query()->cravan();
        $request = request();

        if (! isset($request->courses)) {

            if (isset($dataArray['country'])) {
                $model->where('country_id', $dataArray['country']);
            }

            if (isset($dataArray['type_id'])) {
                $model->where('type_id', $dataArray['type_id']);
            }

            if (isset($dataArray['details'])) {
                $model->where('supplier', 'Like', '%' . $dataArray['details'] . '%');
            }
            if (isset($dataArray['supplier'])) {
                $supplier = AidSupplier::where('name', 'like', '%' . $dataArray['supplier'] . '%')->first();
                if (empty($supplier)) {
                    $model->where('suppliers', 'Like', '%"id";s:1:"0"%');
                } else {
                    $model->where('suppliers', 'Like', '%"id";s:1:"' . $supplier->id . '"%');
                }
            }
            if (isset($dataArray['supplier_end_date'])) {

                $model->where('suppliers', 'Like', '%' . $dataArray['supplier_end_date'] . '%');
            }

            if (isset($dataArray['country_org'])) {
                $model->where('country_org', 'Like', '%' . $dataArray['country_org'] . '%');
            }

            if (isset($dataArray['minister_name'])) {
                $model->where('minister_name', 'Like', '%' . $dataArray['minister_name'] . '%');
            }

            if (isset($dataArray['ship_date'])) {
                if (isset($dataArray['ship_date_to'])) {
                    $model->whereBetween('ship_date', [$dataArray['ship_date'], $dataArray['ship_date_to']]);
                } else {
                    $model->where('ship_date', $dataArray['ship_date']);
                }
            }

            if (isset($dataArray['cost_min'])) {
                if (isset($dataArray['cost_max'])) {
                    $model->whereBetween('cost', [$dataArray['cost_min'], $dataArray['cost_max']]);
                } else {
                    $model->where('cost', '>=', $dataArray['cost_min']);
                }
            }

            if (isset($dataArray['ship_date_from'])) {
                if (isset($dataArray['ship_date_to'])) {
                    $model->whereBetween('ship_date', [$dataArray['ship_date_from'], $dataArray['ship_date_to']]);
                } else {
                    $model->where('ship_date', $dataArray['ship_date_from']);
                }
            }

            if (isset($dataArray['arrive_date_from'])) {
                if (isset($dataArray['arrive_date_to'])) {
                    $model->whereBetween('arrive_date', [$dataArray['arrive_date_from'], $dataArray['arrive_date_to']]);
                } else {
                    $model->where('arrive_date', $dataArray['arrive_date_from']);
                }
            }
            $aids = $model->get();
            $ids = [];
            foreach ($aids as $aid) {
                $ids[] = $aid->id;
            }
            if ($request->submit == 'export') {
                return (new ExportAid($ids, $this->view))->download('aids.xlsx');
            }

            if ($request->submit == 'print') {
                return view($this->view . '.print', [
                    'data' => $model->orderBy('ship_date', 'asc')->get(),
                    'print' => 'true',
                    'lang' => App::getLocale(),
                ]);
            }
            flash(trans('main.select_rows_to_delete'))->error();

            return redirect(route($this->route . '.index'));
        }

        if ($request->submit == 'delete') {

            $rows = $this->model::whereIn('id', $request->courses)->get();
            foreach ($rows as $row) {
                if ($row['image'] != null) {
                    $this->deleteFile($row['image'], 'uploads/aids_file');
                }
                if ($row['file']  != null) {
                    $this->uploadFile($row['file'], 'uploads/aids_doc');
                }

                $row->delete();
            }
            flash(trans('main.rows_deleted_successfully'))->success();
            //        flash('Country Deleted Successfully')->success();
        } elseif ($request->submit == 'export') {
            return (new ExportAid($request->courses, $this->view))->download('aids.xlsx');
        } elseif ($request->submit == 'print') {
            return view($this->view . '.print', [
                'data' => Aid::whereIn('id', $request->courses)->orderBy('ship_date', 'asc')->get(),
                'print' => 'true',
                'lang' => App::getLocale(),

            ]);
        }

        return redirect(route($this->route . '.index'));
    }

    /*
     * Countries Datatable
     *
     *
     */
    public function datatable()
    {
        $dataArray = filterDatatableGet($_GET);
        $model = $this->model::query()->cravan();

        if (isset($dataArray['country']) && $dataArray['country'] != '') {

            $model->where('country_id', $dataArray['country']);
        }

        if (isset($dataArray['type_id']) && $dataArray['type_id'] != '') {
            $model->where('type_id', $dataArray['type_id']);
        }

        if (isset($dataArray['details']) && $dataArray['details'] != '') {
            $model->where('suppliers', 'Like', '%' . $dataArray['details'] . '%');
        }
        if (isset($dataArray['supplier']) && $dataArray['supplier'] != '') {
            $supplier = AidSupplier::where('name', 'like', '%' . $dataArray['supplier'] . '%')->first();
            if (empty($supplier)) {
                $model->where('suppliers', 'Like', '%"id";s:1:"0"%');
            } else {
                $model->where('suppliers', 'Like', '%"id";s:1:"' . $supplier->id . '"%');
            }
        }
        if (isset($dataArray['supplier_end_date']) && $dataArray['supplier_end_date'] != '') {

            $model->where('suppliers', 'Like', '%' . $dataArray['supplier_end_date'] . '%');
        }

        if (isset($dataArray['country_org']) && $dataArray['country_org'] != '') {
            $model->where('country_org', 'Like', '%' . $dataArray['country_org'] . '%');
        }

        if (isset($dataArray['minister_name']) && $dataArray['minister_name'] != '') {
            $model->where('minister_name', 'Like', '%' . $dataArray['minister_name'] . '%');
        }

        if (isset($dataArray['ship_date']) && $dataArray['ship_date'] != '') {
            if (isset($dataArray['ship_date_to'])) {
                $model->whereBetween('ship_date', [$dataArray['ship_date'], $dataArray['ship_date_to']]);
            } else {
                $model->where('ship_date', $dataArray['ship_date']);
            }
        }

        if (isset($dataArray['cost_min']) && $dataArray['cost_min'] != '') {
            if (isset($dataArray['cost_max'])) {
                $model->whereBetween('cost', [$dataArray['cost_min'], $dataArray['cost_max']]);
            } else {
                $model->where('cost', '>=', $dataArray['cost_min']);
            }
        }

        if (isset($dataArray['ship_date_from']) && $dataArray['ship_date_from'] != '') {
            if (isset($dataArray['ship_date_to'])) {
                $model->whereBetween('ship_date', [$dataArray['ship_date_from'], $dataArray['ship_date_to']]);
            } else {
                $model->where('ship_date', $dataArray['ship_date_from']);
            }
        }

        if (isset($dataArray['arrive_date_from']) && $dataArray['arrive_date_from'] != '') {
            if (isset($dataArray['arrive_date_to'])) {
                $model->whereBetween('arrive_date', [$dataArray['arrive_date_from'], $dataArray['arrive_date_to']]);
            } else {
                $model->where('arrive_date', $dataArray['arrive_date_from']);
            }
        }
        $data = $model->latest();
        return datatables()->eloquent($data)
            ->addColumn('chk', function ($data) {
                return '<input type="checkbox" name="courses[]" value="' . $data->id . '" class="iCheck-square chk-item">';
            })
            ->addColumn('type', function ($data) {
                return '<a href="' . route($this->route . '.show', [$data->id]) . '">' . (optional($data->type)->name_ar ?? '--') . '</a>';
            })
            ->addColumn('country', function ($data) {
                return getCountry($data->country_id);
            })
            ->addColumn('supplier', function ($data) {
                $suppliers = unserialize($data->suppliers);
                $supplier = $suppliers[0];
                $get_supplier = AidSupplier::where('id', $supplier['id'])->first();
                if (empty($get_supplier)) {
                    return 'N/A';
                }

                return $get_supplier->name;
            })
            ->editColumn('cost', function ($data) {
                return number_format($data->cost, 2, '.', ',');
            })
            ->addColumn('name', function ($data) {
                $title = $data->title_en  ?? '=';
                return '<a href="' . route($this->route . '.show', [$data->id]) . '">' . $title . '</a>';
            })
            ->editColumn('ship_date', function ($data) {
                return $data->ship_date->format('Y-m-d');
            })
            ->editColumn('is_active', function ($data) {
                return $data->is_active ? '<span class="badge bg-success">' . awtTrans('نعم') . '</span>' : '<span class="badge bg-danger">' . awtTrans('لا') . '</span>';
            })
            ->rawColumns(['type', 'name', 'is_active', 'chk', 'type', 'country', 'supplier', 'assessments'])->make(true);
    }
}
