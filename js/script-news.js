
const addBeritaButton = document.getElementById('addButton'); 
const editBeritaButtons = document.querySelectorAll('.edit-button'); 
const insertBeritaModal = document.getElementById('insertBeritaModal'); 
const editBeritaModal = document.getElementById('editBeritaModal'); 
const closeButtons = document.querySelectorAll('.close'); 


addBeritaButton.addEventListener('click', () => {
    insertBeritaModal.style.display = 'block';
});

// Fungsi untuk membuka modal edit berita
editBeritaButtons.forEach((button) => {
    button.addEventListener('click', (e) => {
        editBeritaModal.style.display = 'block';
    });
});

closeButtons.forEach((closeButton) => {
    closeButton.addEventListener('click', () => {
        insertBeritaModal.style.display = 'none';
        editBeritaModal.style.display = 'none';
    });
});


window.addEventListener('click', (event) => {
    if (event.target === insertBeritaModal) {
        insertBeritaModal.style.display = 'none';
    }
    if (event.target === editBeritaModal) {
        editBeritaModal.style.display = 'none';
    }
});
