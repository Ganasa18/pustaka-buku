<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Gulu_Gulu_Team with Bootstrap SB Admin 2 <?= date('Y'); ?></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yakin mau keluar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih "Logout" di bawah jika kamu yakin sudah selesai.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="<?= base_url('autentifikasi/logout'); ?>">Logout</a>
      </div>
    </div>
  </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>sb/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>sb/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>sb/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>sb/js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>sb/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>sb/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/myscript.js"></script>
<!-- <script src="<?= base_url('assets/'); ?>sb/js/demo/chart-pie-demo.js"></script>
<script src="<?= base_url('assets/'); ?>sb/vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script>
  $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });
  $(document).ready(function() {
    $("#table-datatable").dataTable({
      "lengthMenu": [5, 10, 25, 50, 75, 100],
    });
  });
  $('.alert-message').alert().delay(3500).slideUp('slow');
  $(document).ready(function() {
    $("#table-datatable2").dataTable({
      "lengthMenu": [5, 10, 25, 50, 75, 100],
      "searching": false,
      "bLengthChange": false,
    });
  });

  $(document).ready(function() {
    $(document).on('click', '#detail', function() {
      var nama = $(this).data('nama');
      var email = $(this).data('email');
      var alamat = $(this).data('alamat');
      var tanggal_input = $(this).data('tanggal');
      var is_active = $(this).data('status');
      var role_id = $(this).data('role');
      $('#nama').text(nama);
      $('#email').text(email);
      $('#alamat').text(alamat);
      $('#tanggal').text(tanggal_input);
      $('#status').text(is_active);
      $('#role').text(role_id);
      $('#modal-item').modal('hide');
    });
  });
</script>
</body>

</html>