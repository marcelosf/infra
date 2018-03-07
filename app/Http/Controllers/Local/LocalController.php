<?php

namespace Infra\Http\Controllers\Local;

use Infra\Model\Local\Local;
use Infra\Http\Controllers\Controller;
use Infra\Repositories\Local\LocalRepositoryEloquent;
use Infra\Validators\Local\LocalValidator;
use Prettus\Repository\Criteria\RequestCriteria;

class LocalController extends Controller
{

    protected $local;

    protected $repository;

    protected $validator;


    public function __construct(LocalRepositoryEloquent $repository, LocalValidator $validator)
    {

        $this->repository = $repository;

        $this->validator = $validator;

    }


    public function index()
    {

        $this->repository->pushCriteria(app(RequestCriteria::class));

        $locals = $this->repository->all();

        return response()->json(['data' => $locals]);

    }

}
