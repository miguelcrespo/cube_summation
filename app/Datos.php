<?php
/**
 * Created by PhpStorm.
 * User: Miguel
 * Date: 1/15/16
 * Time: 4:31 PM
 */

namespace App;

class Datos
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    private function returnValue($key)
    {
        $value = null;
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];

        }
        return $value;

    }
    public function getMatrix()
    {
        return $this->returnValue('matrix');
    }

    public function getActions()
    {
        return $this->returnValue('actions');

    }

    public function setMatrix($matrix)
    {
        $_SESSION['matrix'] = $matrix;
    }
    public function setActions($actions)
    {
        $_SESSION['actions'] = $actions;
    }

    public function deleteSession(){
        session_destroy();
    }

}