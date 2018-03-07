<?php

namespace Infra\Presenters;

use Infra\Transformers\PatchListTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PatchListPresenter.
 *
 * @package namespace Infra\Presenters;
 */
class PatchListPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PatchListTransformer();
    }
}
