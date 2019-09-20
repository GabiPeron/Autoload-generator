<?php

    require_once "./src/generator/autoload_generator.php";
    require_once "./src/generator/pdo_generator.php";

    $filepath = "./src/json/folders.json";

    $generator = new AutoloadGenerator();

    $generator->generate($filepath);

?>