<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class TeamForm extends Form
{
    public function buildForm()
    {
        $formControlClass = 'col-sm-12 form-control';
        $formSelectClass = 'col-sm-12 form-select';
        $labelClass = 'col-sm-2 form-label';
        $wrapperClass = 'mb-3 row';

        $this->add('name_en', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الاسم بالانجليزية'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name_en],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الاسم بالانجليزية'), 'class' => 'col-sm-12 form-control'],
            ])

            ->add('name_ar', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الاسم بالعربية'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name_ar],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الاسم بالعربية'), 'class' => 'col-sm-12 form-control'],
            ])

            ->add('name_fr', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الاسم بالفرنسية'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name_fr],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الاسم بالفرنسية'), 'class' => 'col-sm-12 form-control'],
            ])

            ->add('job_en', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الوظيفة بالانجليزية'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->job_en],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الوظيفة بالانجليزية'), 'class' => 'col-sm-12 form-control'],
            ])

            ->add('job_ar', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الوظيفة بالعربية'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->job_ar],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الوظيفة بالعربية'), 'class' => 'col-sm-12 form-control'],
            ])

            ->add('job_fr', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الوظيفة بالفرنسية'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->job_fr],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الوظيفة بالفرنسية'), 'class' => 'col-sm-12 form-control'],
            ])
         ->add('image', 'file', [
               'rules' => isset($this->model) ? 'nullable' : 'required',
                'label' => awtTrans('صورة'),
                'label_attr' => ['class' => $labelClass, 'for' => $this->image],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('صورة'),
                    'class' => $formControlClass,
                    'id' => 'image',
                ],
            ])
        
                ->add('is_active', 'checkbox', [
                'label' => awtTrans('نشط؟'),
                'label_attr' => ['class' => $labelClass],
                'wrapper' => ['class' => 'form-group row'],
                'default_value' => 1,
                'value' =>1,
                'checked' => isset($this->model) ? $this->is_active : false,
                'attr' => [
                    'class' => 'form-check-input',
                    'data-toggle' => 'toggle', // If you're using bootstrap toggle
                    'data-on' => awtTrans('نشط'),
                    'data-off' => awtTrans('غير نشط'),
                ],
            ])
             ->add('is_main', 'checkbox', [
                'label' => awtTrans('اساسي'),
                'label_attr' => ['class' => $labelClass],
                'wrapper' => ['class' => 'form-group row'],
                'default_value' => 1,
                'value' =>1,
                'checked' =>  isset($this->model) ? $this->is_main : false ,
                'attr' => [
                    'class' => 'form-check-input',
                    'data-toggle' => 'toggle', // If you're using bootstrap toggle
                    'data-on' => awtTrans('نشط'),
                    'data-off' => awtTrans('غير نشط'),
                ],
            ]);
        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left'],
            'attr' => ['class' => 'col-md-12 btn btn-primary '],
        ]);

    }
}
