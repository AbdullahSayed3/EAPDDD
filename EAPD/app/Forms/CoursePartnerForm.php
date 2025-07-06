<?php

namespace App\Forms;

use App;
use App\Models\CourseField;
use App\Models\CourseNatural;
use Illuminate\Support\Facades\App as FacadesApp;
use Kris\LaravelFormBuilder\Form;

class CoursePartnerForm extends Form
{
    public function buildForm()
    {

        $this

            ->add('name', 'text', [
                'rules' => 'required',
                'label' => awtTrans('اسم المركز / الشريك'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('اسم المركز / الشريك'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('name_en', 'text', [
                'rules' => 'required',
                'label' => awtTrans('name_en'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => '', 'class' => 'col-sm-6 form-control'],
            ])


            ->add('name_fr', 'text', [
                'rules' => 'required',
                'label' => awtTrans('name_fr'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => '', 'class' => 'col-sm-6 form-control'],
            ])
            ->add('field_id', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('مجال العمل'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'class' => \App\Models\CourseField::class,
                'property' => FacadesApp::getLocale() == 'ar' ? 'name_ar' : 'name_en',
                'query_builder' => function (CourseField $type) {
                    // If query builder option is not provided, all data is fetched
                    return $type;
                },
                'attr' => ['placeholder' => awtTrans('مجال العمل'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('partner_natural', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('طبيعة الجهة'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'class' => \App\Models\CourseNatural::class,
                'property' => FacadesApp::getLocale() == 'ar' ? 'name_ar' : 'name_en',
                'query_builder' => function (CourseNatural $type) {
                    // If query builder option is not provided, all data is fetched
                    return $type;
                },
                'attr' => ['placeholder' => awtTrans('طبيعة الجهة'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('address', 'textarea', [
                'rules' => 'required',
                'label' => awtTrans('العنوان بالعربية'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->address],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('العنوان'), 'class' => 'col-sm-6 form-control ', 'autocomplete' => 'off'],
            ])


            ->add('address_en', 'textarea', [
                'rules' => 'required',
                'label' => awtTrans('العنوان بالانجليزية'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->address_en],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('العنوان'), 'class' => 'col-sm-6 form-control ', 'autocomplete' => 'off'],
            ])


            ->add('address_fr', 'textarea', [
                'rules' => 'required',
                'label' => awtTrans('العنوان بالفرنسية'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->address_fr],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('العنوان'), 'class' => 'col-sm-6 form-control ', 'autocomplete' => 'off'],
            ])

            ->add('contact_name', 'text', [
                'rules' => 'required',
                'label' => awtTrans('اسم نقطة الاتصال'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('اسم نقطة الاتصال'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('contact_phone', 'text', [
                'rules' => 'required',
                'label' => awtTrans('التليفون'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('التليفون'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('contact_email', 'email', [
                'rules' => 'required',
                'label' => awtTrans('البريد الالكتروني'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('البريد الالكتروني'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('documents[]', 'file', [
                'label' => awtTrans('وثائق ذات صلة'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('وثائق ذات صلة'), 'class' => 'col-sm-6 form-control ', 'multiple' => 'true'],
            ])

            ->add('notes', 'textarea', [
                //                'rules' => '',
                'label' => awtTrans('ملاحظات أخرى'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('ملاحظات أخرى'), 'class' => 'col-sm-6 form-control ', 'autocomplete' => 'off'],
            ]);
        //        $this->add('back', 'submit', [
        //            'label' => trans('main.back'),
        //            'wrapper' => ['class' => 'form-group row col-md-2 pull-left ml-1'],
        //            'attr' => ['class' => 'col-md-12 btn btn-danger ']
        //        ]);
        $this->add('back', 'static', [
            'label' => false,
            'tag' => 'a', // Tag to be used for holding static data,
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left ml-1'],
            'attr' => ['class' => 'col-md-12 btn btn-danger ', 'href' => route('coursesPartners.index')],
            'value' => trans('main.back'), // If nothing is passed, data is pulled from model if any
        ]);
        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left'],
            'attr' => ['class' => 'col-md-12 btn btn-primary '],
        ]);

    }
}
