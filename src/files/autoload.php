<?php
  spl_autoload_register(function ($nomeClasse) { 
      $folders = array("classes","conf","dao","pdo");
      foreach ($folders as $folder) {
            if (file_exists($folder.DIRECTORY_SEPARATOR.$nomeClasse.".class.php")) {
                require_once($folder.DIRECTORY_SEPARATOR.$nomeClasse.".class.php");
            }
        }
  });
?>