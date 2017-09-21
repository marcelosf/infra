<?php

namespace Infra\Http\Controllers\Home;

use Illuminate\Http\Request;
use Infra\Http\Controllers\Controller;
use Infra\Model\Infra\Patch;

class HomeController extends Controller
{

    protected $patch;

    public function __construct(Patch $patch)
    {

        $this->patch = $patch;

    }


    public function index() {

        $patches = $this->patch->with('rack', 'local')->get()->all();

        return view('home.index', compact('patches'));

    }

}
