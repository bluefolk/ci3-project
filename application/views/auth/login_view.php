<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI PANDHU - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/webfonts/css/all.min.css'); ?>">

    <style>
        body {
            background-color: #98a665;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Inria Serif', serif;
        }

        .login-container {
            background-color: #e35451;
            padding: 30px;
            border-radius: 8px;
            width: 100%;
            max-width: 350px;
            text-align: center;
            font-family: 'Inria Serif', serif;
        }

        .login-container h2 {
            color: white;
            margin-bottom: 20px;
            font-family: 'Inria Serif', serif;
            font-size: 1.8rem;
        }

        .login-container .logo-text {
            color: white;
            margin-bottom: 20px;
            font-family: 'Inria Serif', serif;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container .logo-text .logo-placeholder-small {
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 50%;
            margin-right: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.8rem;
            color: black;
            font-weight: bold;
        }

        .login-container .form-label {
            color: white;
            text-align: left;
            width: 100%;
            margin-bottom: 5px;
            font-size: 0.9rem;
            font-family: 'Inria Serif', serif;
        }

        .login-container .form-control {
            background-color: white;
            border: none;
            margin-bottom: 15px;
            font-family: 'Inria Serif', serif;
        }

        .login-container .btn-login {
            background-color: #cccccc;
            color: black;
            border: none;
            width: 100%;
            padding: 10px;
            font-size: 1.1rem;
            margin-top: 10px;
            font-family: 'Inria Serif', serif;
        }

        .login-container .help-text {
            color: white;
            margin-top: 20px;
            font-size: 0.8rem;
            text-align: left;
            font-family: 'Inria Serif', serif;
        }

        .alert {
            margin-bottom: 20px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>DPMD Kab. Halut</h2>
        <img src="<?= base_url('assets/logo_halut.jpeg'); ?>" alt="Logo"
            style="max-width: 100%; height: 150px; border-radius: 10%;">
        <h4 style="margin-top: 20px; font-weight: bold; color: white;" class="mt-5">LOGIN KE SI PANDHU</h4>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php echo form_open('auth/login'); ?>
        <div class="mb-3 text-start">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
            <?php echo form_error('username', '<div class="text-danger">', '</div>'); ?>
        </div>
        <div class="mb-3 text-start">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
        </div>
        <button type="submit" class="btn btn-login">LOGIN</button>
        <?php echo form_close(); ?>

        <!-- <div class="help-text">
            <p>Sample users for testing:</p>
            <ul>
                <li>Super Admin: admin / password123</li>
                <li>Village Admin: admin_desa / password123</li>
                <li>District Head: kadis / password123</li>
                <li>Treasurer: kabid / password123</li>
            </ul>
        </div> -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>