<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/jqc-1.12.4/dt-1.11.3/datatables.min.css">

<script src="public/js/customer.js"></script>

<div class="row px-4">
    <div class="col-sm-12">

        <?php if (empty($data)) { ?>

            <?php echo 'tidak ada data'; ?>

        <?php } else { ?>
            <div class="text-end me-3  mb-3">
                <button type="button" class="btn btn-primary position-relative" id="sendAllMessage" data-bs-toggle="modal" data-bs-target="#modalAll">Kirim pesan kesemua customer</button>
            </div>


            <table id="tableKeeping" class="ui celled table ">
                <thead>
                    <tr>
                        <th>Nomor telpon</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>



                    <?php foreach ($data as $row) { ?>
                        <tr>
                            <td><?= $row['phone_number']; ?></td>
                            <td><?= $row['cust_name']; ?></td>

                            <td style="width: 110px;">
                                <!-- <a href="update-keeping/<?= $row['id_keeping']; ?>">
                                    <button type="button" class="btn btn-success">Update</button>
                                </a> -->

                                <button type="button" class="btn btn-success" id="sendMessage" data-bs-toggle="modal" data-bs-target="#modalMessage" value="<?= $row['id_cust']; ?>" onclick="getNameAndPhone('<?= $row['cust_name']; ?>', '<?= $row['phone_number']; ?>') ">Kirim Pesan</button>

                            </td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>



        <?php } ?>





        <!-- Modal -->
        <div class="modal fade" id="modalMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Kirim Pesan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formSendMessageToCust" action="POST" class="d-flex flex-column">
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Nomor telpon</label>
                                <input type="text" name="phoneNumber" class="form-control" id="phoneNumber" aria-describedby="emailHelp" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" id="name" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="pesan" class="form-label">Pesan</label>
                                <textarea class="form-control" name="message" id="message" rows="5" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary"  id="outKeeping" onclick="sendMessageToCust()">Kirim</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="modalAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Kirim Pesan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formSendMessageAll" action="POST" class="d-flex flex-column">
                            <div class="mb-3">
                                <label for="pesan" class="form-label">Pesan</label>
                                <textarea class="form-control" name="message" id="messageAll" rows="5" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary"  id="outKeeping" onclick="sendMessageToAllCust()">Kirim</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>


    </div>



</div>