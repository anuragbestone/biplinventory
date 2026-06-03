@extends("layouts.app")
@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="profile-main">
        <!-- Header -->
        <div class="pm-header">
            <div>
                <h3>Welcome, {{ $profileData->full_name }}</h3>
                <span>{{ date("D jS F, Y") }}</span>
            </div>
        </div>

        <!-- Card -->
        <div class="pm-card">
            <!-- Top -->
            <div class="pm-top">
                <!-- LEFT -->
                <div class="pm-user">
                    <img src="https://i.pravatar.cc/80" />
                    <div class="user-name-head">
                        <h6>User Name</h6>
                        <span>user@gmail.com</span>
                    </div>
                </div>

                <!-- RIGHT BUTTON GROUP -->
                <div class="pm-actions">
                    <button class="pm-edit-btn" data-bs-toggle="modal" data-bs-target="#changeprofile">
                        Change Profile
                    </button>


                </div>
            </div>

            <!-- Form View -->
            <div class="pm-grid">
                <div class="pm-field">
                    <label>Full Name</label>
                    <div class="pm-value">{{ $profileData->full_name }}</div>
                </div>

                <div class="pm-field">
                    <label>Email</label>
                    <div class="pm-value">{{ $profileData->email }}</div>
                </div>

                <div class="pm-field">
                    <label>Contact</label>
                    <div class="pm-value">{{ $profileData->contact_number }}</div>
                </div>

                <div class="pm-field">
                    <label>Whatsapp No</label>
                    <div class="pm-value">{{ $profileData->whatsapp_contact }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="changeprofile">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pm-modal">
                <div class="modal-header">
                    <h6>Edit Profile</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Profile Image Edit -->
                    <div class="pm-edit-profile-img">
                        <img src="https://i.pravatar.cc/100" alt="profile" />

                        <label class="pm-img-edit">
                            <i class="fa-solid fa-pen"></i>
                            <input type="file" hidden />
                        </label>
                    </div>

                    <button class="pm-submit">Submit</button>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>


</div>

@endsection