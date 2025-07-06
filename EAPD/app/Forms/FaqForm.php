<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class FaqForm extends Form
{
    public function buildForm()
    {
        $formControlClass = 'col-sm-12 form-control';
        $formSelectClass = 'col-sm-12 form-select';
        $labelClass = 'col-sm-2 form-label';
        $wrapperClass = 'mb-3 row';

        $this
            ->add('question_ar', 'text', [
                'rules' => 'required',
                'label' => awtTrans('السوال عربي'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->question],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('السوال عربي'), 'class' => 'col-sm-12 form-control'],
            ])

            ->add('answer_ar', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الاجابة عربي'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->answer],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الاجابة عربي'), 'class' => 'col-sm-12 form-control'],
            ])



             ->add('question_en', 'text', [
                'rules' => 'required',
                'label' => awtTrans('السوال انجليزي'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->question],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('السوال انجليزي'), 'class' => 'col-sm-12 form-control'],
            ])

            ->add('answer_en', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الاجابة انجليزي'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->answer],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الاجابة انجليزي'), 'class' => 'col-sm-12 form-control'],
            ])

            
             ->add('question_fr', 'text', [
                'rules' => 'required',
                'label' => awtTrans('السوال فرنسي'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->question],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('السوال فرنسي'), 'class' => 'col-sm-12 form-control'],
            ])

            ->add('answer_fr', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الاجابة فرنسي'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->answer],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الاجابة فرنسي'), 'class' => 'col-sm-12 form-control'],
            ]);

        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left'],
            'attr' => ['class' => 'col-md-12 btn btn-primary '],
        ]);

    }
}
