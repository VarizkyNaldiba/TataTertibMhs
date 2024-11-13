  //script list tatib
        document.getElementById('filter-tingkat').addEventListener('change', function () {
            const filterValue = this.value;
            const rows = document.querySelectorAll('#tatib-table tbody tr');

            rows.forEach(row => {
                const tingkat = row.getAttribute('data-tingkat');
                if (filterValue === "" || filterValue === tingkat) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
  