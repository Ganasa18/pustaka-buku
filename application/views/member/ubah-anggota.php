<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-9">
      <?= form_open_multipart('member/ubahProfil'); ?>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="text" name="email" id="email" class="form-control" value="<?= $email; ?>" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
        <div class="col-sm-10">
          <input type="text" name="nama" id="nama" class="form-control" value="<?= $user; ?>">
          <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-2">Gambar</div>
        <div class="col-sm-10">
          <div class="row">
            <div class="row mt-4">
              <div class="col-sm-3">
                <img src="<?= base_url('assets/sb/img/profile/') . $image; ?>" class="img-thumbnail">
              </div>
              <div class="col-sm-5">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image" for="image">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class=" modal-footer">
          <a class="btn btn-dark" href="<?= base_url('member/myProfil'); ?>"><i class="fas fa-ban"></i> Kembali</a>
          <button type="submit" class="btn btn-primary "><i class=" fas fa-plus-circle"></i> Ubah data</button>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
  <!-- Container End -->
</div>
<!-- Main Content End -->