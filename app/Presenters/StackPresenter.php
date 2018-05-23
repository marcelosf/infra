<?php

namespace Infra\Presenters;

use Infra\Transformers\StackTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StackPresenter.
 *
 * @package namespace Infra\Presenters;
 */
class StackPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StackTransformer();
    }
}
