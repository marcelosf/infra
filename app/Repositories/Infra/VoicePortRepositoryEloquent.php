<?php

namespace Infra\Repositories\Infra;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Infra\Repositories\Infra\VoicePortRepository;
use Infra\Entities\Infra\VoicePort;
use Infra\Validators\Infra\VoicePortValidator;

/**
 * Class VoicePortRepositoryEloquent.
 *
 * @package namespace Infra\Repositories\Infra;
 */
class VoicePortRepositoryEloquent extends BaseRepository implements VoicePortRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VoicePort::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return VoicePortValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
