<div class="modal fade" id="signin-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered p-2 my-0 mx-auto" style="max-width: 950px;">
        <div class="modal-content border-light">
            <div class="modal-body px-0 py-2 py-sm-0">
                <button class="btn-close position-absolute top-0 end-0 mt-3 me-3" type="button" data-bs-dismiss="modal"></button>
                <div class="row mx-0">
                    <div class="col-md-6 p-4 p-sm-5">
                        <h2 class="h3 mb-4 mb-sm-5">Hey there!<br>Welcome back.</h2>
                        <img class="d-block mx-auto" src="images/sign-in.svg" width="344" alt="login">
                        <div class="mt-4 mt-sm-5">
                            <span class="opacity-60">Don't have an account?</span>
                            <a class="text-dark opacity-60" href="#signup-modal" data-bs-toggle="modal" data-bs-dismiss="modal">Sign up here</a>
                        </div>
                    </div>
                    <div class="col-md-6 border-start-md border-dark px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
                        <form action="#" method="post">
                            <h4>Login details</h4>
                            <div class="mb-4">
                                <label class="form-label mb-2" for="login-username">Username <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="login-username" name="username" minlength="3" maxlength="8" required>
                            </div>
                            <div class="mb-4">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <label class="form-label mb-0" for="login-password">Password <span class="text-danger">*</span></label>
                                    <a class="fs-sm text-dark" href="#forget-password-modal" data-bs-toggle="modal" data-bs-dismiss="modal">Forgot password?</a>
                                </div>
                                <div class="password-toggle">
                                    <input class="form-control" type="password" id="login-password" name="password" minlength="6" maxlength="32" required>
                                    <label class="password-toggle-btn" aria-label="Show/Hide password">
                                        <input class="password-toggle-check" type="checkbox">
                                        <span class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-accent bg-gradient border-0 btn-lg w-100" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
