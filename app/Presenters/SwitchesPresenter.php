<?php

namespace Infra\Presenters;

use Infra\Transformers\SwitchesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SwitchesPresenter.
 *
 * @package namespace Infra\Presenters;
 */
class SwitchesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SwitchesTransformer();
    }
}
