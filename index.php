<?php include('inc/head.php'); ?>
<?php
    $path = realpath('files');
    $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path),RecursiveIteratorIterator::SELF_FIRST);
    $files = [];
    foreach ($objects as $name ) {
        if((basename($name) != '.') && (basename($name) != '..')) {
            $files[] = basename($name->getPathname());
            if (is_dir($name)) {
                echo '<strong><a href="'. $name.'">' . ucfirst(basename($name)) . '</a></strong><br/>';
            }else {
                echo '<a class="files" href="'. $name .'">'. basename($name) . '</a><br/>';
            }

        }
    }

?>

<?php include('inc/foot.php'); ?>