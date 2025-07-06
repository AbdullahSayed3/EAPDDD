<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class EditFaqFrom extends Form
{
    public function buildForm()
    {
        $formControlClass = 'col-sm-12 form-control';
        $formSelectClass = 'col-sm-12 form-select';
        $labelClass = 'col-sm-2 form-label';
        $wrapperClass = 'mb-3 row';

        $this
            ->add('question', 'text', [
                'rules' => 'required',
                'label' => awtTrans('السوال'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->question],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('السوال'), 'class' => 'col-sm-12 form-control'],
            ])
            ->add('answer', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الاجابة'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->answer],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الاجابة'), 'class' => 'col-sm-12 form-control'],
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
