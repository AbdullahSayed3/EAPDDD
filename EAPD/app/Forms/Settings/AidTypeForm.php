<?php

namespace App\Forms\Settings;

use App\Models\AidType;
use Illuminate\Support\Facades\App;
use Kris\LaravelFormBuilder\Form;

class AidTypeForm extends Form
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
            ])
            ->add('parent_id', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('نوع القافلة الرئيسيي'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => 'parent_id'],
                'wrapper' => ['class' => 'mb-3 col-sm-12 row'],
                'class' => \App\Models\AidType::class,
                'property' => App::getLocale() == 'ar' ? 'name_ar' : 'name_en',
                'query_builder' => function (AidType $type) {
                    return $type->newQuery();
                },
                'attr' => [
                    'class' => 'col-sm-6 form-select',
                ],
            ])
            ->add('image', 'file', [
                'rules' => (isset($this->model) ? 'nullable' : 'required') . '|mimetypes:image/svg+xml',
                'label' => awtTrans('صورة'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->image],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => [
                    'placeholder' => awtTrans('صورة'),
                    'class' => 'col-sm-2 form-control',
                    'id' => 'image',
                ],
            ]);


        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left'],
            'attr' => ['class' => 'col-md-12 btn btn-primary '],
        ]);
    }
}
