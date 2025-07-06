<?php

namespace App\Http\Controllers;

use App\Exports\ExportEvents;
use App\Forms\EventForm;
use App\Http\Controllers\Traits\UploadTrait;
use App\Models\Events;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class EventsController extends Controller
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
        $this->active = 'events';
        $this->view = 'events';
        $this->route = 'events';
        $this->form = EventForm::class;
        $this->model = Events::class;
        $this->title = 'events';
        $this->keys = [
            'type_id',
            'subject',
            'participants',
            'start_date',
            'end_date',
            'location',
            'documents',
            'notes',
        ];
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'subject', 'display' => awtTrans('الموضوع الرئيسي'), 'data' => 'subject', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'type_id', 'display' => awtTrans('نوع الفعالية'), 'data' => 'type', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'start_date', 'display' => awtTrans('تاريخ البدء'), 'data' => 'start_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'end_date', 'display' => awtTrans('تاريخ الإنتهاء'), 'data' => 'end_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'participants', 'display' => awtTrans('الجهات المشاركة'), 'data' => 'participants', 'orderable' => 'false', 'searchable' => 'false'],

            ['name' => 'location', 'display' => awtTrans('مكان الإنعقاد'), 'data' => 'location', 'orderable' => 'true', 'searchable' => 'true'],
        ];
        $this->wrapper_class = 'form-group';
        $this->middleware('can:show_events')->only(['index', 'show']);
        $this->middleware('can:create_events')->only(['create', 'store']);
        $this->middleware('can:edit_events')->only(['edit', 'update']);
        $this->middleware('can:delete_events')->only(['delete']);

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // dd(app($this->model)->type());
        $this->table = [
            ['name' => 'chk', 'display' => '<input id="check-all" type="checkbox" class="iCheck-square chk-all">', 'data' => 'chk', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'subject', 'display' => awtTrans('الموضوع الرئيسي'), 'data' => 'subject', 'orderable' => 'false', 'searchable' => 'false'],
            ['name' => 'type_id', 'display' => awtTrans('نوع الفعالية'), 'data' => 'type', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'start_date', 'display' => awtTrans('تاريخ البدء'), 'data' => 'start_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'end_date', 'display' => awtTrans('تاريخ الإنتهاء'), 'data' => 'end_date', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'participants', 'display' => awtTrans('الجهات المشاركة'), 'data' => 'participants', 'orderable' => 'false', 'searchable' => 'false'],

            ['name' => 'location', 'display' => awtTrans('مكان الإنعقاد'), 'data' => 'location', 'orderable' => 'true', 'searchable' => 'true'],
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
                $files[] = $this->uploadFile($file[0], 'events');
            }
        } else {
            flash(awtTrans('Documents Are Required'))->error();

            return redirect(route($this->route.'.create'))->withInput();
        }

        $participants = explode("\n", $request->participants);

        $data = $request->only($this->keys);

        $data['participants'] = serialize($participants);
        $data['documents'] = serialize($files);
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
        $model->participants = implode("\n", unserialize($model->participants));

        $form = $formBuilder->create($this->form, [
            'method' => 'PUT',
            'model' => $model->toArray(),                              // Not passed to view, just used in form class
            'url' => route($this->route.'.update', ['event' => $model['id']]),
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
        $files = [];

        if (isset($request->documents)) {
            foreach ($request->documents as $file) {
                $files[] = $this->uploadFile($file[0], 'events');
            }
        } else {
            $files = unserialize($model->documents);
        }

        $participants = explode("\n", $request->participants);

        $data = $request->only($this->keys);

        $data['participants'] = serialize($participants);
        $data['documents'] = serialize($files);

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

                return (new ExportEvents([], $this->view))->download('events.xlsx');
            }
            if ($request->submit == 'print') {
                return view($this->view.'.print', [
                    'data' => Events::orderBy('start_date', 'asc')->get(),
                    'print' => 'true',
                    'lang' => App::getLocale(),
                ]);
            }
            flash(trans('main.select_rows_to_delete'))->error();

            return redirect(route($this->route.'.index'));
        }

        if ($request->submit == 'delete') {

            $rows = $this->model::whereIn('id', $request->courses)->orderBy('start_date', 'asc')->get();
            foreach ($rows as $row) {
                $row->delete();

            }
            flash(trans('main.rows_deleted_successfully'))->success();
            //        flash('Country Deleted Successfully')->success();
        } elseif ($request->submit == 'export') {
            return (new ExportEvents($request->courses, $this->view))->download('events.xlsx');
        } elseif ($request->submit == 'print') {
            return view($this->view.'.print', [
                'data' => Events::whereIn('id', $request->courses)->orderBy('start_date', 'asc')->get(),
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

        $dataArray = filterDatatableGet($_GET);

        $model = $this->model::query();
        if (isset($dataArray['event'])) {
            $model->where('type_id', $dataArray['event']);
        }

        if (isset($dataArray['subject'])) {

            $model->where('subject', 'LIKE', '%'.$dataArray['subject'].'%');
        }
        if (isset($dataArray['comps'])) {
            $model->where('participants', 'LIKE', '%'.$dataArray['comps'].'%');
        }
        if (isset($dataArray['date_from'])) {
            $model->where('start_date', '>', $dataArray['date_from']);
        }
        if (isset($dataArray['date_to'])) {
            $model->where('end_date', '<', $dataArray['date_to']);
        }

        return DataTables::of($model)
            ->addColumn('chk', function ($model) {
                return '<input type="checkbox" name="courses[]" value="'.$model->id.'" class="iCheck-square chk-item">';

            })
            ->addColumn('type', function ($model) {
                return $model->type?->name_ar ?? '-';
            })
            ->addColumn('participants', function ($model) {
                $array = unserialize($model->participants);

                return implode('-', $array);
            })
            ->addColumn('subject', function ($model) {
                $array = unserialize($model->participants);

                return '<a href="'.route($this->route.'.show', [ $model->id]).'">'.$model->subject.'</a>';
            })
            ->editColumn('start_date', function ($model) {
                return $model->start_date->format('Y-m-d');
            })
            ->editColumn('end_date', function ($model) {
                return $model->end_date->format('Y-m-d');
            })
            ->rawColumns(['type', 'chk', 'subject', 'assessment_link', 'applications', 'assessments'])->make(true);
    }
}
