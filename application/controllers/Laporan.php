<?php
defined('BASEPATH') or exit('No Direct script access allowed');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Laporan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model(['ModelUser', 'ModelBuku', 'ModelPinjam']);
  }
  public function laporan_buku()
  {
    $data['judul'] = 'Laporan Data Buku';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();
    $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('buku/laporan_buku', $data);
    $this->load->view('templates/footer');
  }

  public function cetak_laporan_buku()
  {
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();
    $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
    $this->load->view('buku/laporan_print_buku', $data);
  }

  public function laporan_buku_pdf()
  {
    $this->load->library('pdf');
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();
    $this->load->view('buku/laporan_pdf_buku', $data);

    $paper_size = 'A4'; // ukuran kertas 
    $orientation = 'landscape'; //tipe format kertas potrait atau landscape 

    $this->pdf->set_paper($paper_size, $orientation);
    //Convert to PDF 
    $this->pdf->filename = "laporan_data_buku.pdf";
    // nama file pdf yang di hasilkan 
    $this->pdf->load_view('buku/laporan_pdf_buku', $data);
  }

  // public function export_excel()
  // {
  //   $data['title'] = "Laporan Buku";
  //   $data['buku'] = $this->ModelBuku->getBuku()->result_array();
  //   $this->load->view('buku/export_excel_buku', $data);
  // }


  public function export_excel()
  {
    $buku = $this->ModelBuku->getBuku()->result_array();

    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No')
      ->setCellValue('B1', 'Judul Buku')
      ->setCellValue('C1', 'Pengarang')
      ->setCellValue('D1', 'Penerbit')
      ->setCellValue('E1', 'Tahun Terbit')
      ->setCellValue('F1', 'Isbn')
      ->setCellValue('G1', 'Stok');

    $kolom = 2;
    $nomor = 1;
    foreach ($buku as $b) {

      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $kolom, $nomor)
        ->setCellValue('B' . $kolom, $b['judul_buku'])
        ->setCellValue('C' . $kolom, $b['pengarang'])
        ->setCellValue('D' . $kolom, $b['penerbit'])
        ->setCellValue('E' . $kolom, $b['tahun_terbit'])
        ->setCellValue('F' . $kolom, $b['isbn'])
        ->setCellValue('G' . $kolom, $b['stok']);
      $kolom++;
      $nomor++;
    }

    $writer = new Xlsx($spreadsheet);

    setlocale(LC_ALL, 'en_US');
    $filename = 'Laporan-Buku';
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($spreadsheet, 'Html');
    ob_end_clean();
    $writer->save('php://output');
    exit();
  }

  public function laporan_pinjam()
  {
    $data['judul'] = 'Laporan Data Peminjaman';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d, buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar', $data);
    $this->load->view('pinjam/laporan-pinjam', $data);
    $this->load->view('templates/footer');
  }

  public function laporan_print_pinjam()
  {
    $data['laporan'] = $this->db->query("
    select * from pinjam p,detail_pinjam d, 
    buku b,user u where d.id_buku=b.id 
    and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();
    $this->load->view('pinjam/laporan_print_pinjam', $data);
  }

  public function laporan_pinjam_pdf()
  {
    $this->load->library('pdf');
    $data['laporan'] = $this->db->query("
    select * from pinjam p,detail_pinjam d, 
    buku b,user u where d.id_buku=b.id 
    and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();

    $this->load->view('pinjam/laporan_pinjam_pdf', $data);

    $paper_size = 'A4'; // ukuran kertas 
    $orientation = 'landscape'; //tipe format kertas potrait atau landscape 

    $this->pdf->set_paper($paper_size, $orientation);
    //Convert to PDF 
    $this->pdf->filename = "laporan_data_peminjam.pdf";
    // nama file pdf yang di hasilkan 
    $this->pdf->load_view('pinjam/laporan_pinjam_pdf', $data);
  }


  public function export_excel_pinjam()
  {
    $peminjam = $this->db->query("
    select * from pinjam p,detail_pinjam d, 
    buku b,user u where d.id_buku=b.id 
    and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();


    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No')
      ->setCellValue('B1', 'Nama Anggota')
      ->setCellValue('C1', 'Judul Buku')
      ->setCellValue('D1', 'Tanggal Pinjam')
      ->setCellValue('E1', 'Tanggal Kembali')
      ->setCellValue('F1', 'Tanggal Dikembalikan')
      ->setCellValue('G1', 'Total Denda')
      ->setCellValue('H1', 'Total Status');

    $kolom = 2;
    $nomor = 1;

    foreach ($peminjam as $p) {

      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $kolom, $nomor)
        ->setCellValue('B' . $kolom, $p['nama'])
        ->setCellValue('C' . $kolom, $p['judul_buku'])
        ->setCellValue('D' . $kolom, $p['tgl_pinjam'])
        ->setCellValue('E' . $kolom, $p['tgl_kembali'])
        ->setCellValue('F' . $kolom, $p['tgl_pengembalian'])
        ->setCellValue('G' . $kolom, $p['total_denda'])
        ->setCellValue('H' . $kolom, $p['status']);
      $kolom++;
      $nomor++;
    }


    $writer = new Xlsx($spreadsheet);

    setlocale(LC_ALL, 'en_US');
    $filename = 'Laporan-Peminjam';
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($spreadsheet, 'Html');
    ob_end_clean();
    $writer->save('php://output');
    exit();
  }
}