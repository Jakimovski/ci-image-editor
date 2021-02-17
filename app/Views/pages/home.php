<?= $this->extend('layouts/main') ?>

<?= $this->section('custom_css') ?>

<style>
    header {
        padding: auto;
        min-width: 100%;
    }

    header div {
        padding-top: 200px;
        padding-bottom: 300px;
    }
</style>


<?= $this->endSection() ?>


<?= $this->section('header') ?>


<header class="bg-secondary text-white">
    <div class="container text-center">
        <h1>Image Editor</h1>
        <p class="lead">Powerful editor that can transform your photos in a matter of seconds.</p>
        <a href="/dashboard" class="btn btn-primary btn-lg">Get Started</a>
    </div>
</header>


<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Image Editor 2020</p>
    </div>
    <!-- /.container -->
</footer>

<?= $this->endSection() ?>