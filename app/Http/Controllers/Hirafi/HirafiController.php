<?php

namespace App\Http\Controllers\Hirafi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HirafiController extends Controller
{
    public function index()
    {
        return view('hirafi.index');
    }
}
