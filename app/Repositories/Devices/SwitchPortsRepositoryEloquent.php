<?php

namespace Infra\Repositories\Devices;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Infra\Repositories\Devices\SwitchPortsRepository;
use Infra\Entities\Devices\SwitchPorts;
use Infra\Validators\Devices\SwitchPortsValidator;

/**
 * Class SwitchPortsRepositoryEloquent.
 *
 * @package namespace Infra\Repositories\Devices;
 */
class SwitchPortsRepositoryEloquent extends BaseRepository implements SwitchPortsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SwitchPorts::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SwitchPortsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
