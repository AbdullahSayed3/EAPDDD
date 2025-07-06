<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ExpertForm extends Form
{
    public function buildForm()
    {
     $backUrl = $this->getModel()
    ? route('experts.show', $this->model['id'])  // Edit mode: go to show
    : route('experts.index');        
        if (isset($this->model['contract_date'])) {
            $this->model['contract_date'] = date('Y-m-d', strtotime($this->model['contract_date']));
        }
        if (isset($this->model['end_date'])) {
            $this->model['end_date'] = date('Y-m-d', strtotime($this->model['end_date']));
        }
        $this
            ->add('name', 'text', [
                'rules' => 'required',
                'label' => awtTrans('الاسم'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('الاسم'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('country', 'select', [
                'rules' => 'required',
                'label' => awtTrans('الدولة'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'choices' => getCountries(),
                'attr' => ['placeholder' => awtTrans('اختر الدولة'), 'class' => 'col-sm-6 form-control selc_country'],
            ])
            ->add('specialist', 'text', [
                'rules' => '',
                'label' => awtTrans('التخصص'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('التخصص'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('sub_specialist', 'text', [
                'rules' => '',
                'label' => awtTrans('التخصص الفرعي'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('التخصص الفرعي'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('qualification', 'text', [
                'rules' => '',
                'label' => awtTrans('المؤهل الدراسي'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('المؤهل الدراسي'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('certifications[]', 'file', [
                'rules' => $this->getData('edit') == 'true' ? '' : '',

                'label' => awtTrans('الشهادات'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => trans('main.qualification_certificates'), 'multiple' => '', 'class' => 'col-sm-4 form-control'],
            ])
            ->add('gender', 'select', [
                'rules' => '',
                'label' => awtTrans('النوع'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'choices' => ['male' => awtTrans('ذكر'), 'female' => awtTrans('انثي')],

                'attr' => ['placeholder' => awtTrans('النوع'), 'class' => 'col-sm-6 form-control selc_gender'],
            ])
            ->add('personal_picture', 'file', [
                'rules' => $this->getData('edit') == 'true' ? '' : '',

                'label' => awtTrans('صورة شخصية'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('صورة شخصية'), 'class' => 'col-sm-4 form-control '],
            ])
            ->add('passport_number', 'text', [
                'rules' => '',
                'label' => awtTrans('رقم جواز السفر'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('رقم جواز السفر'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('passport_photos[]', 'file', [
                'rules' => $this->getData('edit') == 'true' ? '' : '',
                'label' => awtTrans('صورة جواز السفر'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('صورة جواز السفر'), 'multiple' => '', 'class' => 'col-sm-4 form-control '],
            ])
            ->add('user_languages', 'textarea', [
                'rules' => '',
                'label' => awtTrans('اللغات التي يجيدها'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'help_block' => [
                    'text' => trans('main.all_in_lines'),
                    'tag' => 'p',
                    'attr' => ['class' => 'help-block col-8 text-right'],
                ],
                'attr' => ['placeholder' => awtTrans('اللغات التي يجيدها'), 'class' => 'col-sm-6 form-control', 'style' => 'max-height: 100px;'],
            ])
            ->add('current_employer', 'text', [
                'rules' => '',
                'label' => trans('main.current_employer'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => trans('main.current_employer'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('employer_address', 'text', [
                'rules' => '',
                'label' => trans('main.employer_address'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => trans('main.employer_address'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('employer_phone', 'textarea', [
                'rules' => '',
                'label' => trans('main.employer_phone'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'help_block' => [
                    'text' => trans('main.all_in_lines'),
                    'tag' => 'p',
                    'attr' => ['class' => 'help-block col-8 text-right'],
                ],
                'attr' => ['placeholder' => trans('main.employer_phone'), 'class' => 'col-sm-6 form-control', 'style' => 'max-height: 100px;'],
            ])
            ->add('employer_email', 'email', [
                'rules' => '',
                'label' => trans('main.employer_email'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => trans('main.employer_email'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('old_contracts', 'textarea', [
                'label' => awtTrans('سوابق التعاقدات مع الوكالة إن وجدت'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('سوابق التعاقدات مع الوكالة إن وجدت'), 'class' => 'col-sm-6 form-control', 'style' => 'max-height: 100px;'],
            ])
            ->add('cv_file', 'file', [
                'rules' => $this->getData('edit') == 'true' ? '' : '',

                'label' => trans('main.cv_file'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => trans('main.cv_file'), 'class' => 'col-sm-4 form-control'],
            ])
            ->add('phone', 'textarea', [
                'rules' => '',
                'label' => trans('main.phone_number'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'help_block' => [
                    'text' => trans('main.all_in_lines'),
                    'tag' => 'p',
                    'attr' => ['class' => 'help-block col-8 text-right'],
                ],
                'attr' => ['placeholder' => trans('main.phone_number'), 'class' => 'col-sm-6 form-control', 'style' => 'max-height: 100px;'],
            ])
            ->add('email', 'email', [
                'rules' => '',
                'label' => trans('main.email_address'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => trans('main.email_address'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('status', 'select', [
                'rules' => 'required',
                'label' => awtTrans('حالة الخبير'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'choices' => ['current' => awtTrans('خبير حالي'), 'old' => awtTrans('خبير سابق'), 'candidate' => awtTrans('مرشح للعمل')],

                'attr' => ['placeholder' => awtTrans('حالة الخبير'), 'class' => 'col-sm-6 form-control selc_stats'],
            ])
            ->add('contract_rules[]', 'file', [
                'rules' => $this->getData('edit') == 'true' ? '' : '',
                'label' => awtTrans('شروط التعاقد'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => trans('main.qualification_certificates'), 'multiple' => '', 'class' => 'col-sm-4 form-control'],
            ])
            ->add('delegate_country', 'select', [
                'rules' => 'required',
                'label' => awtTrans('الدولة الموفد إليها حالياً'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'choices' => getCountries(),
                'attr' => ['placeholder' => awtTrans('اختر الدولة الموفد إليها حالياً'), 'class' => 'col-sm-6 form-control selc_country'],
            ])
            ->add('delegate_org', 'textarea', [
                'rules' => '',
                'label' => awtTrans('الجهة الموفد إليها حالياً'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('الجهة الموفد إليها حالياً'), 'class' => 'col-sm-6 form-control', 'style' => 'max-height: 100px;'],
            ])
            // //

            ->add('contract_date', 'text', [
                'rules' => 'required',
                'label' => awtTrans('بداية التعاقد'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('بداية التعاقد'), 'autocomplete' => 'off', 'class' => 'col-sm-6 form-control date-picker-input'],
            ])
            ->add('end_date', 'text', [
                'rules' => 'required',
                'label' => awtTrans('نهاية التعاقد'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('نهاية التعاقد'), 'autocomplete' => 'off', 'class' => 'col-sm-6 form-control date-picker-input'],
            ])
            ->add('acceptation_info[]', 'file', [
                'rules' => $this->getData('edit') == 'true' ? '' : '',

                'label' => awtTrans('بيانات الموافقات ذات الصلة'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('بيانات الموافقات ذات الصلة'), 'multiple' => '', 'class' => 'col-sm-4 form-control'],
            ])
            ->add('cost', 'text', [
                'rules' => '',
                'label' => awtTrans('التكلفة السنوية'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group col-12 row'],
                'attr' => ['placeholder' => awtTrans('التكلفة السنوية'), 'class' => 'col-sm-6 form-control'],
            ])
            ->add('notes', 'textarea', [
                'rules' => '',
                'label' => awtTrans('ملاحظات أخرى'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'attr' => ['placeholder' => awtTrans('ملاحظات أخرى'), 'class' => 'col-sm-6 form-control ', 'autocomplete' => 'off'],
            ]);

        //        $this->add('back', 'submit', [
        //            'label' => trans('main.back'),
        //            'wrapper' => ['class' => 'form-group col-12 row col-md-2 pull-left ml-1'],
        //            'attr' => ['class' => 'col-md-12 btn btn-danger ']
        //        ]);
      $this->add('back', 'static', [
    'label' => false,
    'tag' => 'a',
    'wrapper' => ['class' => 'form-group row col-md-2 pull-left ml-1'],
    'attr' => [
        'class' => 'col-md-12 btn btn-danger',
        'href' => $backUrl,
    ],
    'value' => trans('main.back'),
]);
        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'form-group row col-md-2 pull-left'],
            'attr' => ['class' => 'col-md-12 btn btn-primary '],
        ]);

    }
}
