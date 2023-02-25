<aside class="col-lg-4 col-md-5 pe-xl-4 mb-5 mb-md-0">
            <div class="card card-body border-0 shadow-sm pb-1 me-lg-1">
                <div class="d-flex d-md-block d-lg-flex align-items-start pt-lg-2 mb-4">
                    <img class="rounded-circle" src="/assets/images/avatar.png" width="48" alt="avatar">
                    <div class="pt-md-2 pt-lg-0 ps-3 ps-md-0 ps-lg-3">
                        <h2 class="fs-lg mb-0">{{auth()->user()->company}}</h2>
                        <ul class="list-unstyled fs-sm mt-3 mb-0">
                            <li><a class="nav-link fw-normal p-0" href="#"><i class="fi-phone opacity-60 me-2"></i>{{auth()->user()->phone}}</a></li>
                            <li><a class="nav-link fw-normal p-0" href="#"><i class="fi-mail opacity-60 me-2"></i>{{auth()->user()->email}}</a></li>
                        </ul>
                    </div>
                </div>
                <a class="btn btn-accent bg-gradient border-0 btn-lg w-100 mb-3" href="/accounts/car/sell"><i class="fi-plus me-2"></i>Sell your car</a>
                <a class="btn btn-outline-dark d-block d-md-none w-100 mb-3" href="#account-nav" data-bs-toggle="collapse">
                    <i class="fi-align-justify me-2"></i>Menu
                </a>
                <div class="collapse d-md-block mt-3" id="account-nav">
                    <div class="card-nav">
                        <a class="card-nav-link {{$subId == 'profile' ? 'active' : '' }}" href="/accounts/profile">
                            <i class="fi-user me-2"></i>Profile
                        </a>
                        <a class="card-nav-link  {{$subId == 'invoices' ? 'active' : '' }}" href="/accounts/invoices">
                            <i class="fi-file me-2"></i>Invoices
                            <span class="badge bg-secondary ms-2">{{userInvoiceCount(auth()->user()->id)}}</span>
                        </a>
                        <a class="card-nav-link {{ $subId == 'current-vehicles' ? 'active' : ''}}" href="/accounts/current-vehicles">
                            <i class="fi-car me-2"></i>Current vehicles
                            <span class="badge bg-secondary ms-2">{{$current}}</span>
                        </a>
                        <a class="card-nav-link {{ $subId == 'sold-vehicles' ? 'active' : ''}}" href="/accounts/sold-vehicles">
                            <i class="fi-cash me-2"></i>Sold vehicles
                            <span class="badge bg-secondary ms-2">{{$sold}}</span>
                        </a>
                        <a class="card-nav-link {{$subId == 'purchased-vehicles' ? 'active' : ''}}" href="/accounts/purchased-vehicles">
                            <i class="fi-cart me-2"></i>Purchased vehicles
                            <span class="badge bg-secondary ms-2">{{$purchased}}</span>
                        </a>

                        <a class="card-nav-link {{$subId == 'dashboard' ? 'active' : ''}}" href="/accounts/dashboard">
                            <i class="fi-cart me-2"></i>Conditional bids                            
                        </a>
                        <a class="card-nav-link {{$subId == 'wishlist' ? 'active' : ''}}" href="/wishlist">
                        <i class="fi-heart  me-2"></i>Wishlist                            
                        </a>

                        <a class="card-nav-link" href="/accounts/logout">
                            <i class="fi-logout me-2"></i>Logout
                        </a>

                    </div>
                </div>
            </div>
        </aside>