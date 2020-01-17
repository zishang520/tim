<?php
namespace luoyy\Tim\Facades;

use Illuminate\Support\Facades\Facade;
use luoyy\Tim\TimManager;

/**
 */
class Tim extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return TimManager::class;
    }
}
