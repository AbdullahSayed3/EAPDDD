@extends('layouts.master')

@section('content')
    <!--page title-->
    <x-base.breadcrumb title=" {{request()->routeIs('partners.create') ?  awtTrans('create') .' '.awtTrans($active)  : awtTrans('edit').' ' .  awtTrans($active) }}" :translate="false" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => $active, 'url' => route($route . '.index')],
        ['label' => request()->routeIs('partners.create') ? awtTrans('create').' ' . awtTrans($active)  : awtTrans('edit').' ' . awtTrans($active)],
    ]" />


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
