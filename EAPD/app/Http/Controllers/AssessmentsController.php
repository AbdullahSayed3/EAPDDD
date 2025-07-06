<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Course;
use App\Exports\AssessmentExport;
use App\Forms\CourseForm;
use App\Http\MyExcel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class AssessmentsController extends Controller
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
        $this->middleware('can:show_assessment')->only(['index', 'show']);
        $this->middleware('can:create_assessment')->only(['create', 'store']);
        $this->middleware('can:edit_assessment')->only(['edit', 'update']);
        $this->middleware('can:delete_assessment')->only(['delete']);
        $this->active = 'courses';
        $this->view = 'assessments';
        $this->route = 'assessments';
        $this->form = CourseForm::class;
        $this->model = Assessment::class;
        $this->title = 'assessments';
        $this->keys = [
            'name',
            'country',
            'job',
            'form',

        ];
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'name', 'display' => trans('main.trainee_name'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'country', 'display' => trans('main.country'), 'data' => 'country', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'course_name', 'display' => trans('main.course_name'), 'data' => 'course_name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'job', 'display' => trans('main.job'), 'data' => 'job', 'orderable' => 'true', 'searchable' => 'true'],
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
            ['name' => 'name', 'display' => trans('main.trainee_name'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'country', 'display' => trans('main.country'), 'data' => 'country', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'course_name', 'display' => trans('main.course_name'), 'data' => 'course_name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'job', 'display' => trans('main.job'), 'data' => 'job', 'orderable' => 'true', 'searchable' => 'true'],
        ];
        $active = $this->active;
        $table_rows = $this->table;
        $route = $this->route;

        if (isset($_GET['course_id'])) {
            $course = Course::find($_GET['course_id']);
            if (empty($course)) {
                return view($this->view . '.index', compact('active', 'table_rows', 'route'));

            } else {
                return view($this->view . '.index', compact('active', 'table_rows', 'route', 'course'));

            }
        } else {

            return view($this->view . '.index', compact('active', 'table_rows', 'route'));
        }

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

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $data = $request->only($this->keys);

        $data['application_code'] = 'check';
        $data['assessment_code'] = 'check';
        $model = $this->model::create($data);
        flash('Value Added Successfully')->success();

        return redirect(route($this->route . '.create'));

        // Do saving and other things...
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, FormBuilder $formBuilder)
    {

        $model = $this->model::find($id);
        // dd($model); 
        if (empty($model)) {
            flash('Can`t find this value')->error();
            return redirect(route($this->route . '.index'));
        }

        //        $form = $formBuilder->create($this->form, [
        //            'method' => 'PUT',
        //            'model' => $model->toArray(),                              // Not passed to view, just used in form class
        //            'url' => route($this->route . '.update', ['id' => $model['id']])
        //        ], ['id' => $model->id]);

        if ($this->isSerialized($model->assessment)) {
            $model->assessment = unserialize($model->assessment);
        } else {
            // Check if it’s JSON encoded, and decode if so.
            $model->assessment = json_decode($model->assessment, true);
        }
        $form_title = $this->title;
        $active = $this->active;
        $route = $this->route;
        // return $model;
        // $model->assessment = unserialize($model->assessment);
        $course = $model->course;
       
        return view('assessments.show', compact('model', 'course', 'form_title', 'active', 'route'));
    }

    private function isSerialized($data)
    {
        return ($data && is_string($data) && @unserialize($data) !== false);
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
        //
        //        $form = $formBuilder->create($this->form, [], ['id' => $model->id]);
        //
        //        if (!$form->isValid()) {
        //            return redirect()->back()->withErrors($form->getErrors())->withInput();
        //        }
        $request = request();
        $data = $request->only($this->keys);
        //        dd($data);
        $model->name = $data['name'];
        $model->country = $data['country'];
        $model->job = $data['job'];
        $model->assessment = serialize($data['form']);
        $model->save();
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

        $request = request();

        if ($request->submit == 'export') {
            return $this->export($request);
        }
        if (!isset($request->applicants)) {
            flash(trans('main.select_rows_to_delete'))->error();

            return redirect(route($this->route . '.index'));
        }

        $rows = $this->model::whereIn('id', $request->applicants)->get();
        foreach ($rows as $row) {
            $row->delete();

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

        if (isset($_GET['course_id'])) {
            $model = $this->model::where('course_id', $_GET['course_id']);

        } else {

            $model = $this->model::query();
        }

        return DataTables::of($model)->addColumn('action', function ($model) {

            $data = '<a href="' . route($this->route . '.show', [$model->id]) . '" style="    margin-right: 10px;" class="btn btn-sm btn-primary"><i class="vl_pencil"></i>' . trans('main.edit') . '</a>';

            return $data;
        })
            ->addColumn('chk', function ($model) {
                return '<input type="checkbox" name="applicants[]" value="' . $model->id . '" class="iCheck-square chk-item">';

            })
            ->addColumn('course_name', function ($model) {

                return optional($model->course)->name();

                //                name
                // country
                // course_name
                // trainee_status
                // date
            })

            ->addColumn('country', function ($model) {

                // return getCountry($model->country);
                return $model->country;
            })
            ->addColumn('name', function ($model) {

                $name = $model->name;

                return '<a href="' . route($this->route . '.show', [$model->id]) . '">' . $name . '</a>';

            })
            ->addColumn('date', function ($model) {

                return $model->created_at->format('Y-m-d');
            })->addColumn('exported', function ($model) {

                return $model->export_status;
            })
            ->rawColumns(['action', 'chk', 'name', 'country', 'course_name', 'trainee_status', 'date'])->make(true);
    }

    public function export($request)
    {
        $ids = $request->applicants;

        if (is_null($ids)) {

            $data = Assessment::get();
            $ids = [];
            foreach ($data as $row) {
                $ids[] = $row->id;
            }
            if (count($ids) == 0) {
                flash(trans('main.no_applicants'))->success();

                return redirect()->back();
            }
        }

        //        $applications=Assessment::whereIn('id',$ids)->get();
        return (new AssessmentExport($ids, $this->view))->download('assessments.xlsx');

        return (new AssessmentExport($ids))->download('assessments.xlsx');

    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function import(): RedirectResponse
    {
        $request = \request();
        if ($request->hasFile('zip_file')) {

            $file = $request->zip_file;
            $zip = $file;
            $ext = $zip->getClientOriginalExtension();
            if ($ext != 'xlsx') {
                flash(awtTrans('يجب ان يكون الملف بصيغه xlsx'))->error();

                return redirect(route($this->route . '.index'));
            }

            $exFile = $file;
            $handle = fopen($exFile, 'r');
            $excel = new MyExcel($exFile);

            $data = $excel->toArray();

            foreach ($data as $row) {
                unset($row['id'], $row['export_status']);

                // if (!isset($row['course_id'])) {
                //     continue; // or log this row if needed
                // }
                $checkCourse = Course::where('id', $row['course_id'])->first();
                if (!empty($checkCourse)) {

                    if (isset($row['assessment']) && is_array($row['assessment'])) {
                        $row['assessment'] = json_encode($row['assessment']);
                    }
                    Assessment::create($row);
                }

            }
            flash(awtTrans('تم رفع البيانات بنجاح'))->success();

            return redirect(route($this->route . '.index'));

        } else {
            flash(awtTrans('الملف المضغوط للمتدريب مطلوب'))->error();

            return redirect(route($this->route . '.index'));
        }

    }
}
