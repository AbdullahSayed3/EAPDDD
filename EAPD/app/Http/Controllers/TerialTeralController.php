<?php

namespace App\Http\Controllers;

use App\Exports\ExportTrial;
use App\Forms\TrialTeralForm;
use App\Http\Controllers\Traits\UploadTrait;
use App\Models\TrialTeral;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class TerialTeralController extends Controller
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
        $this->active = 'TrialTeral';
        $this->view = 'TrialTeral';
        $this->route = 'TrialTeral';
        $this->form = TrialTeralForm::class;
        $this->model = TrialTeral::class;
        $this->title = 'TrialTeral';
        $this->keys = [
            'name',
            'contract_files',
            'contract_field',
            'cost',
            'agency_cost',
            'details',
            'start_date',
            'status',
            'acceptation_number',
            'notes',
            'beneficiary_countries',
        ];
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'countries', 'display' => awtTrans('الدول / الجهات'), 'data' => 'countries', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'field', 'display' => awtTrans('مجالات التعاون'), 'data' => 'field', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'start_date', 'display' => awtTrans('تاريخ بدء الاتفاق'), 'data' => 'start_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'status', 'display' => awtTrans('الحالة'), 'data' => 'status', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'acceptation_number', 'display' => awtTrans('رقم موافقة الوزير أو مجلس الإدارة'), 'data' => 'acceptation_number', 'orderable' => 'true', 'searchable' => 'true'],
        ];
        $this->wrapper_class = 'form-group';

        $this->middleware('can:show_teral_terials')->only(['index', 'show']);
        $this->middleware('can:create_teral_terials')->only(['create', 'store']);
        $this->middleware('can:edit_teral_terials')->only(['edit', 'update']);
        $this->middleware('can:delete_teral_terials')->only(['delete']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'countries', 'display' => awtTrans('الدول / الجهات'), 'data' => 'countries', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'field', 'display' => awtTrans('مجالات التعاون'), 'data' => 'field', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'start_date', 'display' => awtTrans('تاريخ بدء الاتفاق'), 'data' => 'start_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'status', 'display' => awtTrans('الحالة'), 'data' => 'status', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'acceptation_number', 'display' => awtTrans('رقم موافقة الوزير أو مجلس الإدارة'), 'data' => 'acceptation_number', 'orderable' => 'true', 'searchable' => 'true'],
        ];
        $active = $this->active;
        $table_rows = $this->table;
        $route = $this->route;

        return view($this->view.'.index', compact('active', 'table_rows', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FormBuilder $formBuilder): View
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
    public function store(FormBuilder $formBuilder): RedirectResponse
    {

        //        $form = $formBuilder->create($this->form);
        //
        //        if (!$form->isValid()) {
        //            return redirect()->back()->withErrors($form->getErrors())->withInput();
        //        }
        $request = request();
        $files = [];

        if (isset($request->contract_files)) {
            foreach ($request->contract_files as $file) {
                $files[] = $this->uploadFile($file, 'trial_teral');
            }
        } else {
            flash(awtTrans('contract files Are Required'))->error();

            return redirect(route($this->route.'.create'))->withInput();
        }

        $participants = explode("\n", $request->participants);

        $data = $request->only($this->keys);

        $data['beneficiary_countries'] = serialize($request->country);
        $data['contract_files'] = serialize($files);
        $data['contract_field'] = serialize($request->contract_field);

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
            'url' => route($this->route.'.update', ['id' => $model['id']]),
        ], ['id' => $model->id]);

        $form_title = 'Edit '.$this->title;
        $active = $this->active;
        $route = $this->route;

        return view($this->view.'.show', compact('form', 'form_title', 'active', 'route', 'model'));
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

            return redirect(route($this->route.'.index'));
        }
        $model->beneficiary_countries = unserialize($model->beneficiary_countries);
        $model->contract_field = unserialize($model->contract_field);
        $form = $formBuilder->create($this->form, [
            'method' => 'PUT',
            'model' => $model->toArray(),                              // Not passed to view, just used in form class
            'url' => route($this->route.'.update', ['id' => $model['id']]),
        ], ['id' => $model->id]);

        $form_title = 'Edit '.$this->title;
        $active = $this->active;
        $route = $this->route;

        return view($this->view.'.edit', compact('form', 'form_title', 'active', 'route', 'model'));
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

            return redirect(route($this->route.'.index'));
        }

        $request = request();
        $files = [];

        if (isset($request->contract_files)) {
            foreach ($request->contract_files as $file) {
                $files[] = $this->uploadFile($file, 'trial_teral');
            }
        } else {
            $files = unserialize($model->contract_files);

        }

        $participants = explode("\n", $request->participants);

        $data = $request->only($this->keys);

        $data['beneficiary_countries'] = serialize($request->country);
        $data['contract_files'] = serialize($files);
        $data['contract_field'] = serialize($request->contract_field);

        $model->update($data);
        flash(awtTrans('Value Edited Successfully'))->success();

        return redirect(route($this->route.'.index', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {

        $request = request();

        if (! isset($request->courses)) {
            if ($request->submit == 'export') {

                return (new ExportTrial([], $this->view))->download('terialTeral.xlsx');
            }
            if ($request->submit == 'print') {
                return view($this->view.'.print', [
                    'data' => TrialTeral::all(),
                    'print' => 'true',
                    'lang' => App::getLocale(),
                ]);
            }
            flash(trans('main.select_rows_to_delete'))->error();

            return redirect(route($this->route.'.index'));
        }

        if ($request->submit == 'delete') {

            $rows = $this->model::whereIn('id', $request->courses)->get();
            foreach ($rows as $row) {
                $row->delete();

            }
            flash(trans('main.rows_deleted_successfully'))->success();
            //        flash('Country Deleted Successfully')->success();
        } elseif ($request->submit == 'export') {
            return (new ExportTrial($request->courses, $this->view))->download('terialTeral.xlsx');
        } elseif ($request->submit == 'print') {
            return view($this->view.'.print', [
                'data' => TrialTeral::whereIn('id', $request->courses)->get(),
                'print' => 'true',
                'lang' => App::getLocale(),

            ]);
        }
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
        $dataArray = filterDatatableGet($_GET);

        $model = $this->model::query();

        if (isset($dataArray['country'])) {

            $model->where('beneficiary_countries', 'LIKE', '%'.$dataArray['country'].'%');
        }

        if (isset($dataArray['countryA'])) {

            $model->where('beneficiary_countries', 'LIKE', '%'.$dataArray['countryA'].'%');
        }
        if (isset($dataArray['status'])) {

            $model->where('status', $dataArray['status']);
        }

        if (isset($dataArray['field'])) {
            $field = $dataArray['field'];
            $model->where('contract_field', 'like', '%"'.$field.'"%');
            //            $model->whereHas('field',function ($query) use ($field) {
            //                $query->where('name_ar','like','%'.$field.'%');
            //            });
        }

        if (isset($dataArray['date_from'])) {
            $model->whereDate('start_date', '>', $dataArray['date_from']);
        }

        if (isset($dataArray['date_to'])) {
            $model->whereDate('start_date', '<', $dataArray['date_to']);
        }

        return DataTables::of($model)
            ->addColumn('chk', function ($model) {
                return '<input type="checkbox" name="courses[]" value="'.$model->id.'" class="iCheck-square chk-item">';

            })
            ->addColumn('countries', function ($model) {
                $array = unserialize($model->beneficiary_countries);
                $data = '<a href="'.route($this->route.'.show', ['id' => $model->id]).'">';
                foreach ($array as $item) {
                    if ($item['org'] != null) {
                        if ($item['id'] == '0') {

                            $data .= $item['org'].'<br>';

                        } else {
                            $data .= getCountry($item['id']).'('.$item['org'].')<br>';

                        }

                    } else {

                        $data .= getCountry($item['id']).'<br>';

                    }
                }
                $data .= '</a>';

                return $data;
            })
            ->addColumn('field', function ($model) {
                $array = unserialize($model->contract_field);
                $data = '<a>';
                foreach ($array as $item) {
                    $data .= getTrialField($item).'<br>';

                }
                $data .= '</a>';

                return $data;
            })

            ->rawColumns(['type', 'chk', 'countries', 'field', 'applications', 'assessments'])->make(true);
    }
}
