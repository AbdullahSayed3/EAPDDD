<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
      protected $active;

    protected $view;

    protected $route;

    protected $form;
    protected $edit_form;

    protected $model;

    protected $title;

    protected $keys;

    protected $table;

    protected $wrapper_class;
 public function __construct(ContactUs $model)
    {
        
        $this->middleware('can:show_contact_us')->only(['index', 'show']);
       
        
        $this->active = awtTrans('contact_us');
        $this->view = 'contact_us.';
        $this->route = 'contact_us';
        $this->form = \App\Forms\FaqForm::class;
        $this->edit_form = \App\Forms\EditFaqFrom::class;

        $this->model = $model;
        $this->title = 'contact_us';
        $this->keys = [
            'question',
            'answer',
        ];
        $this->table = [
            ['name' => 'id', 'display' => '#', 'data' => 'id', 'orderable' => 'true', 'searchable' => 'false'],
            ['name' => 'name', 'display' => awtTrans('name'), 'data' => 'name', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'email', 'display' => trans('awt.email_address'), 'data' => 'email', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'message_type', 'display' => awtTrans('message_type'), 'data' => 'message_type', 'orderable' => 'true', 'searchable' => 'true'],
            ['name' => 'message', 'display' => awtTrans('message'), 'data' => 'message', 'orderable' => 'true', 'searchable' => 'true'],        
            // ['name' => 'action', 'display' => awtTrans('العمليات'), 'data' => 'action', 'orderable' => 'false', 'searchable' => 'false'],
        ];
        $this->wrapper_class = 'form-group';
    }

    public function index()
    {
         $active = $this->active;
        $table_rows = $this->table;
        $route = $this->route;
        return view($this->view.'.index', compact('active', 'table_rows', 'route'));
   }
  

    public function datatable()
    {
        $model = $this->model::query();
        return DataTables::of($model)->make(true);
    }

}
