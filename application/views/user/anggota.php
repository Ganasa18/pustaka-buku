<!-- Begin Page Content -->
<div class="container-fluid">

  <?= $this->session->flashdata('pesan'); ?>
  <div class="row">
    <div class="col-lg-12">
      <?php if (validation_errors()) { ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php } ?>
      <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-borderless table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Email</th>
                  <!-- <th scope="col" nowrap>Member Sejak</th> -->
                  <th scope="col">Image</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $i = 1;
                foreach ($anggota as $a) { ?>
                  <tr>
                    <th scope=" row"><?= $i++; ?></th>
                    <td><?= $a['nama']; ?></td>
                    <td><?= $a['email']; ?></td>
                    <!-- <td><?= date('d F Y', $a['tanggal_input']); ?></td> -->
                    <td>
                      <picture>
                        <source srcset="" type="image/svg+xml">
                        <img src="<?= base_url('assets/sb/img/profile/') . $a['image']; ?>" class="img-fluid img-thumbnail" alt="profile" style="width:60px;height:80px;">
                      </picture>
                    </td>
                    <td class="text-center">
                      <a class="btn btn-info text-light" id="detail" data-toggle="modal" data-target="#modal-detail" data-nama="<?= $a['nama']; ?>" data-email="<?= $a['email']; ?>" data-alamat="<?= $a['alamat']; ?>" data-tanggal="<?= date('d F Y', $a['tanggal_input']); ?>" data-status="<?= $a['is_active']  == '1' ? 'Active' : 'Deactive' ?>" data-role="<?= $a['role_id']  == '1' ? 'Admin' : 'Member' ?>">
                        <i class="fas fa-eye"></i> INFO </a>
                    </td>
                    <!--<td>
                                        <a href="<?
                                                  ?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                                        <a href="<?
                                                  ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $b['judul_buku']; ?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
                                    </td> -->
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade show" id="modal-detail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered no-margin table-hover">
            <tbody>
              <tr>
                <th> Nama </th>
                <td><span id="nama"></span></td>
              </tr>
              <tr>
                <th> Email </th>
                <td><span id="email"></span></td>
              </tr>
              <tr>
                <th> Alamat </th>
                <td><span id="alamat"></span></td>
              </tr>
              <tr>
                <th> Member Sejak </th>
                <td><span id="tanggal"></span></td>
              </tr>
              <tr>
                <th> Status </th>
                <td><span id="status"></span></td>
              </tr>
              <tr>
                <th> Role Id </th>
                <td><span id="role"></span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>