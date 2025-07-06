<?php

namespace App\Forms;

use App\Models\JobType;
use Illuminate\Support\Facades\App;
use Kris\LaravelFormBuilder\Form;

class JobForm extends Form
{
    public function buildForm()
    {
        $formControlClass = 'col-sm-12 form-control';
        $formSelectClass = 'col-sm-12 form-select';
        $labelClass = 'col-sm-2 form-label';
        $wrapperClass = 'mb-3 row';
        
        // Get existing model data for edit mode
        $model = $this->getData('model');

        $this
            // Job Code (Language Selection)
            ->add('code', 'select', [
                'rules' => 'required',
                'label' => awtTrans('اللغة'),
                'label_attr' => ['class' => $labelClass, 'for' => 'code'],
                'wrapper' => ['class' => $wrapperClass],
                'choices' => [
                    '' => awtTrans('اختر اللغة'),
                    'ar' => awtTrans('اللغة العربية'),
                    'en' => awtTrans('اللغة الإنجليزية'),
                    'fr' => awtTrans('اللغة الفرنسية'),
                ],
                'selected' => $model ? $model->code : null,
                'attr' => [
                    'class' => $formSelectClass,
                    'id' => 'code',
                ],
            ])

            ->add('job_type_id', 'entity', [
                'rules' => 'required',
                'label' => awtTrans('نوع الوظيفة'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label', 'for' => $this->name],
                'wrapper' => ['class' => 'form-group row'],
                'class' => \App\Models\JobType::class,
                'property' => App::getLocale() == 'ar' ? 'name_ar' : 'name_en',
                'query_builder' => function (JobType $type) {
                    // If query builder option is not provided, all data is fetched
                    return $type;
                },
                'attr' => ['placeholder' => awtTrans('نوع الوظيفة'), 'class' => 'col-sm-6 form-control'],
            ])
            
            // Job Name
            ->add('name', 'text', [
                'rules' => 'required|string|max:255',
                'label' => awtTrans('اسم الوظيفة'),
                'label_attr' => ['class' => $labelClass, 'for' => 'name'],
                'wrapper' => ['class' => $wrapperClass],
                'value' => $model ? $model->name : null,
                'attr' => [
                    'placeholder' => awtTrans('أدخل اسم الوظيفة'),
                    'class' => $formControlClass,
                    'id' => 'name'
                ],
            ])
            
            // Job Image
            ->add('image', 'file', [
                'rules' => $model ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp' : 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
                'label' => awtTrans('صورة الوظيفة'),
                'label_attr' => ['class' => $labelClass, 'for' => 'image'],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    'class' => $formControlClass,
                    'accept' => 'image/*',
                    'id' => 'image'
                ],
                'help_block' => [
                    'text' => $model && $model->image ? 
                        awtTrans('الصورة الحالية: ') . basename($model->image) . ' - ' . awtTrans('اختر صورة جديدة للاستبدال') :
                        awtTrans('اختر صورة للوظيفة (الحد الأقصى: 2 ميجابايت)'),
                    'tag' => 'small',
                    'attr' => ['class' => 'text-muted']
                ]
            ])
             ->add('job_images[]', 'file', [
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
            
            // Job Content
            ->add('content', 'textarea', [
                'rules' => 'required|string',
                'label' => awtTrans('وصف الوظيفة'),
                'label_attr' => ['class' => $labelClass, 'for' => 'content'],
                'wrapper' => ['class' => $wrapperClass],
                'value' => $model ? $model->content : null,
                'attr' => [
                    'placeholder' => awtTrans('اكتب وصف مفصل للوظيفة'),
                    'class' => $formControlClass . ' summernote',
                    'rows' => 6,
                    'id' => 'content'
                ],
            ])
            
            // Countries
            ->add('country_id', 'select', [
                'rules' => 'required|array|min:1',
                'label' => awtTrans('الدول المتاحة'),
                'label_attr' => ['class' => $labelClass, 'for' => 'country_id'],
                'wrapper' => ['class' => $wrapperClass],
                'choices' => $this->getCountryChoices(),
                'selected' => $model && $model->country_id ? $model->country_id : [],
                'attr' => [
                    'class' => 'col-sm-12 select2-multiple',
                    'id' => 'country_id',
                    'multiple' => true,
                    'data-placeholder' => awtTrans('اختر الدول المتاحة للتقديم')
                ],
            ])
            
            // Tags
            ->add('tags', 'text', [
                'rules' => 'nullable|string',
                'label' => awtTrans('الكلمات المفتاحية'),
                'label_attr' => ['class' => $labelClass, 'for' => 'tags'],
                'wrapper' => ['class' => $wrapperClass],
                'value' => $model && $model->tags ? (is_array($model->tags) ? implode(',', $model->tags) : $model->tags) : null,
                'attr' => [
                    // 'placeholder' => awtTrans('أدخل الكلمات المفتاحية مفصولة بفواصل'),
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
            
            // Start Date
            ->add('start_date', 'date', [
                'rules' => 'required|date|after_or_equal:today',
                'label' => awtTrans('تاريخ بداية التقديم'),
                'label_attr' => ['class' => $labelClass, 'for' => 'start_date'],
                'wrapper' => ['class' => $wrapperClass],
                'value' => $model && $model->start_date ? $model->start_date->format('Y-m-d\TH:i') : null,
                'attr' => [
                    'class' => $formControlClass,
                    'id' => 'start_date',
                    'min' => now()->format('Y-m-d\TH:i')
                ],
            ])
            
            // End Date
            ->add('end_date', 'date', [
                'rules' => 'required|date|after:start_date',
                'label' => awtTrans('تاريخ انتهاء التقديم'),
                'label_attr' => ['class' => $labelClass, 'for' => 'end_date'],
                'wrapper' => ['class' => $wrapperClass],
                'value' => $model && $model->end_date ? $model->end_date->format('Y-m-d\TH:i') : null,
                'attr' => [
                    'class' => $formControlClass,
                    'id' => 'end_date'
                ],
            ])
            
           ->add('requirements', 'text', [
                'rules' => 'nullable',
                'label' => awtTrans('requirements'),
                'label_attr' => ['class' => $labelClass, 'for' => $this->name],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    // 'placeholder' => awtTrans('enter_requirements'),
                    'class' => 'form-control input-tags tags',
                    'data-role' => 'tagsinput',
                    'id'=>"tags"
                ],
            ])
            ->add('benefit', 'text', [
                'rules' => 'nullable',
                'label' => awtTrans('benefits'),
                'label_attr' => ['class' => $labelClass, 'for' => $this->name],
                'wrapper' => ['class' => $wrapperClass],
                'attr' => [
                    // 'placeholder' => awtTrans('enter_benefits'),
                    'class' => 'form-control input-tags tags',
                    'data-role' => 'tagsinput'
                ],
            ])
            
            // Active Status
            ->add('is_active', 'checkbox', [
                'rules' => 'nullable|boolean',
                'label' => awtTrans('نشط'),
                'label_attr' => ['class' => 'col-sm-2 col-form-label'],
                'wrapper' => ['class' => 'form-group row'],
                'value' => 1,
                'checked' => $model ? $model->is_active : true,
                'attr' => [
                    'class' => 'form-check-input',
                    'id' => 'is_active'
                ],
                'help_block' => [
                    'text' => awtTrans('قم بإلغاء التحديد لإخفاء الوظيفة من القائمة العامة'),
                    'tag' => 'small',
                    'attr' => ['class' => 'text-muted ms-4']
                ]
                ]);
            
            // Additional Images
            // ->add('job_images', 'file', [
            //     'rules' => 'nullable|array|max:5',
            //     'label' => awtTrans('صور إضافية'),
            //     'label_attr' => ['class' => $labelClass, 'for' => 'job_images'],
            //     'wrapper' => ['class' => $wrapperClass],
            //     'attr' => [
            //         'class' => $formControlClass,
            //         'multiple' => 'multiple',
            //         'accept' => 'image/*',
            //         'id' => 'job_images'
            //     ],
            //     'help_block' => [
            //         'text' => awtTrans('يمكنك رفع حتى 5 صور إضافية (الحد الأقصى لكل صورة: 2 ميجابايت)'),
            //         'tag' => 'small',
            //         'attr' => ['class' => 'text-muted']
            //     ]
            // ]);

        // Submit Button
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

    /**
     * Get country choices for the select field
     */
    private function getCountryChoices()
    {
        $countries = getCountries(); // Your existing function
        
        // Add empty option at the beginning
        return ['' => awtTrans('اختر الدول')] + $countries;
    }

}