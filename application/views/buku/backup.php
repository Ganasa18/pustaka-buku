<!-- Begin Page Content -->

<!-- End of Main Content -->
<!-- Modal Tambah buku baru-->
<div class="container">


  <form action="<?= base_url('buku/ubahBuku'); ?>" method="post" enctype="multipart/form-data">
    <?php foreach ($buku as $b) : ?>
      <div class="form-group">
        <input type="text" class="form-control form-control-user" id="judul_buku" name="judul_buku" value="<?= $b['judul_buku']; ?>">
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
        <input type="text" class="form-control form-control-user" id="pengarang" name="pengarang" value="<?= $b['pengarang']; ?>">
      </div>
      <div class=" form-group">
        <input type="text" class="form-control form-control-user" id="penerbit" name="penerbit" value="<?= $b['penerbit']; ?>">
      </div>
      <div class=" form-group">
        <select name="tahun" class="form-control form-control-user">
          <option value="">Pilih Tahun</option>
          <?php
            for ($i = date('Y'); $i > 1000; $i--) { ?>
            <option value="<?= $i; ?>"><?= $i; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <input type="text" class="form-control form-control-user" id="isbn" name="isbn" value="<?= $b['isbn']; ?>">
      </div>
      <div class=" form-group">
        <input type="text" class="form-control form-control-user" id="stok" name="stok" value="<?= $b['stok']; ?>">
      </div>
      <div class="row">
        <div class="col-sm-3">
          <img src="<?= base_url('assets/sb/img/upload/') . $b['image']; ?>" class="img-thumbnail">
        </div>
        <div class=" form-group">
          <input type="file" class="form-control form-control-user" id="image" name="image" value="<?= $b['image']; ?>">
        </div>
      </div>
      <div class=" modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Ubah data</button>
      </div>
    <?php endforeach; ?>
  </form>
</div>

<!-- End of Modal Tambah Mneu -->