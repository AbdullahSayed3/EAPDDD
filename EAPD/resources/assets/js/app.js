// Import jQuery first
import $ from 'jquery';
window.$ = window.jQuery = $;

// Import Bootstrap
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// Polyfill jQuery tooltip to use Bootstrap 5
$.fn.tooltip = function (options) {
    return this.each(function () {
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            new bootstrap.Tooltip(this, options);
        }
    });
};

// Import other plugins
import 'datatables.net';
// import 'datatables.net-dt';
import 'datatables.net-bs5';
import select2 from 'select2';
select2();
// Import bootstrap-datepicker
import 'bootstrap-datepicker';
// Initialize datepicker on elements with the datepicker class
$(document).ready(function () {
    $('.datepicker').datepicker();
});

// Initialize read-more functionality
// $(function () {
//     // Find all table links using jQuery
//     const tableLinks = $('table a');

//     // Apply functionality to each link
//     tableLinks.each(function () {
//         // Add read-more class to all table links
//         $(this).addClass('read-more');

//         // Store original href
//         const originalHref = $(this).attr('href');

//         // Initialize Bootstrap tooltip
//         new bootstrap.Tooltip(this, {
//             title: $(this).text(),
//             placement: 'top',
//             trigger: 'hover',
//             html: true,
//             container: 'body'
//         });

//         // Add click event listener using jQuery
//         $(this).on('click', function (e) {
//             e.preventDefault(); // Always prevent default first

//             if ($(this).hasClass('expanded')) {
//                 $(this).removeClass('expanded');
//                 $(this).attr('title', 'Click to expand');
//                 // If we want to navigate after collapsing, uncomment the next line
//                 // window.location.href = originalHref;
//             } else {
//                 $(this).addClass('expanded');
//                 $(this).attr('title', 'Click to collapse');
//             }
//         });
//     });
// });

// Initialize Select2 for dropdowns
$(document).ready(function () {
    // Common select2 options
    const select2Options = {
        width: '100%',
        allowClear: true,
        placeholder: function () {
            // Use the placeholder from data-placeholder or the default text from the original element
            return $(this).data('placeholder') || $(this).attr('placeholder') || '';
        }
    };

    // Initialize all select2 elements
    $('[data-bs-toggle="select2"]').select2({
        ...select2Options,
        minimumResultsForSearch: 6 // Only show search for larger lists
    });

    // Initialize multiple select elements
    $('.select2-multiple').select2({
        ...select2Options,
        closeOnSelect: false,
        tags: false,
        tokenSeparators: [','],
        // Custom template for selected items
        templateSelection: function (data) {
            if (!data.id) return data.text;
            return $(`<span>${data.text}</span>`);
        }
    });
});

// Ensure courses table is always visible
// document.addEventListener('DOMContentLoaded', function() {
//     const coursesTable = document.querySelector('.courses-table');
//     if (coursesTable) {
//         coursesTable.style.removeProperty('display');
//         coursesTable.style.removeProperty('opacity');
//         coursesTable.style.removeProperty('visibility');
//     }
// });
