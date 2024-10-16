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