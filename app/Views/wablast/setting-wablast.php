<?php

use NextG\Autoreply\App\Configuration; ?>

<script src="<?= Configuration::$ROOT; ?>public/js/setting-wablast.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/jqc-1.12.4/dt-1.11.3/datatables.min.css">
<div class="row px-4">
    <div class="col-sm-12">

        <?php if (empty($data)) { ?>

            <?php echo 'tidak ada data'; ?>

        <?php } else { ?>


            <div class="d-flex flex-row justify-content-between align-items-center">
                <h5>Status device : <span class="<?= ($data['status'] == 'connected') ? 'text-success' : 'text-danger' ?>"><?= $data['status']; ?></span></h5>

                <!-- <a href="barcode"> -->
                <button type="button" class="btn btn-primary save-setting" data-bs-toggle="modal" data-bs-target="#barcode">Scan</button>
                <!-- </a> -->
            </div>

            <table id="tableRealtime" class="ui celled table ">
                <thead>
                    <tr>
                        <th>Nomor telpon</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>



                    <?php foreach ($data['realtimeData'] as $row) { ?>
                        <tr>
                            <td><?= $row['phone']['to']; ?></td>
                            <td><?= $row['message']; ?></td>
                            <td><?= $row['status']; ?></td>
                            <td><?= $row['date']['created_at']; ?></td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>

        <?php } ?>

    </div>


    <div class="modal fade" id="barcode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Scan QR CODE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>



</div>