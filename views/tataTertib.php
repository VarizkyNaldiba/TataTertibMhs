<?php $title = 'Tata Tertib';
include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="container mt-5" style="margin-left: 270px;"> <!-- Margin left untuk menghindari sidebar -->
    <h1 class="text-center">Daftar Tata Tertib</h1>

    <form method="GET" action="/tataTertib"> <!-- Corrected action -->
        <div class="form-group">
            <label for="tingkat">Filter berdasarkan tingkat pelanggaran:</label>
            <select name="tingkat" class="form-control" id="tingkat">
                <option value="">Semua Tingkat</option>
                <option value="Tingkat I" <?php if (isset($tingkat) && $tingkat == 'Tingkat I') echo 'selected'; ?>>Tingkat I</option>
                <option value="Tingkat II" <?php if (isset($tingkat) && $tingkat == 'Tingkat II') echo 'selected'; ?>>Tingkat II</option>
                <option value="Tingkat III" <?php if (isset($tingkat) && $tingkat == 'Tingkat III') echo 'selected'; ?>>Tingkat III</option>
                <option value="Tingkat IV" <?php if (isset($tingkat) && $tingkat == 'Tingkat IV') echo 'selected'; ?>>Tingkat IV</option>
                <option value="Tingkat V" <?php if (isset($tingkat) && $tingkat == 'Tingkat V') echo 'selected'; ?>>Tingkat V</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Filter</button>
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
            <?php if (!empty($dataTatib)): ?>
                <?php foreach ($dataTatib as $index => $tatib): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($tatib['pelanggaran'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($tatib['tingkat'], ENT_QUOTES, 'UTF-8') ?></td>
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