<?php

namespace Infra\Http\Controllers\Home;

use Illuminate\Http\Request;
use Infra\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index() {

        return view('home.index');

    }

}
