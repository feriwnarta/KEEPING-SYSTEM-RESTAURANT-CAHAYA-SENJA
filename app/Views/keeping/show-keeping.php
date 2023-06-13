<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/jqc-1.12.4/dt-1.11.3/datatables.min.css">

<script src="public/js/out-keeping.js"></script>

<div class="row px-4">
    <div class="col-sm-12">

        <?php if (empty($data)) { ?>

            <?php echo 'tidak ada data'; ?>

        <?php } else { ?>


            <table id="tableKeeping" class="ui celled table ">
                <thead>
                    <tr>
                        <th>Nomor telpon</th>
                        <th>Nama</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>



                    <?php foreach ($data as $row) { ?>
                        <tr id="<?= $row['id_keeping']; ?>">
                            <td><?= $row['nomor_telpon']; ?></td>
                            <td><?= $row['cust_name']; ?></td>
                            <td><?= $row['nama_produk']; ?></td>
                            <td><?= $row['product_count']; ?></td>
                            <td style="width: 110px;">

                                <!-- <a href="update-keeping/<?= $row['id_keeping']; ?>">
                                    <button type="button" class="btn btn-success">Update</button>
                                </a> -->

                                <button type="button" class="btn btn-danger" id="outKeeping" data-bs-toggle="modal" data-bs-target="#modalOutKeeping" value="<?= $row['id_keeping']; ?>" onclick="outKeeping(this)">Out Keeping</button>


                            </td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>

        <?php } ?>





        <!-- Modal -->
        <div class="modal fade" id="modalOutKeeping" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Out Keeping</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="list-product">
                        </div>
                        <div class="menu-load">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="outKeeping" data-bs-dismiss="modal" onclick="processOut()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>


    </div>



</div>