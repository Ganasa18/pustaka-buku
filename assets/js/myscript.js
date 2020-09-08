const flashData = $('.flash-data').data('flashdata');
if (flashData == true) {
	Swal.fire({
		title: 'Data Buku',
		text: 'Berhasil' + flashData,
		icon: 'success'
	});
}
