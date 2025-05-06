<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model','product');
    }

    public function index()
    {
        $data = array();
        $data['products'] = $this->product->getProducts();
        $this->load->view('product/product_view', $data);
    }

    public function form($product_id = null)
    {
        $data = array();
        if($product_id){
            $data['product'] = $this->product->getProductById($product_id);
        }
        $this->load->view('product/product_form_view', $data);
    }

    public function save($id = null)
    {
        $form_data = array
        (
            'id' => $id,
            'stok' => $this->input->post('stok'),
            'nama' => $this->input->post('nama'),
            'deskripsi' => $this->input->post('deskripsi'),
            'harga' => $this->input->post('harga')
        );

        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = time() . '_' . $_FILES['gambar']['name'];

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $upload_data = $this->upload->data();
                $form_data['gambar'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('message', array('danger', 'Upload gambar gagal: ' . $this->upload->display_errors('', '')));
                redirect('product/form/' . $id);
                return;
            }
        }

        if(!$id){
            $send_form = $this->product->createProduct($form_data);
        } else {
            $send_form = $this->product->updateProduct($form_data);
        }

        if($send_form){
            $this->session->set_flashdata('message', array('success','Produk berhasil dibuat!'));
            redirect('product');
        }
        else
        {
            $this->session->set_flashdata('message', array('danger','Ups! Datanya salah!'));
            redirect('product/form');
        }
    }

    public function delete($id)
    {
        $product = $this->product->getProductById($id);

        if (!$product || count($product) === 0) {
            $this->session->set_flashdata('message', array('danger', 'Produk tidak ditemukan.'));
            redirect('product');
            return;
        }

        // Cek apakah produk digunakan dalam tabel product_order
        $this->db->where('product_id', $id);
        $product_in_order = $this->db->get('product_order')->num_rows();

        if ($product_in_order > 0) {
            $this->session->set_flashdata('message', array('danger', 'Produk tidak bisa dihapus karena digunakan dalam order.'));
            redirect('product');
            return;
        }

        // Jika aman untuk dihapus
        if (!empty($product[0]->gambar)) {
            $gambar_path = FCPATH . 'uploads/' . $product[0]->gambar;
            if (file_exists($gambar_path)) {
                unlink($gambar_path); // Hapus file gambar dari server
            }
        }

        if ($this->product->deleteProduct($id)) {
            $this->session->set_flashdata('message', array('success', 'Produk berhasil dihapus.'));
        } else {
            $this->session->set_flashdata('message', array('danger', 'Gagal menghapus produk dari database.'));
        }

        redirect('product');
    }

}
