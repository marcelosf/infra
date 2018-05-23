<?php

namespace Infra\Repositories\Devices;

use Infra\Entities\Devices\Switches;
use Infra\Presenters\SwitchesPresenter;
use Infra\Validators\Devices\SwitchesValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SwitchesRepositoryEloquent.
 *
 * @package namespace Infra\Repositories\Devices;
 */
class SwitchesRepositoryEloquent extends BaseRepository implements SwitchesRepository
{

     protected $fieldSearchable = [

         'dstack.rack_id'

     ];

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

    public function presenter()
    {

        return SwitchesPresenter::class;

    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
