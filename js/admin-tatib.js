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
        const nomor = row.children[0].textContent;
        const konten = row.children[1].textContent;
        const tingkat = row.children[2].textContent;

        // Isi modal dengan data
        document.getElementById('nomor').value = nomor;
        document.getElementById('editKonten').value = konten;
        document.getElementById('editTingkat').value = tingkat;

        // Tampilkan modal
        modal.style.display = 'block';
        console.log('Modal opened with data:', { nomor, konten, tingkat }); // Debugging
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


// Mendapatkan elemen tombol Tambah
const addButton = document.getElementById('addButton');

// Fungsi untuk membuka modal dengan isi kosong
addButton.addEventListener('click', (e) => {
    e.preventDefault();

    // Kosongkan isi modal
    document.getElementById('nomor').value = '';
    document.getElementById('editKonten').value = '';
    document.getElementById('editTingkat').value = '';

    // Tampilkan modal
    modal.style.display = 'block';
    console.log('Modal opened with empty fields'); // Debugging
});
