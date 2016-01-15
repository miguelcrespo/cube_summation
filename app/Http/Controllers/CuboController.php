<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CuboController extends Controller
{

    private function iniciarSession()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

    }

    private function getMatrix()
    {
        $matrix = null;
        if (isset($_SESSION['matrix'])) {
            $matrix = $_SESSION['matrix'];

        }

        return $matrix;
    }

    public function index()
    {
        $this->iniciarSession();

        $matrix = $this->getMatrix();

        return view('home.home', ['matrix' => $matrix]);
    }

    public function create(Request $request)
    {
        $this->iniciarSession();

        $this->validate($request, [
            't' => 'required|min:1|max:50',
            'm' => 'required|min:1|max:1000',
            'n' => 'required|min:1|max:100',
        ]);

        $input = $request->only('t', 'm', 'n');

        $matrix = new Matrix($input['t'], $input['n'], $input['m']);

        $this->iniciarConfiguracionSession($matrix, 0, 0);


        return response()->json(['error' => 'false']);

    }

    private function iniciarConfiguracionSession($matrix, $int, $int1)
    {
        $_SESSION['matrix'] = $matrix;
        $_SESSION['tests'] = 0;
        $_SESSION['actions'] = 0;
    }

}


class Matrix
{
    private $t, $m, $n, $matrix;

    function __construct($t, $n, $m)
    {
        $this->t = $t;
        $this->m = $m;
        $this->n = $n;
        $this->construirMatrix($n);
    }

    private function construirMatrix($n)
    {
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                for ($k = 0; $k < $n; $k++) {
                    $this->matrix[$i][$j][$k] = 0;
                }
            }
        }
    }

    public function updateValue($x, $y, $z, $value)
    {
        $this->matrix[$x][$y][$z] = $value;
    }

    public function query($x1, $y1, $z1, $x2, $y2, $z2)
    {
        $sum = 0;
        for ($i = $x1; $i < $x2; $i++) {
            for ($j = $y1; $j < $y2; $j++) {
                for ($k = $z1; $k < $z2; $k++) {
                    $sum += $this->matrix[$i][$j][$k];
                }
            }
        }
        return $sum;
    }

    public function getM()
    {
        return $this->m;
    }

    public function getMatrix()
    {
        return $this->matrix;
    }

    public function getN()
    {
        return $this->n;
    }

    public function getT()
    {
        return $this->t;
    }


}