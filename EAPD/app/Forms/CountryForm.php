<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CountryForm extends Form
{
    public function buildForm()
    {
        $formControlClass = 'col-sm-12 form-control';
        $formSelectClass = 'col-sm-12 form-select';
        $labelClass = 'col-sm-2 form-label';
        $wrapperClass = 'mb-3 row';

        $this
            ->add('name_ar', 'text', [
                'rules' => 'required',
                'label' => trans('awt.name_ar'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_name_ar'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => '',
                    'class' => $formControlClass,
                    'id' => 'course_name_ar'
                ],
            ])

            ->add('name_en', 'text', [
                'rules' => 'required',
                'label' => awtTrans('name_en'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_name_en'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => '',
                    'class' => $formControlClass,
                    'id' => 'course_name_en'
                ],
            ])

            ->add('name_fr', 'text', [
                'rules' => 'required',
                'label' => awtTrans('name_fr'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_name_fr'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => '',
                    'class' => $formControlClass,
                    'id' => 'course_name_fr'
                ],
            ])
            ->add('lat', 'number', [
                'rules' => 'required',
                'label' => 'LAT',
                'label_attr' => ['class' => $labelClass, 'for' => 'course_name_fr'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => '',
                    'class' => $formControlClass,
                    'id' => 'course_name_fr'
                ],
            ])
            ->add('lng', 'number', [
                'rules' => 'required',
                'label' => 'LNG',
                'label_attr' => ['class' => $labelClass, 'for' => 'course_name_fr'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => '',
                    'class' => $formControlClass,
                    'id' => 'course_name_fr'
                ],
            ]);
        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left'],
            'attr' => ['class' => 'col-md-12 btn btn-primary '],
        ]);
    }
}
