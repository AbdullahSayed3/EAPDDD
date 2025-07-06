<style>
    /* Style for countries list */
    .countries-list {
        max-height: max-content;
        /* overflow-y: auto; */
        line-height: 1.5;
        padding-right: 5px;
        color: #333;
        text-align: right;
        direction: rtl;
    }

    /* Apply proper spacing for country separator */
    .countries-list span:not(:last-child):after {
        content: " | ";
        padding: 0 3px;
    }

    /* Highlight style for filtered countries */
    .highlighted-country {
        font-weight: bold;
        color: #335A9E;
        background-color: rgba(51, 90, 158, 0.1);
        padding: 2px 4px;
        border-radius: 3px;
    }

    /* Tables formatting */
    .table-bordered th,
    .table-bordered td {
        vertical-align: middle;
    }

    /* Make dates consistent */
    .table td {
        font-family: Tahoma, Arial, sans-serif;
    }

    /* Ensure proper RTL alignment for all tables */
    .table {
        text-align: right;
    }

    /* Add scrolling for long country lists in other tabs */
    td .countries-list {
        max-width: 300px;
        word-wrap: break-word;
    }

    /* Fix for hidden course tab specifically */
    #courses.active {
        pointer-events: auto !important;
        z-index: 10 !important;
    }

    /* Style the pagination */
    .pagination {
        direction: ltr;
    }

    .pagination-container {
        margin: 15px 0;
    }

    /* Improve pagination in RTL context */
    .pagination-container .page-item {
        margin: 0 2px;
    }

    .pagination-container .page-link {
        border-radius: 4px;
        color: #335A9E;
        border-color: #eaeaea;
    }

    .pagination-container .page-item.active .page-link {
        background-color: #335A9E;
        border-color: #335A9E;
        color: white;
    }

    /* Filter badges */
    .filter-badge {
        display: inline-block;
        padding: 4px 8px;
        margin: 2px;
        background-color: #335A9E;
        color: white;
        border-radius: 20px;
        font-size: 0.85rem;
    }

    .filter-badge .remove-filter {
        margin-right: 5px;
        cursor: pointer;
        opacity: 0.8;
    }

    .filter-badge .remove-filter:hover {
        opacity: 1;
    }

    /* Active filters container */
    .active-filters {
        margin: 10px 0;
        padding: 8px;
        background-color: #f8f9fa;
        border-radius: 4px;
        border: 1px solid #eaeaea;
    }
</style>
