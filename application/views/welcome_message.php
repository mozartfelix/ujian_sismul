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
    $action_form = '/order/save/';
    if(isset($order) && $order){
        foreach ($order as $ordered);
        $action_form = $action_form.$ordered->id ?>
        <h1>Edit Produk: <?= $ordered->id ?></h1>
    <?php } else { ?>
        <h1>Produk Baru</h1>
    <?php }
    if($products) { ?>
    <form id="form_make_order" method="post" action="<?=site_url($action_form)?>">
        <div class="container mb-3">
            <div class="row font-weight-bold">
                <div class="col-sm-2 col-xs-2">Gambar</div>
                <div class="col-sm-2 col-xs-2">Nama</div>
                <div class="col-sm-2 col-xs-2">Stok</div>
                <div class="col-sm-2 col-xs-2">Harga</div>
                <div class="col-sm-2 col-xs-2">Jumlah</div>
            </div>
        </div>

        <?php foreach ($products as $product) { ?>
            <div class="container mb-2">
                <div class="row align-items-center">
                    <div class="col-sm-2 col-xs-2">
                        <?php if (!empty($product->gambar)) { ?>
                            <img src="<?= base_url('uploads/' . $product->gambar) ?>" alt="Gambar <?= $product->nama ?>" style="max-width: 100px; height: auto;">
                        <?php } else { ?>
                            <span>Tidak ada gambar</span>
                        <?php } ?>
                    </div>
                    <div class="col-sm-2 col-xs-2"><?= $product->nama ?></div>
                    <div class="col-sm-2 col-xs-2"><?= $product->stok ?></div>
                    <div class="col-sm-2 col-xs-2">Rp<?= number_format($product->harga, 2, ',', '.') ?></div>
                    <div class="col-sm-2 col-xs-2">
                        <input type="number" id="product[<?=$product->id?>]" name="product[<?=$product->id?>]" step="1" min="0" max="100"
                               onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="0" class="form-control">
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="mt-4">
            <button class="btn btn-primary" type="submit">Buat pesanan</button>
        </div>
    </form>
    <?php } else { ?>
        <div class="col-sm-12 col-xs-12">Tidak ada produk</div>
    <?php } ?>
</div>
<?php $this->load->view('_partials/scripts'); ?>
</body>
</html>
