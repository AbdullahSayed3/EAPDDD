<?php

namespace App\Http\Controllers;

use App\Exports\ExportExpert;
use App\Forms\ExpertForm;
use App\Http\Controllers\Traits\UploadTrait;
use App\Http\MyExcel;
use App\Models\Expert;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class ExpertsController extends Controller
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

        $this->middleware('can:show_events')->only(['index', 'show']);
        $this->middleware('can:create_events')->only(['create', 'store']);
        $this->middleware('can:edit_events')->only(['edit', 'update']);
        $this->middleware('can:delete_events')->only(['delete']);

        $this->active = 'experts';
        $this->view = 'experts';
        $this->route = 'experts';
        $this->form = ExpertForm::class;
        $this->model = Expert::class;
        $this->title = 'experts';
        $this->keys = [
            'name',
            'country',
            'specialist',
            'sub_specialist',
            'qualification',
            'certifications',
            'gender',
            'personal_picture',
            'passport_number',
            'passport_photos',
            'languages',
            'current_employer',
            'employer_address',
            'employer_phone',
            'employer_email',
            'old_contracts',
            'cv',
            'phone',
            'email',
            'status',
            'contract_rules',
            'delegate_country',
            'delegate_org',
            'contract_date',
            'end_date',
            'acceptation_info',
            'cost',
            'notes',
        ];
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'country', 'display' => awtTrans('الدولة'), 'data' => 'country', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'name', 'display' => awtTrans('الاسم'), 'data' => 'name', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'specialist', 'display' => awtTrans('التخصص'), 'data' => 'specialist', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'status', 'status' => awtTrans('حالة الخبير'), 'data' => 'status', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'contract_date', 'display' => awtTrans('بداية التعاقد'), 'data' => 'contract_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'end_date', 'display' => awtTrans('نهاية التعاقد'), 'data' => 'end_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'passport_number', 'display' => awtTrans('رقم جواز السفر'), 'data' => 'passport_number', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'delegate_org', 'display' => awtTrans('الجهه الموفد اليها'), 'data' => 'delegate_org', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'notes', 'display' => awtTrans('ملاحظات'), 'data' => 'notes', 'orderable' => 'true', 'searchable' => 'true'],
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
            ['name' => 'country', 'display' => awtTrans('الدولة'), 'data' => 'country', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'name', 'display' => awtTrans('الاسم'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'specialist', 'display' => awtTrans('التخصص'), 'data' => 'specialist', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'status', 'display' => awtTrans('حالة الخبير'), 'data' => 'status', 'orderable' => 'false', 'searchable' => 'false'],

            ['name' => 'contract_date', 'display' => awtTrans('بداية التعاقد'), 'data' => 'contract_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'end_date', 'display' => awtTrans('نهاية التعاقد'), 'data' => 'end_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'passport_number', 'display' => awtTrans('رقم جواز السفر'), 'data' => 'passport_number', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'delegate_org', 'display' => awtTrans('الجهه الموفد اليها'), 'data' => 'delegate_org', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'notes', 'display' => awtTrans('ملاحظات'), 'data' => 'notes', 'orderable' => 'true', 'searchable' => 'true'],
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
    public function store(FormBuilder $formBuilder): RedirectResponse
    {

        $form = $formBuilder->create($this->form);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();
        $certifications = [];

        if (isset($request->certifications)) {
            foreach ($request->certifications as $file) {
                $certifications[] = $this->uploadFile($file, 'experts');
            }
        } else {
            //            flash(awtTrans("Certifications Required"))->error();
            //            return redirect(route($this->route . '.create'))->withInput();
        }
        if ($request->end_date <= $request->contract_date) {
            flash('يجب ان يكون تاريخ بداية التعاقد سابق لتاريخ  نهاية التعاقد')->error();

            return redirect(route($this->route . '.create'))->withInput();
        }
        $passport_photos = [];

        if (isset($request->passport_photos)) {
            foreach ($request->passport_photos as $file) {
                $passport_photos[] = $this->uploadFile($file, 'experts');
            }
        } else {
            //            flash(awtTrans("passport photos Required"))->error();
            //            return redirect(route($this->route . '.create'))->withInput();
        }

        $contract_rules = [];

        if (isset($request->contract_rules)) {
            foreach ($request->contract_rules as $file) {
                $contract_rules[] = $this->uploadFile($file, 'experts');
            }
        } else {
            //            flash(awtTrans("contract rules Required"))->error();
            //            return redirect(route($this->route . '.create'))->withInput();
        }

        $acceptation_info = [];

        if (isset($request->acceptation_info)) {
            foreach ($request->acceptation_info as $file) {
                $acceptation_info[] = $this->uploadFile($file, 'experts');
            }
        } else {
            //            flash(awtTrans("contract rules Required"))->error();
            //            return redirect(route($this->route . '.create'))->withInput();
        }

        $personal_picture = null;

        if (isset($request->personal_picture)) {
            $personal_picture = $this->uploadFile($request->personal_picture, 'experts');
        } else {
            //            flash(awtTrans("personal picture Required"))->error();
            //            return redirect(route($this->route . '.create'))->withInput();
        }

        $cv = null;

        if (isset($request->cv_file)) {
            $cv = $this->uploadFile($request->cv_file, 'experts');
        } else {
            //            flash(awtTrans("cv file Required"))->error();
            //            return redirect(route($this->route . '.create'))->withInput();
        }

        $data = $request->only($this->keys);

        $phone_number = explode("\n", $request->phone_number);
        $languages = explode("\n", $request->user_languages);
        $employer_phone = explode("\n", $request->employer_phone);

        $data['phone'] = serialize($phone_number);
        $data['personal_picture'] = $personal_picture;
        $data['passport_photos'] = serialize($passport_photos);
        $data['certifications'] = serialize($certifications);
        $data['contract_rules'] = serialize($contract_rules);
        $data['acceptation_info'] = serialize($acceptation_info);
        $data['languages'] = serialize($languages);
        $data['employer_phone'] = serialize($employer_phone);
        $data['cv'] = $cv;
        if ($data['acceptation_info'] == null || ! isset($data['acceptation_info'])) {
            if (isset($data['contract_date'])) {
                $startDate = Carbon::parse($data['contract_date']);
                $endDate = Carbon::parse($data['end_date']);
                // add 4 year
                $expectEndDate = $startDate->addYears(4);
                if ($endDate->gt($expectEndDate)) {
                    flash(awtTrans('Invaild End Contract Date only 4 Years'))->error();

                    return redirect()->back();
                }
            }
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
            'url' => route($this->route . '.update', [$model->id]),
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
        $model->phone = implode("\n", unserialize($model->phone));
        $model->user_languages = implode("\n", unserialize($model->languages));
        $model->employer_phone = implode("\n", unserialize($model->employer_phone));

        $form = $formBuilder->create($this->form, [
            'method' => 'PUT',
            'model' => $model->toArray(),                              // Not passed to view, just used in form class
            'url' => route($this->route . '.update', [$model['id']]),
        ], ['id' => $model->id, 'edit' => true]);

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
    public function update(int $id, FormBuilder $formBuilder)
    {

        $model = $this->model::find($id);
        if (empty($model)) {
            flash('Can`t find this value')->error();

            return redirect(route($this->route . '.index'));
        }

        $form = $formBuilder->create($this->form, [], ['id' => $model->id, 'edit' => true]);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $request = request();

        $certifications = [];

        if (isset($request->certifications)) {
            foreach ($request->certifications as $file) {
                $certifications[] = $this->uploadFile($file, 'experts');
            }
        } else {
            $certifications = unserialize($model->certifications);
        }

        $passport_photos = [];

        if (isset($request->passport_photos)) {
            foreach ($request->passport_photos as $file) {
                $passport_photos[] = $this->uploadFile($file, 'experts');
            }
        } else {
            $passport_photos = unserialize($model->passport_photos);
        }

        $contract_rules = [];

        if (isset($request->contract_rules)) {
            foreach ($request->contract_rules as $file) {
                $contract_rules[] = $this->uploadFile($file, 'experts');
            }
        } else {
            $contract_rules = unserialize($model->contract_rules);
        }

        $acceptation_info = [];

        if (isset($request->acceptation_info)) {
            foreach ($request->acceptation_info as $file) {
                $acceptation_info[] = $this->uploadFile($file, 'experts');
            }
        } else {
            $acceptation_info = unserialize($model->acceptation_info);
        }

        $personal_picture = null;

        if (isset($request->personal_picture)) {
            $personal_picture = $this->uploadFile($request->personal_picture, 'experts');
        } else {
            $personal_picture = $model->personal_picture;
        }

        $cv = null;

        if (isset($request->cv_file)) {
            $cv = $this->uploadFile($request->cv_file, 'experts');
        } else {
            $cv = $model->cv;
        }

        $data = $request->only($this->keys);

        $phone_number = explode("\n", $request->phone);
        $languages = explode("\n", $request->user_languages);
        $employer_phone = explode("\n", $request->employer_phone);

        $data['phone'] = serialize($phone_number);
        $data['personal_picture'] = $personal_picture;
        $data['passport_photos'] = serialize($passport_photos);
        $data['certifications'] = serialize($certifications);
        $data['contract_rules'] = serialize($contract_rules);
        $data['acceptation_info'] = serialize($acceptation_info);
        $data['languages'] = serialize($languages);
        $data['employer_phone'] = serialize($employer_phone);
        $data['cv'] = $cv;

        if ($data['acceptation_info'] == null || ! isset($data['acceptation_info'])) {
            if (isset($data['contract_date'])) {
                $startDate = Carbon::parse($data['contract_date']);
                $endDate = Carbon::parse($data['end_date']);
                // add 4 year
                $expectEndDate = $startDate->addYears(4);
                if ($endDate->gt($expectEndDate)) {
                    flash(awtTrans('Invaild End Contract Date only 4 Years'))->error();

                    return redirect()->back();
                }
            }
        }

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

        $request = request();
        if (! isset($request->courses)) {
            if ($request->submit == 'export') {

                return (new ExportExpert([], $this->view))->download('experts.xlsx');
            }
            if ($request->submit == 'print') {
                return view($this->view . '.print', [
                    'data' => Expert::orderBy('contract_date', 'asc')->get(),
                    'print' => 'true',
                    'lang' => App::getLocale(),
                ]);
            }
            if ($request->submit == 'print2') {
                if ($request->input('print_choices') == null) {
                    flash(awtTrans('يجب اختيار خانه واحده علي الاقل'))->error();

                    return redirect(route($this->route . '.index'));
                }
                if (count($request->input('print_choices')) > 8) {
                    flash(awtTrans('يجب اخيتار 8 خانات كحد اقصي'))->error();

                    return redirect(route($this->route . '.index'));
                }

                return view($this->view . '.print2', [
                    'data' => Expert::orderBy('contract_date', 'asc')->get(),
                    'print' => 'true',
                    'lang' => App::getLocale(),
                    'print_choices' => $request->input('print_choices'),
                ]);
            }
            flash(trans('main.select_rows_to_delete'))->error();

            return redirect(route($this->route . '.index'));
        }

        if ($request->submit == 'delete') {

            $rows = $this->model::whereIn('id', $request->courses)->orderBy('contract_date', 'asc')->get();
            foreach ($rows as $row) {
                $row->delete();
            }
            flash(trans('main.rows_deleted_successfully'))->success();
        } elseif ($request->submit == 'export') {
            return (new ExportExpert($request->courses, $this->view))->download('experts.xlsx');
        } elseif ($request->submit == 'print2') {
            return view($this->view . '.print2', [
                'data' => Expert::whereIn('id', $request->courses)->orderBy('contract_date', 'asc')->get(),
                'print' => 'true',
                'lang' => App::getLocale(),
                'print_choices' => $request->input('print_choices'),

            ]);
        } elseif ($request->submit == 'print') {
            return view($this->view . '.print', [
                'data' => Expert::whereIn('id', $request->courses)->orderBy('contract_date', 'asc')->get(),
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

        $model = $this->model::query();

        if (isset($dataArray['country'])) {
            // Handle multiple countries (comma-separated value)
            if (strpos($dataArray['country'], ',') !== false) {
                $countries = explode(',', $dataArray['country']);
                $model->where(function ($query) use ($countries) {
                    foreach ($countries as $country) {
                        $query->orWhere('country', 'like', '%' . $country . '%');
                    }
                });
            } else {
                $model->where('country', 'like', '%' . $dataArray['country'] . '%');
            }
        }

        if (isset($dataArray['name'])) {
            $model->where('name', 'like', '%' . $dataArray['name'] . '%');
        }

        if (isset($dataArray['specialist'])) {
            $model->where('specialist', 'like', '%' . $dataArray['specialist'] . '%');
        }

        if (isset($dataArray['sub_specialist'])) {
            $model->where('sub_specialist', 'like', '%' . $dataArray['sub_specialist'] . '%');
        }

        if (isset($dataArray['qualification'])) {
            $model->where('qualification', 'like', '%' . $dataArray['qualification'] . '%');
        }

        if (isset($dataArray['gender'])) {
            $model->where('gender', 'like', '%' . $dataArray['gender'] . '%');
        }

        if (isset($dataArray['current_employer'])) {
            $model->where('current_employer', 'like', '%' . $dataArray['current_employer'] . '%');
        }

        if (isset($dataArray['phone'])) {
            $model->where('phone', 'like', '%' . $dataArray['phone'] . '%');
        }

        if (isset($dataArray['email'])) {
            $model->where('email', 'like', '%' . $dataArray['email'] . '%');
        }

        if (isset($dataArray['delegate_org'])) {
            $model->where('delegate_org', 'like', '%' . $dataArray['delegate_org'] . '%');
        }

        if (isset($dataArray['delegate_country'])) {
            // Handle multiple delegate countries (comma-separated value)
            if (strpos($dataArray['delegate_country'], ',') !== false) {
                $delegateCountries = explode(',', $dataArray['delegate_country']);
                $model->where(function ($query) use ($delegateCountries) {
                    foreach ($delegateCountries as $country) {
                        $query->orWhere('delegate_country', 'like', '%' . $country . '%');
                    }
                });
            } else {
                $model->where('delegate_country', 'like', '%' . $dataArray['delegate_country'] . '%');
            }
        }

        if (isset($dataArray['languages'])) {
            $model->where('languages', 'like', '%' . $dataArray['languages'] . '%');
        }

        if (isset($dataArray['status'])) {
            // Handle multiple status values (comma-separated value)
            if (strpos($dataArray['status'], ',') !== false) {
                $statuses = explode(',', $dataArray['status']);
                $model->where(function ($query) use ($statuses) {
                    foreach ($statuses as $status) {
                        $query->orWhere('status', 'like', '%' . $status . '%');
                    }
                });
            } else {
                $model->where('status', 'like', '%' . $dataArray['status'] . '%');
            }
        }

        if (isset($dataArray['delegOrg'])) {
            $model->where('delegate_org', 'like', '%' . $dataArray['delegOrg'] . '%');
        }

        if (isset($dataArray['contract_date'])) {
            $model->where('contract_date', '>=', $dataArray['contract_date']);
        }

        if (isset($dataArray['contract_from'])) {
            if (isset($dataArray['contract_to'])) {
                $model->whereBetween('contract_date', [$dataArray['contract_from'], $dataArray['contract_to']]);
            } else {
                $model->where('contract_date', '>=', $dataArray['contract_from']);
            }
        }

        if (isset($dataArray['cost_from'])) {
            if (isset($dataArray['cost_to'])) {
                $model->whereBetween('cost', [$dataArray['cost_from'], $dataArray['cost_to']]);
            } else {
                $model->where('cost', '>=', $dataArray['cost_from']);
            }
        }

        if (isset($dataArray['contract_end_from'])) {
            if (isset($dataArray['contract_to'])) {
                $model->whereBetween('end_date', [$dataArray['contract_end_from'], $dataArray['contract_end_to']]);
            } else {
                $model->where('end_date', '<=', $dataArray['contract_end_from']);
            }
        }

        if (isset($dataArray['end_date'])) {
            $model->where('end_date', '<=', $dataArray['end_date']);
        }

        return DataTables::of($model)
            ->editColumn('chk', function ($model) {
                return '<input type="checkbox" name="courses[]" value="' . $model->id . '" class="iCheck-square chk-item">';
            })
            ->editColumn('name', function ($model) {
                return '<a href="' . route($this->route . '.show', [$model->id]) . '">' . $model->name . '</a>';
            })
            ->editColumn('country', function ($model) {
                return getCountry($model->delegate_country);
            })
            ->editColumn('contract_date', function ($model) {
                if ($model->contract_date == null) {
                    return '_';
                }
                return Carbon::createFromTimeString($model->contract_date)->format('Y-m-d');
            })
            ->editColumn('status', function ($model) {
                if ($model->status == 'current') {
                    return awtTrans('خبير حالي');
                } elseif ($model->status == 'old') {
                    return awtTrans('خبير سابق');
                } else {
                    return awtTrans('مرشح للعمل');
                }
            })
            ->editColumn('end_date', function ($model) {
                if ($model->end_date == null) {
                    return '_';
                }
                return Carbon::createFromTimeString($model->end_date)->format('Y-m-d');
            })
            ->rawColumns(['type', 'chk', 'name', 'country', 'applications', 'assessments'])
            ->make(true);
    }

    public function import()
    {
        $request = request();

        if (!$request->hasFile('zip_file')) {
            flash(awtTrans('الملف المضغوط للخبراء مطلوب'))->error();
            return redirect(route($this->route . '.create'));
        }

        $file = $request->file('zip_file');
        if ($file->getClientOriginalExtension() !== 'zip') {
            flash(awtTrans('يجب ان يكون الملف بصيغه zip'))->error();
            return redirect(route($this->route . '.create'));
        }

        // Save the uploaded zip file
        $zipPath = public_path('/uploads/zipFiles/TempUpload.zip');
        $file->move(public_path('/uploads/zipFiles'), 'TempUpload.zip');

        // Clear old extracted Excel files
        \File::deleteDirectory(public_path('uploads/excel'));
        \File::makeDirectory(public_path('uploads/excel'));

        // Extract the new zip file
        $zip = new \ZipArchive;
        if ($zip->open($zipPath) === true) {
            $zip->extractTo(public_path('uploads/excel'));
            $zip->close();
        } else {
            flash(awtTrans('فشل في فتح الملف المضغوط'))->error();
            return redirect(route($this->route . '.create'));
        }

        // Find the Excel file dynamically
        $excelFiles = glob(public_path('uploads/excel/*.xlsx'));
        if (count($excelFiles) === 0) {
            flash(awtTrans('لم يتم العثور على أي ملف Excel داخل الملف المضغوط'))->error();
            return redirect(route($this->route . '.create'));
        }

        $exFile = $excelFiles[0]; // Use the first (only) Excel file
        $excel = new MyExcel($exFile);
        $data = $excel->toArray();
        // dd($data);
        // Filter out empty rows or header-only rows
        $validData = array_filter($data, function ($row) {
            return !empty(array_filter($row)); // Filters rows with all empty cells
        });

        // Optional: dd if needed
        // dd($validData);

        foreach ($validData as $row) {
            unset($row['id'], $row['export_status']);
            // $row['wait_list'] = 'true';

            // Only insert if required fields are filled (adjust fields as needed)
            if (!empty($row ?? null)) {
                // Try to find course by name
                Expert::create([
                    'name' => $row['Name'] ?? null,
                    'country' => getCountryByName($row['Country']) ?? null,
                    'qualification' => $row['Educational Qualification'] ?? null,
                    'specialist' => $row['Specialization'] ?? null,
                    'sub_specialist' => $row['Sub-specialization'] ?? null,
                    'gender' => $row['Gender'] ?? null,
                    'languages' => $row['Languages Proficiency'] ?? null,
                    'current_employer' => $row['Current Employer'] ?? null,
                    'employer_address' => $row['Employer Address'] ?? null,
                    'employer_phone' => $row['Employer Phone'] ?? null,
                    'employer_email' => $row['Employer Email'] ?? null,
                    'phone' => $row['Phone Number'] ?? null,
                    'email' => $row['Email'] ?? null,
                    'contract_date' => Carbon::parse($row['Contract Start']) ?? null,
                    'end_date' => Carbon::parse($row['Contract End']) ?? null,
                    'passport_number' => $row['Passport Number'] ?? null,
                    'delegate_country' => getCountryByName($row['Current Destination Country']) ?? null,
                    'delegate_org' => $row['Current Destination Entity'] ?? null,
                    'cost' => $row['Annual Cost'] ?? null,
                    'status' => $row['Expert Status'] ?? null,
                    'note' => $row['Note'] ?? null
                ]);

                // Application::create($row);
            }
        }

        flash(awtTrans('تم رفع البيانات بنجاح'))->success();
        return redirect(route($this->route . '.index'));
    }
}
