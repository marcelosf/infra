<?php

namespace Infra\Repositories\Infra;

use Infra\Entities\Infra\Rack;
use Infra\Validators\Infra\RackValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class RackRepositoryEloquent.
 *
 * @package namespace Infra\Repositories\Infra;
 */
class RackRepositoryEloquent extends BaseRepository implements RackRepository
{

    protected $fieldSearchable = [

        'name',
        'id'

    ];

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
