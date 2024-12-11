// Mendapatkan elemen modal dan tombol-tombol terkait
const modal = document.getElementById('editModal'); // Modal utama
const closeModal = document.querySelector('.close'); // Tombol close (x)
const editButtons = document.querySelectorAll('.edit-button'); // Tombol Edit
const tingkatSelect = document.getElementById('editTingkat'); // Dropdown Tingkat
const poinInput = document.getElementById('poin'); // Input Poin
const adminInput = document.getElementById('admin'); // Input Dosen

// Fungsi untuk membuka modal saat tombol Edit diklik
editButtons.forEach((button) => {
    button.addEventListener('click', (e) => {
        e.preventDefault();

        // Ambil data dari baris tabel terkait
        const row = button.closest('tr'); // Baris terkait tombol Edit
        const nomor = row.children[0].textContent; // Kolom 1: No
        const admin = row.children[1].textContent; // Kolom 2: Dosen/Admin
        const konten = row.children[2].textContent; // Kolom 3: Pelanggaran
        const tingkat = row.children[3].textContent; // Kolom 4: Tingkat
        const poin = row.children[4].textContent; // Kolom 5: Poin

        // Isi modal dengan data dari tabel
        document.getElementById('nomor').value = nomor;
        adminInput.value = admin; // Isi dosen
        document.getElementById('editKonten').value = konten;
        tingkatSelect.value = tingkat; // Pilih tingkat yang sesuai
        poinInput.value = poin; // Isi poin

        // Ubah judul modal untuk edit
        document.getElementById('modalTitle').textContent = 'Edit Pelanggaran';

        // Tampilkan modal
        modal.style.display = 'block';
    });
});

// Fungsi untuk menutup modal
closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
});

// Menutup modal ketika klik di luar area modal
window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

// Mendapatkan elemen tombol Tambah
const addButton = document.getElementById('addButton');

// Fungsi untuk membuka modal dengan isi kosong
addButton.addEventListener('click', (e) => {
    e.preventDefault();

    // Kosongkan isi modal
    document.getElementById('nomor').value = '';
    adminInput.value = ''; // Kosongkan dosen
    document.getElementById('editKonten').value = '';
    tingkatSelect.value = ''; // Reset dropdown tingkat
    poinInput.value = ''; // Kosongkan poin

    // Ubah judul modal untuk tambah
    document.getElementById('modalTitle').textContent = 'Tambah Pelanggaran';

    // Tampilkan modal
    modal.style.display = 'block';
});

// Fungsi untuk mengatur poin berdasarkan tingkat yang dipilih
function setPoin(tingkat) {
    switch (tingkat) {
        case 'I':
            poinInput.value = 32;
            break;
        case 'II':
            poinInput.value = 16;
            break;
        case 'III':
            poinInput.value = 8;
            break;
        case 'IV':
            poinInput.value = 4;
            break;
        case 'V':
            poinInput.value = 2;
            break;
        default:
            poinInput.value = ''; // Kosongkan jika tidak valid
    }
}

// Event listener untuk mengubah poin berdasarkan tingkat yang dipilih
tingkatSelect.addEventListener('change', () => {
    const tingkat = tingkatSelect.value;
    setPoin(tingkat);
});
