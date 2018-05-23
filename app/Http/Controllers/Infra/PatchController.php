<?php

namespace Infra\Http\Controllers\Infra;

use Infra\Http\Controllers\Controller;
use Infra\Repositories\Infra\PatchRepositoryEloquent;
use Infra\Validators\Infra\PatchValidator;

class PatchController extends Controller
{

    protected $repository;

    protected $validator;

    public function __construct(PatchRepositoryEloquent $repository, PatchValidator $validator)
    {

        $this->repository = $repository;

        $this->validator = $validator;

    }

    public function index()
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $patch = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([

                'data' => $patch

            ]);

        }

        return view('patch.index', compact('patch'));

    }

}
