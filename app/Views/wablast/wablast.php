<?php

use NextG\Autoreply\App\Configuration; ?>


<div class="container">
    <h1>Setting Wablast</h1>

    <!-- Message -->
    <div class="row">
        <div class="col-sm-6">
            <div class="mt-3">
                <label for="exampleFormControlTextarea1" class="form-label">Pesan berhasil masuk keeping</label>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary">Tambahkan variabel</button>
                </div>
                <div id="editabelSaveKeeping" class="editableDiv" contenteditable="true"><?= (isset($data) && $data['save'] != '') ? $data['save'] : '' ?></div>


            </div>
        </div>
        <div class="col-sm-6">
            <div class="mt-3">
                <label for="exampleFormControlTextarea1" class="form-label">Pesan sukses keluar keeping</label>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary">Tambahkan variabel</button>
                </div>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>
    </div>
</div>

<script src="<?= Configuration::$ROOT; ?>public/js/wablast.js"></script>