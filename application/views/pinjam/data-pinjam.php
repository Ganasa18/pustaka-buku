<div class="container">
  <center>
    <table>
      <tr>
        <td>
          <div class="table-responsive full-width">
            <table class="table table-bordered table-striped table-hover" id="table-datatable">
              <tr>
                <th>No Pinjam</th>
                <th>Tanggal Pinjam</th>
                <th>ID User</th>
                <th>ID Buku</th>
                <th>Tanggal Kembali</th>
                <th>Tanggal Pengembalian</th>
                <th>Terlambat</th>
                <th>Denda</th>
                <th>Status</th>
                <th>Total Denda</th>
                <th>Pilihan</th>
              </tr>
              <?php
              foreach ($pinjam as $p) {
              ?>
                <tr>
                  <td><?= $p['no_pinjam']; ?></td>
                  <td><?= $p['tgl_pinjam']; ?></td>
                  <td><?= $p['id_user']; ?></td>
                  <td><?= $p['id_buku']; ?></td>
                  <td><?= $p['tgl_kembali']; ?></td>
                  <td>
                    <?= $p['tgl_pengembalian']; ?>
                    <input type="hidden" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= date('Y-m-d'); ?>">
                  </td>
                  <td>
                    <?php
                    if ($p['status'] == "Kembali") {
                      $tglx = new DateTime($p['tgl_kembali']);
                      $tgly = new DateTime($p['tgl_pengembalian']);
                      if ($tgly < $tglx) {
                        $selisih = "0";
                        echo $selisih;
                      } else {
                        $selisih = $tgly->diff($tglx)->format("%a");
                        echo $selisih;
                      }
                    } else {
                      $tgl1 = new DateTime($p['tgl_kembali']);
                      $tgl2 = new DateTime();
                      if ($tgl2 < $tgl1) {
                        $selisih = "0";
                        echo $selisih;
                      } else {
                        $selisih = $tgl2->diff($tgl1)->format("%a");
                        echo $selisih;
                      }
                    }
                    ?> Hari
                  </td>
                  <td><?= $p['denda']; ?></td>
                  <?php if ($p['status'] == "Pinjam") {
                    $status = "warning";
                  } else {
                    $status = "secondary";
                  } ?>
                  <td><i class="btn btn-outline-<?= $status; ?> btn-sm"><?= $p['status']; ?></i></td>
                  <?php
                  if ($selisih < 0) {
                    $total_denda = $p['denda'] * 0;
                  } else {
                    $total_denda = $p['denda'] * $selisih;
                  }
                  ?>
                  <form action="<?= base_url('pinjam/ubahStatus/' . $p['id_buku'] . '/' . $p['no_pinjam']); ?>" method="POST">
                    <td><?= $total_denda; ?>
                      <input type="hidden" name="totaldenda" id="totaldenda" value="<?= $total_denda; ?>">
                    </td>
                    <td nowrap>
                      <?php if ($p['status'] == "Kembali") { ?>
                        <i class="btn btn-sm btn-outline-secondary"><i class="fas fa-fw fa-edit"></i>Ubah Status</i>
                      <?php } else { ?>
                        <button type="submit" class="btn btn-sm btn-outline-info"><i class="fas fa-fw fa-edit"></i>Ubah Status</button>
                      <?php } ?>
                    </td>
                  </form>
                </tr>
              <?php
              } ?>
            </table>
          </div>
        </td>
      </tr>
    </table>
  </center>
</div>
</div>