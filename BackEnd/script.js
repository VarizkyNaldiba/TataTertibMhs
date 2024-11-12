function showPage(page) {

    var pages = document.getElementsByClassName('page');
    for (var i = 0; i < pages.length; i++) {
      pages[i].classList.add('hidden');
    }
  
    document.getElementById(page).classList.remove('hidden');
  
    var sidebarItems = document.querySelectorAll('.sidebar li');
    for (var i = 0; i < sidebarItems.length; i++) {
      sidebarItems[i].classList.remove('active');
    }
  
    var clickedItem = document.querySelector(`.sidebar li a[onclick="showPage('${page}')"]`).parentNode;
    clickedItem.classList.add('active');
  }

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
  