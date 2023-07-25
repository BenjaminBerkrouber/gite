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

    var deleteSpan = document.createElement('span');
    deleteSpan.className = 'delete-icon';
    deleteSpan.innerHTML = '<i class="fas fa-trash"></i>';  // Icône de croix Font Awesome
    deleteSpan.addEventListener('click', function(e) {
        e.stopPropagation();
        this.parentElement.remove();
    });

    var newDiv = document.createElement('div');
    newDiv.className = 'image-upload-slider';
    newDiv.appendChild(newImagePreview);
    newDiv.appendChild(newInput);
    newDiv.appendChild(deleteSpan);  // Ajoute la croix de suppression à la nouvelle div
    newDiv.addEventListener('click', function () {
        newInput.click();
    });

    document.getElementById('sliderImages').appendChild(newDiv);
});
