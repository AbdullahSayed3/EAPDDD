@extends('layouts.master')

@section('content')
    <!--page title-->
<x-base.breadcrumb 
    title="{{ request()->routeIs('blogs.create') 
        ? awtTrans('create') . ' ' . (App::getLocale() == 'en' ? 'Blogs' : 'المقالات')
        : awtTrans('edit') . ' ' . (App::getLocale() == 'en' ? 'Blogs' : 'المقالات') }}" 
    :translate="false" 
    :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => App::getLocale() == 'en' ? 'Blogs' : 'المقالات', 'url' => route($route . '.index')],
        ['label' => request()->routeIs('blogs.create') 
            ? awtTrans('create') 
            : awtTrans('edit') . ' ' . (App::getLocale() == 'en' ? 'Blogs' : 'المقالات')],
    ]" 
/>
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">
                
                <div class="card-body">

                    @include('flash::message')
 <!-- Add the select all checkbox manually -->
                    {{-- <div class="form-group col-md-12 mb-2">
                        <label>
                            <input type="checkbox" id="select-all-permissions">
                            {{ awtTrans('تحديد / إلغاء تحديد الكل') }}
                        </label>
                    </div> --}}

                    <!-- Render the rest of the form -->
                    {!! form($form) !!}
                
                </div>

               
            </div>

        </div>
    </div>
@endsection
@section('scripts')
<script>
        document.getElementById('select-all-permissions').addEventListener('change', function() {
            console.log('test');
            
            const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
</script>
@endsection
