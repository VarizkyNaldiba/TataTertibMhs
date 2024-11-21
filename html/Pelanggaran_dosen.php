<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggaran</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/perlanggaranPage.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUa8sa9fQb1EV7D7vEnFH3npZZMmj7f4cN2M1a1FmcYIbsGp67OA9CmMf6a9" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="sidebar">
        <img class="logo" src="../img/logo copy.png" alt="logo">
        <div class="logo-separator"></div>
        <ul>
            <li><a href="homepage.php"><i data-feather="home"></i></a></li>
            <li><a href="listTatib.php"><i data-feather="book"></i></a></li>
            <li class="active"><a href="pelanggaranpage.php"><i data-feather="x-square"></i></a></li>
            <li><a href=""><i data-feather="bell"></i></a></li>
        </ul>
    </div>

    <div class="content">
            <div class="header">
                <h1>Pelanggaran</h1>
            </div>
            <div class="profile">
                <p><strong>Nama :Ahmad Rusdi Ambarawa</strong></p>
                <p><strong>NIM : 2341010203</strong></p>
                <p><strong>Semester : 2</strong></p>
            </div>

            <h3>Tabel Pelanggaran</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Pelanggar</th>
                            <th>Pelanggaran</th>
                            <th>Tingkat Pelanggaran</th>
                            <th>Dosen Pengampu</th>
                            <th>Tugas Khusus</th>
                            <th>Surat</th>
                            <th>Poin</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ahmad Rusdi Ambarawa</td>
                            <td>Berkomunikasi dengan tidak sopan, baik tertulis atau tidak tertulis kepada mahasiswa, dosen, karyawan, atau orang lain</td>
                            <td>V</td>
                            <td>Dr. Wawan Agung S.pd</td>
                            <td>-</td>
                            <td>Surat Pernyataan tidak mengulangi lagi</td>
                            <td>2 Poin</td>
                            <td>On Progress</td>
                        </tr>
                    </tbody>
                </table>
                <div class="statement-button">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Kumpulkan
                </button>
                </div>
                
            </div>
    
            
            <div class="footer">
                <p>© Copyright 2024 web Tatib. All Rights Reserved.</p>
                <img class="footer-logo" src="../img/Logo name.png" alt="">
            </div>
        </div>

      <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <p class="text-muted" style="font-size: 0.9rem;">*File yang diupload maksimal 2 MB</p>

        <!-- Surat Pernyataan -->
        <div class="form-group">
          <label for="suratPernyataan" class="font-weight-bold">Surat Pernyataan: *</label>
          <div 
            class="upload-area border rounded bg-light d-flex align-items-center justify-content-center"
            style="height: 150px; border-style: dashed; cursor: pointer;" 
            onclick="document.getElementById('fileSurat').click()">
            <p class="text-muted mb-0" id="labelSurat">Upload File</p>
          </div>
          <input type="file" id="fileSurat" style="display: none;" onchange="updateFileName(this, 'labelSurat')">
        </div>

        <!-- Tugas Khusus -->
        <div class="form-group mt-3">
          <label for="tugasKhusus" class="font-weight-bold">Tugas Khusus: *</label>
          <div 
            class="upload-area border rounded bg-light d-flex align-items-center justify-content-center"
            style="height: 150px; border-style: dashed; cursor: pointer;" 
            onclick="document.getElementById('fileTugas').click()">
            <p class="text-muted mb-0" id="labelTugas">Upload File</p>
          </div>
          <input type="file" id="fileTugas" style="display: none;" onchange="updateFileName(this, 'labelTugas')">
        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

    <!-- feather icons -->
    <script>
        feather.replace();
    </script>
</body>
</html>