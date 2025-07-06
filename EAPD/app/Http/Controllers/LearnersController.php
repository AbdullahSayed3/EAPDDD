<?php

namespace App\Http\Controllers;

use App\Exports\LearnersExport;
use App\Forms\LearnersForm;
use App\Models\Learners;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

// use App\Exports\LearnersExport;

class LearnersController extends Controller
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

    public function __construct()
    {
        
        $this->middleware('can:show_learners')->only(['index', 'show']);
        $this->middleware('can:create_learners')->only(['create', 'store']);
        $this->middleware('can:edit_learners')->only(['edit', 'update']);
        $this->middleware('can:delete_learners')->only(['delete']);
        
        $this->active = 'learners';
        $this->view = 'learners';
        $this->route = 'learners';
        $this->form = LearnersForm::class;
        $this->model = Learners::class;
        $this->title = 'learners';
        $this->keys = [
            'scholarships_id',
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'nationality',
            'email_address',
            'birth_date',
        ];
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'first_name', 'display' => awtTrans('الاسم'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'gender', 'display' => awtTrans('النوع'), 'data' => 'gender', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'nationality', 'display' => awtTrans('الجنسيه'), 'data' => 'nationality', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'scholarships_id', 'display' => awtTrans('المنحة الحالية'), 'data' => 'scholarships_id', 'orderable' => 'false', 'searchable' => 'false'],
            // ['name' => 'course_date', 'display' => awtTrans('تاريخ الدورة	'), 'data' => 'course_date', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'age', 'display' => awtTrans('السن'), 'data' => 'age', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'email_address', 'display' => awtTrans('البريد الالكتروني'), 'data' => 'email_address', 'orderable' => 'true', 'searchable' => 'true'],
            //             ['name' => 'birth_date', 'display' => awtTrans('الهاتف'), 'data' => 'phone', 'orderable' => 'true', 'searchable' => 'true'],
            //             ['name' => 'passport_id', 'display' => awtTrans('رقم جواز السفر'), 'data' => 'passport_id', 'orderable' => 'true', 'searchable' => 'true'],
            // //            ['name' => 'exported', 'display' => trans('main.exported'), 'data' => 'exported', 'orderable' => 'true', 'searchable' => 'true'],
            //             ['name' => 'country', 'display' => awtTrans('الدولة'), 'data' => 'country', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'edit', 'display' => awtTrans('تعديل'), 'data' => 'edit', 'orderable' => 'false', 'searchable' => 'false'],

        ];
        $this->wrapper_class = 'form-group';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'first_name', 'display' => awtTrans('الاسم'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'gender', 'display' => awtTrans('النوع'), 'data' => 'gender', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'nationality', 'display' => awtTrans('الجنسيه'), 'data' => 'nationality', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'scholarships_id', 'display' => awtTrans('المنحة الحالية'), 'data' => 'scholarships_id', 'orderable' => 'false', 'searchable' => 'false'],
            // ['name' => 'course_date', 'display' => awtTrans('تاريخ الدورة	'), 'data' => 'course_date', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'age', 'display' => awtTrans('السن'), 'data' => 'age', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'email_address', 'display' => awtTrans('البريد الالكتروني'), 'data' => 'email_address', 'orderable' => 'true', 'searchable' => 'true'],
            //             ['name' => 'birth_date', 'display' => awtTrans('الهاتف'), 'data' => 'phone', 'orderable' => 'true', 'searchable' => 'true'],
            //             ['name' => 'passport_id', 'display' => awtTrans('رقم جواز السفر'), 'data' => 'passport_id', 'orderable' => 'true', 'searchable' => 'true'],
            // //            ['name' => 'exported', 'display' => trans('main.exported'), 'data' => 'exported', 'orderable' => 'true', 'searchable' => 'true'],
            //             ['name' => 'country', 'display' => awtTrans('الدولة'), 'data' => 'country', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'edit', 'display' => awtTrans('تعديل'), 'data' => 'edit', 'orderable' => 'false', 'searchable' => 'false'],

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
    public function store(FormBuilder $formBuilder): RedirectResponse
    {
        $form = $formBuilder->create($this->form);
        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $data = $request->only($this->keys);
        $data['participants'] = serialize($request->participants);
        // dd($request->all(), $data);
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
        // $files = [];

        // $participants = explode("\n", $request->participants);

        $data = $request->only($this->keys);
        $data['participants'] = serialize($request->participants);

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
        $dataArray = filterDatatableGet($_GET);

        $model = $this->model::query();

        if (isset($dataArray['first_name'])) {
            $first_name = $dataArray['first_name'];

            $model->where(function ($query) use ($first_name) {
                $query->where('first_name', 'Like', '%'.$first_name.'%');
            });
        }
        if (isset($dataArray['second_name'])) {
            $second_name = $dataArray['second_name'];
            $model->where(function ($query) use ($second_name) {
                $query->where('middle_name', 'Like', '%'.$second_name.'%');
            });
        }
        if (isset($dataArray['third_name'])) {
            $third_name = $dataArray['third_name'];
            $model->where(function ($query) use ($third_name) {
                $query->where('last_name', 'Like', '%'.$third_name.'%');
            });
        }

        if (isset($dataArray['country'])) {
            $model->where('nationality', 'Like', '%'.$dataArray['country'].'%');
        }
        if (isset($dataArray['scholarships_id'])) {
            $model->where('scholarships_id', $dataArray['scholarships_id']);
        }
        if (isset($dataArray['gender'])) {
            $model->where('gender', $dataArray['gender']);
        }
        $learners = $model->get();
        $ids = [];
        foreach ($learners as $learner) {
            $ids[] = $learner->id;
        }
        if (! isset($request->learners)) {
            if ($request->submit == 'export') {
                return (new LearnersExport($ids, $this->view))->download('learners.xlsx');
            }
            if ($request->submit == 'print') {
                return view($this->view.'.print', [
                    'data' => $learners,
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
                    'data' => $learners,
                    'print' => 'true',
                    'title' => $request->input('print_title'),
                    'print_choices' => $request->input('print_choices'),
                    'lang' => App::getLocale(),

                ]);
            }

            return redirect(route($this->route.'.index'));
        }

        if ($request->submit == 'delete') {

            $rows = $this->model::whereIn('id', $request->learners)->orderBy('created_at', 'asc')->get();
            foreach ($rows as $row) {
                $row->delete();
            }
            flash(trans('main.rows_deleted_successfully'))->success();
        } elseif ($request->submit == 'export') {
            return (new LearnersExport($request->learners, $this->view))->download('learners.xlsx');
        } elseif ($request->submit == 'print') {
            return view($this->view.'.print', [
                'data' => Learners::whereIn('id', $request->learners)->orderBy('created_at', 'asc')->get(),
                'print' => 'true',
                'lang' => App::getLocale(),

            ]);
        } elseif ($request->submit == 'print2') {
            if ($request->input('print_choices') == null) {
                flash(awtTrans('يجب اختيار خانه واحده علي الاقل'))->error();

                return redirect(route($this->route.'.index'));
            }

            return view($this->view.'.print2', [
                'data' => Learners::whereIn('id', $request->learners)->orderBy('created_at', 'asc')->get(),
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

        if (isset($dataArray['first_name'])) {
            $first_name = $dataArray['first_name'];

            $model->where(function ($query) use ($first_name) {
                $query->where('first_name', 'Like', '%'.$first_name.'%');
            });
        }
        if (isset($dataArray['second_name'])) {
            $second_name = $dataArray['second_name'];
            $model->where(function ($query) use ($second_name) {
                $query->where('middle_name', 'Like', '%'.$second_name.'%');
            });
        }
        if (isset($dataArray['third_name'])) {
            $third_name = $dataArray['third_name'];
            $model->where(function ($query) use ($third_name) {
                $query->where('last_name', 'Like', '%'.$third_name.'%');
            });
        }

        if (isset($dataArray['country'])) {
            $model->where('nationality', 'Like', '%'.$dataArray['country'].'%');
        }
        if (isset($dataArray['scholarships_id'])) {
            $model->where('scholarships_id', $dataArray['scholarships_id']);
        }
        if (isset($dataArray['gender'])) {
            $model->where('gender', $dataArray['gender']);
        }

        return DataTables::of($model)->editColumn('chk', function ($model) {
            return '<input type="checkbox" name="learners[]" value="'.$model->id.'" class="iCheck-square chk-item">';
        })
            ->editColumn('edit', function ($model) {
                return '<a href="'.route($this->route.'.edit', [$model->id]).'">'.awtTrans('تعديل').'</a>';
            })

            ->editColumn('scholarships_id', function ($model) {

                if (empty($model->scholarship)) {
                    return 'N\A';
                }

                return $model->scholarship->program;
            })
            ->editColumn('nationality', function ($model) {

                if (empty($model->nationality)) {
                    return 'N\A';
                }

                return getCountry($model->nationality);
            })

            ->editColumn('name', function ($model) {
                $name = $model->first_name.' '.$model->middle_name.' '.$model->last_name;

                return '<a href="'.route($this->route.'.show', [$model->id]).'">'.$name.'</a>';
            })

            ->editColumn('gender', function ($model) {
                if ($model->gender == 'male') {
                    return awtTrans('ذكر');
                } elseif ($model->gender == null) {
                    return 'N/A';
                }

                return awtTrans('انثي');
            })->editColumn('age', function ($model) {
                if (isset($model->birth_date)) {
                    return $model->age();

                }

                return '';
            })
            ->rawColumns(['action', 'chk', 'name', 'nationality', 'scholarships_id', 'age', 'edit'])->make(true);
    }
}
