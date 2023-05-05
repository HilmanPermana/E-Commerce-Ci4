<div class="row">
    <div class="col-md-5">
        <?= session()->has('cart') ? '' : '' ?>
    </div>
</div>

<?php if (session()->has('cart')) { ?>
    <?php foreach (session('cart') as $data) : ?>
        <div class="card">
            <div class="card-body">
                <div class="container mb-5 mt-3">
                    <div class="row d-flex align-items-baseline">
                        <div class="col-xl-9">
                            <p style="color: #7e8d9f;font-size: 20px;"> &gt;&gt; <strong>ID: #123-123</strong></p>
                        </div>
                    </div>
                    <div class="container">
                        <div class="col-md-12">
                            <div class="text-center">
                                <i class="far fa-building fa-4x ms-0" style="color:#8f8061 ;"></i>
                                <p class="pt-2">PPL E-Commerce</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-8">
                                <ul class="list-unstyled">
                                    <li class="text-muted">To: <span style="color:#8f8061 ;"><?php $data['nama'] ?></span></li>
                                    <li class="text-muted"><?php $data['alamat'] ?></li>
                                    <li class="text-muted"><i class="fas fa-phone"></i><?php $data['hp'] ?></li>
                                </ul>
                            </div>
                            <div class="col-xl-4">
                                <p class="text-muted">Invoice</p>
                                <ul class="list-unstyled">
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061;"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-success  text-black fw-bold">
                                            Paid</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row my-2 mx-1 justify-content-center">
                            <div class="col-md-2 mb-4 mb-md-0">
                                <div class="
                        bg-image
                        ripple
                        rounded-5
                        mb-4
                        overflow-hidden
                        d-block
                        " data-ripple-color="light">
                                    <img src="<?= base_url('gambar/' . $data['gambar'] . '') ?>" class="w-100" height="100px" alt="Elegant shoes and shirt" />
                                    <a href="#!">
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: hsla(0, 0%, 98.4%, 0.2)"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4 mb-md-0">
                                <h5 class="mb-2">
                                    <s class="text-muted me-2 small align-middle"> <?php $data['harga'] ?></s><span class="align-middle"><?php echo number_format(((int)$data['hargajual'] - ((int)$data['hargajual'] * (int)$item['diskon'] / 100)) * (int)$item['qty']) ?></span>
                                </h5>
                                <p class="text-danger"><small>You save 25%</small></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-8">
                                <p class="ms-3">Add additional notes and payment information</p>
                            </div>
                            <div class="col-xl-3">
                                <ul class="list-unstyled">
                                    <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$1050</li>
                                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Shipping</span>$15</li>
                                </ul>
                                <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span style="font-size: 25px;">$1065</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php } ?>