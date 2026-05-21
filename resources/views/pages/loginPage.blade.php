<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventory Dashboard - login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset("assets") }}/style.css">
</head>
<body>
<div class="main-login"
<div class="container py-3">
<div class="login-main water-effect">
    
    <div class="login-wrapper d-flex justify-content-center align-items-center">
        <div class="login-box text-center">

            <div class="logo mb-3">
                <img src="{{ asset("assets") }}/images/logo.png.webp" alt="Bestone Logo" class="img-fluid">
            </div>

            <h4>Welcome to Bestone Inventory Systems</h4>
            <p>Login to access your Plant dashboard</p>

            <form method="POST" action="{{ url("doLogin") }}">
                @csrf
                <!-- Email -->
                <div class="form-group text-start mb-3">
                    <label>Email</label>
                    <div class="input-group custom-input">
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="text" name="email" value="{{ old("email") }}" class="form-control" placeholder="Enter your email">
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group text-start mb-4">
                    <label>Password</label>
                    <div class="input-group custom-input position-relative">
                        <span class="input-group-text">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" value="{{ old("password") }}" id="loginPassword" class="form-control pe-5" placeholder="Enter your Password">
                        <!-- EYE ICON -->
                        <span class="pass-toggle">
                            <i class="fa-solid fa-eye-slash"></i>
                        </span>
                    </div>
                </div>
                
                

                <!-- Button -->
                <button type="submit" class="btn login-btn w-100">
                    Login
                </button>
            </form>

        </div>
    </div>

</div>

</div>




<script>
document.querySelector('.pass-toggle').addEventListener('click', function () {

    let input = document.getElementById('loginPassword');
    let icon = this.querySelector('i');

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }

});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.ripples/0.5.3/jquery.ripples.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
    Swal.fire({
        text: @json(session('success')),
        icon: "success"
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        text: @json(session('error')),
        icon: "error"
    });
</script>
@endif

<script>
$(document).ready(function () {
    $(".water-effect").ripples({
        resolution: 512,
        dropRadius: 20,
        perturbance: 0.04,
        interactive: true
    });
});
</script>
</body>
</html>