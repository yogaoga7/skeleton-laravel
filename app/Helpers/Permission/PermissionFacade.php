<?php 
namespace App\Helpers\Permission;

use Illuminate\Support\Facades\Facade;

class PermissionFacade extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return PermissionClass::class; }
}