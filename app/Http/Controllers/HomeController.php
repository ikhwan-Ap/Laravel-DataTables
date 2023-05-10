<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $data = [
                'title'          => 'Dashboard',
                'total_user'     => User::get()->count()
            ];
            return view('index', $data);
        } else {
            return Redirect::route('login');
        }
    }
}
