// Mendapatkan elemen modal dan tombol-tombol terkait
const modal = document.getElementById('editModal'); // Modal utama
const closeModal = document.querySelector('.close'); // Tombol close (x)
const editButtons = document.querySelectorAll('.edit-button'); // Tombol Edit

// Fungsi untuk membuka modal saat tombol Edit diklik
editButtons.forEach((button) => {
    button.addEventListener('click', (e) => {
        e.preventDefault();

        // Ambil data dari baris tabel terkait
        const row = button.closest('tr');
        const judul = row.children[0].textContent;
        const konten = row.children[1].textContent;
        const penulis = row.children[2].textContent;

        // Isi modal dengan data
        document.getElementById('editJudul').value = judul;
        document.getElementById('editKonten').value = konten;
        document.getElementById('editPenulis').value = penulis;

        // Tampilkan modal
        modal.style.display = 'block';
        console.log('Modal opened with data:', { judul, konten, penulis }); // Debugging
    });
});

// Fungsi untuk menutup modal
closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
    console.log('Modal closed'); // Debugging
});

// Menutup modal ketika klik di luar area modal
window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
        console.log('Modal closed by clicking outside'); // Debugging
    }
});
