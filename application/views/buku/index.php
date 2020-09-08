<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="flashdata" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>
  <?= $this->session->flashdata('pesan'); ?>
  <div class="row">
    <div class="col-lg-12">
      <!-- Basic Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"> List Books </h6>
        </div>
        <div class="card-body">
          <?php if (validation_errors()) { ?>
            <div class="alert alert-danger" role="alert">
              <?= validation_errors(); ?>
            </div>
          <?php } ?>
          <?= $this->session->flashdata('pesan'); ?>
          <a href="" class="btn btn-info float-right mb-3" data-toggle="modal" data-target="#bukuBaruModal"><i class="fas fa-plus"></i> Buku Baru</a>
          <table class="table table-responsive mt-3" id="table-datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Tahun Terbit</th>
                <th scope="col">ISBN</th>
                <th scope="col">Stok</th>
                <th scope="col">DiPinjam</th>
                <th scope="col">DiBooking</th>
                <th scope="col">Gambar</th>
                <th scope="col">Pilihan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $a = 1;
              foreach ($buku as $b) { ?>
                <tr>
                  <th scope="row"><?= $a++; ?></th>
                  <td><?= $b['judul_buku']; ?></td>
                  <td><?= $b['pengarang']; ?></td>
                  <td><?= $b['penerbit']; ?></td>
                  <td><?= $b['tahun_terbit']; ?></td>
                  <td><?= $b['isbn']; ?></td>
                  <td><?= $b['stok']; ?></td>
                  <td><?= $b['dipinjam']; ?></td>
                  <td><?= $b['dibooking']; ?></td>
                  <td>
                    <picture>
                      <source srcset="" type="image/svg+xml">
                      <img src="<?= base_url('assets/sb/img/upload/') . $b['image']; ?>" class="img-fluid img-thumbnail" alt="...">
                    </picture>
                  </td>
                  <td>
                    <a href="<?= base_url('buku/UbahBuku/') . $b['id']; ?>" class="btn btn-warning btn-circle "><i class="fas fa-pencil-alt"></i></a>
                    <a href="<?= base_url('buku/hapusbuku/') . $b['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $b['judul_buku']; ?> ?');" class="btn btn-danger btn-circle mt-2"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>


    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Modal Tambah buku baru-->
<div class="modal fade" id="bukuBaruModal" tabindex="-1" role="dialog" aria-labelledby="bukuBaruModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bukuBaruModalLabel">Tambah Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('buku'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control form-control-user" id="judul_buku" name="judul_buku" placeholder="Masukkan Judul Buku">
          </div>
          <div class="form-group">
            <select name="id_kategori" class="form-control form-control-user">
              <option value="">Pilih Kategori</option>
              <?php
              foreach ($kategori as $k) { ?>
                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-user" id="pengarang" name="pengarang" placeholder="Masukkan nama pengarang">
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-user" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit">
          </div>
          <div class="form-group">
            <select name="tahun" class="form-control form-control-user">
              <option value="">Pilih Tahun</option>
              <?php
              for ($i = date('Y'); $i > 1000; $i--) { ?>
                <option value="<?= $i; ?>"><?= $i; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-user" id="isbn" name="isbn" placeholder="Masukkan ISBN">
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan nominal stok">
          </div>
          <div class="form-group">
            <input type="file" class="form-control form-control-user" id="image" name="image">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
          <button type="submit" name="image" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Modal Tambah Mneu -->