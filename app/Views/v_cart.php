<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
    <?= $this->include('components/front-end/sidebar') ?>
    <?= $this->include('components/front-end/cart') ?>
<?= $this->endSection() ?>