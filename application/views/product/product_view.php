<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-BR">
<?php $this->load->view('_partials/head'); ?>
<body>
<?php $this->load->view('_partials/header'); ?>
<div class="container container-person mt-5 p-5">
    <?=write_message()?>
    <h1>Produk</h1>
    <div class="col-md-12 mb-3">
        <div class="row">
            <a class="btn btn-primary" href="<?= base_url('product/form/') ?>">Produk Baru</a>
        </div>
    </div>
    <table id="product_table" class="table table-striped table-bordered table-responsive-sm" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Gambar Produk</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($products) {
            foreach ($products as $product) { ?>
                <tr>
                    <td><?= $product->id ?></td>
                    <td><?= $product->nama ?></td>
                    <td><?= $product->stok ?></td>
                    <td>Rp<?= number_format($product->harga, 2, ',', '.') ?></td>
                    <td>
                        <?php if (!empty($product->gambar)): ?>
                            <img src="<?= base_url('uploads/'.$product->gambar) ?>" alt="Gambar Produk" style="max-width:100px;">
                        <?php else: ?>
                            <small>Tidak ada gambar</small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url('product/form/'.$product->id) ?>" class="btn btn-sm btn-warning mr-1">Edit</a>
                        <a class="btn btn-sm btn-danger delete-product" href="#" data-id="<?= base_url('product/delete/'.$product->id) ?>" data-toggle="modal" data-target="#deleteProductModal">Delete</a>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <td class="text-center" colspan="6">Tidak ada produk</td>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php $this->load->view('_partials/product/delete_product_confirm_modal'); ?>
<?php $this->load->view('_partials/scripts'); ?>
</body>

</html>