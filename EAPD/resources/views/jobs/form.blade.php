@extends('layouts.master')

@section('content')
    <!--page title-->
    <x-base.breadcrumb
        title=" {{ request()->routeIs('jobs.create') ? awtTrans('create') . ' ' : awtTrans('edit') . ' ' . 'jobs' }}"
        :translate="false" :breadcrumbs="[
            ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
            ['label' => 'jobs', 'url' => route($route . '.index')],
            ['label' => request()->routeIs('jobs.create') ? awtTrans('create') : awtTrans('edit') . awtTrans('jobs')],
        ]" />

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">
                <div class="card-body">
                    @include('flash::message')

                    <!-- Render the form -->
                    {!! form($form) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <!-- Bootstrap Tags Input CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">
    <style>
        /* Modern Tags Input Styling */
        .bootstrap-tagsinput {
            width: 100%;
            min-height: 45px;
            padding: 8px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }

        .bootstrap-tagsinput.focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .bootstrap-tagsinput input {
            border: none;
            box-shadow: none;
            outline: none;
            background-color: transparent;
            padding: 6px;
            margin: 0;
            width: auto !important;
            max-width: inherit;
        }

        .bootstrap-tagsinput .tag {
            margin: 4px;
            padding: 6px 12px;
            border-radius: 20px;
            background-color: #e9ecef;
            color: #495057;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-block;
            transition: all 0.2s ease;
        }

        .bootstrap-tagsinput .tag:hover {
            background-color: #dee2e6;
        }

        .bootstrap-tagsinput .tag [data-role="remove"] {
            margin-left: 8px;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.2s ease;
        }

        .bootstrap-tagsinput .tag [data-role="remove"]:hover {
            opacity: 1;
        }

        .bootstrap-tagsinput .tag [data-role="remove"]:after {
            content: "×";
            padding: 0 2px;
        }

        /* Placeholder styling */
        .bootstrap-tagsinput input::placeholder {
            color: #adb5bd;
            opacity: 1;
        }

        /* RTL Support */
        [dir="rtl"] .bootstrap-tagsinput .tag [data-role="remove"] {
            margin-left: 0;
            margin-right: 8px;
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .bootstrap-tagsinput {
                background-color: transparent;
                border-color: var(--bs-border-color);
            }

            .bootstrap-tagsinput input {
                color: #080809;
            }

            .bootstrap-tagsinput .tag {
                background-color: #4a5568;
                color: #e2e8f0;
            }

            .bootstrap-tagsinput .tag:hover {
                background-color: #2d3748;
            }

            .bootstrap-tagsinput input::placeholder {
                color: #a0aec0;
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        // Function to load script dynamically
        function loadScript(src) {
            return new Promise((resolve, reject) => {
                const script = document.createElement('script');
                script.src = src;
                script.onload = resolve;
                script.onerror = reject;
                document.head.appendChild(script);
            });
        }

        // Load required scripts in order
        async function loadDependencies() {
            try {
                // Check if jQuery is already loaded
                if (typeof jQuery === 'undefined') {
                    await loadScript('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js');
                }

                // Load other dependencies
                await loadScript(
                    'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js');
                await loadScript('https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js');
                await loadScript(
                    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js');

                // Initialize after all scripts are loaded
                initializeComponents();
            } catch (error) {
                console.error('Error loading dependencies:', error);
            }
        }

        // Initialize components
        function initializeComponents() {
            // Initialize Tags Input
            function initializeTagsInput() {
                try {
                    $('.input-tags').each(function() {
                        $(this).tagsinput({
                            trimValue: true,
                            confirmKeys: [13, 44], // Enter and comma
                            focusClass: 'focus',
                            allowDuplicates: false,
                            tagClass: function(item) {
                                return 'tag';
                            },
                            onTagExists: function(item, $tag) {
                                $tag.fadeOut().fadeIn();
                            },
                            beforeTagAdd: function(event) {
                                if (event.item.length > 30) {
                                    event.cancel = true;
                                    alert('{{ awtTrans('Tag length cannot exceed 30 characters') }}');
                                }
                            }
                        });

                        // Event handlers
                        $(this).on('itemAdded', function(event) {
                            $(event.tag).hide().fadeIn(300);
                        });

                        $(this).on('itemRemoved', function(event) {
                            $(event.tag).fadeOut(300, function() {
                                $(this).remove();
                            });
                        });

                        // Keyboard navigation
                        $(this).next('.bootstrap-tagsinput').find('input').on('keydown', function(e) {
                            if (e.keyCode === 8 && $(this).val() === '') {
                                const tags = $(this).closest('.bootstrap-tagsinput').find('.tag');
                                if (tags.length > 0) {
                                    const lastTag = tags.last();
                                    lastTag.fadeOut(300, function() {
                                        $(this).remove();
                                    });
                                }
                            }
                        });
                    });
                } catch (error) {
                    console.error('Error initializing tags input:', error);
                }
            }

            // Initialize Multi-Select
            function initializeMultiSelect() {
                try {
                    $('select[name="country_id[]"]').select2({
                        theme: 'bootstrap-5',
                        placeholder: '{{ awtTrans('select_countries') }}',
                        allowClear: true,
                        multiple: true,
                        width: '100%'
                    });
                } catch (error) {
                    console.error('Error initializing multi-select:', error);
                }
            }

            // Initialize both components
            initializeTagsInput();
            initializeMultiSelect();
        }

        // Start loading dependencies when document is ready
        $(document).ready(function() {
            loadDependencies();
        });
    </script>
@endpush
