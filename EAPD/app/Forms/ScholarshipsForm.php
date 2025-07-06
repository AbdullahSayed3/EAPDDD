<?php

namespace App\Forms;

use App\Models\CourseField;
use Illuminate\Support\Facades\App;
use Kris\LaravelFormBuilder\Form;

class ScholarshipsForm extends Form
{
    public function buildForm()
    {
        
        $formControlClass = 'col-sm-6 form-control';
        $formSelectClass = 'col-sm-6 form-select';
        $labelClass = 'col-sm-2 form-label';
        $wrapperClass = 'mb-3 row';
        $this
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
            ->add('program', 'text', [
                'rules' => 'required',
                'label' => awtTrans('program_ar'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('program_ar'), 'class' => 'col-sm-6 form-control'],
            ])
            
            ->add('program_en', 'text', [
                'rules' => 'required',
                'label' => awtTrans('program_en'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('program_en'), 'class' => 'col-sm-6 form-control'],
            ])
            
            ->add('program_fr', 'text', [
                'rules' => 'required',
                'label' => awtTrans('program_fr'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('program_ar'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('owner', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الجهة'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الجهة'), 'class' => 'col-sm-6 form-control'],
            ])

            // ->add('department', 'text', [
            //     'rules' => 'required',
            //     'label' =>awtTrans('مجال الدراسة'),
            //     'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
            //     'wrapper' => ['class' => 'form-group row'],
            //     'attr' => ['placeholder' =>awtTrans('مجال الدراسة'), 'class' => 'col-sm-6 form-control ','autocomplete'=>'off'],
            // ])
            ->add('department', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('مجال الدراسة'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'class' => \App\Models\CourseField::class,
                'property' => App::getLocale() == 'ar'? 'name_ar' : 'name_en',
                'query_builder' => function (CourseField $type) {
                    // If query builder option is not provided, all data is fetched
                    return $type;
                },
                'attr' => ['placeholder' => awtTrans('مجال الدراسة'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('participants', 'select', [
                'rules' => 'required',
                'label' => awtTrans('الدول المشاركه'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'choices' => getCountries(),
                'attr' => ['class' => 'col-sm-6 form-control participants', 'multiple' => 'true'],
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
        // ->add('learners_num', 'number', [
        //     'rules' => 'required',
        //     'label' =>awtTrans('عدد الدراسين'),
        //     'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
        //     'wrapper' => ['class' => 'form-group row'],
        //     'attr' => ['placeholder' =>awtTrans('عدد الدراسين'), 'class' => 'col-sm-6 form-control ','min'=>'1'],
        // ])
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
        ->add('annual_cost', 'number', [
            'rules' => 'required',
            'label' =>awtTrans('التكلفه السنوية'),
            'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
            'wrapper' => ['class' => 'form-group row'],
            'attr' => ['placeholder' =>awtTrans('التكلفه السنوية'), 'class' => 'col-sm-6 form-control ','min'=>'1'],
        ])->add('content_ar', 'textarea', [
                'rules' => 'required',
                'label' =>trans('awt.بالعربية المحتوري'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_content'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('المحتوى'),
                    'class' => $formControlClass,
                    'id' => 'course_content',
                    'autocomplete' => 'off'
                ],
            ])
            ->add('content_en', 'textarea', [
                'rules' => 'required',
                'label' => trans('awt.بالانجليزية المحتوري'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_content'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('المحتوى'),
                    'class' => $formControlClass,
                    'id' => 'course_content',
                    'autocomplete' => 'off'
                ],
            ])
            ->add('content_fr', 'textarea', [
                'rules' => 'required',
                'label' => trans('awt.بالفرنسية المحتوري'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_content'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('المحتوى'),
                    'class' => $formControlClass,
                    'id' => 'course_content',
                    'autocomplete' => 'off'
                ],
            ]);
       
        
        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left'],
            'attr' => ['class' => 'col-md-12 btn btn-primary '],
        ]);

    }
}
