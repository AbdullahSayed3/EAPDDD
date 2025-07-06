<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class BlogForm extends Form
{
    public function buildForm()
    {
        $formControlClass = 'col-sm-12 form-control';
        $formSelectClass = 'col-sm-12 form-select';
        $labelClass = 'col-sm-2 form-label';
        $wrapperClass = 'mb-3 row';

        $this
         ->add('code', 'select', [
                'rules' => 'required',
                'label' => awtTrans('اللغة'),
                'label_attr' => ['class' => $labelClass, 'for' => 'code'],
                'wrapper' => ['class' => $wrapperClass],
                'choices' => [
                    'ar' => awtTrans('اللغة العربية'),
                    'en' => awtTrans('اللغة الانجليزية'),
                    'fr' => awtTrans('اللغة الفرنسية'),
                ],
                'attr' => [
                    'placeholder' => awtTrans('لغة المقال'),
                    'class' => $formSelectClass,
                    'id' => 'code',
                ],
            ])
            ->add('title', 'text', [
                'rules' => 'required',
                'label' => awtTrans('العنوان'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('العنوان'), 'class' => 'col-sm-12 form-control'],
            ])
              ->add('content', 'textarea', [
                'rules' => 'required',
                'label' => awtTrans('المحتوى'),
                'label_attr' => ['class' => $labelClass, 'for' => 'content'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('المحتوى'),
                    'class' => $formControlClass,
                    'id' => 'content',
                    'autocomplete' => 'off'
                ],
            ])
         ->add('cover', 'file', [
               'rules' => isset($this->model) ? 'nullable' : 'required',
                'label' => awtTrans('غلاف'),
                'label_attr' => ['class' => $labelClass, 'for' => $this->image],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('غلاف'),
                    'class' => $formControlClass,
                    'id' => 'image',
                ],
            ])
             ->add('images[]', 'file', [
                'label' => awtTrans('صور'),
                'label_attr' => ['class' => $labelClass, 'for' => 'images'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('صور'),
                    'class' => $formControlClass,
                    'id' => 'course_documents',
                    'multiple' => 'true'
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
            ]);
        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left'],
            'attr' => ['class' => 'col-md-12 btn btn-primary '],
        ]);

    }
}
