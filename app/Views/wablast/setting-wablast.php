<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/jqc-1.12.4/dt-1.11.3/datatables.min.css">
<div class="row px-4">
    <div class="col-sm-12">

        <?php if (empty($data)) { ?>

            <?php echo 'tidak ada data'; ?>

        <?php } else { ?>


            <div class="d-flex flex-row justify-content-between align-items-center">
                <h5>Status device : <span class="<?= ($data['status'] == 'connected') ? 'text-success' : 'text-danger' ?>"><?= $data['status']; ?></span></h5>

                <a href="<?= (isset($data['barcode'])) ? $data['barcode'] : '' ?>">
                    <button type="button" class="btn btn-primary save-setting">Scan</button>
                </a>
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






</div>