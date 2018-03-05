<?php namespace App\Models\Content\Traits\Attribute;

/**
 * Trait Attribute
 *
 * @author Anuj Jaha
 */

use File;
use App\Repositories\Content\EloquentContentRepository;

trait Attribute
{
	/**
	 * @return string
	 */
	public function getEditButtonAttribute($routes, $prefix = 'admin')
	{
		return '<a href="'.route($prefix .'.'. $routes->editRoute, $this).'" class="btn btn-xs btn-info"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> ';
	}
	
	/**
	 * @return string
	 */
	public function getDeleteButtonAttribute($routes, $prefix = 'admin')
	{
	    return '<a href="'.route($prefix .'.'. $routes->deleteRoute, $this).'"
	            data-method="delete"
	            data-trans-button-cancel="Cancel"
	            data-trans-button-confirm="Delete"
	            data-trans-title="Do you want to Delete this Item ?"
	            class="btn btn-xs btn-danger"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>';
	}

	/**
	 * @return string
	 */
	public function getActionButtonsAttribute()
	{
		$repository = new EloquentContentRepository;

		$routes = $repository->getModuleRoutes();

		return $this->getEditButtonAttribute($routes, $repository->clientRoutePrefix) . $this->getDeleteButtonAttribute($routes, $repository->clientRoutePrefix);
	}   

	/**
	 * @return string
	 */
	public function getAdminActionButtonsAttribute()
	{
		$repository = new EloquentContentRepository;

		$routes = $repository->getModuleRoutes();

		return $this->getEditButtonAttribute($routes, $repository->adminRoutePrefix) . $this->getDeleteButtonAttribute($routes, $repository->adminRoutePrefix);
	}   
}