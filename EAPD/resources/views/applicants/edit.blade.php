@extends('layouts.master')

@section('content')
    <!--page title-->
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="page-title d-flex align-items-center p-3">

                    <div>
                        <h4 class="weight500 d-inline-block pr-3 mr-3 mb-0 border-right">{{ awtTrans('إضافة متدربين') }}</h4>
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ awtTrans('الصفحة الرئيسية') }}</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route($route . '.index') }}">{{ awtTrans('قائمة المتدربين') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ awtTrans('إضافة متدربين') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <x-base.breadcrumb title="تعديل متدربين" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'قائمة المتدربين', 'url' => route($route . '.index')],
        ['label' => 'تعديل متدربين'],
    ]" />


    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">

                <div class="card-body">

                    @include('flash::message')

                    {!! form($form) !!}
                </div>
            </div>

        </div>
    </div>
@endsection
@section('custom_scripts')
    {{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // const categorySelect = document.getElementById("category");
        const entitySelect = document.getElementById("entity_id");
        const entitySelectionDiv = document.getElementById("entity-selection");
        const contentSelect = document.getElementById("content_type");
        const contentSelectionDiv = document.getElementById("content-selection");

            const packageTypeSelect = document.getElementById("package_type");
            const timesInputDiv = document.getElementById("times-input");
            const durationInputDiv = document.getElementById("duration-input");

        // Data passed from the controller
        // const categories = @json($categories);

        // categorySelect.addEventListener("change", function() {
        //     const selectedCategory = this.value;
        //     entitySelect.innerHTML = '<option value="" selected disabled>Select</option>';
        //     contentSelect.innerHTML = '<option value="" selected disabled>Select Content Type</option>';

        //     if (selectedCategory && categories[selectedCategory]) {
        //         entitySelectionDiv.style.display = "block";
        //         categories[selectedCategory].forEach(entity => {
        //             const option = document.createElement("option");
        //             option.value = entity.id;
        //             option.textContent = entity.name;
        //             entitySelect.appendChild(option);
        //         });
        //     } else {
        //         entitySelectionDiv.style.display = "none";
        //     }
        // });

        // entitySelect.addEventListener("change", function() {
        //     const selectedCategory = categorySelect.value;
        //     const selectedEntityId = this.value;
        //     contentSelect.innerHTML = '<option value="" selected disabled>Select Content Type</option>';

        //     const selectedEntity = categories[selectedCategory].find(entity => entity.id ==
        //         selectedEntityId);
        //     if (selectedEntity && selectedEntity.contents) {
        //         contentSelectionDiv.style.display = "block";
        //         Object.entries(selectedEntity.contents).forEach(([key, value]) => {
        //             if (value) {
        //                 const option = document.createElement("option");
        //                 option.value = key;
        //                 option.textContent = value;
        //                 contentSelect.appendChild(option);
        //             }
        //         });
        //     } else {
        //         contentSelectionDiv.style.display = "none";
        //     }
        // });

        packageTypeSelect.addEventListener("change", function() {
            if (this.value === "times") {
                timesInputDiv.style.display = "block";
                durationInputDiv.style.display = "none";
            } else {
                timesInputDiv.style.display = "none";
                durationInputDiv.style.display = "block";
            }
        });
    });
</script> --}}
@endsection
