<?php

use NextG\Autoreply\App\Configuration; ?>


<div class="container">
    <div class="d-flex flex-row justify-content-between align-items-center">
        <h1>Setting Pesan Wablast</h1>
        <button type="button" class="btn btn-primary save-setting" onclick="saveSettingClicked()">Simpan</button>
    </div>


    <!-- Message -->
    <div class="row">
        <div class="col-sm-6">
            <div class="mt-3">
                <label for="exampleFormControlTextarea1" class="form-label">Pesan berhasil masuk keeping</label>
                <div class="mb-3 mt-2">
                    <button type="button" class="btn btn-outline-secondary btnVarSave" data-toggle="popover" data-placement="right">Tambahkan variabels</button>
                </div>
                <div id="editabelSaveKeeping" class="editableDiv" contenteditable="true"><?= (isset($data) && $data['save'] != '') ? $data['save'] : '' ?></div>

                <h2>Preview</h2>

                <div class="preview1"></div>

            </div>
        </div>
        <div class="col-sm-6">
            <div class="mt-3">
                <label for="exampleFormControlTextarea1" class="form-label">Pesan sukses keluar keeping</label>
                <div class="mb-3 mt-2">
                    <button type="button" class="btn btn-outline-secondary btnVarOut">Tambahkan variabel</button>
                </div>
                <div id="editableOutKeeping" class="editableDiv" contenteditable="true"><?= (isset($data) && $data['out'] != '') ? $data['out'] : '' ?></div>

                <h2>Preview</h2>

                <div class="preview2"></div>
            </div>
        </div>
    </div>
</div>

<div id="popOverOption1" class="dropdown-menu">

    <?php if (isset($data['options']) && !empty($data['options'])) { ?>

        <?php foreach ($data['options'] as $option) { ?>
            <li class="dropdown-item" id="<?= $option['option_name'] ?>"><?= $option['value_name'] ?></li>
        <?php } ?>


    <?php } ?>
</div>

<div id="popOverOption2" class="dropdown-menu">

    <?php if (isset($data['options']) && !empty($data['options'])) { ?>

        <?php foreach ($data['options'] as $option) { ?>
            <li class="dropdown-item" id="<?= $option['option_name'] ?>"><?= $option['value_name'] ?></li>
        <?php } ?>


    <?php } ?>
</div>


<script src="<?= Configuration::$ROOT; ?>public/js/wablast.js"></script>