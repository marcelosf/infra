<?php

namespace Infra\Repositories\Infra;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Infra\Repositories\Infra\RackRepository;
use Infra\Entities\Infra\Rack;
use Infra\Validators\Infra\RackValidator;

/**
 * Class RackRepositoryEloquent.
 *
 * @package namespace Infra\Repositories\Infra;
 */
class RackRepositoryEloquent extends BaseRepository implements RackRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Rack::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RackValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
