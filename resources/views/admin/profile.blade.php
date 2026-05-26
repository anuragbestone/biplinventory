@extends("layouts.app")
@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="profile-main">
        <!-- Header -->
        <div class="pm-header">
            <div>
                <h3>Welcome, Kshiteez</h3>
                <span>Tue, 07 June 2022</span>
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
                        <h6>{{ $profileData->full_name }}</h6>
                        <span>{{ $profileData->email }}</span>
                    </div>
                </div>

                <!-- RIGHT BUTTON GROUP -->
                <div class="pm-actions">
                    <button class="pm-edit-btn" data-bs-toggle="modal" data-bs-target="#passModal">
                        Change Password
                    </button>

                    <button class="pm-edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">
                        Edit
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
    <div class="modal fade" id="editModal">
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
                    <input class="pm-input" placeholder="Full Name" />
                    <input class="pm-input" placeholder="Email" />
                    <input class="pm-input" placeholder="Contact" />
                    <input class="pm-input" placeholder="Whatsapp No" />
                    <button class="pm-submit">Submit</button>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <!-- PASSWORD MODAL -->
    <div class="modal fade" id="passModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pm-modal">
                <div class="modal-header">
                    <h6>Change your password</h6>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="pm-pass-wrap">
                        <input type="password" class="pm-input" placeholder="Current Password" />
                        <i class="fa-solid fa-eye pm-toggle"></i>
                    </div>
                    <div class="pm-pass-wrap">
                        <input type="password" class="pm-input" placeholder="New Password" />
                        <i class="fa-solid fa-eye pm-toggle"></i>
                    </div>
                    <button class="pm-submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll(".pm-toggle").forEach((icon) => {
                    icon.addEventListener("click", function () {
                        let input = this.previousElementSibling;
                        if (input.type === "password") {
                            input.type = "text";
                            this.classList.replace("fa-eye", "fa-eye-slash");
                        } else {
                            input.type = "password";
                            this.classList.replace("fa-eye-slash", "fa-eye");
                        }
                    });
                });
</script>

@endsection