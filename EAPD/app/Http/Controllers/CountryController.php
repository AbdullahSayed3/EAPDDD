<?php

namespace App\Http\Controllers;

use App\Exports\CountryExport;
use App\Models\Application;
use App\Models\Country;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class CountryController extends Controller
{
    //
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
    public function __construct(Country $model)
    {

        $this->middleware('can:show_country')->only(['index', 'show']);
        $this->middleware('can:create_country')->only(['create', 'store']);
        $this->middleware('can:edit_country')->only(['edit', 'update']);
        $this->middleware('can:delete_country')->only(['delete']);

        $this->active = 'الدول';
        $this->view = 'countries.';
        $this->route = 'countries';
        $this->form = \App\Forms\CountryForm::class;

        $this->model = $model;
        $this->title = 'countries';
        $this->keys = [
            'name_ar',
            'name_en',
            'name_fr',
            'lat',
            'lng'
        ];
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'name_en', 'display' => App::getLocale() == 'en' ? 'Name in English' : 'الاسم بالانجليزي', 'data' => 'name_en', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'name_ar', 'display' => App::getLocale() == 'en' ? 'Name in Arabic' : 'الاسم عربي', 'data' => 'name_ar', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'name_fr', 'display' => App::getLocale() == 'en' ? 'Name in Franch' : 'الاسم بالفرنسية', 'data' => 'name_fr', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'num_of_traniess', 'display' => trans('awt.    إجمالي عدد المتدربين'), 'data' => 'num_of_traniess', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'num_of_courses', 'display' => trans('awt.اجمالي الدورات'), 'data' => 'num_of_courses', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'num_of_traniess_male', 'display' => trans('awt.عدد المتدربين الذكور'), 'data' => 'num_of_traniess_male', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'num_of_traniess_female', 'display' => trans('awt.عدد المتدربين الاناث'), 'data' => 'num_of_traniess_female', 'orderable' => 'true', 'searchable' => 'true'],

            ['name' => 'lat', 'display' => 'LAT', 'data' => 'lat', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'lat', 'display' => 'LNG', 'data' => 'lng', 'orderable' => 'true', 'searchable' => 'true'],
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
        $data['code'] = substr($data['name_en'], 0, 3);
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

            return DataTables::of($model)
                ->addColumn('action', function ($model) {
                    $data = '<a href="' . route($this->route . '.edit', [$model->id]) . '" style="    margin-right: 10px;" class="btn btn-sm btn-primary"><i class="vl_pencil"></i>' . trans('main.edit') . '</a>';
                    $data .= '<a data-delete-url="' . route($this->route . '.delete', [$model->id]) . '" style="    margin-right: 10px;" class="btn btn-sm btn-danger delete-row text-white"><i class="vl_recycle-bin"></i>' . trans('main.delete') . '</a>';

                    return $data;
                })
                ->addColumn('num_of_courses', function ($model) {
                    return Course::where('countries', 'like', '%' . $model->code . '%')->count();
                })
                ->addColumn('num_of_traniess', function ($model) {
                    return Application::where('nationality', $model->code)->count();
                })
                ->addColumn('num_of_traniess_male', function ($model) {
                    return Application::where('nationality', $model->code)->where('gender', 'male')->count();
                })

                ->addColumn('num_of_traniess_female', function ($model) {
                    return Application::where('nationality', $model->code)->where('gender', 'female')->count();
                })
                ->editColumn('chk', function ($model) {
                    return '<input type="checkbox" name="countries[]" value="' . $model->id . '" class="iCheck-square chk-item">';
                })
                ->rawColumns(['chk', 'action', 'num_of_courses', 'num_of_traniess', 'num_of_traniess_male', 'num_of_traniess_female'])->make(true);
        }
    }

    public function countryAction(Request $request)
    {
        // return $request->all();

        if ($request->submit === 'export') {
            return (new CountryExport($this->view, $request->countries ?? 0))->download('countries.xlsx');
        }

        // PRINT
        if ($request->submit === 'print') {
            if (isset($request->countries)) {
                $data = Country::withCount(['application', 'maleApplications', 'femaleApplications'])
                    ->whereIn('id', $request->countries)->latest()->get();
            } else {
                $data = Country::withCount(['application', 'maleApplications', 'femaleApplications'])->latest()->get();
            }

            return view($this->view . '.print', [
                'data' => $data,
                'print' => 'true',
                'inv' => isset($ajaxRequest['inv']) && $ajaxRequest['inv'] !== null,
                'lang' => App::getLocale(),
            ]);
        }
    }
}
