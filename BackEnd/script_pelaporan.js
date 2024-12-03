document.getElementById('jenisPelanggaran').addEventListener('change', function () {
    var jenisPelanggaran = this.value;
    var tingkatInput = document.getElementById('tingkat');
    var sanksiSelect = document.getElementById('sanksi');  // Menambahkan deklarasi untuk sanksiSelect

    // Mendapatkan tingkat yang sesuai dari data-tingkat atribut
    var selectedOption = this.options[this.selectedIndex];
    var tingkat = selectedOption.getAttribute('data-tingkat');

    // Mengatur nilai tingkat berdasarkan jenis pelanggaran yang dipilih
    tingkatInput.value = tingkat;

    // Menampilkan opsi sanksi dan deskripsi tugas sesuai tingkat
    if (tingkat === '1') {
        sanksiSelect.innerHTML = `
            <option value="Sanksi Tingkat 1A">Sanksi Tingkat 1A</option>
            <option value="Sanksi Tingkat 1B">Sanksi Tingkat 1B</option>
        `;
        document.getElementById('deskripsiTugas-container').style.display = 'block'; // Menampilkan deskripsi tugas
    } else if (tingkat === '2') {
        sanksiSelect.innerHTML = `
            <option value="Sanksi Tingkat 2A">Sanksi Tingkat 2A</option>
            <option value="Sanksi Tingkat 2B">Sanksi Tingkat 2B</option>
        `;
        document.getElementById('deskripsiTugas-container').style.display = 'block'; // Menampilkan deskripsi tugas
    } else if (tingkat === '3') {
        sanksiSelect.innerHTML = `
            <option value="Sanksi Tingkat 3A">Sanksi Tingkat 3A</option>
            <option value="Sanksi Tingkat 3B">Sanksi Tingkat 3B</option>
        `;
        document.getElementById('deskripsiTugas-container').style.display = 'block'; // Menampilkan deskripsi tugas
    } else if (tingkat === '4') {
        sanksiSelect.innerHTML = `
            <option value="Sanksi Tingkat 4A">Sanksi Tingkat 4A</option>
            <option value="Sanksi Tingkat 4B">Sanksi Tingkat 4B</option>
        `;
        document.getElementById('deskripsiTugas-container').style.display = 'none'; // Menyembunyikan deskripsi tugas
    } else if (tingkat === '5') {
        sanksiSelect.innerHTML = `
            <option value="Sanksi Tingkat 5A">Sanksi Tingkat 5A</option>
            <option value="Sanksi Tingkat 5B">Sanksi Tingkat 5B</option>
        `;
        document.getElementById('deskripsiTugas-container').style.display = 'none'; // Menyembunyikan deskripsi tugas
    } else {
        sanksiSelect.innerHTML = ''; // Tidak ada sanksi
        document.getElementById('deskripsiTugas-container').style.display = 'none'; // Menyembunyikan deskripsi tugas
    }
});