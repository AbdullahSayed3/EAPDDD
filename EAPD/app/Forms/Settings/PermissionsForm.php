<?php

namespace App\Forms\Settings;

use Kris\LaravelFormBuilder\Form;

class PermissionsForm extends Form
{
    public function buildForm()
    {
        if ($this->getData('only_view') !== true) {
            $this
                ->add('name', 'text', [
                    'rules' => 'required',
                    'label' => 'Name',
                    'wrapper' => ['class' => 'form-group col-md-6'],

                ])->add('nice_name', 'text', [
                    'rules' => 'required',
                    'label' => 'Nice name',
                    'wrapper' => ['class' => 'form-group col-md-6'],

                ])
                ->add('guard_name', 'hidden', [
                    'rules' => 'required',
                    'value' => 'web',

                ])->add('clone_form', 'checkbox', [
                    'value' => 1,
                    'label' => 'Clone Form Data',
                    'checked' => false,
                    'wrapper' => ['class' => 'form-group col-md-12'],

                ])->add('submit', 'submit', [
                    'label' => 'save',
                    'value' => 'save',
                    'wrapper' => ['class' => 'form-group col-md-2'],
                    'attr' => ['class' => 'col-md-12 btn btn-primary pull-right'],
                ]);
        } else {
            $this
                ->add('name', 'text', [
                    'rules' => 'required',
                    'label' => 'Name',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'attr' => ['readonly'],

                ])->add('nice_name', 'text', [
                    'rules' => 'required',
                    'label' => 'Nice name',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'attr' => ['readonly'],

                ])
                ->add('guard_name', 'hidden', [
                    'rules' => 'required',
                    'value' => 'web',
                    'attr' => ['readonly'],

                ]);

        }
    }
}
