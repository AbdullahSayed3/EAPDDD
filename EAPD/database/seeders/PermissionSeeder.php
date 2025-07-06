<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Delete Previces Permissions //
        // DB::table('permissions')->delete();
        $data = [

            // Courses
            [
                'name' => 'show_courses',
                'guard_name' => 'web',
                'nice_name' => 'عرض الدورات التدريبية'
            ],

            [
                'name' => 'create_courses',
                'guard_name' => 'web',
                'nice_name' => 'اضافة الدورات التدريبية'
            ],

            [
                'name' => 'edit_courses',
                'guard_name' => 'web',
                'nice_name' => 'تعديل الدورات التدريبية'
            ],

            [
                'name' => 'delete_courses',
                'guard_name' => 'web',
                'nice_name' => 'حذف الدورات التدريبية'
            ],

            // Applicants
            [
                'name' => 'show_applicants',
                'guard_name' => 'web',
                'nice_name' => 'عرض المتدربين'
            ],

            [
                'name' => 'create_applicants',
                'guard_name' => 'web',
                'nice_name' => 'اضافة المتدربين'
            ],

            [
                'name' => 'edit_applicants',
                'guard_name' => 'web',
                'nice_name' => 'تعديل المتدربين'
            ],

            [
                'name' => 'delete_applicants',
                'guard_name' => 'web',
                'nice_name' => 'حذف المتدربين'
            ],



            [
                'name' => 'show_applications',
                'guard_name' => 'web',
                'nice_name' => 'عرض المتدربين'
            ],

            [
                'name' => 'create_applications',
                'guard_name' => 'web',
                'nice_name' => 'اضافة المتدربين'
            ],

            [
                'name' => 'edit_applications',
                'guard_name' => 'web',
                'nice_name' => 'تعديل المتدربين'
            ],

            [
                'name' => 'delete_applications',
                'guard_name' => 'web',
                'nice_name' => 'حذف المتدربين'
            ],

            // Experts
            [
                'name' => 'show_experts',
                'guard_name' => 'web',
                'nice_name' => 'عرض  قسم الخبراء'
            ],

            [
                'name' => 'create_experts',
                'guard_name' => 'web',
                'nice_name' => 'اضافة قسم الخبراء'
            ],

            [
                'name' => 'edit_experts',
                'guard_name' => 'web',
                'nice_name' => 'تعديل قسم الخبراء'
            ],

            [
                'name' => 'delete_experts',
                'guard_name' => 'web',
                'nice_name' => 'حذف قسم الخبراء'
            ],


            // Aids
            [
                'name' => 'show_aids',
                'guard_name' => 'web',
                'nice_name' => 'عرض  المنح و المعونات'
            ],

            [
                'name' => 'create_aids',
                'guard_name' => 'web',
                'nice_name' => 'اضافة المنح و المعونات'
            ],

            [
                'name' => 'edit_aids',
                'guard_name' => 'web',
                'nice_name' => 'تعديل المنح و المعونات'
            ],

            [
                'name' => 'delete_aids',
                'guard_name' => 'web',
                'nice_name' => 'حذف المنح و المعونات'
            ],

            // trial Trials
            [
                'name' => 'show_teral_terials',
                'guard_name' => 'web',
                'nice_name' => 'عرض التعاون الثلاثي'
            ],

            [
                'name' => 'create_teral_terials',
                'guard_name' => 'web',
                'nice_name' => 'اضافة التعاون الثلاثي'
            ],

            [
                'name' => 'edit_teral_terials',
                'guard_name' => 'web',
                'nice_name' => 'تعديل التعاون الثلاثي'
            ],

            [
                'name' => 'delete_teral_terials',
                'guard_name' => 'web',
                'nice_name' => 'حذف التعاون الثلاثي'
            ],


            // trial events
            [
                'name' => 'show_events',
                'guard_name' => 'web',
                'nice_name' => 'عرض الفاعليات'
            ],

            [
                'name' => 'create_events',
                'guard_name' => 'web',
                'nice_name' => 'اضافة الفاعليات'
            ],

            [
                'name' => 'edit_events',
                'guard_name' => 'web',
                'nice_name' => 'تعديل الفاعليات'
            ],

            [
                'name' => 'delete_events',
                'guard_name' => 'web',
                'nice_name' => 'حذف الفاعليات'
            ],


            //  settings
            [
                'name' => 'show_settings',
                'guard_name' => 'web',
                'nice_name' => 'عرض اعدادات النظام'
            ],
            [
                'name' => 'edit_settings',
                'guard_name' => 'web',
                'nice_name' => 'تعديل اعدادات النظام'
            ],

            // Scholarships

            [
                'name' => 'show_scholarships',
                'guard_name' => 'web',
                'nice_name' => 'عرض المنح الدراسية'
            ],

            [
                'name' => 'create_scholarships',
                'guard_name' => 'web',
                'nice_name' => 'اضافة المنح الدراسية'
            ],

            [
                'name' => 'edit_scholarships',
                'guard_name' => 'web',
                'nice_name' => 'تعديل المنح الدراسية'
            ],

            [
                'name' => 'delete_scholarships',
                'guard_name' => 'web',
                'nice_name' => 'حذف المنح الدراسية'
            ],


            // assessment

            [
                'name' => 'show_assessment',
                'guard_name' => 'web',
                'nice_name' => 'عرض التقييمات'
            ],

            [
                'name' => 'create_assessment',
                'guard_name' => 'web',
                'nice_name' => 'اضافة التقييمات'
            ],

            [
                'name' => 'edit_assessment',
                'guard_name' => 'web',
                'nice_name' => 'تعديل التقييمات'
            ],

            [
                'name' => 'delete_assessment',
                'guard_name' => 'web',
                'nice_name' => 'حذف التقييمات'
            ],



            // Parteners
            [
                'name' => 'mange_website',
                'guard_name' => 'web',
                'nice_name' => 'ادارة الموقع'
            ],
            [
                'name' => 'show_partner',
                'guard_name' => 'web',
                'nice_name' => 'عرض الشركاء'
            ],

            [
                'name' => 'create_partner',
                'guard_name' => 'web',
                'nice_name' => 'اضافة الشركاء'
            ],

            [
                'name' => 'edit_partner',
                'guard_name' => 'web',
                'nice_name' => 'تعديل الشركاء'
            ],

            [
                'name' => 'delete_partner',
                'guard_name' => 'web',
                'nice_name' => 'حذف الشركاء'
            ],

            [
                'name' => 'show_faq',
                'guard_name' => 'web',
                'nice_name' => 'عرض التعليمات'
            ],

            [
                'name' => 'create_faq',
                'guard_name' => 'web',
                'nice_name' => 'اضافة التعليمات'
            ],

            [
                'name' => 'edit_faq',
                'guard_name' => 'web',
                'nice_name' => 'تعديل التعليمات'
            ],

            [
                'name' => 'delete_faq',
                'guard_name' => 'web',
                'nice_name' => 'حذف التعليمات'
            ],


            [
                'name' => 'show_blogs',
                'guard_name' => 'web',
                'nice_name' => 'عرض المدونة'
            ],

            [
                'name' => 'create_blogs',
                'guard_name' => 'web',
                'nice_name' => 'اضافة المدونة'
            ],

            [
                'name' => 'edit_blogs',
                'guard_name' => 'web',
                'nice_name' => 'تعديل المدونة'
            ],
            [
                'name' => 'delete_blogs',
                'guard_name' => 'web',
                'nice_name' => 'حذف المدونة'
            ],

            [
                'name' => 'show_teams',
                'guard_name' => 'web',
                'nice_name' => 'عرض فريق العمل'
            ],

            [
                'name' => 'create_teams',
                'guard_name' => 'web',
                'nice_name' => 'اضافة فريق العمل'
            ],

            [
                'name' => 'edit_teams',
                'guard_name' => 'web',
                'nice_name' => 'تعديل فريق العمل'
            ],
            [
                'name' => 'delete_teams',
                'guard_name' => 'web',
                'nice_name' => 'حذف فريق العمل'
            ],


            [
                'name' => 'show_contact_us',
                'guard_name' => 'web',
                'nice_name' => 'عرض تواصل معنا'
            ],


            // learners
            [
                'name' => 'show_learners',
                'guard_name' => 'web',
                'nice_name' => 'عرض الدارسين'
            ],

            [
                'name' => 'create_learners',
                'guard_name' => 'web',
                'nice_name' => 'اضافة الدارسين'
            ],

            [
                'name' => 'edit_learners',
                'guard_name' => 'web',
                'nice_name' => 'تعديل الدارسين'
            ],

            [
                'name' => 'delete_learners',
                'guard_name' => 'web',
                'nice_name' => 'حذف الدارسين'
            ],


            // learners
            [
                'name' => 'show_jobs',
                'guard_name' => 'web',
                'nice_name' => 'عرض فرص العمل'
            ],

            [
                'name' => 'create_jobs',
                'guard_name' => 'web',
                'nice_name' => 'اضافة فرص العمل'
            ],

            [
                'name' => 'edit_jobs',
                'guard_name' => 'web',
                'nice_name' => 'تعديل فرص العمل'
            ],

            [
                'name' => 'delete_jobs',
                'guard_name' => 'web',
                'nice_name' => 'حذف فرص العمل'
            ],



            [
                'name' => 'show_achivements',
                'guard_name' => 'web',
                'nice_name' => 'عرض الانجازات'
            ],
            [
                'name' => 'create_achivements',
                'guard_name' => 'web',
                'nice_name' => 'اضافة الانجازات'
            ],
            [
                'name' => 'edit_achivements',
                'guard_name' => 'web',
                'nice_name' => 'تعديل الانجازات'
            ],
            [
                'name' => 'delete_achivements',
                'guard_name' => 'web',
                'nice_name' => 'حذف الانجازات'
            ],

            // learners
            [
                'name' => 'show_course_partners',
                'guard_name' => 'web',
                'nice_name' => 'عرض مراكز التميز والشركاء'
            ],

            [
                'name' => 'create_course_partners',
                'guard_name' => 'web',
                'nice_name' => 'اضافة مراكز التميز والشركاء'
            ],

            [
                'name' => 'edit_course_partners',
                'guard_name' => 'web',
                'nice_name' => 'تعديل مراكز التميز والشركاء'
            ],

            [
                'name' => 'delete_course_partners',
                'guard_name' => 'web',
                'nice_name' => 'حذف مراكز التميز والشركاء'
            ],



            // Countries
            [
                'name' => 'show_countries',
                'guard_name' => 'web',
                'nice_name' => 'عرض ألدول'
            ],

            [
                'name' => 'create_countries',
                'guard_name' => 'web',
                'nice_name' => 'اضافة ألدول'
            ],

            [
                'name' => 'edit_countries',
                'guard_name' => 'web',
                'nice_name' => 'تعديل ألدول'
            ],

            [
                'name' => 'delete_countries',
                'guard_name' => 'web',
                'nice_name' => 'حذف ألدول'
            ],

            [
                'name' => 'show_place',
                'guard_name' => 'web',
                'nice_name' => 'عرض اماكن الانعقاد الدورات التدريبية'
            ],

            [
                'name' => 'create_place',
                'guard_name' => 'web',
                'nice_name' => 'اضافة اماكن الانعقاد الدورات التدريبية'
            ],

            [
                'name' => 'edit_place',
                'guard_name' => 'web',
                'nice_name' => 'تعديل اماكن الانعقاد الدورات التدريبية'
            ],

            [
                'name' => 'delete_place',
                'guard_name' => 'web',
                'nice_name' => 'حذف اماكن الانعقاد الدورات التدريبية'
            ],

            [
                'name' => 'show_country',
                'guard_name' => 'web',
                'nice_name' => 'عرض الدول'
            ],

            [
                'name' => 'create_country',
                'guard_name' => 'web',
                'nice_name' => 'اضافة الدول'
            ],

            [
                'name' => 'edit_country',
                'guard_name' => 'web',
                'nice_name' => 'تعديل الدول'
            ],

            [
                'name' => 'delete_country',
                'guard_name' => 'web',
                'nice_name' => 'حذف الدول'
            ],


            [
                'name' => 'show_reports',
                'guard_name' => 'web',
                'nice_name' => 'عرض التقارير'
            ],


        ];

        $admin = Role::firstOrCreate(['name' => 'SystemManager', 'guard_name' => 'web']);

        foreach ($data as $d) {
            Permission::firstOrCreate($d);
            $admin->givePermissionTo($d['name']);
        }
    }
}
