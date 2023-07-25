<?php

    $giteFolder = 'public/images/gites/gite-' . $id_gite;
    if (!is_dir($giteFolder)) {
        mkdir($giteFolder, 0755, true);
    }

    $tmpFilePath = $imageIllustration['tmp_name'];
    $fileName = "illustrator.jpg";
    $uploadPath = $giteFolder . '/' . $fileName;
    move_uploaded_file($tmpFilePath, $uploadPath);
    $uploadPath = '/'.$giteFolder . '/' . $fileName;
    add_gite_image($id_gite, $fileName, $uploadPath, 'illustration');

    if($_FILES['sliderImages']['error'][0] === UPLOAD_ERR_OK){
        $sliderImageCount = count($sliderImages['name']);
        for ($i = 0; $i < $sliderImageCount; $i++) {
            if ($sliderImages['error'][$i] === UPLOAD_ERR_OK) {
                $sliderTmpFilePath = $sliderImages['tmp_name'][$i];
                $sliderFileName = "slider-gite-{$id_gite}-{$i}.jpg";
                $sliderUploadPath = $giteFolder . '/' . $sliderFileName;
                move_uploaded_file($sliderTmpFilePath, $sliderUploadPath);
                add_gite_image($id_gite, $sliderFileName, $sliderUploadPath, 'slider');
            }
    }

    }