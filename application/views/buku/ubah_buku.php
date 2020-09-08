<div class="container">
    <?php foreach ($buku as $b) : ?>
        <?= form_open_multipart('buku/ubahBuku'); ?>
        <div class="row">
            <div class="col-lg-9">
                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="hidden" name="id" value="<?php echo $b['id'] ?>">
                    <input type="text" class="form-control form-control-user" id="judul_buku" name="judul_buku" value="<?= $b['judul_buku']; ?>">
                </div>
                <div class="form-group">
                    <label>Id Kategori</label>
                    <select name="id_kategori" class="form-control form-control-user">
                        <?php foreach ($kategori as $k) : ?>
                            <option value="<?= $k['id_kategori'] ?> " <?= $k['id_kategori'] == $b['id_kategori'] ? 'selected' : null ?>><?= $k['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pengarang</label>
                    <input type="text" class="form-control form-control-user" id="pengarang" name="pengarang" value="<?= $b['pengarang']; ?>">
                </div>
                <div class=" form-group">
                    <label>Penerbit</label>
                    <input type="text" class="form-control form-control-user" id="penerbit" name="penerbit" value="<?= $b['penerbit']; ?>">
                </div>
                <div class=" form-group">
                    <label>Tahun Terbit</label>
                    <select name="tahun" id="tahun" class="form-control form-control-user">
                        <option value="<?= $b['tahun_terbit']; ?>"><?= $b['tahun_terbit']; ?></option>
                        <?php
                        for ($i = date('Y'); $i > 1500; $i--) { ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                        <?php } ?>
                    </select>
                    <!-- <input type="text" class="form-control form-control-user" id="tahun" name="tahun" value="<?= $b['tahun_terbit']; ?>"> -->
                </div>
                <div class="form-group">
                    <label>No ISBN</label>
                    <input type="text" class="form-control form-control-user" id="isbn" name="isbn" value="<?= $b['isbn']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Stok Buku</label>
                    <input type="text" class="form-control form-control-user" id="stok" name="stok" value="<?= $b['stok']; ?>">
                </div>
                <div class="row mt-4">
                    <div class="col-sm-3">
                        <img src="<?= base_url('assets/sb/img/upload/') . $b['image']; ?>" class="img-thumbnail">
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" for="image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                    <div class=" modal-footer">
                        <button class="btn btn-dark" onclick="window.history.go(-1)"><i class="fas fa-ban"></i> Kembali</button>
                        <button type="submit" class="btn btn-primary "><i class=" fas fa-plus-circle"></i> Ubah data</button>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
        </form>
        </div>
</div>