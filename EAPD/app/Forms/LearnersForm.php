<?php

namespace App\Forms;

use App\Models\Scholarships;
use Kris\LaravelFormBuilder\Form;

class LearnersForm extends Form
{
    public function buildForm()
    {

        $this
            ->add('scholarships_id', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('اسم المنحة'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-sm-12  row'],
                'class' => \App\Models\Scholarships::class,
                'property' => 'program',
                'query_builder' => function (Scholarships $type) {
                    // If query builder option is not provided, all data is fetched
                    return $type;
                },
                'attr' => ['placeholder' => awtTrans('اسم المنحة'), 'class' => 'col-sm-6 form-control selc_scholarship'],
            ])
            ->add('first_name', 'text', [
                'rules' => 'required',
                'label' => awtTrans(' الاسم الاول'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-sm-12 row'],
                'attr' => ['placeholder' => awtTrans('الاسم الاول'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('middle_name', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الاسم الثاني'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-sm-12 row'],
                'attr' => ['placeholder' => awtTrans('الاسم الثاني'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('last_name', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الاسم الثالث'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-sm-12 row'],
                'attr' => ['placeholder' => awtTrans('اللقب'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('gender', 'select', [
                'rules' => 'required',
                'label' => awtTrans('النوع'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'choices' => ['male' => awtTrans('ذكر'), 'female' => awtTrans('انثي')],

                'attr' => ['placeholder' => awtTrans('اختر النوع'), 'class' => 'col-sm-6 form-control selc_gender'],
            ])

            ->add('nationality', 'select', [
                'rules' => 'required',
                'label' => awtTrans('الجنسيه'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'choices' => getCountries(),
                'attr' => ['placeholder' => awtTrans('اختر دوله الجنسيه'), 'class' => 'col-sm-6 form-control selc_country'],
            ])

            ->add('email_address', 'email', [
                // 'rules' => 'required|email',
                'label' => awtTrans('البريد الالكتروني'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('البريد الالكتروني'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('birth_date', 'text', [
                // 'rules' => 'required',
                'label' => awtTrans('تاريخ الميلاد'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],

                'attr' => ['placeholder' => awtTrans('تاريخ الميلاد'), 'autocomplete' => 'off', 'class' => 'col-sm-6 form-control date-picker-input'],
            ]);

        //        $this->add('back', 'submit', [
        //            'label' => trans('main.back'),
        //            'wrapper' => ['class' => 'form-group col-12 row col-md-2 pull-left ml-1'],
        //            'attr' => ['class' => 'col-md-12 btn btn-danger ']
        //        ]);
        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'form-group  row  col-md-11 '],
            'attr' => ['class' => 'col-md-1 btn btn-primary offset-md-11 '],
        ]);
        $this->add('back', 'static', [
            'label' => false,
            'tag' => 'a', // Tag to be used for holding static data,
            'wrapper' => ['class' => 'form-group  row col-md-1 '],
            'attr' => ['class' => 'col-md-12  ml-4 btn btn-danger ', 'href' => route('learners.index')],
            'value' => trans('main.back'), // If nothing is passed, data is pulled from model if any
        ]);
    }
}
