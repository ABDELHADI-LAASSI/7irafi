<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.index');
        } elseif (Auth::user()->role == 'hirafi') {
            return redirect()->route('hirafi.index');
        } elseif (Auth::user()->role == 'user') {
            return redirect()->route('user.main');
        }

        return view('dashboard');
    }
}
