<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Gîte</title>
    <!-- Liens CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/view/admin/css/style_admin_gite.css">

</head>
<body>

<div class="container mt-4" id="create">
    <h1>Add Gîte</h1>
    <hr>
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
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger mt-4" id="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary">Create Gîte</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="/app/admin/gite/create_gite.js"></script>

</body>
</html>
