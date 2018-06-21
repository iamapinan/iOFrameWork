<?php
namespace app\cmd;

use ConsoleKit\Command;

class CreateController extends Command {
    function controller_intent($name) {

        return "
            <?php
            namespace controllers;
            class $name {
                public function __construct() {
                    // construct here
                }

                public function index() {
                    // Your return value.
                }
            }
        ";
    }

    function create ($name) {
        return file_put_contents('controllers/'.$name.'.php', $this->controller_intent($name));
    }

    public function execute(array $args, array $options = array())
    {
        print_r($args);
        if($this->create($args[0])) {
            $this->writeln("Controller ". $args[0] ." create successfully!.", ConsoleKit\Colors::GREEN);
        } else {
            $this->writeln("Controller ". $args[0] ." create fail!.", ConsoleKit\Colors::RED);
        }
    }
}
?>