//data dump untuk nyoba pelacakan untuk cari pelnggaran dari database
const pelanggaranDatabase = [
    "Berkomunikasi dengan tidak sopan",
    "Berbicara kasar kepada teman",
    "Melanggar aturan berpakaian",
    "Mengganggu ketertiban kelas",
    "Tidak membawa perlengkapan",
    "Berbuat plagiarisme",
    "Terlambat masuk kelas",
    "Tidak sopan kepada dosen",
    "Meninggalkan kelas tanpa izin",
    "Melanggar aturan ujian"
];


const jenisPelanggaranInput = document.getElementById('jenisPelanggaran');
const suggestionsList = document.getElementById('suggestionsList');


jenisPelanggaranInput.addEventListener('input', function () {
    const query = this.value.toLowerCase();
    suggestionsList.innerHTML = ''; // Clear previous suggestions

    if (query) {
        const filteredSuggestions = pelanggaranDatabase.filter(item =>
            item.toLowerCase().includes(query)
        );

        if (filteredSuggestions.length > 0) {
            suggestionsList.style.display = 'block';
            filteredSuggestions.forEach(item => {
                const div = document.createElement('div');
                div.textContent = item;
                div.classList.add('suggestion-item');
                div.addEventListener('click', function () {
                    jenisPelanggaranInput.value = item; // Set input value
                    suggestionsList.style.display = 'none'; // Hide suggestions
                });
                suggestionsList.appendChild(div);
            });
        } else {
            suggestionsList.style.display = 'none';
        }
    } else {
        suggestionsList.style.display = 'none';
    }
});


document.addEventListener('click', function (e) {
    if (!suggestionsList.contains(e.target) && e.target !== jenisPelanggaranInput) {
        suggestionsList.style.display = 'none';
    }
});


const tugasKhususCheckbox = document.getElementById('tugasKhusus');
const deskripsiTugasTextarea = document.getElementById('deskripsiTugas');


tugasKhususCheckbox.addEventListener('change', function () {
    if (this.checked) {
        deskripsiTugasTextarea.disabled = false; // Enable textarea
        deskripsiTugasTextarea.focus(); // Focus on textarea
    } else {
        deskripsiTugasTextarea.disabled = true; // Disable textarea
        deskripsiTugasTextarea.value = ''; // Clear the value
    }
});

function resetForm() {
    document.getElementById('pelanggaranForm').reset();

//disable tugas akhir
    const deskripsiTugasTextarea = document.getElementById('deskripsiTugasKhusus');
    if (deskripsiTugasTextarea) {
        deskripsiTugasTextarea.disabled = true;
    }

    window.location.href = 'pelanggaran_dosen.php'; // Ganti 'nama_halaman.html' dengan URL halaman tujuan
}
