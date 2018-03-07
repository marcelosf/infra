<?php

namespace Infra\Http\Controllers\Home;

use Infra\Http\Controllers\Controller;
use Infra\Repositories\PatchList\PatchListRepositoryEloquent;
use Infra\Validators\PatchListValidator;


class HomeController extends Controller
{

    protected $repository;


    protected $validator;


    public function __construct(PatchListRepositoryEloquent $repository, PatchListValidator $validator)
    {

        $this->repository = $repository;

        $this->validator = $validator;

    }


    public function index() {

        $patches = $this->repository->paginate(12);

        $pagination = $patches['meta']['pagination'];

        if (request()->wantsJson()) {

            return response()->json(['data' => $patches, 'pagination' => $pagination]);

        }

        return view('home.index', compact('patches', 'pagination'));

    }

}
