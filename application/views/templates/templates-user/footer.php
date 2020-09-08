</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="<?= base_url(); ?>assets/sb/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/'); ?>sb/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>sb/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>sb/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>sb/js/sb-admin-2.min.js"></script>
<script>
  $(document).ready(function() {

    function semuaData() {
      $.ajax({
        url: 'https://coronavirus-19-api.herokuapp.com/all',
        type: "POST",
        dataType: 'JSON',
        success: function(data) {
          try {
            var json = data;
            var kasus = data.cases
            var meninggal = data.deaths
            var sembuh = data.recovered
            $('#data-kasus').html(data);
          } catch {
            alert('Error')
          }
        }
      })
    }
  })

  $('.alert').alert().delay(3000).slideUp('slow');
  $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });
</script>
</body>

</html>