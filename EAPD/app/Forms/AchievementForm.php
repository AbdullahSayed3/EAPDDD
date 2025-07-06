<?php

namespace App\Forms;

use App\Models\AchievementType;
use Illuminate\Support\Facades\App;
use Kris\LaravelFormBuilder\Form;

class AchievementForm extends Form
{
    public function buildForm()
    {
        
        $formControlClass = 'col-sm-12 form-control';
        $formSelectClass = 'col-sm-12 form-select';
        $labelClass = 'col-sm-2 form-label';
        $wrapperClass = 'mb-3 row';

        $this
         ->add('achievement_type_id', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('تصنيفات الانجازات'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_natural_id'],
                'wrapper' => ['class' => $wrapperClass],
                'class' => AchievementType::class,
                'property' => App::getLocale() == 'ar' ? 'name_ar' : 'name_en',
                'query_builder' => function (AchievementType $type) {
                    return $type;
                },
                'attr' => [
                    'placeholder' => '',
                    'class' => $formSelectClass,
                    'id' => 'achievement_type_id',
                ],
            ])
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
            ])
             ->add('country_id', 'select', [
                'rules' => 'required',
                'label' => awtTrans('الدول المتاحة'),
                'label_attr' => ['class' => $labelClass, 'for' => 'country_id'],
                'wrapper' => ['class' => $wrapperClass],
                'choices' => $this->getCountryChoices(),
                'selected' => $this->model && $this->country_id ? $this->country_id : [],
                'attr' => [
                    'class' => 'col-sm-6 form-control select2 ',
                    'id' => 'country_id',
                
                ],
            ])
            


            ->add('description_ar', 'textarea', [
                'rules' => 'required',
                'label' => trans('main.description_ar'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->description_ar],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => '', 'class' => 'col-sm-6 form-control'],
            ])
            ->add('description_en', 'textarea', [
                'rules' => 'required',
                'label' => trans('main.description_en'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->description_en],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => '', 'class' => 'col-sm-6 form-control'],
            ])->add('description_fr', 'textarea', [
                'rules' => 'required',
                'label' => trans('main.description_fr'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->description_fr],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => '', 'class' => 'col-sm-6 form-control'],
            ])

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

     private function getCountryChoices()
    {
        $countries = getCountries(); // Your existing function
        
        // Add empty option at the beginning
        return ['' => awtTrans('اختر الدول')] + $countries;
    }

}
