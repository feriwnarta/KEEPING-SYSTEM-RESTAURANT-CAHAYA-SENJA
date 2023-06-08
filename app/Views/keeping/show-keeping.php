<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/jqc-1.12.4/dt-1.11.3/datatables.min.css">

<div class="row px-4">
    <div class="col-sm-12">

        <?php if (empty($data)) { ?>

            <?php echo 'tidak ada data'; ?>

        <?php } else { ?>


            <table id="tableKeeping" class="ui celled table ">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nomor telpon</th>
                        <th>Nama</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>



                    <?php foreach ($data as $row) { ?>
                        <tr id="?= $row['id_keeping']; ?>">
                            <td><?= $row['tanggal']; ?></td>
                            <td><?= $row['nomor_telpon']; ?></td>
                            <td><?= $row['cust_name']; ?></td>
                            <td><?= $row['nama_produk']; ?></td>
                            <td><?= $row['product_count']; ?></td>
                            <td style="width: 200px;">

                                <a href="update-keeping/<?= $row['id_keeping']; ?>">
                                    <button type="button" class="btn btn-success">Update</button>
                                </a>
                                <a href="out-keeping/<?= $row['id_keeping']; ?>/">
                                    <button type="button" class="btn btn-danger">Out Keeping</button>
                                </a>

                            </td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>
        <?php } ?>


    </div>
</div>