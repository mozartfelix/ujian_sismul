<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-BR">
<?php $this->load->view('_partials/head'); ?>
<body>
<?php $this->load->view('_partials/header'); ?>
<div class="container container-person mt-5 p-5">
    <?=write_message()?>
    <h1>Daftar Pesanan</h1>
    <div class="col-md-12 mb-3">
        <div class="row">
            <a class="btn btn-primary" href="<?= base_url('/') ?>">Order Baru</a>
        </div>
    </div>
    <table id="product_table" class="table table-striped table-bordered table-responsive-sm" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tanggal pemesanan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($orders) {
            foreach ($orders as $order) { ?>
                <tr>
                    <td><?= $order->id ?></td>
                    <td><?php $data = new DateTime($order->data); echo $data->format('d/m/Y - H:i:s') ?></td>
                    <td>
                        <a href="<?= base_url('order/view/'.$order->id) ?>" class="btn btn-sm btn-warning mr-1">Show</a>
                        <a class="btn btn-sm btn-danger delete-order" href="#" data-id="<?= base_url('order/delete/'.$order->id) ?>" data-toggle="modal" data-target="#deleteOrderModal">Delete</a>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <td class="text-center" colspan="6">Tidak ada permintaan</td>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php $this->load->view('_partials/order/delete_order_confirm_modal'); ?>
<?php $this->load->view('_partials/scripts'); ?>
</body>

</html>