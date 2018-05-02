<?php include('inc/head.php'); ?>
<?php
if (isset($_POST['contenu'])) {
    $fichier = $_POST['file'];
    $file = fopen($fichier, "w");
    fwrite($file, $_POST['contenu']);
    fclose($file);
}

if (isset($_GET['delete'])) {
    delete_dir($_GET['delete']);
}


$path = realpath('files');
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path),RecursiveIteratorIterator::SELF_FIRST);
$pathInfo = [];
foreach ($objects as $object) {
    if ((basename($object) != '.') && (basename($object) != '..')) {
        $pathInfo[$object->getFileName()] = pathinfo($object);
        if (is_dir($object)) {
            echo ' <strong>' . ucfirst(basename($object)) .'</strong>
                    <a href="?delete=' . $object->getPathName() . '"><span class="glyphicon glyphicon-remove delete" aria-hidden="true"></span></a>  
                    <br/>';
        } else {
            echo '  <input type="hidden" name="delete" value="' . $object->getPathName() . '">
                    <a class="files" href="?fileEdit=' . $object . '">'. basename($object) . '</a>
                    <a href="?delete=' . $object->getPathName() . '"><span class="glyphicon glyphicon-remove delete" aria-hidden="true"></span></a>
                    <br/>';
        }
    }
}
if (isset($_GET['fileEdit'])) {
    $extension = $pathInfo[basename($_GET['fileEdit'])]['extension'];
    if ($extension == 'jpg') {
        $errorsFileExtension = '<h4>Vous ne pouvez editez que les fichier txt ou html !</h4>';
    } else {
        $contenu = file_get_contents($_GET['fileEdit']);
?>
<form method="POST" action="index.php">
    <textarea name="contenu"><?= $contenu ?></textarea>
    <input type="hidden" name="file" value="<?= $_GET['fileEdit'] ?>">
    <input type="submit" value="Envoyer">
</form>
<?php
//Fermeture du else puis du bloc if parent
    }
} ?>

<?php if (isset($errorsFileExtension)){
    echo $errorsFileExtension;
}

function delete_dir($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file )
        {
            delete_dir( $file );
        }

        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );
    }
    return header("location: index.php");
}


?>
<?php include('inc/foot.php'); ?>