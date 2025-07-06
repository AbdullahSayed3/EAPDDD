<?php

namespace App\Forms\Settings;

use App\Models\Permission;
use Illuminate\Support\Facades\App;
use Kris\LaravelFormBuilder\Form;

class RolesForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'rules' => 'required',
                'label' => awtTrans('اسم المجموعه'),
                'wrapper' => ['class' => 'form-group col-md-6'],

            ])->add('nice_name', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الاسم اللطيف'),
                'wrapper' => ['class' => 'form-group col-md-6'],

            ])
            ->add('guard_name', 'hidden', [
                'rules' => 'required',
                'value' => 'web'])
            ->add('select_all', 'checkbox', [
                'label' => awtTrans('تحديد / إلغاء تحديد الكل'),
                'wrapper' => ['class' => 'form-group col-md-12 mb-2'],
                'attr' => [
                    'id' => 'select-all-permissions',
                    'class' => 'form-check-input'
                ],
                'label_attr' => ['class' => 'form-check-label'],
                'value' => 1,
                'checked' => false,
            ])
            ->add('permissions', 'entity', [
                'label' => awtTrans('الصلاحيات'),
                'wrapper' => ['class' => 'form-group col-md-12 row'],

                'class' => \App\Models\Permission::class,
                'property' => App::getLocale() == 'en' ? 'name' : 'nice_name',
                'query_builder' => function (Permission $lang) {
                    // If query builder option is not provided, all data is fetched
                    return $lang->orderBy('name', 'asc');
                },
                'expanded' => true,
                'multiple' => true,
                'label_attr' => ['class' => 'col-12'],
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

                    // Returns the array of short names from model relationship data
                    return array_pluck($data, 'permissions_id');
                },
            ])->add('submit', 'submit', [
                'label' => 'Save',
                'wrapper' => ['class' => 'form-group col-md-12'],
                'attr' => ['class' => 'col-md-2 btn btn-primary pull-right'],
            ]);
    }
}
