<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <style type="text/css">
    .table-data {
        width: 100%;
        border-collapse: collapse;
    }

    .table-data tr th,
    .table-data tr td {
        border: 1px solid black;
        font-size: 11pt;
        font-family: Verdana;
        padding: 10px 10px 10px 10px;
    }

    h3 {
        font-family: Verdana;
    }
    </style>
    <h3>
        <center>Laporan Data Peminjam</center>
    </h3>
    <br />
    <table class="table-data">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Anggota</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Tanggal Pinjam</th>
                <th scope="col">Tanggal Kembali </th>
                <th scope="col">Tanggal Dikembalikan</th>
                <th scope="col">Total Denda</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($laporan as $l) { ?>
            <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $l['nama']; ?></td>
                <td><?= $l['judul_buku']; ?></td>
                <td><?= $l['tgl_pinjam']; ?></td>
                <td><?= $l['tgl_kembali']; ?></td>
                <td><?= $l['tgl_pengembalian']; ?></td>
                <td><?= $l['total_denda']; ?></td>
                <td><?= $l['status']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <script type="text/javascript">
    window.print();
    </script>
</body>

</html>