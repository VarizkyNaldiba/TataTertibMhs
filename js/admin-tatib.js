const addButton = document.getElementById('addButton');
const editButtons = document.querySelectorAll('.edit-button');
const insertModal = document.getElementById('insertModal');
const editModal = document.getElementById('editModal');
const closeButtons = document.querySelectorAll('.close');

addButton.addEventListener('click', () => {
    insertModal.style.display = 'block';
});

editButtons.forEach((button) => {
    button.addEventListener('click', (e) => {
        editModal.style.display = 'block';
    });
});


closeButtons.forEach((closeButton) => {
    closeButton.addEventListener('click', () => {
        insertModal.style.display = 'none';
        editModal.style.display = 'none';
    });
});


window.addEventListener('click', (event) => {
    if (event.target === insertModal) {
        insertModal.style.display = 'none';
    }
    if (event.target === editModal) {
        editModal.style.display = 'none';
    }
});


const setPoinByTingkat = (tingkat, poinField) => {
    let poin = '';
    switch (tingkat) {
        case 'I':
            poin = 32;
            break;
        case 'II':
            poin = 16;
            break;
        case 'III':
            poin = 8;
            break;
        case 'IV':
            poin = 4;
            break;
        case 'V':
            poin = 2;
            break;
        default:
            poin = '';
    }
    poinField.value = poin;
};


document.addEventListener('change', (event) => {
    if (event.target.id === 'tingkat') {
        const selectedTingkat = event.target.value;
        const poinField = event.target.closest('form').querySelector('#poin');
        setPoinByTingkat(selectedTingkat, poinField);
    }
});
