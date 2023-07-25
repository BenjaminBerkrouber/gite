<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Gîte</title>
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="/view/admin/css/style_admin_gite.css">
</head>
<body>

<div class="container mt-4" id="update">
    <h1>Update Gîte</h1>
    <hr>
    <!-- Formulaire pour ajouter un nouveau gîte -->
    <form action="/admin/gite/update" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-4">
                <div class="d-flex flex-column align-items-center">
                    <div class="image-upload">
                        <?php $illustration = array_shift($gite['images']); ?>
                        <img id="preview" src="<?= $illustration['path'] ?>" alt="<?= $illustration['nomImg'] ?>" style="width: 100%;">
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
                        <input type="text" class="form-control" id="nom" name="nom" value="<?= $gite['nom']?>" required>
                    </div>
                    <div class="col-3">
                        <label for="places">Places</label>
                        <input type="number" class="form-control" id="places" name="places" value="<?= $gite['places']?>" required>
                    </div>
                    <div class="col-3">
                        <label for="prix">Prix</label>
                        <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="<?= $gite['prix']?>" required>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="6" required><?= $gite['description'] ?></textarea>
                </div>
                <div class="form-group mt-4">
                    <button type="button" id="addSliderImage" class="btn btn-secondary mt-3">Ajouter une photo pour le slider</button>
                    <div id="sliderImages" class="slider-images-container mt-3">
                        <?php
                        foreach($gite['images'] as $image): ?>
                            <div class="image-upload-slider" data-image-id="<?= $image['id_photo'] ?>">
                                <img src="<?= $image['path'] ?>" alt="<?= $image['nomImg'] ?>" style="width: 100px; height: 100px;">
                                <input type="file" name="sliderImages[]" style="display: none;">
                                <span class="delete-icon"><i class="fas fa-trash"></i></span>  <!-- Bouton de suppression ajouté ici -->
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger mt-4" id="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary mt-3" style="margin-right: 20px;">Update Gîte</button>
        </div>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="/app/admin/gite/update_gite.js"></script>

</body>
</html>
