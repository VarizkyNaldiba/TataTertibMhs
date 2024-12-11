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
     var skipTugasContainer = document.getElementById('skipTugasKhusus-container');
 
     if (tingkat === 'I' || tingkat === 'II' || tingkat === 'III') {
         deskripsiTugasContainer.style.display = 'block'; // Tampilkan deskripsi tugas
         skipTugasContainer.style.display = 'block'; // Tampilkan tombol lapor DPA
     } else {
         deskripsiTugasContainer.style.display = 'none'; // Sembunyikan deskripsi tugas
         skipTugasContainer.style.display = 'none'; // Sembunyikan tombol lapor DPA
     }
 });
 
 // Fungsi tombol Lapor ke DPA
 document.getElementById('skipTugasKhusus').addEventListener('click', function () {
     if (confirm('Apakah Anda yakin ingin melaporkan ke DPA dan tidak mengisi tugas khusus?')) {
         deskripsiTugasContainer.style.display = 'none'; // Sembunyikan deskripsi tugas
     }
});

function showConfirmation() {

    var confirmAction = confirm("Apakah Anda yakin ingin melaporkan?");

    if (confirmAction) {
        window.location.href = "pelanggaran_dosen.php"; 
    }

}