<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PPL-Commerce</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/aos.min.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.min.min.css') ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="<?php echo base_url() ?>sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>

                <?= $this->renderSection('content') ?>

                <footer class="shadow mt-5">
                    <div class="container py-4 py-lg-5">
                        <hr>
                        <center>
                            <p class="text-muted mb-0">Copyright © 2023</p>
                        </center>
                    </div>
                </footer>

                <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
                <script src="<?= base_url('assets/js/script.min.js') ?>"></script>
                <script src="<?= base_url('assets/js/aos.min.min.js') ?>"></script>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

                <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>

</html>