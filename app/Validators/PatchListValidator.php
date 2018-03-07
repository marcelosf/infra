<?php

namespace Infra\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class PatchListValidator.
 *
 * @package namespace Infra\Validators;
 */
class PatchListValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
