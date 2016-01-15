<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CuboController extends Controller
{
    public function index()
    {
        return view('home.home');
    }

}
