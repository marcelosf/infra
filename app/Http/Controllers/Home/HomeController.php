<?php

namespace Infra\Http\Controllers\Home;

use Infra\Http\Controllers\Controller;
use Infra\Repositories\Infra\PatchRepositoryEloquent;
use Infra\Validators\Infra\PatchValidator;
use Prettus\Repository\Criteria\RequestCriteria;


class HomeController extends Controller
{

    protected $repository;


    protected $validator;


    public function __construct(PatchRepositoryEloquent $repository, PatchValidator $validator)
    {

        $this->repository = $repository;

        $this->validator = $validator;

    }


    public function index() {

        $this->repository->pushCriteria(app(RequestCriteria::class));

        $patches = $this->repository->paginate(14);

        $pagination = $patches['meta']['pagination'];

        return view('home.index', compact('patches', 'pagination'));

    }

}
