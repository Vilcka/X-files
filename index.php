<?php include('inc/head.php'); ?>
<?php
if (isset($_POST['contenu'])) {
    $fichier = $files[1];
    $file = fopen($fichier, "w");
    fwrite($fichier, $_POST['contenu']);
    fclose($fichier);
}


    $path = realpath('files');
    $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path),RecursiveIteratorIterator::SELF_FIRST);
    $files = [];
    foreach ($objects as $name => $object) {
        if ((basename($name) != '.') && (basename($name) != '..')) {
            $files[] = $name;
            if (is_dir($name)) {
                echo '<strong>' . ucfirst(basename($name)) .'</strong><br/>';
            }else {
                echo '<a class="files" href="?f='. dirname($name) . $name .'">'. basename($name) . '</a><br/>';
            }
        }
    }
    var_dump($files);

$fichier = $files[1];
$contenu = file_get_contents($fichier);

?>
<form method="POST" action="index.php">
    <textarea name="contenu"><?= $contenu ?></textarea>
    <input type="submit" value="Envoyer">
</form>

<?php include('inc/foot.php'); ?>