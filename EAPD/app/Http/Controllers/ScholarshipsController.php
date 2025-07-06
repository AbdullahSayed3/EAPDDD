<?php

namespace App\Http\Controllers;

use App\Exports\ScholarshipsExport;
use App\Forms\ScholarshipsForm;
use App\Http\Controllers\Traits\UploadTrait;
use App\Models\Scholarships;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class ScholarshipsController extends Controller
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

    public function __construct()
    {
        $this->active = 'scholarships';
        $this->view = 'scholarships';
        $this->route = 'scholarships';
        $this->form = ScholarshipsForm::class;
        $this->model = Scholarships::class;
        $this->title = 'scholarships';
        $this->keys = [
            'program',
            'owner',
            'department',
            'start_date',
            'end_date',
            'participants',
            'annual_cost'
        ];
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'program', 'display' => awtTrans('البرنامج / المنحة'), 'data' => 'program', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'owner', 'display' => awtTrans('الجهة'), 'data' => 'owner', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'start_date', 'display' => awtTrans('تاريخ البدء'), 'data' => 'start_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'end_date', 'display' => awtTrans('تاريخ الإنتهاء'), 'data' => 'end_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'learners', 'display' => awtTrans('عدد الدارسين'), 'data' => 'learners', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'participants', 'display' => awtTrans('الدول المشاركه '), 'data' => 'participants', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'department', 'display' => awtTrans('مجال الدراسة'), 'data' => 'department', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'annual_cost', 'display' => awtTrans('التكلفه السنوية'), 'data' => 'annual_cost', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'edit', 'display' => awtTrans('تعديل'), 'data' => 'edit', 'orderable' => 'true', 'searchable' => 'true'],

        ];
        $this->wrapper_class = 'form-group';

        $this->middleware('can:show_scholarships')->only(['index', 'show']);
        $this->middleware('can:create_scholarships')->only(['create', 'store']);
        $this->middleware('can:edit_scholarships')->only(['edit', 'update']);
        $this->middleware('can:delete_scholarships')->only(['delete']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'program', 'display' => awtTrans('البرنامج / المنحة'), 'data' => 'program', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'owner', 'display' => awtTrans('الجهة'), 'data' => 'owner', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'start_date', 'display' => awtTrans('تاريخ البدء'), 'data' => 'start_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'end_date', 'display' => awtTrans('تاريخ الإنتهاء'), 'data' => 'end_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'learners', 'display' => awtTrans('عدد الدارسين'), 'data' => 'learners', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'participants', 'display' => awtTrans('الدول المشاركة'), 'data' => 'participants', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'department', 'display' => awtTrans('مجال الدراسة'), 'data' => 'department', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'annual_cost', 'display' => awtTrans('التكلفه السنوية'), 'data' => 'annual_cost', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'edit', 'display' => awtTrans('تعديل'), 'data' => 'edit', 'orderable' => 'true', 'searchable' => 'true'],
        ];

        $this->wrapper_class = 'form-group';
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
    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create($this->form);
        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $data = $request->all();
        // return $data;
        $data['participants'] = serialize($request->participants);
        $data['learners_num'] = 0;
        // $data['learners_num'] = $request->input('learners_num', 0); // Default to 0 if not provided
        $data['annual_cost'] = $data['annual_cost'] ?? 0; // Default to 0 if not provided
        if(isset($data['image']))
        {
            $data['image'] = $this->uploadFile($data['image'],'scholarships');
        }

        if(! isset($data['is_active']))
        {
            $data['is_active'] = 0; // Default to 0 if not provided
        } else {
            $data['is_active'] = 1; // Set to 1 if provided
        }
        $model = Scholarships::create($data);
        $model->learners_num = $model->learners()->count();
        $model->save();
        flash(trans('main.thank_you_for_apply'))->success();

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
            'model' => $model->toArray(),                              // Not passed to view, just used in form class
            'url' => route($this->route.'.update', [ $model['id']]),
        ], ['id' => $model->id]);

        $form_title = 'Edit '.$this->title;
        $active = $this->active;
        $route = $this->route;

        return view($this->view.'.show', compact('model', 'form_title', 'active', 'route'));
    }

    /**
     * Show the form for editing the specified resource.
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
        $model->participants = implode("\n", unserialize($model->participants));

        $form = $formBuilder->create($this->form, [
            'method' => 'PUT',
            'model' => $model->toArray(),                              // Not passed to view, just used in form class
            'url' => route($this->route.'.update', [$model['id']]),
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
    public function update(int $id, FormBuilder $formBuilder): RedirectResponse
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
        $data['participants'] = serialize($request->participants);

        if(isset($data['image']))
        {
            $data['image'] = $this->uploadFile($data['image'],'scholarships');
        }
        if(! isset($data['is_active']))
        {
            $data['is_active'] = 0; // Default to 0 if not provided
        } else {
            $data['is_active'] = 1; // Set to 1 if provided
        }
        $model->update($data);
        flash(trans('main.updates_success_scholarships'))->success();

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
        $dataArray = filterDatatableGet($_GET);

        $model = $this->model::query();

        if (isset($dataArray['program'])) {
            $model->where('program', 'Like', '%'.$dataArray['program'].'%');
        }
        if (isset($dataArray['owner'])) {
            $model->where('owner', 'Like', '%'.$dataArray['owner'].'%');
        }
        if (isset($dataArray['participants'])) {
            $model->where('participants', 'Like', '%'.$dataArray['participants'].'%');
        }

        if (isset($dataArray['start_date_from'])) {
            if (isset($dataArray['start_date_to'])) {
                $model->whereBetween('start_date', [$dataArray['start_date_from'], $dataArray['start_date_to']]);

            } else {
                $model->where('start_date', '>=', $dataArray['start_date_from']);

            }
        }
        if (isset($dataArray['end_date_from'])) {
            if (isset($dataArray['end_date_to'])) {
                $model->whereBetween('end_date', [$dataArray['end_date_from'], $dataArray['end_date_to']]);

            } else {
                $model->where('end_date', '>=', $dataArray['end_date_from']);

            }
        }
        $scholarships = $model->orderBy('start_date', 'asc')->get();
        $ids = [];
        foreach ($scholarships as $scholarship) {
            $ids[] = $scholarship->id;
        }
        if (! isset($request->scholarships)) {
            if ($request->submit == 'export') {
                return (new ScholarshipsExport($ids, $this->view))->download('scholarships.xlsx');
            }
            if ($request->submit == 'print') {
                return view($this->view.'.print', [
                    'data' => $scholarships,
                    'print' => 'true',
                    'lang' => App::getLocale(),
                ]);
            }

            if ($request->submit == 'print2') {
                if ($request->input('print_choices') == null) {
                    flash(awtTrans('يجب اختيار خانه واحده علي الاقل'))->error();

                    return redirect(route($this->route.'.index'));
                }

                return view($this->view.'.print2', [
                    'data' => $scholarships,
                    'print' => 'true',
                    'title' => $request->input('print_title'),
                    'print_choices' => $request->input('print_choices'),
                    'lang' => App::getLocale(),

                ]);
            }
            flash(trans('main.select_rows_to_delete'))->error();

            return redirect(route($this->route.'.index'));
        }

        if ($request->submit == 'delete') {

            $rows = $this->model::whereIn('id', $request->scholarships)->orderBy('start_date', 'asc')->get();
            foreach ($rows as $row) {
                $row->delete();

            }
            flash(trans('main.rows_deleted_successfully'))->success();
            //        flash('Country Deleted Successfully')->success();
        } elseif ($request->submit == 'export') {
            return (new ScholarshipsExport($request->scholarships, $this->view))->download('scholarships.xlsx');
        } elseif ($request->submit == 'print') {
            return view($this->view.'.print', [
                'data' => Scholarships::whereIn('id', $request->scholarships)->orderBy('start_date', 'asc')->get(),
                'print' => 'true',
                'lang' => App::getLocale(),

            ]);
        } elseif ($request->submit == 'print2') {
            if ($request->input('print_choices') == null) {
                flash(awtTrans('يجب اختيار خانه واحده علي الاقل'))->error();

                return redirect(route($this->route.'.index'));
            }

            return view($this->view.'.print2', [
                'data' => Scholarships::whereIn('id', $request->scholarships)->orderBy('start_date', 'asc')->get(),
                'print_choices' => $request->input('print_choices'),
                'title' => $request->input('print_title'),
                'print' => 'true',
                'lang' => App::getLocale(),
            ]);
        }

        return redirect(route($this->route.'.index'));
    }

    public function datatable()
    {

        $dataArray = filterDatatableGet($_GET);

        $model = $this->model::query();

        if (isset($dataArray['program'])) {
            $word = $dataArray['program'];
            $model->where(function ($q) use ($word) {
                    $q->where('program', 'LIKE', '%' . $word . '%')
                      ->orWhere('program_en', 'LIKE', '%' . $word . '%')
                      ->orWhere('program_fr', 'LIKE', '%' . $word . '%');
                });
        }
        if(isset($dataArray['program_select']))
        {
            $model->where('id',$dataArray['program_select']);
        }
        if (isset($dataArray['owner'])) {
            $model->where('owner', 'Like', '%'.$dataArray['owner'].'%');
        }
        if (isset($dataArray['participants'])) {
            $model->where('participants', 'Like', '%'.$dataArray['participants'].'%');
        }

        if (isset($dataArray['start_date_from'])) {
            if (isset($dataArray['start_date_to'])) {
                $model->whereBetween('start_date', [$dataArray['start_date_from'], $dataArray['start_date_to']]);

            } else {
                $model->where('start_date', '>=', $dataArray['start_date_from']);

            }
        }
        if (isset($dataArray['end_date_from'])) {
            if (isset($dataArray['end_date_to'])) {
                $model->whereBetween('end_date', [$dataArray['end_date_from'], $dataArray['end_date_to']]);

            } else {
                $model->where('end_date', '>=', $dataArray['end_date_from']);

            }
        }

        return DataTables::of($model)
            ->addColumn('chk', function ($model) {
                return '<input type="checkbox" name="scholarships[]" value="'.$model->id.'" class="iCheck-square chk-item">';
            })
            ->editColumn('name', function ($model) {
                $name = $model->first_name.' '.$model->middle_name.' '.$model->last_name;

                return '<a href="'.route($this->route.'.show', [$model->id]).'">'.$name.'</a>';
            })
            ->editColumn('program', function ($model) {
                return '<a href="'.route($this->route.'.show', [$model->id]).'">'.$model->program.'</a>';
            })
            ->addColumn('edit', function ($model) {
                return '<a href="'.route($this->route.'.edit', [$model->id]).'">'.awtTrans('تعديل').'</a>';
            })
            ->editColumn('owner', function ($model) {
                return $model->owner;
            })

            ->editColumn('department', function ($model) {
                return $model->field->name_ar;
            })
            // ->editColumn('annual_cost', function ($model) {

            //     return $model->annual_cost * $model->learners_num;
            // })
            ->editColumn('start_date', function ($model) {
                if ($model->start_date == null) {
                    return '_';
                }

                return Carbon::createFromTimeString($model->start_date)->format('Y-m-d');
            })
            ->editColumn('end_date', function ($model) {
                if ($model->end_date == null) {
                    return '_';
                }

                return Carbon::createFromTimeString($model->end_date)->format('Y-m-d');
            })
            ->editColumn('participants', function ($model) {
                $array = unserialize($model->participants);

                return count($array);
            })->editColumn('learners', function ($model) {
                return $model->learners->count();
            })

            ->rawColumns(['chk', 'program', 'owner', 'start_date_from', 'end_date_from', 'participants', 'edit'])->make(true);
    }
}
