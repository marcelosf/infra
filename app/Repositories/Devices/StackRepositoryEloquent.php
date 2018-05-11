<?php

namespace Infra\Repositories\Devices;

use Infra\Entities\Devices\Stack;
use Infra\Validators\Devices\StackValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class StackRepositoryEloquent.
 *
 * @package namespace Infra\Repositories\Devices;
 */
class StackRepositoryEloquent extends BaseRepository implements StackRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Stack::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StackValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
