   function filterTingkat() {
        // Ambil nilai filter yang dipilih
        const filterValue = document.getElementById("filter-tingkat").value;

        // Filter tabel pelanggaran
        const rows = document.querySelectorAll("#tatib-table tbody tr");
        rows.forEach(row => {
            const tingkat = row.getAttribute("data-tingkat");
            if (filterValue === "" || tingkat === filterValue) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });

        // Filter sanksi berdasarkan tingkat
        const sanksiItems = document.querySelectorAll(".sanksi-tingkat");
        sanksiItems.forEach(item => {
            const tingkat = item.getAttribute("data-tingkat");
            if (filterValue === "" || tingkat === filterValue) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });
    }

 

