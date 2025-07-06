<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Select2 dropdowns
        $(".selc_country").select2({
            placeholder: "{{ awtTrans('اختر دولة') }}"
        });

        $(".selc_report_type").select2({
            placeholder: "{{ awtTrans('اختر نوع التقرير') }}"
        });
    })
</script>
