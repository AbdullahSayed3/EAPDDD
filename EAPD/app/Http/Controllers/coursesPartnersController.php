<?php

namespace App\Http\Controllers;

use App\Exports\ExportPartner;
use App\Forms\CoursePartnerForm;
use App\Http\Controllers\Traits\UploadTrait;
use App\Models\CoursePartner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class coursesPartnersController extends Controller
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
        $this->active = 'courses';
        $this->view = 'coursesPartners';
        $this->route = 'coursesPartners';
        $this->form = CoursePartnerForm::class;
        $this->model = CoursePartner::class;
        $this->title = 'coursesPartners';
        $this->keys = [
            'name',
            'name_en',
            'name_fr',
            'field_id',
            'partner_natural',
            'contact_name',
            'address',
            'address_en',
            'address_fr',
            'contact_phone',
            'contact_email',
            'documents',
            'notes',

        ];
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'name', 'display' => awtTrans('اسم المركز / الشريك'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'total_courses', 'display' => awtTrans('عدد الدورات'), 'data' => 'total_courses', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'total_application', 'display' => awtTrans('	إجمالي عدد المتدربين'), 'data' => 'total_application', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'course_name', 'display' => awtTrans('اسم اخر دورة	'), 'data' => 'course_name', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'course_date', 'display' => awtTrans('تاريخ اخر دورة	'), 'data' => 'course_date', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'edit', 'display' => awtTrans('تعديل'), 'data' => 'edit', 'orderable' => 'false', 'searchable' => 'false'],
        ];
        $this->wrapper_class = 'form-group';

        $this->middleware('can:show_course_partners')->only(['index', 'show']);
        $this->middleware('can:create_course_partners')->only(['create', 'store']);
        $this->middleware('can:edit_course_partners')->only(['edit', 'update']);
        $this->middleware('can:delete_course_partners')->only(['delete']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'name', 'display' => awtTrans('اسم المركز / الشريك'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'total_courses', 'display' => awtTrans('عدد الدورات'), 'data' => 'total_courses', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'total_application', 'display' => awtTrans('إجمالي عدد المتدربين'), 'data' => 'total_application', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'course_name', 'display' => awtTrans('اسم اخر دورة'), 'data' => 'course_name', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'course_date', 'display' => awtTrans('تاريخ اخر دورة'), 'data' => 'course_date', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'edit', 'display' => awtTrans('تعديل'), 'data' => 'edit', 'orderable' => 'false', 'searchable' => 'false'],
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
        } else {
            //            flash(awtTrans("Documents Are Required"))->error();
            //            return redirect(route($this->route . '.create'))->withInput();
        }

        $participants = explode("\n", $request->participants);

        $data = $request->only($this->keys);

        $data['documents'] = serialize($files);
        $data['trainees'] = serialize($request->trainees);
        $data['countries'] = serialize($request->countries);
        $data['name_en'] = serialize($request->name_ar);
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
            'url' => route($this->route.'.update', [$model['id']]),
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
        $model->trainees = unserialize($model->trainees);
        $model->countries = unserialize($model->countries);

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

        $form = $formBuilder->create($this->form, [], [$model->id]);

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

        $data = $request->only($this->keys);

        $data['documents'] = serialize($files);
        $data['trainees'] = serialize($request->trainees);
        $data['countries'] = serialize($request->countries);
        $data['name_en'] = serialize($request->name_ar);

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

                return (new ExportPartner([], $this->view))->download('courses_partners.xlsx');
            }
            if ($request->submit == 'print') {
                return view($this->view.'.print', [
                    'data' => CoursePartner::all(),
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
            return (new ExportPartner($request->courses, $this->view))->download('courses_partners.xlsx');
        } elseif ($request->submit == 'print') {
            return view($this->view.'.print', [
                'data' => CoursePartner::whereIn('id', $request->courses)->get(),
                'print' => 'true',
                'lang' => App::getLocale(),

            ]);
        }

        return redirect(route($this->route.'.index'));
    }

    /*
     * Countries Datatable
     *
     *
     */
    public function datatable()
{
    //optimize performance using eager loading
    $model = $this->model::with([
        'courses' => function ($q) { // Adjust columns based on what's used,
            $q->withCount('applications');
        }
    ])->select('id', 'name');

    return DataTables::of($model)
        ->editColumn('chk', fn($model) =>
            '<input type="checkbox" name="courses[]" value="'.$model->id.'" class="iCheck-square chk-item">'
        )
        ->editColumn('name', fn($model) =>
            '<a href="'.route($this->route.'.show', [$model->id]).'">'.$model->name.'</a>'
        )
        ->editColumn('total_courses', fn($model) =>
            $model->courses->count()
        )
        ->editColumn('total_application', fn($model) =>
            $model->courses->sum('applications_count')
        )
        ->editColumn('edit', fn($model) =>
            '<a href="'.route($this->route.'.edit', [$model->id]).'">'.awtTrans('تعديل').'</a>'
        )
        ->editColumn('course_name', function ($model) {
            $last = $model->courses->sortByDesc('start_date')->first();
            return $last
                ? '<a href="/courses/'.$last->id.'">'.$last->name_ar.'</a>'
                : '-';
        })
        ->editColumn('course_date', function ($model) {
            $last = $model->courses->sortByDesc('start_date')->first();
            return $last
                ? $last->start_date->format('Y-m-d')
                : '-';
        })
        ->rawColumns(['type', 'chk', 'trainees', 'countries', 'course_name', 'name', 'edit'])
        ->make(true);
}

}
