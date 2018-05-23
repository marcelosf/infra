<?php

namespace Infra\Presenters;

use Infra\Transformers\SwitchPortTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SwitchPortPresenter.
 *
 * @package namespace Infra\Presenters;
 */
class SwitchPortPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SwitchPortTransformer();
    }
}
