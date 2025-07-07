<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAMION Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            display: flex;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .left-section {
            flex: 1;
            background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
            background-size: cover;
            position: relative;
            padding: 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .left-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2); /* Slight overlay to match the original design */
        }

        .left-section h2, .left-section h1, .left-section p, .signup-btn {
            position: relative;
            z-index: 1;
        }

        .left-section h2 {
            font-size: 14px;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .left-section h1 {
            font-size: 40px;
            font-weight: bold;
            line-height: 1.1;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .left-section p {
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 10px;
        }

        .signup-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid white;
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: background 0.3s;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .signup-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .right-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .signup-link {
            text-align: right;
            margin-bottom: 20px;
        }

        .signup-link a {
            color: #3B82F6;
            text-decoration: none;
            font-size: 14px;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .logo img {
            width: 30px;
        }

        .logo h1 {
            font-size: 28px;
            color: #1E3A8A;
            font-weight: bold;
        }

        .logo sup {
            font-size: 14px;
            vertical-align: super;
        }

        .right-section h2 {
            font-size: 20px;
            color: #1E3A8A;
            margin-bottom: 20px;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .input-group {
            position: relative;
        }

        input {
            width: 100%;
            padding: 12px 40px 12px 15px;
            border: 1px solid #E5E7EB;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
            background: #F9FAFB;
        }

        input:focus {
            border-color: #3B82F6;
        }

        .input-group i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280;
            font-size: 16px;
        }

        .forgot-password {
            text-align: right;
            margin-top: -5px;
            margin-bottom: 15px;
        }

        .forgot-password a {
            color: #3B82F6;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .login-btn {
            background: #3B82F6;
            border: none;
            padding: 12px;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: background 0.3s;
            width: 50px;
            height: 50px;
            align-self: flex-end;
        }

        .login-btn:hover {
            background: #1E3A8A;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #6B7280;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                max-width: 400px;
            }

            .left-section {
                min-height: 300px;
            }

            .right-section {
                padding: 20px;
            }

            .left-section h1 {
                font-size: 30px;
            }

            .left-section h2, .left-section p {
                font-size: 12px;
            }

            .signup-btn {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .left-section h1 {
                font-size: 24px;
            }

            .left-section h2, .left-section p {
                font-size: 10px;
            }

            .signup-btn {
                font-size: 10px;
                padding: 8px 15px;
            }

            .right-section h2 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            
        </div>
        <div class="right-section">
            <div class="logo">
                <img src="<?= base_url() ?>assets/images/elebus_techbluew-09.png" alt="eleSMART Logo">
                <h1>eleSMART<sup>®</sup></h1>
            </div>
            <h2>Dashboard Log In</h2>
            <form>
                <div class="input-group">
                    <input type="email" value="semih@kamion.co">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="input-group">
                    <input type="password" value="********">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="forgot-password">
                    <a href="#">Forgot Password?</a>
                </div>
                <button class="login-btn"><i class="fas fa-arrow-right"></i></button>
            </form>
        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Login button clicked! (This is a demo)');
        });

        document.querySelector('.signup-btn').addEventListener('click', () => {
            alert('Redirecting to Sign Up page... (This is a demo)');
        });
    </script>
</body>
</html>