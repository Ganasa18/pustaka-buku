<div class="row">
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-bottom-warning shadow h-100 py-2 bg-light">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-md font-weight-bold text-dark text-uppercase mb-1">Cases</div>
            <div class="h1 mb-0 font-weight-bold text-dark"><?= $global['cases'] ?>
            </div>
          </div>
          <div class="col-auto">
            <a href="#"><i class="far fa-frown-open fa-3x text-warning"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-bottom-danger shadow h-100 py-2 bg-light">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-md font-weight-bold text-dark text-uppercase mb-1">Death</div>
            <div class="h1 mb-0 font-weight-bold text-dark">
              <?= $global['deaths'] ?>
            </div>
          </div>
          <div class="col-auto">
            <a href="#"><i class="far fa-sad-cry fa-3x text-danger"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-bottom-success shadow h-100 py-2 bg-light">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-md font-weight-bold text-dark text-uppercase mb-1">Recovered</div>
            <div class="h1 mb-0 font-weight-bold text-dark">
              <?= $global['recovered'] ?>
            </div>
          </div>
          <div class="col-auto">
            <a href="#"><i class="far fa-grin-squint fa-3x text-success"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg">
    <div class="card border-bottom-info shadow h-100 py-2 bg-light">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-md font-weight-bold text-dark text-uppercase mb-1">Indonesia</div>
            <div class="h4 mb-0 font-weight-bold text-dark">
              Positif : <?= $indo[0]['positif'] ?> orang <br> Meninggal : <?= $indo[0]['meninggal'] ?> orang <br> Sembuh : <?= $indo[0]['sembuh'] ?> orang <br>
            </div>
          </div>
          <div class="col-auto">
            <a href="#"><i class="fas fa-globe-asia fa-3x text-info"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-lg">
    <div class="container-fluid mx-auto">
      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="<?= base_url('assets/sb/img/upload/conan.jpg') ?>" class="d-block w-30" style="width: 100%; height: 350px;" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="<?= base_url('assets/sb/img/upload/komanak.jpg') ?>" class="d-block w-30" alt="..." style="width: 100%; height: 350px;">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second slide label</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="<?= base_url('assets/sb/img/upload/statistika.jpg') ?>" class="d-block w-30" alt="..." style="width: 100%; height: 350px;">
            <div class="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div>


<div style="padding: 25px;">

  <!-- Tampilkan semua produk -->
  <div class="row">
    <!-- looping products -->
    <?php foreach ($buku as $buku) { ?>
      <div class="col-md-2 col-md-3">
        <div class="thumbnail" style="height: 370px;">
          <img src="<?php echo base_url(); ?>assets/sb/img/upload/<?= $buku->image; ?>" style="max-width:100%; max-height: 100%; height: 200px; width: 180px">
          <div class="caption">
            <h5 style="min-height:30px;"><?= $buku->pengarang ?></h5>
            <h5><?= $buku->penerbit ?></h5>
            <h5><?= substr($buku->tahun_terbit, 0, 4) ?></h5>
            <p>
              <?php
              if ($buku->stok < 1) {
                echo "<i class='btn btn-outline-primary fas fw fa-shopping-cart'> Booking&nbsp;&nbsp 0</i>";
              } else {
                echo "<a class='btn btn-outline-primary fas fw fa-shopping-cart' href='" . base_url('booking/tambahBooking/' . $buku->id) . "'> Booking</a>";
              }
              ?>
              <a class="btn btn-outline-warning fas fw fa-search" href="<?= base_url('home/detailBuku/' . $buku->id); ?>"> Detail</a></p>
          </div>
        </div>
      </div> <?php } ?>

    <!-- end looping -->
  </div>
  <?= $this->pagination->create_links(); ?>

  <script>

  </script>