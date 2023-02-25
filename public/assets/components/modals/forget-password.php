<div class="modal fade" id="forget-password-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered p-2 my-0 mx-auto" style="max-width: 950px;">
        <div class="modal-content border-light">
            <div class="modal-body px-0 py-2 py-sm-0">
                <button class="btn-close position-absolute top-0 end-0 mt-3 me-3" type="button" data-bs-dismiss="modal"></button>
                <div class="row mx-0">
                    <div class="col-md-6 p-4 p-sm-5">
                        <h2 class="h3 mb-4 mb-sm-5">Forgot password?<br>Send password reset email.</h2>
                        <img class="d-block mx-auto" src="images/sign-in.svg" width="344" alt="login">
                        <div class="mt-4 mt-sm-5">
                            <span class="opacity-60">Don't have an account?</span>
                            <a class="text-dark opacity-60" href="#signup-modal" data-bs-toggle="modal" data-bs-dismiss="modal">Sign up here</a>
                            <br>
                            <span class="opacity-60">Already have an account?</span>
                            <a class="text-dark opacity-60" href="#signin-modal" data-bs-toggle="modal" data-bs-dismiss="modal">Sign in here</a>
                        </div>
                    </div>
                    <div class="col-md-6 border-start-md border-dark px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
                        <form action="#" method="post">
                            <h4>Account details</h4>
                            <div class="mb-4">
                                <label class="form-label mb-2" for="forget-password-email">Email address <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" id="forget-password-email" name="email" maxlength="255" required>
                            </div>
                            <button class="btn btn-accent bg-gradient border-0 btn-lg w-100" type="submit">Send email</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
