<?php

namespace Infra\Repositories\Local;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Infra\Repositories\Local\LocalRepository;
use Infra\Entities\Local\Local;
use Infra\Validators\Local\LocalValidator;


class LocalRepositoryEloquent extends BaseRepository implements LocalRepository
{

    protected $fieldSearchable = [

        'build',
        'floor',
        'local',

    ];

    public function model()
    {
        return Local::class;
    }


    public function validator()
    {

        return LocalValidator::class;
    }


    public function boot()
    {

        $this->pushCriteria(app(RequestCriteria::class));

    }
    
}
