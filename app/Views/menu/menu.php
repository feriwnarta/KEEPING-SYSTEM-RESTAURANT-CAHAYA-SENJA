<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/jqc-1.12.4/dt-1.11.3/datatables.min.css">

<script src="public/js/menu.js"></script>

<div class="row px-4">
    <div class="col-sm-12">

        <?php if (empty($data)) { ?>

            <?php echo 'tidak ada data'; ?>

        <?php } else { ?>


            <table id="tableKeeping" class="ui celled table ">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>



                    <?php foreach ($data as $row) { ?>
                        <tr id="<?= $row['id_menu']; ?>">
                            <td><img src="public/menu/<?= $row['thumbnail']; ?>" width="80px"></td>
                            <td><?= $row['name']; ?></td>
                            <td style="width: 70px;">

                                <!-- <a href="update-keeping/<?= $row['id_keeping']; ?>">
                                    <button type="button" class="btn btn-success">Update</button>
                                </a> -->

                                <button type="button" class="btn btn-success" id="updateKeeping" data-bs-toggle="modal" data-bs-target="#modalOutKeeping" onclick="updateMenu('public/menu/<?= $row['thumbnail']; ?>', '<?= $row['name']; ?>', '<?= $row['id_menu']; ?>' )">Update</button>

                                <!-- <button type="button" class="btn btn-danger" id="removeKeeping" onclick="removeMenu('<?= $row['id_menu']; ?>')">Hapus</button> -->


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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Menu</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="list-product">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="updateMenu" data-bs-dismiss="modal" onclick="processUpdateMenu()">Update</button>
                    </div>
                </div>
            </div>
        </div>


    </div>



</div>