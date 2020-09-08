<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user();
    }

    //manajemen Buku 
    public function index()
    {

        $data['judul'] = 'Data Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]', [
            'required' => 'Judul Buku harus diisi',
            'min_length' => 'Judul buku terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Nama pengarang harus diisi',
        ]);
        $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [
            'required' => 'Nama pengarang harus diisi',
            'min_length' => 'Nama pengarang terlalu pendek'
        ]);
        $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
            'required' => 'Nama penerbit harus diisi',
            'min_length' => 'Nama penerbit terlalu pendek'
        ]);
        $this->form_validation->set_rules('tahun', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric', [
            'required' => 'Tahun terbit harus diisi',
            'min_length' => 'Tahun terbit terlalu pendek',
            'max_length' => 'Tahun terbit terlalu panjang',
            'numeric' => 'Hanya boleh diisi angka'
        ]);
        $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [
            'required' => 'Nama ISBN harus diisi',
            'min_length' => 'Nama ISBN terlalu pendek',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();
        $this->load->library('upload', $config);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = '';
            }
            $data = [
                'judul_buku' => $this->input->post('judul_buku', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'pengarang' => $this->input->post('pengarang', true),
                'penerbit' => $this->input->post('penerbit', true),
                'tahun_terbit' => $this->input->post('tahun', true),
                'isbn' => $this->input->post('isbn', true),
                'stok' => $this->input->post('stok', true),
                'dipinjam' => 0,
                'dibooking' => 0,
                'image' => $gambar
            ];
            $this->ModelBuku->simpanBuku($data);
            redirect('index.php/buku');
        }
    }


    public function hapusBuku()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelBuku->hapusBuku($where);
        redirect('index.php/buku');
    }


    public function kategori()
    {
        $data['judul'] = 'Kategori Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => 'Judul Buku harus diisi'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/kategori', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_kategori' => $this->input->post('kategori', true)
            ];
            $this->ModelBuku->simpanKategori($data);
            redirect('buku');
        }
    }
    public function ubahKategori()
    {
        $data['judul'] = 'Ubah Data Kategori';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelBuku->kategoriWhere(['id_kategori' => $this->uri->segment(3)])->result_array();

        $this->form_validation->set_rules('kategori', 'Nama Kategori', 'required|min_length[3]', [
            'required' => 'Nama Kategori harus diisi',
            'min_length' => 'Nama Kategori terlalu pendek'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/ubah_kategori', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'nama_kategori' => $this->input->post('kategori', true)
            ];

            $this->ModelBuku->updateKategori(['id_kategori' => $this->input->post('id')], $data);
            redirect('buku/kategori');
        }
    }

    public function hapusKategori()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelBuku->hapusKategori($where);
        redirect('index.php/buku/kategori');
    }

    public function ubahBuku()
    {
        $data['judul'] = 'Ubah Data Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->ModelBuku->bukuWhere(['id' => $this->uri->segment(3)])->result_array();
        $kategori = $this->ModelBuku->joinKategoriBuku(['buku.id' => $this->uri->segment(3)])->result_array();
        foreach ($kategori as $k) {
            $data['id'] = $k['id_kategori'];
            $data['k'] = $k['id_kategori'];
        }
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]', [
            'required' => 'Judul Buku harus diisi',
            'min_length' => 'Judul buku terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Nama pengarang harus diisi',
        ]);
        $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [
            'required' => 'Nama pengarang harus diisi',
            'min_length' => 'Nama pengarang terlalu pendek'
        ]);
        $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
            'required' => 'Nama penerbit harus diisi',
            'min_length' => 'Nama penerbit terlalu pendek'
        ]);
        $this->form_validation->set_rules('tahun', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric', [
            'required' => 'Tahun terbit harus diisi',
            'min_length' => 'Tahun terbit terlalu pendek',
            'max_length' => 'Tahun terbit terlalu panjang',
            'numeric' => 'Hanya boleh diisi angka'
        ]);
        $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [
            'required' => 'Nama ISBN harus diisi',
            'min_length' => 'Nama ISBN terlalu pendek',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/ubah_buku', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $judul_buku = $this->input->post('judul_buku');
            $id_kategori = $this->input->post('id_kategori');
            $pengarang = $this->input->post('pengarang');
            $penerbit = $this->input->post('penerbit');
            $tahun_terbit = $this->input->post('tahun');
            $isbn = $this->input->post('isbn');
            $stok = $this->input->post('stok');
            // $dipinjam = $this->input->post('dipinjam');
            // $dibooking = $this->input->post('dibooking');
            // cek gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/sb/img/upload/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['buku']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/sb/img/upload/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('judul_buku', $judul_buku);
            $this->db->set('id_kategori', $id_kategori);
            $this->db->set('pengarang', $pengarang);
            $this->db->set('penerbit', $penerbit);
            $this->db->set('tahun_terbit', $tahun_terbit);
            $this->db->set('isbn', $isbn);
            $this->db->set('stok', $stok);
            // $this->db->set('dipinjam', $dipinjam);
            // $this->db->set('dibooking', $dibooking);
            $this->db->where('id', $id);
            $this->db->update('buku');
            redirect('buku');
        }
    }
}

            //  = $this->input->post('id');
            // $judul_buku = $this->input->post('judul_buku');
            // $id_kategori = $this->input->post('id_kategori');
            // $pengarang = $this->input->post('pengarang');
            // $penerbit = $this->input->post('penerbit');
            // $tahun_terbit = $this->input->post('tahun');
            // $isbn = $this->input->post('isbn');
            // $stok = $this->input->post('stok');
            // $dipinjam = $this->input->post('dipinjam');
            // $dibooking = $this->input->post('dibooking');


            // $upload_image = $_FILES['image']['name'];

            // if ($upload_image) {
            //     $config['allowed_types'] = 'gif|jpg|png';
            //     $config['max_size']      = '2048';
            //     $config['upload_path']   = './assets/sb/img/upload/';
            //     $config['file_name'] = 'image' . time();


            //     $this->load->library('upload', $config);
            //     $this->upload->initialize($config);

            //     if ($this->upload->do_upload('image')) {

            //         $new_image = $this->upload->data('file_name');
            //         $this->db->set('image', $new_image);
            //     } else {
            //         echo $this->upload->display_errors();
            //     }
            // }


            // $this->db->set('judul_buku', $judul_buku);
            // $this->db->set('id_kategori', $id_kategori);
            // $this->db->set('pengarang', $pengarang);
            // $this->db->set('penerbit', $penerbit);
            // $this->db->set('tahun_terbit', $tahun_terbit);
            // $this->db->set('isbn', $isbn);
            // $this->db->set('stok', $stok);
            // $this->db->set('dipinjam', $dipinjam);
            // $this->db->set('dibooking', $dibooking);
            // $this->db->where('id', $id);
            // $this->db->update('buku');
            // if (!empty($_FILES["image"]["name"])) {
            //     $this->image = $this->ModelBuku->_uploadImage();
            // } else {
            //     $this->image = $post["old_image"];
            // }
            // // if ($this->upload->do_upload('image')) {
            // //     $image = $this->upload->data();
            // //     unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
            // //     $gambar = $image['file_name'];
            // // } else {
            // //     $gambar = $this->input->post('old_pict', TRUE);
            // // }
            // $data = [
            //     'judul_buku' => $this->input->post('judul_buku', true),
            //     'id_kategori' => $this->input->post('id_kategori', true),
            //     'pengarang' => $this->input->post('pengarang', true),
            //     'penerbit' => $this->input->post('penerbit', true),
            //     'tahun_terbit' => $this->input->post('tahun', true),
            //     'isbn' => $this->input->post('isbn', true),
            //     'stok' => $this->input->post('stok', true),
            //     'dipinjam' => $this->input->post('dipinjam', true),
            //     'dibooking' => $this->input->post('dibooking', true),






        // if ($this->form_validation->run() == false) {
        //     $this->load->view('templates/header', $data);
        //     $this->load->view('templates/sidebar', $data);
        //     $this->load->view('templates/topbar', $data);
        //     $this->load->view('buku/ubah_buku', $data);
        //     $this->load->view('templates/footer');
        // } else {
        //     //konfigurasi sebelum gambar diupload
        //     $config['upload_path'] = './assets/img/upload/';
        //     $config['allowed_types'] = 'jpg|png|jpeg';
        //     $config['max_size'] = '3000';
        //     $config['max_width'] = '1024';
        //     $config['max_height'] = '1000';
        //     $config['file_name'] = 'img' . time();
        //     $this->load->library('upload', $config);

        //     if ($this->upload->do_upload('image')) {
        //         $image = $this->upload->data();
        //         unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
        //         $gambar = $image['file_name'];
        //     } else {
        //         $gambar = $this->input->post('old_pict', TRUE);
        //         $this->db->set('image', $gambar);
        //     }
        // }

        // if ($this->form_validation->run() == false) {
        //     $this->load->view('templates/header', $data);
        //     $this->load->view('templates/sidebar', $data);
        //     $this->load->view('templates/topbar', $data);
        //     $this->load->view('buku/ubah_buku', $data);
        //     $this->load->view('templates/footer');
        // } else {
        //         //konfigurasi sebelum gambar diupload 
        //         $config['upload_path'] = './assets/img/upload/';
        //         $config['allowed_types'] = 'jpg|png|jpeg';
        //         $config['max_size'] = '3000';
        //         $config['max_width'] = '1024';
        //         $config['max_height'] = '1000';
        //         $config['file_name'] = 'img' . time();
        //         //memuat atau memanggil library upload 
        //         $this->load->library('upload', $config);
        //         if ($this->form_validation->run() == false) {
        //             $this->load->view('templates/header', $data);
        //             $this->load->view('templates/sidebar', $data);
        //             $this->load->view('templates/topbar', $data);
        //             $this->load->view('buku/ubah_buku', $data);
        //             $this->load->view('templates/footer');
        //         } else {
        //             if ($this->upload->do_upload('image')) {
        //                 $image = $this->upload->data();
        //                 unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
        //                 $gambar = $image['file_name'];
        //             } else {
        //                 $gambar = $this->input->post('old_pict', TRUE);
        //                 $this->db->set('image', $gambar);
        //             }
