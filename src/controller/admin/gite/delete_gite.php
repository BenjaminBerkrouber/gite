<?php

function rrmdir($src) {
    if(file_exists($src)) {
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                $full = $src . '/' . $file;
                if ( is_dir($full) ) {
                    rrmdir($full);
                }
                else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($src);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Delete gite's images folder
        $giteFolder = 'public/images/gites/gite-' . $id;
        rrmdir($giteFolder);

        delete_gite($id);

        header("Location: /admin/gite");
        exit();
    } else {
        echo "Erreur : ID manquant.";
        exit();
    }
}
