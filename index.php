<?php include('inc/head.php'); ?>
<?php
    $path = realpath('files');
    $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path),RecursiveIteratorIterator::SELF_FIRST);
    foreach ($objects as $name => $object) {
        if((basename($object) != '.') && (basename($object) != '..')) {
            if (is_dir($name)) {
                echo '<strong><a href="'. $name.'">' . ucfirst(basename($name)) . '</a></strong><br/>';
            }else {
                echo '<a class="files" href="'. $name .'">'. basename($object) . '</a><br/>';
            }


        }
    }


?>

<?php include('inc/foot.php'); ?>