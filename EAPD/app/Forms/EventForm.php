<?php

namespace App\Forms;

use App\Models\EventType;
use Illuminate\Support\Facades\App;
use Kris\LaravelFormBuilder\Form;

class EventForm extends Form
{
    public function buildForm()
    {
        if (isset($this->model['start_date'])) {
            $this->model['start_date'] = date('Y-m-d', strtotime($this->model['start_date']));
        }
        if (isset($this->model['end_date'])) {
            $this->model['end_date'] = date('Y-m-d', strtotime($this->model['end_date']));
        }
        $this
            ->add('type_id', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('نوع الفعالية'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'class' => \App\Models\EventType::class,
                'property' => App::getLocale() == 'ar' ? 'name_ar' : 'name_en',
                'query_builder' => function (EventType $type) {
                    // If query builder option is not provided, all data is fetched
                    return $type;
                },
                'attr' => ['placeholder' => awtTrans('نوع الفعالية'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('subject', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الموضوع الرئيسي'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الموضوع الرئيسي'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('participants', 'textarea', [
                'rules' => 'required',
                'label' => awtTrans('الجهات المشاركة'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الجهات المشاركة'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('start_date', 'text', [
                'rules' => 'required',
                'label' => awtTrans('تاريخ البدء'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('تاريخ البدء'), 'class' => 'col-sm-6 form-control date-picker-input', 'autocomplete' => 'off'],
            ])
            ->add('end_date', 'text', [
                'rules' => 'required',
                'label' => awtTrans('تاريخ الإنتهاء'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('تاريخ الإنتهاء'), 'class' => 'col-sm-6 form-control date-picker-input', 'autocomplete' => 'off'],
            ])

            ->add('location', 'text', [
                'rules' => 'required',
                'label' => awtTrans('مكان الإنعقاد'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('مكان الإنعقاد'), 'class' => 'col-sm-6 form-control ', 'autocomplete' => 'off'],
            ])
            ->add('documents[]', 'file', [
                'label' => awtTrans('وثائق ذات صلة'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('وثائق ذات صلة'), 'class' => 'col-sm-6 form-control ', 'multiple' => 'true'],
            ])
            ->add('notes', 'textarea', [
                'rules' => 'required',
                'label' => awtTrans('ملاحظات أخرى'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('ملاحظات أخرى'), 'class' => 'col-sm-6 form-control ', 'autocomplete' => 'off'],
            ]);
        //        $this->add('back', 'submit', [
        //            'label' => trans('main.back'),
        //            'wrapper' => ['class' => 'form-group row col-md-2 pull-left ml-1'],
        //            'attr' => ['class' => 'col-md-12 btn btn-danger ']
        //        ]);
        $this->add('back', 'static', [
            'label' => false,
            'tag' => 'a', // Tag to be used for holding static data,
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left ml-1'],
            'attr' => ['class' => 'col-md-12 btn btn-danger ', 'href' => route('events.index')],
            'value' => trans('main.back'), // If nothing is passed, data is pulled from model if any
        ]);
        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left'],
            'attr' => ['class' => 'col-md-12 btn btn-primary '],
        ]);
    }
}
