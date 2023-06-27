<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Gîte</title>
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Poppins';
            background-color: #EEE2DF;
        }

        h1 {
            color: #CA7C5C;
            margin-bottom: 2rem;
        }

        .container {
            background-color: #EED7C5;
            padding: 2rem;
            border-radius: 10px;
        }

        hr {
            border-top: 1px solid #CA7C5C;
        }

        .image-upload {
            position: relative;
            cursor: pointer;
        }

        .image-upload .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-upload:hover .overlay {
            opacity: 1;
        }

        .slider-image-preview {
            width: 30%; /* Ajustez cette valeur pour changer la taille de l'image du slider */
            margin-right: 1em;
        }

        #preview {
            max-height: 300px; /* Ajustez cette valeur pour changer la hauteur maximale de l'image d'illustration */
        }

        #sliderImages {
            display: flex;
            flex-wrap: wrap; /* Cette propriété permet aux éléments de se répartir sur plusieurs lignes */
            align-items: center;
            overflow-x: auto; /* Cette propriété permet de faire défiler les images horizontalement */
            overflow-y: hidden; /* Cette propriété supprime la barre de défilement verticale */
        }

        .image-upload-slider{
            margin: 20px 20px;
        }

        .slider-images-container .image-upload-slider {
            width: 80px;
            height: 80px;
            margin-right: 20px; /* Augmente la marge à droite de chaque image */
            margin-bottom: 20px; /* Ajoute une marge en dessous de chaque image */
            position: relative;
        }

        .slider-images-container .image-upload-slider img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slider-images-container .image-upload-slider input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .btn-create-gite {
            width: 100%;
            background-color: #CA7C5C;
            color: white;
            border-color: #CA7C5C;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-create-gite:hover {
            background-color: #B36A5E;
            border-color: #B36A5E;
        }

        .mt-4 {
            margin-top: 4rem;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h1>Add Gîte</h1>
    <hr>

    <!-- Formulaire pour ajouter un nouveau gîte -->
    <form action="/admin/gite/create" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-4">
                <div class="d-flex flex-column align-items-center">
                    <div class="image-upload">
                        <img id="preview" src="https://caer.univ-amu.fr/wp-content/uploads/default-placeholder.png" alt="Default Gîte Image" style="width: 100%;">
                        <div class="overlay">
                            <i class="fas fa-image"></i>
                        </div>
                        <input type="file" class="form-control-file" id="imageIllustration" name="imageIllustration" required style="display: none;">
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="form-row">
                    <div class="col-6">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="col-3">
                        <label for="places">Places</label>
                        <input type="number" class="form-control" id="places" name="places" required>
                    </div>
                    <div class="col-3">
                        <label for="prix">Prix</label>
                        <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="6" required></textarea>
                </div>
                <div class="form-group mt-4">
                    <button type="button" id="addSliderImage" class="btn btn-secondary mt-3">Ajouter une photo pour le slider</button>
                    <div id="sliderImages" class="slider-images-container mt-3"></div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3 btn-create-gite">Create Gîte</button>
    </form>
</div>

<!-- JS Bootstrap (jQuery requis) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    // Script pour afficher l'image choisie par l'utilisateur avant l'envoi du formulaire
    document.getElementById('imageIllustration').addEventListener('change', function (e) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview').src = e.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    });

    // Script pour ouvrir le sélecteur de fichiers lorsque l'utilisateur clique sur l'image d'illustration
    document.querySelector('.image-upload').addEventListener('click', function () {
        document.getElementById('imageIllustration').click();
    });

    // Script pour ajouter un nouveau champ de formulaire pour uploader une image
    document.getElementById('addSliderImage').addEventListener('click', function() {
        var newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.name = 'sliderImages[]';
        newInput.style.display = 'none';

        var newImagePreview = document.createElement('img');
        newImagePreview.src = 'https://caer.univ-amu.fr/wp-content/uploads/default-placeholder.png';
        newImagePreview.style.width = '100px';
        newImagePreview.style.height = '100px';

        newInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    newImagePreview.src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        var newDiv = document.createElement('div');
        newDiv.className = 'image-upload-slider';
        newDiv.appendChild(newImagePreview);
        newDiv.appendChild(newInput);
        newDiv.addEventListener('click', function () {
            newInput.click();
        });

        document.getElementById('sliderImages').appendChild(newDiv);
    });
</script>

</body>
</html>
