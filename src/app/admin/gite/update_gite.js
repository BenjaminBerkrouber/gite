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

// Sélectionne l'élément parent et ajoute un écouteur d'événements
document.addEventListener('click', function(e) {
    var deleteIcon = e.target.closest('.delete-icon');

    // Si l'événement a été déclenché par un bouton de suppression
    if (deleteIcon) {
        console.log('Delete icon clicked');  // Log when the delete icon is clicked
        e.stopPropagation();  // Empêche l'événement de click de se propager à l'élément parent
        var imageId = deleteIcon.parentElement.getAttribute('data-image-id');
        console.log('Image ID: ', imageId);  // Log the image ID
        var imageElement = deleteIcon.parentElement;

        // Obtenez l'ID du gite depuis l'attribut data-gite-id du formulaire
        var giteId = document.querySelector('form').getAttribute('data-gite-id');

        // Envoie une requête AJAX pour supprimer l'image de la base de données
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/admin/gite/delete_image/' + giteId, true);  // Ajoutez l'ID du gite à la requête AJAX
        console.log('Opening AJAX request');  // Log when the AJAX request is opened
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            console.log('AJAX readyState changed: ', this.readyState);  // Log when the readyState changes
            if (this.readyState === 4 && this.status === 200) {
                console.log('AJAX request successful');  // Log when the AJAX request is successful
                imageElement.remove();
            } else if (this.readyState === 4) {
                console.error('An error occurred: ', this.statusText);
            }
        };
        console.log('Sending AJAX request');  // Log when the AJAX request is sent
        xhr.send('image_id=' + imageId);
    }
});
