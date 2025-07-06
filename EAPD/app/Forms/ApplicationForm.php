<?php

namespace App\Forms;

use App\Models\Course;
use Kris\LaravelFormBuilder\Form;

class ApplicationForm extends Form
{
    public function buildForm()
    {

        if (isset($this->model['birth_date'])) {
            $this->model['birth_date'] = date('Y-m-d', strtotime($this->model['birth_date']));
        }
        $this
            ->add('course_id', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('اسم الدورة'),
                'label_attr' => ['class' => 'col-sm-2 form-label required-field', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-sm-12 row'],
                'class' => \App\Models\Course::class,
                'property' => 'name_ar',
                'query_builder' => function (Course $type) {
                    // If query builder option is not provided, all data is fetched
                    return $type;
                },
                'attr' => ['placeholder' => awtTrans('اسم الدورة'), 'class' => 'col-sm-6 form-select'],
            ])
            ->add('first_name', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الاسم'),
                'label_attr' => ['class' => 'col-sm-4 form-label required-field', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-sm-6 row'],
                'attr' => ['placeholder' => awtTrans('الاسم الاول'), 'class' => 'col-sm-8 form-control'],
            ])

            ->add('middle_name', 'text', [
                // 'rules' => 'required',
                'label' => false,
                //                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-sm-3'],
                'attr' => ['placeholder' => awtTrans('الاسم الثاني'), 'class' => 'col-sm-12 form-control'],
            ])
            ->add('last_name', 'text', [
                // 'rules' => 'required',
                'label' => false,
                //                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-sm-3'],
                'attr' => ['placeholder' => awtTrans('اللقب'), 'class' => 'col-sm-12 form-control'],
            ])
            ->add('gender', 'select', [
                'rules' => 'required',
                'label' => awtTrans('النوع'),
                'label_attr' => ['class' => 'col-sm-2 form-label required-field', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'choices' => ['male' => awtTrans('ذكر'), 'female' => awtTrans('انثي')],

                'attr' => ['placeholder' => awtTrans('اختر النوع'), 'class' => 'col-sm-6 form-select selc_gender'],
            ])
            ->add('nationality', 'select', [
                'rules' => 'required',
                'label' => awtTrans('الجنسيه'),
                'label_attr' => ['class' => 'col-sm-2 form-label required-field', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'choices' => getCountries(),
                'attr' => ['placeholder' => awtTrans('اختر دوله الجنسيه'), 'class' => 'col-sm-6 form-select selc_country'],
            ])

            ->add('address', 'text', [
                // 'rules' => 'required',
                'label' => awtTrans('العنوان'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('العنوان'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('phone_number', 'textarea', [
                // 'rules' => 'required',
                'label' => awtTrans('رقم الهاتف'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'help_block' => [
                    'text' => awtTrans('في حاله اكثر من رقم يرجي وضع كل رقم في سطر منفصل'),
                    'tag' => 'p',
                    'attr' => ['class' => 'form-text col-8 text-right'],
                ],
                'attr' => ['placeholder' => awtTrans('رقم الهاتف'), 'class' => 'col-sm-6 form-control', 'style' => 'max-height: 100px;'],
            ])

            ->add('email_address', 'email', [
                // 'rules' => 'required|email',/
                'label' => awtTrans('البريد الالكتروني'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('البريد الالكتروني'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('birth_date', 'text', [
                // 'rules' => 'required',
                'label' => awtTrans('تاريخ الميلاد'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],

                'attr' => ['placeholder' => awtTrans('تاريخ الميلاد'), 'autocomplete' => 'off', 'class' => 'col-sm-6 form-control date-picker-input'],
            ])

            ->add('personal_picture', 'file', [
                'rules' => $this->getData('edit') == 'true' ? '' : '',
                'label' => awtTrans('الصوره الشخصيه'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('الصوره الشخصيه'), 'class' => 'col-sm-4 form-control'],
            ])

            ->add('passport_id', 'text', [
                'rules' => 'required',
                'label' => awtTrans('رقم جواز السفر'),
                'label_attr' => ['class' => 'col-sm-2 form-label required-field', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('رقم جواز السفر'), 'class' => 'col-sm-6 form-control'],
                'default_value' => '0000',

            ])

            ->add('passport_photos[]', 'file', [
                'rules' => $this->getData('edit') == 'true' ? '' : '',
                'label' => awtTrans('صور جواز السفر'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('صور جواز السفر'), 'multiple' => '', 'class' => 'col-sm-4 form-control'],
            ])

            ->add('qualification', 'text', [
                // 'rules' => 'required',
                'label' => awtTrans('المؤهل الدراسي'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('المؤهل الدراسي'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('qualification_certificates[]', 'file', [
                'rules' => $this->getData('edit') == 'true' ? '' : '',
                'label' => awtTrans('شهادات المؤهل الدراسي'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('شهادات المؤهل الدراسي'), 'multiple' => '', 'class' => 'col-sm-4 form-control'],
            ])

            ->add('user_languages', 'textarea', [
                // 'rules' => 'required',
                'label' => awtTrans('اللغات'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'help_block' => [
                    'text' => awtTrans('في حاله اكثر من لغه يرجي وضع كل لغه في سطر منفصل'),
                    'tag' => 'p',
                    'attr' => ['class' => 'form-text col-8 text-right'],
                ],
                'attr' => ['placeholder' => awtTrans('اللغات'), 'class' => 'col-sm-6 form-control', 'style' => 'max-height: 100px;'],
            ])

            ->add('country', 'select', [
                'label' => awtTrans('الدوله'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'choices' => getCountries(),
                'attr' => ['placeholder' => awtTrans('الدوله'), 'class' => 'col-sm-6 form-select selc_country'],
            ])

            ->add('current_employer', 'text', [
                // 'rules' => 'required',
                'label' => awtTrans('الوظيفه الحاليه'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('الوظيفه الحاليه'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('employer_address', 'text', [
                // 'rules' => 'required',
                'label' => awtTrans('عنوان الوظيفه الحاليه'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('عنوان الوظيفه الحاليه'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('employer_phone', 'textarea', [
                // 'rules' => 'required',
                'label' => awtTrans('هاتف العمل'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'help_block' => [
                    'text' => awtTrans('في حاله اكثر من رقم يرجي وضع كل رقم في سطر منفصل'),
                    'tag' => 'p',
                    'attr' => ['class' => 'form-text col-8 text-right'],
                ],
                'attr' => ['placeholder' => awtTrans('هاتف العمل'), 'class' => 'col-sm-6 form-control', 'style' => 'max-height: 100px;'],
            ])

            ->add('employer_email', 'email', [
                // 'rules' => 'required|email',
                'label' => awtTrans('البريد الالكتروني للعمل'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('البريد الالكتروني للعمل'), 'class' => 'col-sm-6 form-control'],
            ])

            ->add('cv_file', 'file', [
                'rules' => $this->getData('edit') == 'true' ? '' : '',
                'label' => awtTrans('السيره الذاتيه'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('السيره الذاتيه'), 'class' => 'col-sm-4 form-control'],
            ])

            ->add('health_certificates[]', 'file', [
                'rules' => $this->getData('edit') == 'true' ? '' : '',
                'label' => awtTrans('الشهادات الصحيه'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('الشهادات الصحيه'), 'multiple' => '', 'class' => 'col-sm-4 form-control'],
            ])

            ->add('other_certificates[]', 'file', [
                'rules' => $this->getData('edit') == 'true' ? '' : '',
                'label' => awtTrans('شهادات اخري'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'attr' => ['placeholder' => awtTrans('شهادات اخري'), 'multiple' => '', 'class' => 'col-sm-4 form-control'],
            ])

            ->add('trainee_status', 'select', [
                'rules' => 'required',
                'label' => awtTrans('حاله المتدرب'),
                'label_attr' => ['class' => 'col-sm-2 form-label required-field', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'choices' => ['primary' => awtTrans('اساسي'), 'secondary' => awtTrans('احتياطي')],
                'selected' => 'primary',
                'attr' => ['placeholder' => awtTrans('حاله المتدرب'), 'class' => 'col-sm-6 form-select selc_stats'],
            ])
            ->add('wait_list', 'select', [
                'rules' => 'required',
                'label' => awtTrans('حاله انتظار المتدرب'),
                'label_attr' => ['class' => 'col-sm-2 form-label required-field', 'for' => $this->name],
                'wrapper' => ['class' => 'mb-3 col-12 row'],
                'choices' => ['true' => awtTrans('في  قائمه الانتظار'), 'false' => awtTrans('ليس في قائمه الانتظار')],
                'selected' => 'false',
                'attr' => ['placeholder' => awtTrans('حاله انتظار المتدرب'), 'class' => 'col-sm-6 form-select selc_stats'],
            ]);

        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'mb-3 col-md-2 me-2 my-2'],
            'attr' => ['class' => 'btn btn-primary w-100'],
        ]);
        $this->add('back', 'static', [
            'label' => false,
            'tag' => 'a', // Tag to be used for holding static data,
            'wrapper' => ['class' => 'mb-3 col-md-2 my-2'],
            'attr' => ['class' => 'btn btn-danger w-100', 'href' => route('applicants.index')],
            'value' => trans('main.back'), // If nothing is passed, data is pulled from model if any
        ]);
    }
}
