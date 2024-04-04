@extends('layouts.app')
@section('title', 'Edit')
@section('body')
    @vite(['resources/css/edit-profile.css'])
    {{-- we here will put the navbar with col 3 max --}}
    <div class="col-10">
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
                        aria-selected="false"><i class="fa-solid fa-ban me-2"></i>
                        Blocked</button>
                </div>
                <div class="tab-content col-7" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab" tabindex="0">
                        <h5 class="m-3"><strong>Edit Profile</strong></h5>
                        <div class="card gray">

                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <img class="rounded-circle " id="profile-pic" width="50px" height="50px"
                                        src="{{ asset('images/galal.jpg') }}" alt="gloo">
                                    <span class="mx-2 "><strong>Karim Desouki's</strong></span>
                                </div>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdropghrabawy" id="ghrabaawy">
                                    Change photo
                                </button>

                                <!-- Modal -->
                                <div class="modal fade " id="staticBackdropghrabawy" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class=" modal-dialog modal-dialog-centered">
                                        <div class="modal-content ">
                                            <div class="modal-header justify-content-center">
                                                <h1 class="modal-title fs-5 text-dark" id="staticBackdropLabel">Change
                                                    Profile photo</h1>
                                            </div>
                                            <div class="modal-body text-light d-flex flex-column align-item-center">
                                                <div class="upload-btn-wrapper text-center">
                                                    <button class="btn-navbar btn">Select form computer</button>
                                                    <input id="upload-img-navbar" type="file" id="myfile"
                                                        name="myfile" />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="text-center">
                                                <a type="button" class="btn text-danger w-100">remove current photo</a>
                                            </div>
                                            <hr>
                                            <div class=" text-center ">
                                                <button type="button" class="btn text-dark mb-2 w-100"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <form>
                                <div class="form-group ">
                                    <label for="formGroupExampleInput" class="mt-3 h5">Website</label>
                                    <input type="text" class="form-control mt-3" id="formGroupExampleInput"
                                        placeholder="Website" disabled>
                                    <p class="text-muted mt-1 small">Editing your links is only available on mobile.
                                        Visit
                                        the
                                        Instagram app and
                                        edit your profile to change the websites in your bio.</p>
                                </div>
                                <div class="form-group">
                                    <label class="mt-3 h5"for="formGroupExampleInput2">Bio</label>
                                    <input type="text" class="form-control mt-1" id="formGroupExampleInput2"
                                        placeholder="Bio">
                                </div>
                                <div class="form-group">
                                    <label class="mt-3 h5"for="inputState">Gender</label>
                                    <select id="inputState" class="form-control mt-1">
                                        <option selected>Male</option>
                                        <option>Female</option>
                                        <option>Custom</option>
                                    </select>
                                    <p class="text-muted mt-1 small">This won’t be part of your public profile.
                                    </p>
                                </div>

                                <div class="row align-items-center">
                                    <h5>Show account suggestions on profiles
                                    </h5>
                                    <div class="col d-flex card flex-row">
                                        <div>
                                            <h5 class="mt-3"for="flexSwitchCheckChecked">Show account
                                                suggestions on profiles</h5>
                                            <p class="text-muted small">Choose whether people can see similar
                                                account
                                                suggestions on your
                                                profile, and whether your account can be suggested on other
                                                profiles.
                                            </p>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked" checked>
                                        </div>
                                    </div>

                                </div>
                        </div>
                        <div class="d-flex justify-content-end flex-row ">
                            <button type="submit" class="btn btn-primary mt-3 w-50">Submit</button>
                        </div>

                        </form>

                    </div>

                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab" tabindex="0">
                        <h5 class="m-4"><strong>Blocked Accounts</strong></h5>
                        <p class="text-muted">You can block people anytime from their profiles.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
