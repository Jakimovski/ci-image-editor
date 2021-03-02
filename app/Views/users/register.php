<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 py-4 my-5 border border-1 border-secondary rounded-3">
        <div class="container">
            <?php if (session()->get('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->get('error') ?>
                </div>
            <?php endif; ?>
            <?php if (isset($validation)) : ?>
                <div class="col-12">
                    <div class="alert alert-danger errorList" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                </div>
            <?php endif; ?>
            <form action="/user/register" method="post" class="">
                <div class="row">
                    <div class="col-12 col-sm-6 mt-2">
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" id="first_name" value="<?= set_value('first_name') ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mt-2">
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" name="last_name" id="last_name" value="<?= set_value('last_name') ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mt-2">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?= set_value('username') ?>" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mt-2">
                        <label for="email">Email address</label>
                        <input type="email" name="email" id="email" value="<?= set_value('email') ?>" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6 mt-2">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mt-2">
                        <div class="form-group">
                            <label for="password_confirm">Confirm password</label>
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-dark w-75">Sign Up</button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 text-center">
                        <a class="text-dark" href="/user/login">Already have an account?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>