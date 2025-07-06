<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AchievementTypeForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name_ar', 'text', [
                'rules' => 'required',
                'label' => trans('main.name_ar'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name_ar],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('الاسم'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('name_en', 'text', [
                'rules' => 'required',
                'label' => trans('main.name_en'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name_en],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => trans('main.name_en'), 'class' => 'col-sm-6 form-control'],
            ])->add('name_fr', 'text', [
                'rules' => 'required',
                'label' => trans('main.name_fr'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name_fr],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => trans('main.name_fr'), 'class' => 'col-sm-6 form-control'],
            ]);
          

        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left'],
            'attr' => ['class' => 'col-md-12 btn btn-primary '],
        ]);

    }
}
