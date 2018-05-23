<?php

namespace Infra\Repositories\Devices;

use Infra\Entities\Devices\Stack;
use Infra\Presenters\StackPresenter;
use Infra\Validators\Devices\StackValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;


class StackRepositoryEloquent extends BaseRepository implements StackRepository
{

    public $fieldSearchable = [

        'rack_id'

    ];

    public function model()
    {

        return Stack::class;

    }


    public function validator()
    {

        return StackValidator::class;

    }


    public function presenter()
    {

        return StackPresenter::class;

    }


    public function boot()
    {

        $this->pushCriteria(app(RequestCriteria::class));

    }
    
}
