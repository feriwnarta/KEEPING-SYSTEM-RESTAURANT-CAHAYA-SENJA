<?php use NextG\Autoreply\App\Configuration; ?>

<script src="<?= Configuration::$ROOT ?>/public/js/input-menu.js"></script>

<div class="container">
    <div class="row">
        <div class="col-sm-7">
            <form id="formSaveMenu">
                <div class=" mb-4 ">
                    <h5>Pilih gambar</h5>
                    <img src="public/menu/insert-image.png" class="input-image " alt="" srcset="" width="100" height="100">
                </div>
                <div class="form-floating mb-4 ">
                    <input type="text" class="form-control input-name-menu" id="floatingInput"
                        placeholder="name@example.com" name="inputNameMenu" required>
                    <label for="floatingInput">Nama Menu</label>

                    <button type="submit" id="submit-btn" class="btn btn-primary container btn-block mt-4 mb-5"
                        onclick="saveMenu()">Simpan Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>