<?php

namespace Infra\Presenters;

use Infra\Transformers\PatchTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PatchPresenter.
 *
 * @package namespace Infra\Presenters;
 */
class PatchPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {

        return new PatchTransformer();

    }
}
