<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-BR">
<?php $this->load->view('_partials/head'); ?>
<body>
<?php $this->load->view('_partials/header'); ?>
<div class="container container-person mt-5 p-5">
    <?=write_message()?>
    <?php
    $action_form = '/product/save/';
    if(isset($product) && $product){
        foreach ($product as $produk);
        $action_form = $action_form.$produk->id ?>
        <h1>Edit Produk: <?= $produk->nama ?></h1>
    <?php } else { ?>
        <h1>Tambah Produk</h1>
    <?php } ?>
    <form id="form_product" method="post" enctype="multipart/form-data" action="<?=site_url($action_form)?>">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="nama">Nama *</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required value="<?= (isset($produk) ? $produk->nama : '') ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="stok">Stok *</label>
                <input type="text" class="form-control" id="stok" name="stok" placeholder="Stok" required value="<?= (isset($produk) ? $produk->stok : '') ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="harga">Harga *</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">Rp</span>
                    </div>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" aria-describedby="inputGroupPrepend" required value="<?= (isset($produk) ? $produk->harga : '') ?>">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi"><?= (isset($produk) ? htmlspecialchars($produk->deskripsi) : '') ?></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="gambar">Upload Gambar</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar">
                <?php if (isset($produk) && !empty($produk->gambar)) : ?>
                    <p>Gambar saat ini:</p>
                    <img src="<?= base_url('uploads/'.$produk->gambar) ?>" alt="Gambar Produk" class="img-thumbnail" style="max-width:150px;">
                <?php endif; ?>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Kirim</button>
        <?= (isset($produk) ? '<a href="#" data-id="'.base_url('product/delete/'.$produk->id).'" class="btn btn-danger delete-product" data-toggle="modal" data-target="#deleteProductModal">Hapus</a>' : '') ?>
    </form>
</div>
<?php $this->load->view('_partials/product/delete_product_confirm_modal'); ?>
<?php $this->load->view('_partials/scripts'); ?>
</body>

</html>