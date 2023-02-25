<div class="modal fade" id="signup-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered p-2 my-0 mx-auto" style="max-width: 950px;">
        <div class="modal-content border-light">
            <div class="modal-body px-0 py-2 py-sm-0">
                <button class="btn-close position-absolute top-0 end-0 mt-3 me-3" type="button" data-bs-dismiss="modal"></button>
                <div class="row mx-0">
                    <div class="col-md-6 p-4 p-sm-5">
                        <h2 class="h3 mb-4 mb-sm-5">Join us.<br>Get premium benefits.</h2>
                        <ul class="list-unstyled mb-4 mb-sm-5">
                            <li class="d-flex mb-2"><i class="fi-check-circle text-primary mt-1 me-2"></i><span>Add and promote your listings</span></li>
                            <li class="d-flex mb-2"><i class="fi-check-circle text-primary mt-1 me-2"></i><span>Easily manage your wishlist</span></li>
                            <li class="d-flex mb-0"><i class="fi-check-circle text-primary mt-1 me-2"></i><span>Leave reviews</span></li>
                        </ul>
                        <img class="d-block mx-auto" src="images/sign-up.svg" width="344" alt="register">
                        <div class="mt-sm-4 pt-md-3">
                            <span class="opacity-60">Already have an account?</span>
                            <a class="text-dark opacity-60" href="#signin-modal" data-bs-toggle="modal" data-bs-dismiss="modal">Sign in here</a>
                        </div>
                    </div>
                    <div class="col-md-6 border-start-md border-dark px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
                        <form class="needs-validation">
                            <h4>Company details</h4>
                            <div class="mb-4">
                                <label class="form-label" for="register-company">Company <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="register-company" name="company" maxlength="255" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-addition">Addition</label>
                                <input class="form-control" type="text" id="register-addition" name="addition" maxlength="255">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-street">Street/Number <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="register-street" name="street" maxlength="255" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-post-box">Post box</label>
                                <input class="form-control" type="text" id="register-post-box" name="post-box" maxlength="255">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-postcode">Postcode <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="register-postcode" name="postcode" maxlength="255" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-town">Town <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="register-town" name="town" maxlength="255" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-country">Country <span class="text-danger">*</span></label>
                                <select name="country" id="register-country" class="form-select" required>
                                    <option value="Austria" selected>Austria</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Hugary">Hungary</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Moldova">Moldova</option>
                                    <option value="Macedonia">Macedonia</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Serbia">Serbia</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Ukrain">Ukraine</option>
                                    <option value="Great Britain">Great Britain</option>
                                    <option value="Kosovo">Kosovo</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-car-dealership">Car dealersip</label>
                                <input class="form-control" type="text" id="register-car-dealership" name="car-dealership" maxlength="255">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-motorcycle-dealership">Motorcycle dealersip</label>
                                <input class="form-control" type="text" id="register-mortocycle-dealership" name="motorcycle-dealership" maxlength="255">
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="register-commercial-vehicle-dealership">Commercial vehicle dealersip</label>
                                <input class="form-control" type="text" id="register-commercial-vehicle-dealership" name="commercial-vehicle-dealership" maxlength="255">
                            </div>
                            <h4>Personal Details</h4>
                            <div class="mb-4">
                                <label class="form-label" for="register-form-of-address">Form of address <span class="text-danger">*</span></label>
                                <select name="form-of-address" id="register-form-of-address" class="form-select" required>
                                    <option value="Mr." selected>Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-first-name">First name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="register-first-name" name="first-name" maxlength="255" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-surname">Surname <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="register-surname" name="surname" maxlength="255" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-email">Email address <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" id="register-email" name="email" maxlength="255" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-telephone">Telephone number <span class="text-danger">*</span></label>
                                <input class="form-control" type="tel" id="register-telephone" name="telephone" placeholder="Enter with area code" maxlength="15" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-mobile">Mobile phone number</label>
                                <input class="form-control" type="tel" id="register-mobile" name="mobile" placeholder="Enter with area code" maxlength="15">
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="register-preferred-language">Preferred language</label>
                                <select name="preferred-language" id="register-preferred-language" class="form-select">
                                    <option value="English" selected>English</option>
                                    <option value="German">German</option>
                                    <option value="Franch">French</option>
                                    <option value="Italian">Italian</option>
                                </select>
                            </div>
                            <h4>Login details</h4>
                            <div class="mb-4">
                                <label class="form-label" for="register-username">Username <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="register-username" name="username" minlength="3" maxlength="8" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-password">Password <span class="text-danger">*</span></label>
                                <div class="password-toggle">
                                    <input class="form-control" type="password" id="register-password" name="password" minlength="6" maxlength="32" required>
                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                        <input class="password-toggle-check" type="checkbox">
                                        <span class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="register-confirm-password">Confirm password <span class="text-danger">*</span></label>
                                <div class="password-toggle">
                                    <input class="form-control" type="password" id="register-confirm-password" name="confirm-password" minlength="6" maxlength="32" required>
                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                        <input class="password-toggle-check" type="checkbox">
                                        <span class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="register-agree-to-terms" name="agree-to-terms" required>
                                <label class="form-check-label" for="register-agree-to-terms">
                                    <span class="opacity-70">By joining, I agree to the</span>
                                    <a href="terms-and-conditions.php" class="text-dark">Terms of use</a>
                                    <span class="opacity-70">and</span>
                                    <a href="privacy-policy.php" class="text-dark">Privacy policy</a>.
                                </label>
                            </div>
                            <button class="btn btn-accent bg-gradient border-0 btn-lg w-100" type="submit">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
