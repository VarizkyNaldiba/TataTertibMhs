// Open modal
document.querySelectorAll('.submit-btn').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        openModal();
    });
});

function openModal() {
    const modal = document.getElementById('uploadModal');
    if (modal) {
        modal.style.display = 'flex';
    } else {
        console.error('Modal element not found!');
    }
}

// Close modal
function closeModal() {
    const modal = document.getElementById('uploadModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Handle form submission
document.getElementById('uploadForm').addEventListener('submit', (e) => {
    e.preventDefault();
    alert('File berhasil diunggah!');
    closeModal();
});