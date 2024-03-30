@extends('layouts.app')
@section('title', 'Edit')
@section('body')
    <div class="col-12">
        {{-- we here will put the navbar with col 3 max --}}
        <div class="col-md-9">
            <div class="d-flex align-items-start col-12">
                <div class="nav flex-column nav-pills me-5 col-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <div class="m-3">
                        <h5>Settings</h5>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title "><i class="fa-brands fa-meta blue"></i> Meta</h5>
                            <h6 class="card-subtitle mt-2 mb-2 text-muted">Accounts Center</h6>
                            <p class="card-text">Manage your connected experiences and account settings across meta
                                technologies</p>
                            <p><i class="fa-regular fa-user mx-2"></i> Personal details</p>
                            <p><i class="fa-solid fa-shield-halved mx-2"></i> Password and Security</p>
                            <p><i class="fa-solid fa-address-card mx-2"></i> Ad Prefrence </p>
                            <p class="blue">See more in Accounts Center</p>
                        </div>
                    </div>
                    <div class="mt-4 mx-3 text-start">
                        <p>How you use Instagram</p>
                    </div>
                    <button class="nav-link active text-start" id="v-pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                        aria-selected="true"><i class="fa-regular fa-user me-2"></i> Edit profile</button>
                    <button class="nav-link text-start" id="v-pills-profile-tab " data-bs-toggle="pill"
                        data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false"><i class="fa-solid fa-ban me-2"></i> Blocked</button>
                </div>
                <div class="tab-content col-9" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab" tabindex="0">
                        <h5 class="m-3"><strong>Edit Profile</strong></h5>
                        <div class="card">

                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <img class="rounded-circle " width="50px" height="50px"
                                        src="{{ asset('images/galal.jpg') }}" alt="gloo">
                                    <span><strong>karim desouki's</strong></span>
                                </div>

                                <button type="button" class="btn btn-primary">Change photo</button>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"
                        tabindex="0">
                        <h5 class="m-4"><strong>Blocked Accounts</strong></h5>
                        <p class="text-muted">You can block people anytime from their profiles.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
