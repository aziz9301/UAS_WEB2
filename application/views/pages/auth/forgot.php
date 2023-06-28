<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-5">
            <div class="card">
                <div class="card-body mb-4">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <form action="<?= site_url('forgot/forgotPassword') ?>" method="post" class="form-signin text-center">
                                <img class="mb-4" src="<?= base_url() ?>/images/logo/console4.png" width="190" height="150">

                                <?php $this->load->view('layouts/_alert') ?>

                                <h1 class="h3 mb-3 font-weight-normal">Forgot Password</h1>

                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Your email" required>
                                </div>
                                <button class="btn btn-lg btn-info btn-block" name="login" type="submit">Reset</button>
                                <div class="form-group mt-1">
                                    <a href="<?= base_url('login') ?>">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>