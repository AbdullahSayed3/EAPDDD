<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Store country names by ID
        var countriesMap = {};

        // Load country names when document is ready
        $(document).ready(function() {
            // Extract country names from the select dropdown
            $('#global-country option').each(function() {
                var $option = $(this);
                var id = $option.val();
                var name = $option.text();
                if (id && name) {
                    countriesMap[id] = name;
                }
            });

            // console.log("Loaded countries map:", countriesMap);

            // Initialize active filters from URL
            initActiveFiltersFromUrl();
        });

        // Function to initialize active filters from URL
        function initActiveFiltersFromUrl() {
            var urlParams = new URLSearchParams(window.location.search);
            var hasFilters = false;

            // Check for country parameter(s)
            var countries = urlParams.getAll('country');
            if (countries && countries.length > 0) {
                countries.forEach(function(countryId) {
                    addCountryFilter(countryId);
                });
                hasFilters = true;
            }

            // Show active filters container if we have any filters
            if (hasFilters) {
                $('#active-filters-container').show();
            }
        }

        // Function to update search parameters and reload tables
        function updateSearch(params) {
            // Update global search parameters
            searchParams = params;

            // Log filter parameters for debugging
            // console.log("Applied filters:", params);

            // Update active filters display
            updateActiveFiltersDisplay(params);

            // Update URL with parameters without reloading the page
            var url = new URL(window.location.href);

            // First clear all existing parameters
            url.search = '';
            var urlParams = new URLSearchParams(url.search);

            // Add new parameters
            for (var key in params) {
                if (Array.isArray(params[key])) {
                    // For arrays like multi-select countries
                    params[key].forEach(function(value) {
                        urlParams.append(key, value);
                    });
                } else {
                    urlParams.set(key, params[key]);
                }
            }

            // Set the new URL and reload the page
            url.search = urlParams.toString();
            window.location.href = url.toString();
            // Reload all DataTables with new parameters
            if (typeof coursesTable !== 'undefined') coursesTable.ajax.reload();
            if (typeof expertsTable !== 'undefined') expertsTable.ajax.reload();
            if (typeof aidsTable !== 'undefined') aidsTable.ajax.reload();
            if (typeof eventsTable !== 'undefined') eventsTable.ajax.reload();
            if (typeof scholarshipsTable !== 'undefined') scholarshipsTable.ajax.reload();
        }

        // Function to update active filters display
        function updateActiveFiltersDisplay(params) {
            var $container = $('#active-filters-container');
            var $list = $('#active-filters-list');
            $list.empty();

            var hasFilters = false;

            // Add country filters
            if (params.country && params.country.length > 0) {
                params.country.forEach(function(countryId) {
                    addCountryFilter(countryId);
                });
                hasFilters = true;
            }

            // Show/hide the container based on whether we have filters
            $container.toggle(hasFilters);
        }

        // Function to add a country filter badge
        function addCountryFilter(countryId) {
            var countryName = countriesMap[countryId] || countryId;
            var $filterBadge = $('<div class="filter-badge" data-filter-type="country" data-filter-id="' +
                countryId + '">' +
                '<span class="remove-filter">&times;</span>' +
                '<span class="filter-name">' + countryName + '</span>' +
                '</div>');

            $('#active-filters-list').append($filterBadge);
        }

        // Handle Quick Search Form Submission
        $('#global-search-form').on('submit', function(e) {
            e.preventDefault();
            var formData = {};

            // Handle country multi-select field
            var countryValues = $('#global-country').val();
            if (countryValues && countryValues.length > 0) {
                formData['country'] = countryValues;
                // console.log("Selected countries:", countryValues);
            }

            // Get all other form fields
            $(this).find('input, select').not('#global-country').each(function() {
                var $field = $(this);
                var value = $field.val();
                var name = $field.attr('name');

                if (value && value.length > 0 && name) {
                    formData[name] = value;
                }
            });

            updateSearch(formData);
        });

        // Handle Advanced Search Form Submission
        $('#advanced-search-form').on('submit', function(e) {
            e.preventDefault();
            var formData = {};

            // Handle country multi-select field in advanced search
            var countryValues = $('#adv-country').val();
            if (countryValues && countryValues.length > 0) {
                formData['country'] = countryValues;
                // console.log("Advanced search - Selected countries:", countryValues);
            }

            // Get all other form fields
            $(this).find('input, select').not('#adv-country').each(function() {
                var $field = $(this);
                var value = $field.val();
                var name = $field.attr('name');

                if (value && value.length > 0 && name) {
                    formData[name] = value;
                }
            });

            updateSearch(formData);
            $('#advancedSearchModal').modal('hide');
        });

        // Reset quick search form
        document.getElementById('reset-search').addEventListener('click', function(e) {
            e.preventDefault();

            // Reset the form
            document.getElementById('global-search-form').reset();

            // Reset select2 dropdowns
            if (typeof $ !== 'undefined') {
                $('.selc_country, .selc_report_type').val(null).trigger('change');
            }

            // Clear all search parameters
            searchParams = {};

            // Update URL to remove all parameters
            var url = new URL(window.location.href);
            url.search = '';
            window.location.href = url.toString();

            // Hide active filters
            $('#active-filters-container').hide();
            $('#active-filters-list').empty();

            // Reload all DataTables with empty parameters
            if (typeof coursesTable !== 'undefined') coursesTable.ajax.reload();
            if (typeof expertsTable !== 'undefined') expertsTable.ajax.reload();
            if (typeof aidsTable !== 'undefined') aidsTable.ajax.reload();
            if (typeof eventsTable !== 'undefined') eventsTable.ajax.reload();
            if (typeof scholarshipsTable !== 'undefined') scholarshipsTable.ajax.reload();
        });

        // Reset advanced search form
        document.getElementById('clear-advanced-search').addEventListener('click', function() {
            document.getElementById('advanced-search-form').reset();
            if (typeof $ !== 'undefined') {
                $('#adv-country').val(null).trigger('change');
                $('#adv-report-type').val(null).trigger('change');
            }
        });

        // Clear all active filters
        $(document).on('click', '#clear-all-filters', function() {
            // Reset the search form
            document.getElementById('global-search-form').reset();

            // Reset select2 dropdowns
            if (typeof $ !== 'undefined') {
                $('.selc_country, .selc_report_type').val(null).trigger('change');
            }

            // Clear all search parameters
            searchParams = {};

            // Update URL to remove all parameters
            var url = new URL(window.location.href);
            url.search = '';
            window.location.href = url.toString();
        });

        // Remove individual filter badge
        $(document).on('click', '.remove-filter', function() {
            var $badge = $(this).closest('.filter-badge');
            var filterType = $badge.data('filter-type');
            var filterId = $badge.data('filter-id');

            // Remove this filter from searchParams
            if (filterType === 'country' && searchParams.country) {
                // For array parameters like country
                searchParams.country = searchParams.country.filter(function(id) {
                    return id != filterId;
                });

                // Remove country from select dropdown
                $('#global-country').val(searchParams.country).trigger('change');
            }

            // Remove the badge
            $badge.remove();

            // Hide container if no filters left
            if ($('#active-filters-list').children().length === 0) {
                $('#active-filters-container').hide();
            }

            // Update search with modified parameters
            updateSearch(searchParams);
        });

        // Monitor country dropdown changes for debugging
        $(document).ready(function() {
            $('#global-country, #adv-country').on('change', function() {
                // console.log("Country selection changed:", $(this).attr('id'), "Value:", $(this).val());
            });
        });
    })
</script>
