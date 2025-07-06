<script>
    document.addEventListener('DOMContentLoaded', function() {
        const DEBUG = false;

        const triggerTabList = Array.from(document.querySelectorAll('#resultsTabs button'));
        const datatablesInitialized = {
            'courses': false,
            'experts': false,
            'aids': false,
            'events': false,
            'scholarships': false
        };

        // Activate DataTable for the specified tab
        function activateTabDataTable(tabId) {
            if (window.tabInitFunctions && typeof window.tabInitFunctions[tabId] === 'function') {
                setTimeout(() => {
                    window.tabInitFunctions[tabId]();
                    datatablesInitialized[tabId] = true;
                }, 50); // increased delay for reliability
            } else {
                const tableId = `${tabId}-datatable`;
                const tableElement = document.getElementById(tableId);
                if (!tableElement) return;

                if (!datatablesInitialized[tabId]) {
                    const tableContainer = document.getElementById(tabId);
                    if (tableContainer) {
                        tableContainer.classList.add('show', 'active');
                        if ($.fn.DataTable.isDataTable(`#${tableId}`)) {
                            $(`#${tableId}`).DataTable().columns.adjust().draw();
                        }
                        datatablesInitialized[tabId] = true;
                    }
                } else {
                    if ($.fn.DataTable.isDataTable(`#${tableId}`)) {
                        setTimeout(() => {
                            $(`#${tableId}`).DataTable().columns.adjust().draw();
                        }, 50);
                    }
                }
            }
        }

        // Main tab activation function
        function activateTab(tabId) {
            if (DEBUG) console.log('Activating tab:', tabId);

            const tabButton = document.querySelector(`button[data-bs-target="#${tabId}"]`);
            const tabContent = document.getElementById(tabId);

            if (!tabButton) {
                console.error(`Tab button not found for: ${tabId}`);
                return false;
            }
            if (!tabContent) {
                console.error(`Tab content not found for: ${tabId}`);
                return false;
            }

            // Deselect all tabs
            triggerTabList.forEach(el => {
                el.classList.remove('active');
                el.setAttribute('aria-selected', 'false');
            });

            // Hide all tab panes
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });

            // Activate current tab and content
            tabButton.classList.add('active');
            tabButton.setAttribute('aria-selected', 'true');
            tabContent.classList.add('show', 'active');

            // Initialize DataTable
            activateTabDataTable(tabId);

            if (DEBUG) console.log('Successfully activated tab:', tabId);
            console.log(`Trying to activate tab content for #${tabId}`);
            console.log('tabButton:', tabButton);
            console.log('tabContent:', tabContent);
            return true;
        }

        // Click handler for tab buttons
        triggerTabList.forEach(triggerEl => {
            triggerEl.addEventListener('click', function(event) {
                event.preventDefault();

                const targetId = this.getAttribute('data-bs-target').substring(1);
                activateTab(targetId);

                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('active_tab', targetId);
                history.replaceState(null, '', currentUrl.toString());
            });
        });

        // Activate tab based on URL query
        function initializeTabFromUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('active_tab');

            if (DEBUG) console.log('URL active_tab parameter:', activeTab);

            if (activeTab) {
                const lowerActiveTab = activeTab.toLowerCase();
                let matchFound = false;

                document.querySelectorAll('#resultsTabs button').forEach(btn => {
                    const tabTarget = btn.getAttribute('data-bs-target');
                    if (tabTarget) {
                        const id = tabTarget.substring(1).toLowerCase();
                        if (id === lowerActiveTab) {
                            const actualId = tabTarget.substring(1);
                            if (DEBUG) console.log('Found match for:', lowerActiveTab, '→', actualId);
                            matchFound = activateTab(actualId);
                        }
                    }
                });

                if (!matchFound) {
                    if (DEBUG) console.warn('Failed to activate tab from URL, using first tab');
                    activateFirstTab();
                }
            } else {
                activateFirstTab();
            }
        }

        // Fallback to first tab
        function activateFirstTab() {
            const firstTab = document.querySelector('#resultsTabs button');
            if (firstTab) {
                const targetId = firstTab.getAttribute('data-bs-target').substring(1);
                if (DEBUG) console.log('Activating first tab:', targetId);
                activateTab(targetId);
            } else {
                console.warn('No tabs found to activate');
            }
        }

        // Start initialization
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeTabFromUrl);
        } else {
            initializeTabFromUrl();
        }
    });
</script>
