<!DOCTYPE html>
<html>
<head>
    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Lien vers la police Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">

    <!-- Votre CSS personnalisé -->
    <style>
        body {
            background-color: #EEE2DF;
            font-family: 'Poppins', sans-serif;
        }

        .form-control {
            background-color: #EED7C5;
            border-color: #CA7C5C;
            color: #B36A5E;
        }

        .btn-custom {
            background-color: #CA7C5C;
            color: #EEE2DF;
        }

        .btn-custom:hover {
            background-color: #B36A5E;
            color: #EEE2DF;
        }

        .form-container {
            margin-top: 10%;
            border: 1px solid #C89F9C;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px 5px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            color: #B36A5E;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="form-title">Admin Login</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="uname">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="uname" name="uname" required>
                    </div>
                    <div class="form-group">
                        <label for="psw">Mot de passe</label>
                        <input type="password" class="form-control" id="psw" name="psw" required>
                    </div>
                    <button type="submit" class="btn btn-custom btn-block">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JS de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
