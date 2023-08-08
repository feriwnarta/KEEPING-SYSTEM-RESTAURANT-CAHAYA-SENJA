<?php

use NextG\Autoreply\App\Configuration;
?>

<script src="<?= Configuration::$ROOT; ?>public/js/input-keeping.js"></script>

<div class="container">
    <div class="row">
        <div class="col-sm-7">
            <form class="form-keeping" method="POST">
                <div class="form-floating mb-4">
                    <input type="date" class="form-control" id="floatingDate" placeholder=" " required disabled>
                    <label for="floatingDate">Tanggal</label>
                </div>

                <div class="form-floating mb-4 ">
                    <input type="number" class="form-control input-cust-number-phone" id="floatingInput" placeholder="name@example.com" name="inputPhoneNumber" required>
                    <label for="floatingInput">Nomor Telpon</label>
                </div>

                <div class="form-floating mb-4 ">
                    <input type="text" class="form-control input-name-cust" id="floatingInput" placeholder="name@example.com" name="inputCustName" required>
                    <label for="floatingInput">Nama Customer</label>
                </div>


                <button type="button" class="btn btn-primary container btn-pilih-minuman" data-bs-toggle="modal" data-bs-target="#getMenu">
                    Pilih minuman
                </button>

                <!-- Modal -->
                <div class="modal fade" id="getMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
<!--                                <h1 class="modal-title fs-5" id="exampleModalLabel">Minuman</h1>-->
                                <div class="search-menu" style="width: 90%">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="searchInput" placeholder="Cari Barang..">
                                        <label for="floatingInput">Cari Barang</label>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="list-product">
                                </div>
                                <div class="menu-load">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary simpan" data-bs-dismiss="modal">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="list-keeping-picked">




                </div>


                <button type="submit" id="submit-btn" class="btn btn-primary container btn-block mt-4 mb-5" onclick="sendButtonKeepingClicked()">Kirim</button>
            </form>
        </div>
    </div>
</div>