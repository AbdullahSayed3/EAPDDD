<?php

namespace App\Forms\Settings;

use Kris\LaravelFormBuilder\Form;

class NameForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'rules' => 'required',
                'label' => trans('main.name'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => trans('main.name'), 'class' => 'col-sm-12 form-control'],
            ]);

        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left'],
            'attr' => ['class' => 'col-md-12 btn btn-primary '],
        ]);

    }
}
