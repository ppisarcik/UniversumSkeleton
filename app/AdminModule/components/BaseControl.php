<?php

namespace App\AdminModule\Components;

use Nette\Application\UI\Control;
use Nette\DI\Container;

abstract class BaseControl extends Control
{
    /** @var Container @inject */
    public $context;

    /**
     * @param string $name
     * @return object
     * @throws \Exception
     */
    protected function getRepository(string $name)
    {
        if(!isset($this->context->parameters['repositories'][$name])) {
            throw new \Exception("Repository does not exist!");
        }

        return $this->context->getService($this->context->parameters['repositories'][$name]);

    }

}