<?php

namespace App\Http\Controllers;

use App\Datos;
use App\Matrix;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CuboController extends Controller
{

    public function index()
    {
        $datos = new Datos();

        $datos->deleteSession();

        $matrix = $datos->getMatrix();

        return view('home.home', ['matrix' => $matrix]);
    }

    public function create(Request $request)
    {
        $datos = new Datos();

        $this->validate($request, [
            'm' => 'required|integer|between:1,1000',
            'n' => 'required|integer|between:1,100',
        ]);

        $input = $request->only('m', 'n');

        $matrix = new Matrix($input['n'], $input['m']);


        $datos->setMatrix($matrix);
        $datos->setActions(0);

        return response()->json(['error' => 'false']);

    }


    public function update(Request $request)
    {
        $datos = new Datos();

        $this->validate($request, [
            'x' => 'required|integer|min:1',
            'y' => 'required|integer|min:1',
            'z' => 'required|integer|min:1',
            'value' => 'required|integer|between:-1000000000,1000000000',
        ]);

        $matrix = $datos->getMatrix();

        if (!$matrix) {
            return response()->json(['error' => 'La matrix no ha sido configurada'], 500);
        }

        $input = $request->only('x', 'y', 'z', 'value');

        if ($input['x'] > $matrix->getN() || $input['y'] > $matrix->getN() || $input['z'] > $matrix->getN()) {
            return response()->json(['error' => 'Valores exceden tamanio de la matrix...'], 422);
        }

        if (!$this->checkTests($matrix)) {
            return response()->json(['error' => 'Tests finalizados'], 500);
        };

        $matrix->updateValue($input['x'] - 1, $input['y'] - 1, $input['z'] - 1, $input['value']);

        return response()->json(['error' => false]);

    }

    public function query(Request $request){
        $datos = new Datos();


        $this->validate($request, [
            'x1' => 'required|min:1',
            'x2' => 'required|min:1',
            'y1' => 'required|min:1',
            'y2' => 'required|min:1',
            'z1' => 'required|min:1',
            'z2' => 'required|min:1',
        ]);


        $matrix = $datos->getMatrix();

        if(!$matrix){
            return response()->json(['error' => 'La matrix no ha sido configurada'], 500);
        }

        $values = $request->only('x1', 'x2', 'y1', 'y2', 'z1', 'z2');

        if($values['x2']-1 < $values['x1']-1 || $values['y2']-1 < $values['y1']-1 || $values['z2']-1 < $values['z1']-1){
            return response()->json(['error' => 'Un rango minimo es menor al maximo'], 422);
        }


        if(!$this->checkTests($matrix)){
            return response()->json(['error' => 'Tests finalizados'], 500);
        };


        return response()->json(['result' => $matrix->query($values['x1']-1, $values['y1']-1, $values['z1']-1, $values['x2']-1, $values['y2']-1, $values['z2']-1)]);
    }


    private function iniciarConfiguracionSession($matrix, $tests, $actions)
    {
        $_SESSION['matrix'] = $matrix;
        $_SESSION['actions'] = $actions;
    }

    private function checkTests($matrix)
    {
        $datos = new Datos();

        if ($datos->getActions() >= $matrix->getM()) {
            $datos->setMatrix(null);
            return false;
        } else {
           $datos->setActions($datos->getActions() + 1);
        }

        return true;
    }


}