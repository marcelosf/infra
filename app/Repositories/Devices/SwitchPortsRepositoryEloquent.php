<?php

namespace Infra\Repositories\Devices;

use Infra\Entities\Devices\SwitchPorts;
use Infra\Presenters\SwitchPortPresenter;
use Infra\Validators\Devices\SwitchPortsValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SwitchPortsRepositoryEloquent.
 *
 * @package namespace Infra\Repositories\Devices;
 */
class SwitchPortsRepositoryEloquent extends BaseRepository implements SwitchPortsRepository
{

    protected $fieldSearchable = [

        'switch_id',
        'dswitch.hostname'

    ];


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


    public function presenter()
    {

        return SwitchPortPresenter::class;

    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
