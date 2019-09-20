<?php

class AutoloadGenerator {

    private $pdo;
    
    public function __construct() {
        $this->pdo = new PdoGenerator();
    }

    public function generate($filepath) {
        $folders = json_decode(file_get_contents($filepath))->folders;
        $last = end($folders);

        $file = '<?php'."\n".'  spl_autoload_register(function ($nomeClasse) { '."\n".'      $folders = array(';
        
        foreach ($folders as $folder) {
            if ($folder == $last) {
                $file .= '"'.$folder.'"';
            }else {
                $file .= '"'.$folder.'"'.',';
            }
        }

        $file .= ');'."\n".'      foreach ($folders as $folder) {
            if (file_exists($folder.DIRECTORY_SEPARATOR.$nomeClasse.".class.php")) {
                require_once($folder.DIRECTORY_SEPARATOR.$nomeClasse.".class.php");
            }
        }
  });
?>';

        file_put_contents("./src/files/autoload.php", $file);

        $this->generate_folders($folders);

        $this->make_test();

        $this->pdo->generate($filepath);

        echo "sucesso!";
    }

    private function generate_folders($folders) {
        foreach ($folders as $folder) {
            mkdir("./src/".$folder);
        }
    }

    private function make_test() {
        $file = '<?php

        require_once "./src/files/connection.php";
    
        $conn = new Connection("test", "mysql", "localhost", "root", "root");
    
        var_dump($conn->conn);
    
    ?>';

    file_put_contents("./src/files/test.php", $file);
    }

}

?>