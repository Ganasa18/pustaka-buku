<!-- Begin Page Content -->
<div class="container-fluid">
  <?= $this->session->flashdata('pesan'); ?>
  <div class="row">
    <div class="col-lg-5">
      <?php if (validation_errors()) { ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php } ?>
      <?= $this->session->flashdata('pesan'); ?>
      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#kategoriBaruModal"><i class="fas fa-file-alt"></i> Tambah Kategori</a>
      <div class="card mb-4 py-3 border-bottom-primary">
        <div class="card-body">
          <table class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kategori</th>
                <th scope="col">Pilihan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $a = 1;
              foreach ($kategori as $k) { ?>
                <tr>
                  <th scope="row"><?= $a++; ?></th>
                  <td><?= $k['nama_kategori']; ?></td>
                  <td>
                    <a href="<?= base_url('buku/ubahKategori/') . $k['id_kategori']; ?>" class="badge badge-info"><i class="fas fa-edit" data-toggle="modal" data-target="#kategoriUbahModal"></i> Ubah</a>
                    <a href="<?= base_url('buku/hapusKategori/') . $k['id_kategori']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $k['nama_kategori']; ?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
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
<!-- Modal Tambah kategori baru-->
<div class="modal fade" id="kategoriBaruModal" tabindex="-1" role="dialog" aria-labelledby="kategoriBaruModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kategoriBaruModalLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('buku/kategori'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label> Kategori </label>
            <input type="text" class="form-control form-control-user" name="kategori" placeholder="New Kategori">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Ubah Kategori Modal -->
<div class="modal fade" id="kategoriUbahModal" tabindex="-1" role="dialog" aria-labelledby="kategoriUbahModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kategoriUbahModalLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('buku/kategori'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label> Kategori </label>
            <input type="text" class="form-control form-control-user" name="kategori" placeholder="New Kategori">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Modal Tambah Mneu -->

<!-- Modal Update kategori baru-->
<!-- <div class="modal fade" id="kategoriUpdateModal" tabindex="-1" role="dialog" aria-labelledby="kategoriUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kategoriUpdateModal">Update Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('buku/ubahKategori'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control form-control-user" name="kategori" placeholder="New Kategori">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div> -->
<!-- End of Modal Update -->