<?php
class Home extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model(['ModelBuku', 'ModelUser', 'ModelBooking', 'ModelPengunjung']);
    $this->ModelPengunjung->count_visitor();
  }
  public function index()
  {
    $global = json_decode(file_get_contents('https://coronavirus-19-api.herokuapp.com/all'), true);
    $indonesia = json_decode(file_get_contents('https://api.kawalcorona.com/indonesia/'), true);

    // PAGINATION
    $this->load->library('pagination');
    // CONFIG
    $config['base_url'] = base_url('home/index/');
    $config['total_rows'] = $this->ModelBuku->countBuku();
    $config['per_page'] = 8;
    // Styling
    $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul></nav>';
    $config['last_link'] = 'First';
    $config['first_tag_open'] = ' <li class="page-item">';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = ' <li class="page-item">';
    $config['last_tag_close'] = '</li>';

    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = ' <li class="page-item">';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = ' <li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = ' <li class="page-item active"><a class="page-link">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = ' <li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['attributes'] = array('class' => 'page-link');
    // Initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data = [
      'judul' => "Katalog Buku",
      'buku' => $this->ModelBuku->getBukuLimit($config['per_page'], $data['start'])->result(),
      'global' => $global,
      'indo' => $indonesia,
    ];
    //jika sudah login dan jika belum login 
    if ($this->session->userdata('email')) {
      $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
      $data['user'] = $user['nama'];




      $this->load->view('templates/templates-user/header', $data);
      $this->load->view('buku/daftarbuku', $data);
      $this->load->view('templates/templates-user/modal');
      $this->load->view('templates/templates-user/footer', $data);
    } else {
      $data['user'] = 'Pengunjung';
      $this->load->view('templates/templates-user/header', $data);
      $this->load->view('buku/daftarbuku', $data);
      $this->load->view('templates/templates-user/modal');
      $this->load->view('templates/templates-user/footer', $data);
    }
  }

  public function detailBuku()
  {
    $id = $this->uri->segment(3);
    $buku = $this->ModelBuku->joinKategoriBuku(['buku.id' => $id])->result();
    $data['user'] = "Pengunjung";
    $data['title'] = "Detail Buku";
    foreach ($buku as $fields) {
      $data['judul'] = $fields->judul_buku;
      $data['pengarang'] = $fields->pengarang;
      $data['penerbit'] = $fields->penerbit;
      $data['kategori'] = $fields->nama_kategori;
      $data['tahun'] = $fields->tahun_terbit;
      $data['isbn'] = $fields->isbn;
      $data['gambar'] = $fields->image;
      $data['dipinjam'] = $fields->dipinjam;
      $data['dibooking'] = $fields->dibooking;
      $data['stok'] = $fields->stok;
      $data['id'] = $id;
    }
    $this->load->view('templates/templates-user/header', $data);
    $this->load->view('buku/detail-buku', $data);
    $this->load->view('templates/templates-user/modal');
    $this->load->view('templates/templates-user/footer');
  }


  public function blok()
  {
    $this->load->view('autentifikasi/blok');
  }
  public function gagal()
  {
    $this->load->view('autentifikasi/gagal');
  }
}
