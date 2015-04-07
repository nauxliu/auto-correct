<?php
include __DIR__.'/vendor/autoload.php';

$auto = new Naux\AutoCorrect();

            //output:「介绍」PHPHub 是国内 PHP 和 Laravel 社区
echo $auto->convert('「介绍」phphub是国内php和laravel社区');
