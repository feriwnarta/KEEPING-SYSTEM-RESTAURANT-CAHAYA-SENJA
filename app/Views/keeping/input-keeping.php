<div class="container">
    <div class="row">
        <div class="col-sm-7">
            <form action="processRegister" method="POST" class="">
                <div class="form-floating mb-4 ">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="inputUsername" required>
                    <label for="floatingInput">Nama Customer</label>
                </div>
                <div class="form-floating mb-4 ">
                    <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="inputPhoneNu,ber" required>
                    <label for="floatingInput">Nomor Telpon</label>
                </div>

                <button type="button" class="btn btn-primary container" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Pilih minuman
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Minuman</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="list-product">
                                    <div class="row">
                                        <div class="col-12 item" id="1">
                                            <div class="d-flex flex-row align-items-center justify-content-between" >
                                                <div class="prdct">
                                                    <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//101/MTA-2199881/anker_anker-bir-botol-minuman-alkohol--620-ml-_full02.jpg" alt="" srcset="" width="80" class="me-2">
                                                    Anker
                                                </div>

                                                <div class="item d-flex flex-row align-items-center">
                                                    <div class="number-input d-flex flex-row">
                                                        <button class="btn minus" onclick="stepDown(event, this)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-dash" viewBox="0 0 16 16">
                                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" stroke="white" stroke-width="1" />
                                                            </svg>

                                                        </button>

                                                        <input class="quantity form-control" min="0" name="quantity" value="0" type="number">

                                                        <button class="btn  plus" onclick="stepUp(event, this)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-plus" viewBox="0 0 16 16">
                                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" stroke="white" stroke-width="1" />
                                                            </svg>
                                                        </button>


                                                    </div>
                                                </div>

                                            </div>
                                            <hr>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-12 item" id="2">
                                            <div class="d-flex flex-row align-items-center justify-content-between" >
                                                <div class="prdct">
                                                    <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//101/MTA-2199881/anker_anker-bir-botol-minuman-alkohol--620-ml-_full02.jpg" alt="" srcset="" width="80" class="me-2">
                                                    Anker
                                                </div>

                                                <div class="item d-flex flex-row align-items-center">
                                                    <div class="number-input d-flex flex-row">
                                                        <button class="btn minus" onclick="stepDown(event, this)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-dash" viewBox="0 0 16 16">
                                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" stroke="white" stroke-width="1" />
                                                            </svg>

                                                        </button>

                                                        <input class="quantity form-control" min="0" name="quantity" value="0" type="number">

                                                        <button class="btn  plus" onclick="stepUp(event, this)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-plus" viewBox="0 0 16 16">
                                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" stroke="white" stroke-width="1" />
                                                            </svg>
                                                        </button>


                                                    </div>
                                                </div>

                                            </div>
                                            <hr>
                                        </div>

                                    </div>
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

                <button type="submit" id="submit-btn" class="btn btn-primary container btn-block mt-4 mb-5">Kirim</button>
            </form>
        </div>
    </div>
</div>