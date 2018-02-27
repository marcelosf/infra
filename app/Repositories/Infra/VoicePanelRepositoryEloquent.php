<?php

namespace Infra\Repositories\Infra;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Infra\Repositories\Infra\VoicePanelRepository;
use Infra\Entities\Infra\VoicePanel;
use Infra\Validators\Infra\VoicePanelValidator;

/**
 * Class VoicePanelRepositoryEloquent.
 *
 * @package namespace Infra\Repositories\Infra;
 */
class VoicePanelRepositoryEloquent extends BaseRepository implements VoicePanelRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VoicePanel::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return VoicePanelValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
