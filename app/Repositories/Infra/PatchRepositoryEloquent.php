<?php

namespace Infra\Repositories\Infra;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Infra\Presenters\PatchPresenter;
use Infra\Entities\Infra\Patch;
use Infra\Validators\Infra\PatchValidator;

/**
 * Class PatchRepositoryEloquent.
 *
 * @package namespace Infra\Repositories\Infra;
 */
class PatchRepositoryEloquent extends BaseRepository implements PatchRepository
{

    protected $fieldSearchable = [



    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {

        return Patch::class;

    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PatchValidator::class;

    }

    public function presenter()
    {

        return PatchPresenter::class;

    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {

        $this->pushCriteria(app(RequestCriteria::class));

    }
    
}
