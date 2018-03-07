<?php

namespace Infra\Repositories\PatchList;

use Infra\Presenters\PatchListPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Infra\Repositories\PatchList\PatchListRepository;
use Infra\Entities\PatchList\PatchList;
use Infra\Validators\PatchListValidator;

/**
 * Class PatchListRepositoryEloquent.
 *
 * @package namespace Infra\Repositories;
 */
class PatchListRepositoryEloquent extends BaseRepository implements PatchListRepository
{

    protected $fieldSearchable = [

        'build',
        'floor',
        'local',
        'patchPort',
        'switchHostName',
        'switchPortIp',
        'switch',
        'resource',
        'switchPortVlan',
        'switchPort',
        'rackLocal',
        'rack',

    ];


    public function model()
    {

        return PatchList::class;

    }


    public function presenter()
    {

        return PatchListPresenter::class;

    }


    public function validator()
    {

        return PatchListValidator::class;

    }


    public function boot()
    {

        $this->pushCriteria(app(RequestCriteria::class));

    }
    
}
