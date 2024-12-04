document.getElementById('tingkat').addEventListener('change', function () {
    var tingkat = this.value;

    // Filter jenis pelanggaran berdasarkan tingkat
    var jenisPelanggaranSelect = document.getElementById('jenisPelanggaran');
    var jenisOptions = jenisPelanggaranSelect.options;

    for (var i = 0; i < jenisOptions.length; i++) {
        var option = jenisOptions[i];
        if (option.getAttribute('data-tingkat') === tingkat || option.value === "") {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    }

    // Reset pilihan jenis pelanggaran
    jenisPelanggaranSelect.value = "";

    // Filter sanksi berdasarkan tingkat
    var sanksiSelect = document.getElementById('sanksi');
    var sanksiOptions = sanksiSelect.options;

    for (var j = 0; j < sanksiOptions.length; j++) {
        var sanksiOption = sanksiOptions[j];
        if (sanksiOption.getAttribute('data-tingkat') === tingkat || sanksiOption.value === "") {
            sanksiOption.style.display = 'block';
        } else {
            sanksiOption.style.display = 'none';
        }
    }

    // Reset pilihan sanksi
    sanksiSelect.value = "";

    // Tampilkan atau sembunyikan form "Deskripsi Tugas Khusus"
    var deskripsiTugasContainer = document.getElementById('deskripsiTugas-container');
    if (tingkat === '1' || tingkat === '2' || tingkat === '3') {
        deskripsiTugasContainer.style.display = 'block'; // Tampilkan deskripsi tugas
    } else {
        deskripsiTugasContainer.style.display = 'none'; // Sembunyikan deskripsi tugas
    }
});
