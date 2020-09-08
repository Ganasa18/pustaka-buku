<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ModelBuku extends CI_Model
{
  //manajemen buku 
  // ? Tampil semua buku

  public function getBuku()
  {
    return $this->db->get('buku');
  }

  // * Tampil Limit Buku Dengan Parameter

  public function getBukuLimit($limit, $start)
  {
    return $this->db->get('buku', $limit, $start);
  }

  // * Count total buku

  public function countBuku()
  {
    return $this->db->get('buku')->num_rows();
  }
  public function bukuWhere($where)
  {
    return $this->db->get_where('buku', $where);
  }

  public function simpanBuku($data = null)
  {
    $this->db->insert('buku', $data);
  }
  // public function updateBuku($data, $where = null)
  // {
  //   $this->db->update('buku', $data, $where);
  // }
  public function hapusBuku($where = null)
  {
    $this->db->delete('buku', $where);
  }
  public function total($field, $where)
  {
    $this->db->select_sum($field);
    if (!empty($where) && count($where) > 0) {
      $this->db->where($where);
    }
    $this->db->from('buku');
    return $this->db->get()->row($field);
  }
  //manajemen kategori 
  public function getKategori()
  {
    return $this->db->get('kategori');
  }
  public function kategoriWhere($where)
  {
    return $this->db->get_where('kategori', $where);
  }
  public function simpanKategori($data = null)
  {
    $this->db->insert('kategori', $data);
  }
  public function hapusKategori($where = null)
  {
    $this->db->delete('kategori', $where);
  }
  public function updateKategori($where = null, $data = null)
  {
    $this->db->update('kategori', $data, $where);
  }
  //join 
  function detail_kategori($id_kategori)
  {
    return $this->db->get_where('kategori', array('id_kategori' => $id_kategori));
  }
  public function joinKategoriBuku($where)
  {
    $this->db->select('buku.id, buku.id_kategori, kategori.nama_kategori, judul_buku, 
                      pengarang, penerbit, tahun_terbit, isbn, stok, dipinjam, 
                      dibooking, image');
    $this->db->from('buku');
    $this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori');
    $this->db->where($where);
    return $this->db->get();
  }

  // public function _uploadImage()
  // {
  //   $config['upload_path']          = './assets/img/upload/';
  //   $config['allowed_types']        = 'gif|jpg|png';
  //   $config['file_name']            = 'img' . time();
  //   $config['overwrite']            = true;
  //   $config['max_size']             = 1024; // 1MB
  //   // $config['max_width']            = 1024;
  //   // $config['max_height']           = 768;

  //   $this->load->library('upload', $config);

  //   if ($this->upload->do_upload('image')) {
  //     return $this->upload->data("file_name");
  //   }

  //   return "default.jpg";
  // }
  // public function edit_data($where, $table)
  // {
  //   return $this->db->get_where($where, $table);
  // }

  // private function _UploadImage()
  // {
  //   $config['upload_path']          = './assets/img/upload/';
  //   $config['allowed_types']        = 'gif|jpg|png';
  //   $config['file_name']            = 'img' . time();
  //   $config['overwrite']            = true;
  //   $config['max_size']             = 1024; // 1MB
  //   // $config['max_width']            = 1024;
  //   // $config['max_height']           = 768;
  //   $this->load->library('upload', $config);

  //   if ($this->upload->do_upload('image')) {
  //     return $this->upload->data("file_name");
  //   }
  //   return "default.jpg";
  // }
}
