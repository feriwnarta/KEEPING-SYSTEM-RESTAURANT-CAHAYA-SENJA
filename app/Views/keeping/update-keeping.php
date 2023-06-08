<?php

use NextG\Autoreply\App\Configuration;



?>

<script src="<?= Configuration::$ROOT; ?>public/js/update-keeping.js"></script>


<div class="container">
    <div class="row">
        <div class="col-sm-7">
            <form class="form-update-keeping" id="<?= $data['data_update']['id'] ?>">
                <div class="form-floating mb-4 ">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="inputCustName" value="<?= $data['data_update']['tanggal'] ?>" disabled>
                    <label for="floatingInput">Tanggal</label>
                </div>

                <div class="form-floating mb-4 ">
                    <input type="text" class="form-control input-phone-number-cust" id="floatingInput" placeholder="name@example.com" name="inputCustName" value="<?= $data['data_update']['phone_number'] ?>">
                    <label for="floatingInput">Nomor Telpon</label>
                </div>

                <div class="form-floating mb-4 ">
                    <input type="text" class="form-control input-name-cust" id="floatingInput" placeholder="name@example.com" name="inputCustName" value="<?= $data['data_update']['cust_name'] ?>">
                    <label for="floatingInput">Nama Customer</label>
                </div>

                <div class="form-floating mb-4">
                    <select class="form-select" id="productDropdown" aria-label="Floating label select example" class="select-product">
                        <option value="<?= $data['data_update']['id_menu'] ?>" selected><?= $data['data_update']['name'] ?></option>


                        <?php foreach ($data['data_menu'] as $menu) { ?>
                            <option value="<?= $menu['id_menu'] ?>"><?= $menu['name'] ?></option>
                        <?php  } ?>

                    </select>
                    <label for="floatingDropdown">Nama Produk</label>
                </div>

                <div class="form-floating mb-4 ">
                    <input type="number" class="form-control input-count-product" id="floatingInput" placeholder="name@example.com" name="inputCustName" value="<?= $data['data_update']['product_count'] ?>">
                    <label for="floatingInput">Jumlah</label>
                </div>

                <button type="submit" id="submit-btn" class="btn btn-primary container btn-block mb-5" onclick="updateKeeping()">Update</button>
            </form>
        </div>
    </div>
</div>