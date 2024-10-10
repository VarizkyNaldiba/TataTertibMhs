<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tata Tertib JTI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Tata Tertib</h1>

        <form method="GET" action="index.php">
            <div class="form-group">
                <label for="tingkat">Filter berdasarkan tingkat pelanggaran:</label>
                <select name="tingkat" class="form-control" id="tingkat">
                    <option value="">Semua Tingkat</option>
                    <option value="Tingkat I">Tingkat I</option>
                    <option value="Tingkat II">Tingkat II</option>
                    <option value="Tingkat III">Tingkat III</option>
                    <option value="Tingkat IV">Tingkat IV</option>
                    <option value="Tingkat V">Tingkat V</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pelanggaran</th>
                    <th>Tingkat</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($dataTatib): ?>
                    <?php foreach ($dataTatib as $index => $tatib): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $tatib['pelanggaran'] ?></td>
                            <td><?= $tatib['tingkat'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data tata tertib.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>