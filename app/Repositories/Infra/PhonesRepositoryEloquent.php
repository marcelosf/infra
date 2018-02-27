<?php

namespace Infra\Repositories\Infra;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Infra\Repositories\Infra\PhonesRepository;
use Infra\Entities\Infra\Phones;
use Infra\Validators\Infra\PhonesValidator;

/**
 * Class PhonesRepositoryEloquent.
 *
 * @package namespace Infra\Repositories\Infra;
 */
class PhonesRepositoryEloquent extends BaseRepository implements PhonesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Phones::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PhonesValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
