<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Course;
use App\Exports\ExportCountries;
use App\Exports\ExportCourse;
use App\Forms\CourseForm;
use App\Http\Controllers\Traits\UploadTrait;
use App\Jobs\ProcessCourseExport;
use App\Models\CourseTrianee;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\DataTables;

class CoursesController extends Controller
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


        $this->middleware('can:show_courses')->only(['index', 'show']);
        $this->middleware('can:create_courses')->only(['create', 'store']);
        $this->middleware('can:edit_courses')->only(['edit', 'update']);
        $this->middleware('can:delete_courses')->only(['delete']);

        $this->active = 'courses';
        $this->view = 'courses';
        $this->route = 'courses';
        $this->form = CourseForm::class;
        $this->model = Course::class;
        $this->title = 'courses';
        $this->keys = [
            'name_ar',
            'name_en',
            'name_fr',

            'type_id',
            'natural_id',
            'field_id',
            'content',
            'content_en',
            'content_fr',
            'start_date',
            'end_date',
            'location',
            'organization_id',
            'documents',
            'countries',
            'trainees',
            'cost',
            'notes',
        ];

        $this->middleware(function ($request, $next) {
            if (session('lang') != null) {
                App::setLocale(session('lang'));
            }

            return $next($request);
        });

        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => awtTrans('رقم الدورة'), 'data' => 'id', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'is_active', 'display' => trans('awt.نشط؟'), 'data' => 'is_active', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'trainees', 'display' => awtTrans('المنسق'), 'data' => 'trainees', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'name_ar', 'display' => awtTrans('الدورة التدريبية'), 'data' => 'name_ar', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'type', 'display' => awtTrans('طبيعة الدورة'), 'data' => 'type', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'organization_id', 'display' => awtTrans('جهة التدريب'), 'data' => 'organization', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'start_date', 'display' => awtTrans('تاريخ الدورة'), 'data' => 'start_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'countries', 'display' => awtTrans('الدول المشاركة'), 'data' => 'countries', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'inv_countries', 'display' => awtTrans('الدول المدعوة'), 'data' => 'inv_countries', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'total_app', 'display' => awtTrans('عدد المتدربين'), 'data' => 'total_app', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'total_app_fem', 'display' => awtTrans('المتدربات النساء'), 'data' => 'total_app_fem', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'assessments', 'display' => awtTrans('التقييمات'), 'data' => 'assessments', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'edit', 'display' => awtTrans('تعديل'), 'data' => 'edit', 'orderable' => 'true', 'searchable' => 'true'],
        ];
        $this->wrapper_class = 'form-group';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user= Auth::user()->assignRole('SystemManager');
        // // return $user->with
        //  dd(json_encode(User::first()->getRoleNames()));

        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => awtTrans('رقم الدورة'), 'data' => 'id', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'is_active', 'display' => trans('awt.نشط؟'), 'data' => 'is_active', 'orderable' => 'true', 'searchable' => 'true'],

            ['name' => 'trainees', 'display' => awtTrans('المنسق'), 'data' => 'trainees', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'name_ar', 'display' => awtTrans('الدورة التدريبية'), 'data' => 'name_ar', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'type_id', 'display' => awtTrans('طبيعة الدورة'), 'data' => 'type', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'organization_id', 'display' => awtTrans('جهة التدريب'), 'data' => 'organization', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'start_date', 'display' => awtTrans('تاريخ البدء'), 'data' => 'start_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'end_date', 'display' => awtTrans('تاريخ الإنتهاء'), 'data' => 'end_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'inv_countries', 'display' => awtTrans('الدول المشاركة'), 'data' => 'inv_countries', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'countries', 'display' => awtTrans('الدول المدعوة'), 'data' => 'countries', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'total_app', 'display' => awtTrans('عدد المتدربين'), 'data' => 'total_app', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'total_app_fem', 'display' => awtTrans('المتدربات النساء'), 'data' => 'total_app_fem', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'assessments', 'display' => awtTrans('التقييمات'), 'data' => 'assessments', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'edit', 'display' => awtTrans('تعديل'), 'data' => 'edit', 'orderable' => 'false', 'searchable' => 'false'],
        ];
        $active = $this->active;
        $table_rows = $this->table;
        $route = $this->route;
        // return $route;

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
        try {
            $form = $formBuilder->create($this->form);

            if (! $form->isValid()) {
                return redirect()->back()->withErrors($form->getErrors())->withInput();
            }

            $request = request();
            $files = [];

            if (isset($request->documents)) {
                foreach ($request->documents as $file) {
                    $files[] = $this->uploadFile($file[0], 'course');
                }
            }

            if (Carbon::parse($request->start_date)->gt(Carbon::parse($request->end_date))) {
                flash(trans('main.start_date_must_be_before_end_date'))->error();
                return redirect(route($this->route . '.create'))->withInput();
            }

            $data = $request->all();

            $data['documents'] = isset($files) ? serialize($files) : null;
            $data['trainees'] = isset($request->trainees) ? serialize($request->trainees) : null;
            $data['countries'] = isset($request->countries) ? serialize($request->countries) : null;
            $data['cost'] = 0;

            if (isset($data['image'])) {
                $data['image'] = $this->uploadFile($data['image'], 'courses_file');
            }

            if (isset($data['images'])) {
                $dataImage = [];
                foreach ($data['images'] as $image) {
                    $item = $this->uploadFile($image[0], 'courses_file');
                    $dataImage[] = $item;
                }
                $data['images'] = serialize($dataImage); // Serialize the images array
            } else {
                $data['images'] = null; // or serialize([]) if you prefer an empty array
            }

            if (!isset($request->is_active)) {
                $data['is_active'] = 0;
            }
            $model = $this->model::create($data);
            if ($model) {
                flash(awtTrans('Value Added Successfully'))->success();
                return redirect(route($this->route . '.create'));
            } else {
                flash('Error Accure')->error();
                return redirect(route($this->route . '.create'));
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, FormBuilder $formBuilder)
    {

        $model = $this->model::with('organization')->find($id);
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

        $qrCode = QrCode::size(100)
            ->generate('https://dev-fe-eapd.atwdemo.com/whatWeDo/capacityBuilding/1');
        return view($this->view . '.show', compact('qrCode', 'form', 'form_title', 'active', 'route', 'model'));
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
        $model->trainees = unserialize($model->trainees);
        $model->countries = unserialize($model->countries);
        $model->start_date = $model->start_date->format('Y-m-d');
        $model->end_date = $model->end_date->format('Y-m-d');

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
        if (request()->start_date > request()->end_date) {
            flash(trans('main.start_date_must_be_before_end_date'))->error();

            return redirect(route($this->route . '.edit', $id))->withInput();
        }

        $form = $formBuilder->create($this->form, [], ['id' => $model->id]);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $files = [];

        if (isset($request->documents)) {
            foreach ($request->documents as $file) {
                $files[] = $this->uploadFile($file[0], 'course');
            }
        } else {
            $files = unserialize($model->documents);
        }

        $data = $request->all();

        if (!isset($request->is_active)) {
            $data['is_active'] = 0;
        }
        $data['documents'] = serialize($files);
        $data['trainees'] = serialize($request->trainees);
        $data['countries'] = serialize($request->countries);
        // $data['name_en'] = serialize($request->name_ar);
        if (isset($data['image'])) {
            $data['image'] = $this->uploadFile($data['image'], 'courses_file');
        }
        if (isset($data['images'])) {
            $dataImage = [];
            foreach ($data['images'] as $image) {
                $item = $this->uploadFile($image[0], 'courses_file');
                $dataImage[] = $item;
            }
            $data['images'] = $dataImage;
        }
        $model->update($data);
        flash(awtTrans('Value Edited Successfully'))->success();

        return redirect(route($this->route . '.index'));
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
        $model = $this->model::query();
        $dataArray = filterDatatableGet($_GET);

        if (isset($dataArray['country'])) {
            $applicants = Application::where('nationality', $dataArray['country'])->get();

            $applicants = $applicants->groupBy('course_id');
            $appids = [];
            foreach ($applicants as $applicant) {
                foreach ($applicant as $applicant_id) {
                    $appids[] = $applicant_id->course_id;
                }
            }

            $model->whereIn('id', $appids);
        }
        if (isset($dataArray['name'])) {
            $model->where('name_ar', 'Like', '%' . $dataArray['name'] . '%');
        }
        if (isset($dataArray['location'])) {
            $model->where('location', 'Like', '%' . $dataArray['location'] . '%');
        }
        if (isset($dataArray['type']) && count($dataArray['type']) > 1) {
            $model->whereIn('type_id', $dataArray['type']);
        }
        if (isset($dataArray['natural'])) {
            $model->whereIn('natural_id', $dataArray['natural']);
        }
        if (isset($dataArray['field'])) {
            $model->whereIn('field_id', $dataArray['field']);
        }
        if (isset($dataArray['trainee'])) {
            $model->where('trainees', 'like', '%"' . $dataArray['trainee'] . '"%');
        }

        if (isset($dataArray['organization'])) {
            $model->whereIn('organization_id', $dataArray['organization']);
        }
        if (isset($dataArray['per_cost_from'])) {
            if (isset($dataArray['per_cost_to'])) {
                $model->whereBetween('cost', [$dataArray['per_cost_from'], $dataArray['per_cost_to']]);
            } else {
                $model->where('cost', '>=', $dataArray['per_cost_from']);
            }
        }
        if (isset($dataArray['app_from'])) {
            if (isset($dataArray['app_to'])) {
                $model->has('applications', '>=', $dataArray['app_from'])->has('applications', '<=', $dataArray['app_to']);
            } else {
                $model->has('applications', '>=', $dataArray['app_from']);
            }
        }
        if (isset($dataArray['appfem_from'])) {
            $fromA = $dataArray['appfem_from'];
            if (isset($dataArray['appfem_to'])) {
                $TA = $dataArray['appfem_to'];
                $model->whereHas('applications', function ($query) use ($fromA, $TA) {
                    $query->where('gender', 'female')->select(DB::raw('COUNT(*) as countApp'))->having('countApp', '>=', $fromA)->having('countApp', '<=', $TA);
                });
            } else {
                $model->whereHas('applications', function ($query) use ($fromA) {
                    $query->where('gender', 'female')->select(DB::raw('COUNT(*) as countApp'))->having('countApp', '>=', $fromA);
                });
            }
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

        $courses = $model->orderBy('start_date', 'asc')->get();
        $ids = [];
        foreach ($courses as $course) {
            $ids[] = $course->id;
        }
        $print_choices = $request->input('print_choices');

        if (! isset($request->courses)) {
            if ($request->submit == 'export') {

                return (new ExportCourse($ids, $this->view))->download('courses.xlsx');
            }
            if ($request->submit == 'print') {
                if (empty($print_choices) || !is_array($print_choices)) {
                    flash(awtTrans('يجب اختيار خانه واحده علي الاقل'))->error();
                    return redirect(route($this->route . '.index'));
                }

                return view($this->view . '.print', [
                    'data' => $courses,
                    'print' => 'true',
                    'title' => $request->input('print_title'),
                    'print_choices' => $print_choices,  // Now it's always an array
                    'lang' => App::getLocale(),

                ]);
            }
            flash(trans('main.select_rows_to_delete'))->error();

            return redirect(route($this->route . '.index'));
        }

        if ($request->submit == 'delete') {

            $rows = $this->model::whereIn('id', $request->courses)->get();
            foreach ($rows as $row) {
                $row->delete();
            }
            flash(trans('main.rows_deleted_successfully'))->success();
        } elseif ($request->submit == 'export') {
            return (new ExportCourse($request->courses, $this->view))->download('courses.xlsx');
            // ProcessCourseExport::dispatch(
            //     $request->courses,
            //     $this->view
            // );
        } elseif ($request->submit == 'print') {
            // $data = $this->model->whereIn('id',$request->courses)->get();
            $print_choices = ['name_en', 'type_id', 'organization_id', 'start_date', 'end_date', 'inv_countries', 'countries', 'total_app', 'total_app_fem'];
            if (empty($print_choices) || !is_array($print_choices)) {
                flash(awtTrans('يجب اختيار خانه واحده علي الاقل'))->error();
                return redirect(route($this->route . '.index'));
            }
            return view($this->view . '.print_single', [
                'data' => Course::whereIn('id', $request->courses)->orderBy('start_date', 'asc')->get(),
                'print' => 'true',
                'title' => $request->input('print_title'),
                'print_choices' => $print_choices,  // Now it's always an array
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
        $model = $this->model::query();
        if (isset($dataArray['country'])) {
            $applicants = Application::where('nationality', $dataArray['country'])->get();
            $applicants = $applicants->groupBy('course_id');
            $ids = [];
            foreach ($applicants as $applicant) {
                foreach ($applicant as $applicant_id) {
                    $ids[] = $applicant_id->course_id;
                }
            }
            $model = Course::whereIn('id', $ids);
        }
        if (isset($dataArray['name'])) {
            $model->where('name_ar', 'Like', '%' . $dataArray['name'] . '%');
        }
        if (isset($dataArray['location'])) {
            $model->where('location', 'Like', '%' . $dataArray['location'] . '%');
        }
        if (isset($dataArray['type'])) {
            $model->whereIn('type_id', $dataArray['type']);
        }

        if (isset($dataArray['natural'])) {
            $model->whereIn('natural_id', $dataArray['natural']);
        }
        if (isset($dataArray['field'])) {
            $model->whereIn('field_id', $dataArray['field']);
        }
        if (isset($dataArray['trainee'])) {
            $model->where('trainees', 'like', '%"' . $dataArray['trainee'] . '"%');
        }

        if (isset($dataArray['organization'])) {
            $model->whereIn('organization_id', $dataArray['organization']);
        }
        if (isset($dataArray['per_cost_from'])) {
            if (isset($dataArray['per_cost_to'])) {
                $model->whereBetween('cost', [$dataArray['per_cost_from'], $dataArray['per_cost_to']]);
            } else {
                $model->where('cost', '>=', $dataArray['per_cost_from']);
            }
        }
        if (isset($dataArray['app_from'])) {
            if (isset($dataArray['app_to'])) {
                $model->has('applications', '>=', $dataArray['app_from'])->has('applications', '<=', $dataArray['app_to']);
            } else {
                $model->has('applications', '>=', $dataArray['app_from']);
            }
        }
        if (isset($dataArray['appfem_from'])) {
            $fromA = $dataArray['appfem_from'];
            if (isset($dataArray['appfem_to'])) {
                $TA = $dataArray['appfem_to'];
                $model->whereHas('applications', function ($query) use ($fromA, $TA) {
                    $query->where('gender', 'female')->select(DB::raw('COUNT(*) as countApp'))->having('countApp', '>=', $fromA)->having('countApp', '<=', $TA);
                });
            } else {
                $model->whereHas('applications', function ($query) use ($fromA) {
                    $query->where('gender', 'female')->select(DB::raw('COUNT(*) as countApp'))->having('countApp', '>=', $fromA);
                });
            }
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
            ->editColumn('chk', function ($model) {
                return '<input type="checkbox" name="courses[]" value="' . $model->id . '" class="iCheck-square chk-item">';
            })
            ->editColumn('type', function ($model) {
                if (! empty($model->natural->name_ar)) {
                    return $model->natural->name_ar;
                } else {
                    return 'فارغ';
                }
            })
            ->editColumn('is_active', function ($model) {
                return $model->is_active ? '<span class="badge bg-success">' . awtTrans('نعم') . '</span>' : '<span class="badge bg-danger">' . awtTrans('لا') . '</span>';
            })
            ->editColumn('edit', function ($model) {
                return '<a href="' . route($this->route . '.edit', [$model->id]) . '">' . awtTrans('تعديل') . '</a>';
            })
            ->editColumn('name_ar', function ($model) {
                return '<a href="' . route($this->route . '.show', [$model->id]) . '">' . $model->name_ar . '</a>';
            })
            ->editColumn('organization', function ($model) {
                if (! empty($model->organization->name)) {
                    return $model->organization->name;
                } else {
                    return 'فارغ';
                }
            })
            ->editColumn('start_date', function ($model) {
                return $model->start_date->format('Y-m-d');
            })
            ->editColumn('end_date', function ($model) {
                return $model->end_date->format('Y-m-d');
            })
            ->editColumn('total_app', function ($model) {
                return $model->applications()->where('wait_list', 'false')->count();
            })
            ->editColumn('total_app_fem', function ($model) {
                return $model->applications()->where('wait_list', 'false')->where('gender', 'female')->count();
            })
            ->editColumn('inv_countries', function ($model) {
                return '<a href="' . route($this->route . '.countries', ['c_id' => $model->id, 'inv' => true]) . '">' . count($model->applications->groupBy('nationality')) . '</a>';
            })->editColumn('countries', function ($model) {
                $array = unserialize($model->countries);
                $data = '<p>';
                foreach ($array as $item) {
                    $data .= getCountry($item) . '<br>';
                }
                $data .= '</p>';

                return '<a href="' . route($this->route . '.countries', ['c_id' => $model->id]) . '">' . count($array) . '</a>';
            })
            ->editColumn('trainees', function ($model) {
                $array = unserialize($model->trainees);
                foreach ($array as $item) {
                    $t = CourseTrianee::where('id', $item)->first();
                    if (! empty($t)) {
                        return $t->name_ar . '<br>';
                    }
                }
            })
            ->editColumn('assessments', function ($model) {

                return '<a href="' . route('assessments.index', ['course_id' => $model->id]) . '" class="btn btn-primary">' . trans('main.show_assessments', ['count' => $model->assessments->count()]) . '</a>';
            })
            ->rawColumns(['type', 'assessments', 'is_active', 'chk', 'trainees', 'countries', 'inv_countries', 'organization', 'name_ar', 'edit'])->make(true);
    }

    public function Countries()
    {
        $this->table = [
            ['name' => 'name', 'display' => awtTrans('الدولة'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'total_courses', 'display' => awtTrans('عدد الدورات'), 'data' => 'total_courses', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'total_apps', 'display' => awtTrans('إجمالي عدد المتدربين'), 'data' => 'total_apps', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'total_apps_fem', 'display' => awtTrans('عدد المتدربات'), 'data' => 'total_apps_fem', 'orderable' => 'true', 'searchable' => 'true'],
            // ['name' => 'cost', 'display' => awtTrans('التكلفة الإجمالية'), 'data' => 'cost', 'orderable' => 'true', 'searchable' => 'true'],
        ];
        $ajaxRequest = filterDatatableGet($_GET);

        if (isset($ajaxRequest['inv']) && $ajaxRequest['inv'] != null) {
            $this->table = [
                ['name' => 'name', 'display' => awtTrans('الدولة المشاركة'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ];
        }
        if (isset($ajaxRequest['cost']) && $ajaxRequest['cost'] == 'true') {
            $this->table = [
                ['name' => 'name', 'display' => awtTrans('الدولة'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
                ['name' => 'total_courses', 'display' => awtTrans('عدد الدورات'), 'data' => 'total_courses', 'orderable' => 'true', 'searchable' => 'true'],
                ['name' => 'total_apps', 'display' => awtTrans('إجمالي عدد المتدربين'), 'data' => 'total_apps', 'orderable' => 'true', 'searchable' => 'true'],
                ['name' => 'total_apps_fem', 'display' => awtTrans('عدد المتدربات'), 'data' => 'total_apps_fem', 'orderable' => 'true', 'searchable' => 'true'],
                ['name' => 'cost', 'display' => awtTrans('التكلفة الإجمالية'), 'data' => 'cost', 'orderable' => 'true', 'searchable' => 'true'],
            ];
        }
        $active = $this->active;
        $table_rows = $this->table;
        $route = $this->route;
        if (getRequest('c_id') != null) {
            $invited = true;
            $course = Course::where('id', getRequest('c_id'))->first();
            if (empty($course)) {
                return redirect(route($this->route . '.index'));
            }
            $ajaxRequest = filterDatatableGet($_GET);
            if (isset($ajaxRequest['inv']) && $ajaxRequest['inv'] != null) {

                return view($this->view . '.countries', compact('active', 'course', 'table_rows', 'route'));
            }

            return view($this->view . '.countries', compact('active', 'course', 'invited', 'table_rows', 'route'));
        }

        return view($this->view . '.countries', compact('active', 'table_rows', 'route'));
    }
    // public function CountriesAjax(DataTables $dataTables)
    // {
    //     $array = [];
    //     $model = $this->model::query();
    //     $course = $model->get();
    //     $ajaxRequest = filterDatatableGet($_GET);

    //     if (isset($ajaxRequest['inv']) && $ajaxRequest['inv'] != null) {
    //         $course = Course::where('id', getRequest('c_id'))->get();

    //         foreach ($course as $course) {
    //             // name only
    //             $countryArray = [];
    //             foreach ($course->applications as $application) {
    //                 if (isset($conAr[$application->nationality])) {
    //                     continue;
    //                 }
    //                 $countryCourse = 0;
    //                 $totalApp = 0;
    //                 $totalAppFem = 0;
    //                 $totalCost = 0;
    //                 $countryArray[$application->nationality]['name'] = getCountry($application->nationality);
    //                 $countryArray[$application->nationality]['total_courses'] = $countryCourse;
    //                 $countryArray[$application->nationality]['total_apps'] = $totalApp;
    //                 $countryArray[$application->nationality]['total_apps_fem'] = $totalAppFem;
    //                 $countryArray[$application->nationality]['cost'] = $totalCost;
    //                 $conAr[$application->nationality] = true;
    //             }
    //             foreach ($countryArray as $key => $value) {
    //                 $array[] = $value;
    //             }
    //         }
    //     } elseif (getRequest('c_id') != null && getRequest('inv') == null) {
    //         $course = Course::where('id', getRequest('c_id'))->first();
    //         $countries = unserialize($course->countries);

    //         // all fileds invited
    //         $countryArray = [];
    //         foreach ($countries as $key => $country) {

    //             $countryCourse = 0;
    //             $totalApp = Application::where('nationality', $country)->distinct('nationality')->count();
    //             $totalAppFem = 0;
    //             $totalCost = 0;
    //             $countryArray[$key]['name'] = getCountry($country);
    //             $countryArray[$key]['total_courses'] = Application::where('nationality', $country)->distinct('course_id')->count('course_id');
    //             $countryArray[$key]['total_apps'] = Application::where('nationality', $country)->distinct('nationality')->count();
    //             $countryArray[$key]['total_apps_fem'] = Application::where('nationality', $country)->where('gender', 'female')->distinct('nationality')->count();
    //             $countryArray[$key]['cost'] = $totalApp * $course->cost;
    //             $conAr[$key] = true;
    //         }
    //         foreach ($countryArray as $key => $value) {
    //             $array[] = $value;
    //         }
    //     } else {
    //         // all fields
    //         // $countries = DB::table('applications')->select('nationality')->distinct('nationality')->get();
    //         $countries = DB::table('applications')->join('courses', 'applications.course_id', '=', 'courses.id')->select('nationality')->distinct('nationality')->get();

    //         $courseAr = [];
    //         $countryCourse = 0;
    //         $totalApp = 0;
    //         $totalAppFem = 0;
    //         $totalCost = 0;
    //         $countryArray = [];
    //         foreach ($countries as $country) {

    //             if (isset($conAr[$country->nationality])) {
    //                 continue;
    //             }
    //             $applications = Application::has('course')->where('nationality', 'Like', '%'.$country->nationality.'%')->get();
    //             $totalAppFem = Application::where('nationality', 'Like', '%'.$country->nationality.'%')->where('gender', 'female')->count();
    //             $totalApp = $applications->count();
    //             $ids = [];
    //             foreach ($applications as $application) {
    //                 if (isset($application->course_id)) {
    //                     $ids[] = $application->course_id;

    //                     continue;
    //                 }

    //             }
    //             $countryCourse = count(array_unique($ids));
    //             $totalCost = $application->course->cost * $totalApp;
    //             $countryArray[$application->nationality]['name'] = getCountry($country->nationality);
    //             $countryArray[$application->nationality]['total_courses'] = $countryCourse;
    //             $countryArray[$application->nationality]['total_apps'] = $totalApp;
    //             $countryArray[$application->nationality]['total_apps_fem'] = $totalAppFem;
    //             $countryArray[$application->nationality]['cost'] = $totalCost;
    //             $conAr[$application->nationality] = true;
    //         }
    //         foreach ($countryArray as $key => $value) {
    //             $array[] = $value;
    //         }
    //     }
    //     $collection = collect($array);

    //     return $dataTables->collection($collection)->toJson();
    // }
    public function CountriesAjax(DataTables $dataTables)
    {
        $array = [];
        $conAr = [];
        $ajaxRequest = filterDatatableGet($_GET);

        // Eager load applications with course
        if (isset($ajaxRequest['inv']) && $ajaxRequest['inv'] !== null) {
            $course = Course::with('applications')->where('id', getRequest('c_id'))->get();

            foreach ($course as $courseItem) {
                $countryArray = [];

                foreach ($courseItem->applications as $application) {
                    $nationality = $application->nationality;

                    if (isset($conAr[$nationality])) {
                        continue;
                    }

                    $totalApps = $courseItem->applications->where('nationality', $nationality)->count();
                    $totalAppsFem = $courseItem->applications->where('nationality', $nationality)->where('gender', 'female')->count();

                    $countryArray[$nationality] = [
                        'name' => getCountry($nationality),
                        'total_courses' => 1,
                        'total_apps' => $totalApps,
                        'total_apps_fem' => $totalAppsFem,
                        'cost' => $totalApps * $courseItem->cost,
                    ];

                    $conAr[$nationality] = true;
                }

                $array = array_merge($array, array_values($countryArray));
            }
        } elseif (getRequest('c_id') !== null) {
            $course = Course::with('applications')->find(getRequest('c_id'));
            $countries = unserialize($course->countries);
            $countryArray = [];

            foreach ($countries as $country) {
                if (isset($conAr[$country])) {
                    continue;
                }

                $apps = $course->applications->where('nationality', $country);
                $totalApps = $apps->count();
                $totalAppsFem = $apps->where('gender', 'female')->count();
                $totalCourses = $apps->pluck('course_id')->unique()->count();

                $countryArray[$country] = [
                    'name' => getCountry($country),
                    'total_courses' => $totalCourses,
                    'total_apps' => $totalApps,
                    'total_apps_fem' => $totalAppsFem,
                    'cost' => $totalApps * $course->cost,
                ];

                $conAr[$country] = true;
            }

            $array = array_merge($array, array_values($countryArray));
        } else {
            $applications = Application::with('course')
                ->whereHas('course')
                ->get()
                ->groupBy('nationality');

            foreach ($applications as $nationality => $appsGroup) {
                if (isset($conAr[$nationality])) {
                    continue;
                }

                $totalApps = $appsGroup->count();
                $totalAppsFem = $appsGroup->where('gender', 'female')->count();
                $totalCourses = $appsGroup->pluck('course_id')->unique()->count();
                $costPerCourse = $appsGroup->first()?->course?->cost ?? 0;
                $totalCost = $totalApps * $costPerCourse;

                $array[] = [
                    'name' => getCountry($nationality),
                    'total_courses' => $totalCourses,
                    'total_apps' => $totalApps,
                    'total_apps_fem' => $totalAppsFem,
                    'cost' => $totalCost,
                ];

                $conAr[$nationality] = true;
            }
        }

        $collection = collect($array);
        return $dataTables->collection($collection)->toJson();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function CountriesAction()
    // {
    //     $array = [];
    //     $model = $this->model::query();
    //     $course = $model->get();
    //     $ajaxRequest = filterDatatableGet($_GET);

    //     if (isset($ajaxRequest['inv']) && $ajaxRequest['inv'] != null) {
    //         $course = Course::where('id', getRequest('c_id'))->get();

    //         foreach ($course as $course) {
    //             // name only
    //             $countryArray = [];
    //             foreach ($course->applications as $application) {
    //                 if (isset($conAr[$application->nationality])) {
    //                     continue;
    //                 }
    //                 $countryCourse = 0;
    //                 $totalApp = 0;
    //                 $totalAppFem = 0;
    //                 $totalCost = 0;
    //                 $countryArray[$application->nationality]['name'] = getCountry($application->nationality);
    //                 $countryArray[$application->nationality]['total_courses'] = $countryCourse;
    //                 $countryArray[$application->nationality]['total_apps'] = $totalApp;
    //                 $countryArray[$application->nationality]['total_apps_fem'] = $totalAppFem;
    //                 $countryArray[$application->nationality]['cost'] = $totalCost;
    //                 $conAr[$application->nationality] = true;
    //             }
    //             foreach ($countryArray as $key => $value) {
    //                 $array[] = $value;
    //             }
    //         }
    //     } elseif (getRequest('c_id') != null && getRequest('inv') == null) {
    //         $course = Course::where('id', getRequest('c_id'))->first();
    //         $countries = unserialize($course->countries);

    //         // all fileds invited
    //         $countryArray = [];
    //         foreach ($countries as $key => $country) {

    //             $countryCourse = 0;
    //             $totalApp = Application::where('nationality', $country)->distinct('nationality')->count();
    //             $totalAppFem = 0;
    //             $totalCost = 0;
    //             $countryArray[$key]['name'] = getCountry($country);
    //             $countryArray[$key]['total_courses'] = Application::where('nationality', $country)->distinct('course_id')->count('course_id');
    //             $countryArray[$key]['total_apps'] = Application::where('nationality', $country)->distinct('nationality')->count();
    //             $countryArray[$key]['total_apps_fem'] = Application::where('nationality', $country)->where('gender', 'female')->distinct('nationality')->count();
    //             $countryArray[$key]['cost'] = $totalApp * $course->cost;
    //             $conAr[$key] = true;
    //         }
    //         foreach ($countryArray as $key => $value) {
    //             $array[] = $value;
    //         }
    //     } else {
    //         // all fields
    //         $countries = DB::table('applications')->select('nationality')->distinct('nationality')->get();

    //         $courseAr = [];
    //         $countryCourse = 0;
    //         $totalApp = 0;
    //         $totalAppFem = 0;
    //         $totalCost = 0;
    //         $countryArray = [];
    //         foreach ($countries as $country) {
    //             if (isset($conAr[$country->nationality])) {
    //                 continue;
    //             }
    //             $applications = Application::where('nationality', 'Like', '%'.$country->nationality.'%')->get();
    //             $totalAppFem = Application::where('nationality', 'Like', '%'.$country->nationality.'%')->where('gender', 'female')->count();
    //             $totalApp = $applications->count();
    //             $ids = [];
    //             foreach ($applications as $application) {
    //                 if (isset($application->course_id)) {
    //                     $ids[] = $application->course_id;

    //                     continue;
    //                 }
    //             }
    //             $countryCourse = count(array_unique($ids));
    //             $totalCost = $application->course ? $application->course->cost * $totalApp : 0;
    //             $countryArray[$application->nationality]['name'] = getCountry($country->nationality);
    //             $countryArray[$application->nationality]['total_courses'] = $countryCourse;
    //             $countryArray[$application->nationality]['total_apps'] = $totalApp;
    //             $countryArray[$application->nationality]['total_apps_fem'] = $totalAppFem;
    //             $countryArray[$application->nationality]['cost'] = $totalCost;
    //             $conAr[$application->nationality] = true;
    //         }
    //         foreach ($countryArray as $key => $value) {
    //             $array[] = $value;
    //         }
    //     }

    //     $request = request();

    //     if ($request->submit == 'export') {
    //         if (isset($ajaxRequest['inv']) && $ajaxRequest['inv'] != null) {
    //             return (new ExportCountries([], $this->view, true))->download('countries.xlsx');
    //         }

    //         return (new ExportCountries([], $this->view))->download('countries.xlsx');
    //     } elseif ($request->submit == 'print') {
    //         $ajaxRequest = filterDatatableGet($_GET);

    //         if (isset($ajaxRequest['inv']) && $ajaxRequest['inv'] != null) {
    //             return view($this->view.'.countryPrint', [
    //                 'data' => $array,
    //                 'print' => 'true',
    //                 'inv' => true,
    //                 'lang' => App::getLocale(),
    //                 'cost' => getRequest('cost'),

    //             ]);

    //         }

    //         return view($this->view.'.countryPrint', [
    //             'data' => $array,
    //             'print' => 'true',
    //             'inv' => false,
    //             'lang' => App::getLocale(),
    //             'cost' => getRequest('cost'),

    //         ]);
    //     }

    //     return redirect(route($this->route.'.index'));
    // }

    //enhance performance using eager loading

    public function CountriesAction()
    {
        $array = [];
        $conAr = [];
        $ajaxRequest = filterDatatableGet($_GET);
        $request = request();

        if (isset($ajaxRequest['inv']) && $ajaxRequest['inv'] !== null) {
            $courses = Course::with('applications')->where('id', getRequest('c_id'))->get();

            foreach ($courses as $course) {
                $countryApps = $course->applications->groupBy('nationality');

                foreach ($countryApps as $nationality => $apps) {
                    if (isset($conAr[$nationality])) continue;

                    $array[] = [
                        'name' => getCountry($nationality),
                        'total_courses' => 1,
                        'total_apps' => $apps->count(),
                        'total_apps_fem' => $apps->where('gender', 'female')->count(),
                        'cost' => $apps->count() * $course->cost,
                    ];

                    $conAr[$nationality] = true;
                }
            }
        } elseif (getRequest('c_id') !== null && getRequest('inv') === null) {
            $course = Course::with('applications')->find(getRequest('c_id'));

            if ($course && $course->countries) {
                $countries = unserialize($course->countries);
                $apps = $course->applications->groupBy('nationality');

                foreach ($countries as $country) {
                    if (isset($conAr[$country])) continue;

                    $filteredApps = $apps->get($country, collect());

                    $array[] = [
                        'name' => getCountry($country),
                        'total_courses' => $filteredApps->pluck('course_id')->unique()->count(),
                        'total_apps' => $filteredApps->count(),
                        'total_apps_fem' => $filteredApps->where('gender', 'female')->count(),
                        'cost' => $filteredApps->count() * $course->cost,
                    ];

                    $conAr[$country] = true;
                }
            }
        } else {
            $applications = Application::with('course')
                ->whereHas('course')
                ->get()
                ->groupBy('nationality');

            foreach ($applications as $nationality => $apps) {
                if (isset($conAr[$nationality])) continue;

                $totalApps = $apps->count();
                $totalAppsFem = $apps->where('gender', 'female')->count();
                $courseIds = $apps->pluck('course_id')->unique();
                $firstCourse = $apps->first()?->course;
                $cost = $firstCourse ? $firstCourse->cost * $totalApps : 0;

                $array[] = [
                    'name' => getCountry($nationality),
                    'total_courses' => $courseIds->count(),
                    'total_apps' => $totalApps,
                    'total_apps_fem' => $totalAppsFem,
                    'cost' => $cost,
                ];

                $conAr[$nationality] = true;
            }
        }

        // EXPORT
        if ($request->submit === 'export') {
            $inv = isset($ajaxRequest['inv']) && $ajaxRequest['inv'] !== null;
            return (new ExportCountries([], $this->view, $inv))->download('countries.xlsx');
        }

        // PRINT
        if ($request->submit === 'print') {
            return view($this->view . '.countryPrint', [
                'data' => $array,
                'print' => 'true',
                'inv' => isset($ajaxRequest['inv']) && $ajaxRequest['inv'] !== null,
                'lang' => App::getLocale(),
                'cost' => getRequest('cost'),
            ]);
        }

        return redirect(route($this->route . '.index'));
    }

    public function printQrCode($id)
    {
        $model = $this->model::find($id);
        $lang = App::getLocale();
        $qrCode = QrCode::size(300)
            ->color(255, 0, 0)
            ->generate('https://dev-fe-eapd.atwdemo.com/whatWeDo/capacityBuilding/1');
        return view('courses.print_qr', compact('model', 'lang', 'qrCode'));
    }
}
