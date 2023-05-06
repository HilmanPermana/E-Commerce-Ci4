<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <?= session()->has('cart') ? '' : '' ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-7">
            <div class="row">
                <?php

                ?>
                <?php if (session()->has('cart')) { ?>
                    <?php foreach (session('cart') as $item) : ?>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama Kemeja</th>
                                    <th>Harga Diskon</th>
                                    <th class="col-3">Jumlah jual</th>
                                    <th class="col-3">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <picture><img class="img-thumbnail" src="<?= base_url('gambar/' . $item['gambar'] . '') ?>" style="max-height: 144px;max-width: 100px;"></picture>
                                    </td>
                                    <td><strong><span style="color: inherit;"><?= $item['name'] ?>&nbsp;</span></strong></td>
                                    <td><strong><span style="color: inherit;"><?php echo number_format(($item['price'] - ($item['price'] * $item['diskon'] / 100)), 0, ',', '.') ?>&nbsp;</span></strong></td>
                                    <td class="text-start" colspan="1">
                                        <form action="update_qty_cart" method="post">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <input type="number" name="qty" value="<?= $item['qty'] ?>">
                                        </form>
                                    </td>
                                    <td><span style="color: inherit;"><?php echo number_format(($item['price'] - ($item['price'] * $item['diskon'] / 100)) * $item['qty']) ?></span></td>
                                    <td>
                                        <form action="<?= base_url('delete_product_in_cart') ?>" method="post" id="form-delete-product-in-cart">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-sm border rounded-pill shadow" data-bs-toggle="tooltip" data-bss-tooltip="" type="button" title="Hapus Produk">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <p class="text-center">Keranjang Kosong</p>
                <?php } ?>
            </div>
        </div>
        <div class="mt-5 col-md-8">
            <?php if (session()->has('cart')) { ?>
                <div class="card border rounded shadow p-4">
                    <form action="<?= base_url('checkout') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">

                            <!-- alert error checkout -->
                            <?php if (session()->has('error')) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> <?= session('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>

                            <div class="col-md-12">
                                <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" id="nama-lengkap" placeholder="Nama Lengkap ..." required>
                            </div>
                            <div class="col-12">
                                <label for="no-hp" class="form-label">No Hp</label>
                                <input type="text" name="no_hp" class="form-control" id="no-hp" placeholder="+62 ..." required>
                            </div>
                            <div class="col-12">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control" cols="30" rows="3" placeholder="Alamat ..." required></textarea>
                            </div>

                            <!-- kota dan kecamatan -->
                            <div class="col-md-6">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" name="kota" class="form-control" id="kota" placeholder="Kota ..." required>
                            </div>

                            <div class="col-md-6">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control" id="kecamatan" placeholder="Kecamatan ..." required>
                            </div>

                            <div class="col-md-6">
                                <label for="kecamatan" class="form-label">Kode Pos</label>
                                <input type="text" name="kode_pos" class="form-control" id="kode_pos" placeholder="Kode Pos ..." required>
                            </div>

                        </div>

                        <hr class="my-4">

                        <div class="col-md-12 mt-5 mb-3">
                            <div class="table-responsive text-start" style="margin-left: 11px;">
                                <?php if (session()->has('cart')) { ?>
                                    <!-- table produk dengan qty -->
                                    <table class="table table-sm">
                                        <thead class="table-primary">
                                            <tr>
                                                <th class="bg-primary text-white" colspan="3">Produk</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: small;">
                                            <?php
                                            foreach (session('cart') as $item) : ?>
                                                <tr>
                                                    <td><?= $item['name'] ?></td>
                                                    <td>Rp<?= number_format(($item['price'] - ($item['price'] * $item['diskon'] / 100)) * $item['qty'], 0, ',', '.') ?>,00,-</td>
                                                    <td><?= $item['qty'] ?> x</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>


                                <?php } ?>

                                <!-- header sub total -->
                                <table class="table table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="bg-primary text-white" colspan="2">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: small;">
                                        <?php
                                        $total = 0;
                                        if (session()->has('cart')) {
                                            foreach (session('cart') as $item) {
                                                $total += ($item['price'] - ($item['price'] * $item['diskon'] / 100))  * $item['qty'];
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td>Rp<?= number_format($total, 0, ',', '.') ?>,00,-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="my-4">

                        <!-- input hidden -->
                        <input type="hidden" name="total_transaksi" value="<?= $total ?>">

                        <button class=" w-100 btn btn-outline-primary py-4 bg-primary text-white" type="submit" onclick="checkout()">checkout</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    async function update_qty_cart(id, type) {
        let qty = document.getElementById('qty_produk_' + id).innerHTML;
        let stok_barang = await get_stok_barang(id);
        console.log(stok_barang, 'sas', qty);
        if (type === 'increment') {
            if (qty < parseInt(stok_barang)) {
                qty = parseInt(qty) + 1;
                let url = 'http://localhost:8080/update_qty_cart';

                let data = {
                    id: id,
                    qty: qty
                }

                await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    }).then(response => response.json())
                    .then(data => {
                        console.log(data);
                    });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Stok Barang Tidak Mencukupi',
                })
            }
        } else if (type === 'decrement') {
            if (qty > 1) {
                qty--;
            }
        }

        document.getElementById('qty_produk_' + id).innerHTML = qty;
    }


    async function get_stok_barang(id) {
        let stok = 0;
        let url = 'http://localhost:8080/api/barang/'
        await fetch(url + id)
            .then(response => response.json())
            .then(data => {
                stok = data.stok;
            });

        return stok;
    }

    function checkout() {

        swal({

            title: " Checkout Berhasil!",

            text: "Pop-up berhasil ditampilkan",

            icon: "success",

            button: true

        });

    }

    $(document).ready(function() {
        $('.btn-kurang, .btn-tambah').on('click', function() {
            var id = $(this).data('id');
            var action = $(this).data('action');

            $.ajax({
                url: '<?= base_url('keranjang/ubah/') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    action: action,
                },
                success: function(response) {
                    // Update tampilan jumlah dan total harga
                    $('input[name="jumlah"][data-id="' + id + '"]').val(response.jumlah);
                    $('#subtotal-harga-' + id).html('Rp' + response.subtotal);
                    $('#total-harga').text(response.total);
                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan error
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        });
    });
</script>