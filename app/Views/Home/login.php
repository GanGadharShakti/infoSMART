<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pine Store Login</title>
    <link rel="stylesheet" href="https://public.codepenassets.com/css/normalize-5.0.0.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
</head>

<body>
    <div class="div">
        <div class="div-container">
            <div class="div-left">
                <div class="left-img mb-4">
                    <img src="<?= base_url('assets/images/pinlogo.png') ?>" alt="">
                </div>
                <h4 class="ele-color">Login</h4>

                <!-- Flash Error Message -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger" style="margin-bottom: 10px;">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <form method="post" action="<?= base_url('login') ?>">
                    <div class="input-block">
                        <label for="email" class="input-label">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" value="vaibhavpan7558@gmail.com">
                    </div>

                    <div class="input-block">
                        <label for="password" class="input-label">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" value="1234" >
                    </div>

                    <div class="div-buttons">
                        <button type="submit" class="custom-button">Login</button>
                    </div>
                </form>
            </div>

            <div class="div-right">
                <img src="https://images.unsplash.com/photo-1512486130939-2c4f79935e4f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=dfd2ec5a01006fd8c4d7592a381d3776&auto=format&fit=crop&w=1000&q=80"
                    alt="Login Banner">
            </div>
        </div>
    </div>
</body>

</html>