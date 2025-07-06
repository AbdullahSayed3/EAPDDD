<?php

namespace App\Forms\Settings;

use App\Models\Role;
use Kris\LaravelFormBuilder\Form;

class SupportMemberForm extends Form
{
    public function buildForm()
    {
        if ($this->getData('only_view') !== true) {

            $this
                ->add('name', 'text', [
                    'rules' => 'required',
                    'label' => awtTrans('اسم المستخدم'),
                    'wrapper' => ['class' => 'form-group col-md-6'],

                ]);
            if ($this->getData('edit')) {
                $this->add('email', 'email', [
                    'rules' => 'required',
                    'label' => awtTrans('البريد الالكتروني'),
                    'wrapper' => ['class' => 'form-group col-md-6'],

                ]);
            } else {

                $this->add('email', 'email', [
                    'rules' => 'required|unique:users',
                    'label' => awtTrans('البريد الالكتروني'),
                    'wrapper' => ['class' => 'form-group col-md-6'],

                ]);

            }

            if ($this->getData('edit')) {
                $this->add('password', 'password', [
                    'rules' => 'confirmed',
                    'label' => awtTrans('كلمه السر'),
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'value' => '',

                ])->add('password_confirmation', 'password', [
                    'rules' => '',
                    'label' => awtTrans('تاكيد كلمه السر'),
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'value' => '',

                ]);
            } else {

                $this->add('password', 'password', [
                    'rules' => 'required|confirmed',
                    'label' => awtTrans('كلمه السر'),
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'value' => '',

                ])->add('password_confirmation', 'password', [
                    'rules' => 'required',
                    'label' => awtTrans('تاكيد كلمه السر'),
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'value' => '',

                ]);
            }
            //        if ( auth()->user()->can( 'add_users_roles' ) ) {
            if (! $this->getData('profile')) {

                $this->
                add('roles', 'entity', [
                    'label' => awtTrans('مجموعه المستخدم'),

                    'class' => \App\Models\Role::class,
                    'property' => 'nice_name',
                    'query_builder' => function (Role $role) {

                        return $role;
                        //                    return $role->where('name', '!=','admin');
                    },
                    'expanded' => false,
                    'multiple' => false,
                    'label_attr' => ['class' => 'col-12 '],
                    'wrapper' => ['class' => 'form-group col-md-6'],

                    'choice_options' => [
                        'wrapper' => ['class' => 'col-md-4'],
                        'label_attr' => ['class' => 'label-class'],
                    ],
                    'selected' => function ($data) {
                        $array = [];
                        if (empty($data)) {
                            return $array;
                        }
                        foreach ($data as $value) {
                            try {

                                $array[] = $value->id;

                            } catch (\Exception $e) {

                            }
                        }

                        return $array;

                    },
                ]);
                //        }
            }

            $this->add('submit', 'submit', [
                'label' => awtTrans('حفظ'),
                'wrapper' => ['class' => 'form-group col-md-12'],
                'attr' => ['class' => 'col-md-2 btn btn-primary pull-right'],
            ]);
        } else {
            $this
                ->add('name', 'text', [
                    'rules' => 'required',
                    'label' => awtTrans('اسم المستخدم'),
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'attr' => ['readonly'],

                ]);
            $this->add('email', 'email', [
                'rules' => 'required',
                'label' => awtTrans('البريد الالكتروني'),
                'wrapper' => ['class' => 'form-group col-md-6'],
                'attr' => ['readonly'],

            ]);
        }
    }
}
