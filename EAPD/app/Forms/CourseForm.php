<?php

namespace App\Forms;

use App\Models\CourseField;
use App\Models\CourseNatural;
use App\Models\CoursePartner;
use App\Models\CourseTrianee;
use App\Models\Place;
use Illuminate\Support\Facades\App;
use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\URL;

class CourseForm extends Form
{
    public function buildForm()
    {
        $defaultCountry = [];
        $url = URL::current();

        if (str_contains($url, 'create')) {
            $defaultCountry = [
                'BJ',
                'BW',
                'BF',
                'BI',
                'CM',
                'CV',
                'CF',
                'TD',
                'KM',
                'CD',
                'CG',
                'CI',
                'DJ',
                'GQ',
                'ER',
                'ET',
                'GA',
                'GM',
                'GH',
                'KE',
                'LS',
                'LR',
                'MG',
                'MW',
                'ML',
                'MR',
                'MU',
                'MZ',
                'NA',
                'NE',
                'NG',
                'PG',
                'RW',
                'ST',
                'SN',
                'SC',
                'SL',
                'SO',
                'ZA',
                'SS',
                'TZ',
                'TG',
                'UG',
                'ZM',
                'ZW',
            ];
        } elseif (str_contains($url, 'edit') && isset($this->model['countries'])) {
            $defaultCountry = $this->model['countries'];
        }

        // Format dates if they exist
        if (isset($this->model['start_date'])) {
            $this->model['start_date'] = date('Y-m-d', strtotime($this->model['start_date']));
        }
        if (isset($this->model['end_date'])) {
            $this->model['end_date'] = date('Y-m-d', strtotime($this->model['end_date']));
        }

        // Common attributes
        $formControlClass = 'col-sm-6 form-control';
        $formSelectClass = 'col-sm-6 form-select';
        $labelClass = 'col-sm-2 form-label';
        $wrapperClass = 'mb-3 row';

        $this
            ->add('is_active', 'checkbox', [
                'label' => awtTrans('نشط؟'),
                'label_attr' => ['class' => $labelClass],
                'wrapper' => ['class' => 'form-group row'],
                'default_value' => 1,
                'value' => 1,
                'checked' => isset($this->model) ? $this->is_active : false,
                'attr' => [
                    'class' => 'form-check-input',
                    'data-toggle' => 'toggle', // If you're using bootstrap toggle
                    'data-on' => awtTrans('نشط'),
                    'data-off' => awtTrans('غير نشط'),
                ],
            ])
            ->add('name_ar', 'text', [
                'rules' => 'required',
                'label' => awtTrans('اسم الدورة التدريبية'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_name_ar'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('الموضوع الرئيسي'),
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
            ->add('type_id', 'select', [
                'rules' => 'required',
                'label' => awtTrans('نوع الدورة'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_type_id'],
                'wrapper' => ['class' => $wrapperClass],
                'choices' => [
                    'citizan' => awtTrans('مدني'),
                    'army' => awtTrans('الجيش'),
                    'police' => awtTrans('الشرطه')
                ],
                'attr' => [
                    'placeholder' => awtTrans('نوع الدورة'),
                    'class' => $formSelectClass,
                    'id' => 'course_type_id',
                    'data-bs-toggle' => 'select2'
                ],
            ])
            ->add('natural_id', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('طبيعة الدورة'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_natural_id'],
                'wrapper' => ['class' => $wrapperClass],
                'class' => CourseNatural::class,
                'property' => App::getLocale() == 'ar' ? 'name_ar' : 'name_en',
                'query_builder' => function (CourseNatural $type) {
                    return $type;
                },
                'attr' => [
                    'placeholder' => awtTrans('طبيعة الدورة'),
                    'class' => $formSelectClass,
                    'id' => 'course_natural_id',
                    'data-bs-toggle' => 'select2'
                ],
            ])
            ->add('field_id', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('مجال التعاون'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_field_id'],
                'wrapper' => ['class' => $wrapperClass],
                'class' => CourseField::class,
                'property' => App::getLocale() == 'ar' ? 'name_ar' : 'name_en',
                'query_builder' => function (CourseField $type) {
                    return $type;
                },
                'attr' => [
                    'placeholder' => awtTrans('مجال التعاون'),
                    'class' => $formSelectClass,
                    'id' => 'course_field_id',
                    'data-bs-toggle' => 'select2'
                ],
            ])
            ->add('content', 'textarea', [
                'rules' => 'required',
                'label' => trans('awt.بالعربية المحتوري'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_content'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('المحتوى'),
                    'class' => $formControlClass,
                    'id' => 'course_content',
                    'autocomplete' => 'off'
                ],
            ])

            ->add('content_en', 'textarea', [
                'rules' => 'required',
                'label' => trans('awt.بالانجليزية المحتوري'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_content'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('المحتوى'),
                    'class' => $formControlClass,
                    'id' => 'course_content',
                    'autocomplete' => 'off'
                ],
            ])
            ->add('content_fr', 'textarea', [
                'rules' => 'required',
                'label' => trans('awt.بالفرنسية المحتوري'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_content'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('المحتوى'),
                    'class' => $formControlClass,
                    'id' => 'course_content',
                    'autocomplete' => 'off'
                ],
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
            //    ->add('images[]', 'file', [
            //     'label' => awtTrans('صور'),
            //     'label_attr' => ['class' => $labelClass, 'for' => 'images[]'],
            //     'wrapper' => ['class' => $wrapperClass],
            //     'attr' => [
            //         'placeholder' => awtTrans('صور'),
            //         'class' => $formControlClass,
            //         'id' => 'images',
            //         'multiple' => true,
            //         'accept' => 'image/*',
            //         'onchange' => 'limitImageUpload(this, 2)',
            //     ],
            //     'value' => null,  // IMPORTANT: No value for file input!
            // ])
            ->add('images[]', 'file', [
                'label' => awtTrans('صور'),
                'label_attr' => ['class' => $labelClass, 'for' => 'images'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('صور'),
                    'class' => $formControlClass,
                    'id' => 'course_documents',
                    'multiple' => 'true',
                    'onchange' => 'limitImageUpload(this, 2)'
                ],
            ])
            // Tags
            ->add('benefit_ar', 'text', [
                'rules' => 'nullable|string',
                'label' => awtTrans('benefit_ar'),
                'label_attr' => ['class' => $labelClass, 'for' => 'tags'],
                'wrapper' => ['class' => $wrapperClass],
                'value' => $this->model && $this->benefit_ar ? (is_array($this->benefit_ar) ? implode(',', $this->benefit_ar) : $this->benefit_ar) : null,
                'attr' => [
                    'class' => $formControlClass . ' input-tags',
                    'data-role' => 'tagsinput',
                    'id' => 'tags'
                ],
                'help_block' => [
                    'text' => awtTrans('مثال: تقنية، برمجة، تطوير، إدارة'),
                    'tag' => 'small',
                    'attr' => ['class' => 'text-muted']
                ]
            ])

            ->add('benefit_en', 'text', [
                'rules' => 'nullable|string',
                'label' => awtTrans('benefit_en'),
                'label_attr' => ['class' => $labelClass, 'for' => 'tags'],
                'wrapper' => ['class' => $wrapperClass],
                'value' => $this->model && $this->benefit_en ? (is_array($this->benefit_en) ? implode(',', $this->benefit_en) : $this->benefit_en) : null,
                'attr' => [
                    'class' => $formControlClass . ' input-tags',
                    'data-role' => 'tagsinput',
                    'id' => 'tags'
                ],
                'help_block' => [
                    'text' => awtTrans('مثال: تقنية، برمجة، تطوير، إدارة'),
                    'tag' => 'small',
                    'attr' => ['class' => 'text-muted']
                ]
            ])


            ->add('benefit_fr', 'text', [
                'rules' => 'nullable|string',
                'label' => awtTrans('benefits_fr'),
                'label_attr' => ['class' => $labelClass, 'for' => 'tags'],
                'wrapper' => ['class' => $wrapperClass],
                'value' => $this->model && $this->benefit_fr ? (is_array($this->benefit_fr) ? implode(',', $this->benefit_fr) : $this->benefit_fr) : null,
                'attr' => [
                    'class' => $formControlClass . ' input-tags',
                    'data-role' => 'tagsinput',
                    'id' => 'tags'
                ],
                'help_block' => [
                    'text' => awtTrans('مثال: تقنية، برمجة، تطوير، إدارة'),
                    'tag' => 'small',
                    'attr' => ['class' => 'text-muted']
                ]
            ])

            // Tags
            ->add('requirement_ar', 'text', [
                'rules' => 'nullable|string',
                'label' => awtTrans('requirement_ar'),
                'label_attr' => ['class' => $labelClass, 'for' => 'tags'],
                'wrapper' => ['class' => $wrapperClass],
                'value' => $this->model && $this->requirement_ar ? (is_array($this->requirement_ar) ? implode(',', $this->requirement_ar) : $this->requirement_ar) : null,
                'attr' => [
                    'class' => $formControlClass . ' input-tags',
                    'data-role' => 'tagsinput',
                    'id' => 'tags'
                ],
                'help_block' => [
                    'text' => awtTrans('مثال: تقنية، برمجة، تطوير، إدارة'),
                    'tag' => 'small',
                    'attr' => ['class' => 'text-muted']
                ]
            ])

            ->add('requirement_en', 'text', [
                'rules' => 'nullable|string',
                'label' => awtTrans('requirement_en'),
                'label_attr' => ['class' => $labelClass, 'for' => 'tags'],
                'wrapper' => ['class' => $wrapperClass],
                'value' => $this->model && $this->requirement_en ? (is_array($this->requirement_en) ? implode(',', $this->requirement_en) : $this->requirement_en) : null,
                'attr' => [
                    'class' => $formControlClass . ' input-tags',
                    'data-role' => 'tagsinput',
                    'id' => 'tags'
                ],
                'help_block' => [
                    'text' => awtTrans('مثال: تقنية، برمجة، تطوير، إدارة'),
                    'tag' => 'small',
                    'attr' => ['class' => 'text-muted']
                ]
            ])


            ->add('requirement_fr', 'text', [
                'rules' => 'nullable|string',
                'label' => awtTrans('requirement_fr'),
                'label_attr' => ['class' => $labelClass, 'for' => 'tags'],
                'wrapper' => ['class' => $wrapperClass],
                'value' => $this->model && $this->requirement_fr ? (is_array($this->requirement_fr) ? implode(',', $this->requirement_fr) : $this->requirement_fr) : null,
                'attr' => [
                    'class' => $formControlClass . ' input-tags',
                    'data-role' => 'tagsinput',
                    'id' => 'tags'
                ],
                'help_block' => [
                    'text' => awtTrans('مثال: تقنية، برمجة، تطوير، إدارة'),
                    'tag' => 'small',
                    'attr' => ['class' => 'text-muted']
                ]
            ])



            ->add('start_date', 'text', [
                'rules' => 'required',
                'label' => awtTrans('تاريخ البدء'),
                'label_attr' => ['class' => $labelClass, 'for' => 'start_date'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('تاريخ البدء'),
                    'class' => $formControlClass . ' date-picker-input',
                    'id' => 'start_date',
                    'autocomplete' => 'off',
                    'data-bs-datepicker' => 'true'
                ],
            ])
            ->add('end_date', 'text', [
                'rules' => 'required',
                'label' => awtTrans('تاريخ الإنتهاء'),
                'label_attr' => ['class' => $labelClass, 'for' => 'end_date'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('تاريخ الإنتهاء'),
                    'class' => $formControlClass . ' date-picker-input',
                    'id' => 'end_date',
                    'autocomplete' => 'off',
                    'data-bs-datepicker' => 'true'
                ],
            ])
            ->add('place_id', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('مكان الإنعقاد'),
                'label_attr' => ['class' => $labelClass, 'for' => 'place_id'],
                'wrapper' => ['class' => $wrapperClass],
                'class' => Place::class,
                'property' => App::getLocale() == 'en' ? 'name_en' : 'name_ar',
                'query_builder' => function (Place $place) {
                    return $place->orderBy(App::getLocale() == 'en' ? 'name_en' : 'name_ar');
                },
                'attr' => [
                    'placeholder' => awtTrans('مكان الإنعقاد'),
                    'class' => $formSelectClass . ' select2-place',
                    'id' => 'place_id',
                    'data-placeholder' => awtTrans('مكان الإنعقاد')
                ],
                'empty_value' => awtTrans('إختر مكان الإنعقاد'),
                'empty_data' => null,
            ])
            ->add('organization_id', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('الجهة المنظمة'),
                'label_attr' => ['class' => $labelClass, 'for' => 'organization_id'],
                'wrapper' => ['class' => $wrapperClass],
                'class' => CoursePartner::class,
                'property' => 'name',
                'query_builder' => function (CoursePartner $type) {
                    return $type;
                },
                'attr' => [
                    'placeholder' => awtTrans('الجهة المنظمة'),
                    'class' => $formSelectClass,
                    'id' => 'organization_id',
                    'data-bs-toggle' => 'select2'
                ],
            ])
            ->add('documents[]', 'file', [
                'label' => awtTrans('وثائق ذات صلة'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_documents'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('وثائق ذات صلة'),
                    'class' => $formControlClass,
                    'id' => 'course_documents',
                    'multiple' => 'true'
                ],
            ])
            ->add('countries', 'select', [
                'rules' => 'required',
                'label' => awtTrans('الدول المدعوة'),
                'label_attr' => ['class' => 'col-sm-2 form-label', 'for' => 'course_countries'],
                'wrapper' => ['class' => 'mb-3 row'],
                'choices' => getCountries(),
                'attr' => [
                    'class' => 'col-sm-6 select2-multiple',
                    'id' => 'course_countries',
                    'multiple' => true,
                    'data-placeholder' => awtTrans('اختر الدول'),
                    'data-bs-toggle' => 'select2'
                ],
            ])
            ->add('trainees', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('اسم منسق الدورة'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_trainees'],
                'wrapper' => ['class' => $wrapperClass],
                'class' => CourseTrianee::class,
                'property' => 'name_ar',
                'query_builder' => function (CourseTrianee $type) {
                    return $type;
                },
                'attr' => [
                    'class' => 'col-sm-6 select2-multiple',
                    'id' => 'course_trainees',
                    'multiple' => true,
                    'data-placeholder' => awtTrans('اختر المنسقين')
                ],
            ])
            ->add('notes', 'textarea', [
                'label' => awtTrans('ملاحظات أخرى'),
                'label_attr' => ['class' => $labelClass, 'for' => 'course_notes'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'placeholder' => awtTrans('ملاحظات أخرى'),
                    'class' => $formControlClass,
                    'id' => 'course_notes',
                    'autocomplete' => 'off'
                ],
            ]);

        $this->add('back', 'static', [
            'label' => false,
            'tag' => 'a',
            'wrapper' => ['class' => 'col-md-2 me-2'],
            'attr' => [
                'class' => 'btn btn-danger w-100',
                'href' => route('courses.index'),
                'id' => 'course_back_btn'
            ],
            'value' => trans('main.back'),
        ]);

        $this->add('submit', 'submit', [
            'label' => trans('main.save'),
            'wrapper' => ['class' => 'col-md-2'],
            'attr' => [
                'class' => 'btn btn-primary w-100',
                'id' => 'course_submit_btn'
            ],
        ]);
    }
}
