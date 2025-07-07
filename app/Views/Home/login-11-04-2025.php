<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Template</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <!-- Login -->
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-6">
            <img src="<?= base_url() ?>assets/images/login-img.png" alt="login"
              class="login-card-img rounded-4  custom-img">
          </div>
          <div class="col-md-6">
            <div class="card-body">
              <div class="brand-wrapper mb-2">
                <img src="<?= base_url() ?>assets/images/ele-logo.png" alt="logo" class="logo" style="height: 70px;">
              </div>
              <!-- <h4 class="login-heading font-weight-bold">eleSMART</h4> -->
              <h4 class="login-heading mb-3 font-weight-bold">Dashboard Login In</h4>
              <form action="<?= base_url('login') ?>" method="post" id="loginForm">
                <div class="form-group position-relative">
                  <label for="email" class="sr-only">Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email address"
                    autocomplete="off">
                  <i class="mdi mdi-email-outline input-icon"></i>
                </div>
                <div class="form-group mb-4 position-relative">
                  <label for="password" class="sr-only">Password</label>
                  <input type="password" name="password" id="password" class="form-control"
                    placeholder="Enter Password">
                  <i class="mdi mdi-lock-outline input-icon"></i>
                </div>
                <div class="row mt-4 align-items-center">
                  <div class="col-9">
                    <a href="#!" class="forgot-password-link d-flex align-items-center">Forgot password?</a>
                  </div>
                  <div class="col-3 text-end">
                    <button class="custom-button">
                      <i class="mdi mdi-arrow-right"></i>
                    </button>
                  </div>
                </div>
              </form>

              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              <script>
                $(document).ready(function () {
                  $("#loginForm").submit(function (e) {
                    e.preventDefault(); // Prevent default form submission

                    $.ajax({
                      url: "<?= base_url('login') ?>",
                      type: "POST",
                      data: $(this).serialize(),
                      dataType: "json",
                      success: function (response) {
                        console.log("elesmart", response)
                        if (response.status === "success") {
                          Swal.fire({
                            icon: "success",
                            title: "Login Successful",
                            text: "Redirecting to OTP verification...",
                            timer: 2000,
                            showConfirmButton: false
                          }).then(() => {
                            window.location.href = "<?= base_url('otp') ?>";
                          });
                        } else {
                          Swal.fire({
                            icon: "error",
                            title: "Login Failed",
                            text: response.message
                          });
                        }
                      }
                    });
                  });
                });
              </script>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.form-control').focus(function () {
        $(this).parent().addClass('active');
      }).blur(function () {
        if (!$(this).val()) {
          $(this).parent().removeClass('active');
        }
      });
    });



  </script>

</body>

</html>