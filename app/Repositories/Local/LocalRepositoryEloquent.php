<?php

namespace Infra\Repositories\Local;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Infra\Repositories\Local\LocalRepository;
use Infra\Entities\Local\Local;
use Infra\Validators\Local\LocalValidator;

/**
 * Class LocalRepositoryEloquent.
 *
 * @package namespace Infra\Repositories\Local;
 */
class LocalRepositoryEloquent extends BaseRepository implements LocalRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Local::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LocalValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
