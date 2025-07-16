<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      display: flex;
      height: 100vh;
      margin: 0;
      background-color: #f8f9fd;
    }

    .container {
      width: 50%;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .right-image {
      width: 50%;
      background: url('<?= base_url("path-to-image.webp") ?>') no-repeat center center;
      background-size: cover;
      border-top-right-radius: 20px;
      border-bottom-right-radius: 20px;
      overflow: hidden;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .form-group {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    input {
      width: 100%;
      padding: 5px 5px;
      border: none;
      border-bottom: 1px solid black;
      outline: none;
    }

    .login-header {
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .btn {
      border: 1px solid #04bf9d;
      /* border: none; */
      padding: 10px 5px;
      border-radius: 20px;
      cursor: pointer;
      color: #04bf9d;

    }

    .btn:hover {
      background: #04bf9d;
      color: white;
      font-weight: bold;
      transition: .3s ease-in;

    }

    .sub-text {
      color: #555;
      margin-bottom: 30px;

    }

    .error {
      color: red;
      font-size: 14px;

      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    
    <?php if (session()->getFlashdata('error')): ?>
      <div class="error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('customerlogin') ?>" method="post">
      <h1>User Login </h1>
      <div class="form-group">
        <label>number : </label>
        <input type="number" name="number" required value="8286080507" />
      </div>

      <div class="form-group">
        <label>Password :</label>
        <input type="password" name="password" required value="1234" />
      </div>

      <button type="submit" class="btn">Login</button>
    </form>
  </div>
  <div class="right-image">
    <img src="https://images.unsplash.com/photo-1512486130939-2c4f79935e4f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=dfd2ec5a01006fd8c4d7592a381d3776&auto=format&fit=crop&w=1000&q=80"
      alt="Login Banner">
  </div>
</body>

</html>