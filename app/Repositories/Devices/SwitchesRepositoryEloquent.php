<?php

namespace Infra\Repositories\Devices;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Infra\Repositories\Devices\SwitchesRepository;
use Infra\Entities\Devices\Switches;
use Infra\Validators\Devices\SwitchesValidator;

/**
 * Class SwitchesRepositoryEloquent.
 *
 * @package namespace Infra\Repositories\Devices;
 */
class SwitchesRepositoryEloquent extends BaseRepository implements SwitchesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Switches::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SwitchesValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
