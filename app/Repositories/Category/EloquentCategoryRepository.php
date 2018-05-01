<?php namespace App\Repositories\Category;

use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\Access\User\User;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\TierLevel\TierLevel;

class EloquentCategoryRepository extends DbRepository
{
	/**
	 * Event Model
	 * 
	 * @var Object
	 */
	public $model;

	/**
	 * Module Title
	 * 
	 * @var string
	 */
	public $moduleTitle = 'Category';

	/**
	 * Table Headers
	 *
	 * @var array
	 */
	public $tableHeaders = [
		'id' 			=> '# (ID)',
		'title' 		=> 'Title',
		'productscount' => 'Products Count',
		'image' 		=> 'Image',
		'actions' 		=> 'Actions'
	];

	/**
	 * Table Columns
	 *
	 * @var array
	 */
	public $tableColumns = [
		'id' => [
			'data' 			=> 'id',
			'name' 			=> 'id',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'title' => [
			'data' 			=> 'title',
			'name' 			=> 'title',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'productscount' => [
			'data' 			=> 'productscount',
			'name' 			=> 'productscount',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'image' => [
			'data' 			=> 'image',
			'name' 			=> 'image',
			'searchable' 	=> false, 
			'sortable'		=> false
		],
		'actions' => [
			'data' 			=> 'actions',
			'name' 			=> 'actions',
			'searchable' 	=> false, 
			'sortable'		=> false
		]
	];

	/**
	 * Is Admin
	 * 
	 * @var boolean
	 */
	protected $isAdmin = false;

	/**
	 * Admin Route Prefix
	 * 
	 * @var string
	 */
	public $adminRoutePrefix = 'admin';

	/**
	 * Client Route Prefix
	 * 
	 * @var string
	 */
	public $clientRoutePrefix = 'frontend';

	/**
	 * Admin View Prefix
	 * 
	 * @var string
	 */
	public $adminViewPrefix = 'backend';

	/**
	 * Client View Prefix
	 * 
	 * @var string
	 */
	public $clientViewPrefix = 'frontend';

	/**
	 * Module Routes
	 * 
	 * @var array
	 */
	public $moduleRoutes = [
		'listRoute' 	=> 'category.index',
		'createRoute' 	=> 'category.create',
		'storeRoute' 	=> 'category.store',
		'editRoute' 	=> 'category.edit',
		'updateRoute' 	=> 'category.update',
		'deleteRoute' 	=> 'category.destroy',
		'dataRoute' 	=> 'category.get-list-data'
	];

	/**
	 * Module Views
	 * 
	 * @var array
	 */
	public $moduleViews = [
		'listView' 		=> 'category.index',
		'createView' 	=> 'category.create',
		'editView' 		=> 'category.edit',
		'deleteView' 	=> 'category.destroy',
	];

	/**
	 * Construct
	 *
	 */
	public function __construct()
	{
		$this->model 		= new Category;
		$this->productModel = new Product;
	}

	/**
	 * Create Event
	 *
	 * @param array $input
	 * @return mixed
	 */
	public function create($input)
	{
		$input = $this->prepareInputData($input, true);
		$model = $this->model->create($input);

		if($model)
		{
			return $model;
		}

		return false;
	}	

	/**
	 * Update Event
	 *
	 * @param int $id
	 * @param array $input
	 * @return bool|int|mixed
	 */
	public function update($id, $input)
	{
		$model = $this->model->find($id);

		if($model)
		{
			$input = $this->prepareInputData($input);		
			
			return $model->update($input);
		}

		return false;
	}

	/**
	 * Destroy Event
	 *
	 * @param int $id
	 * @return mixed
	 * @throws GeneralException
	 */
	public function destroy($id)
	{
		$model = $this->model->find($id);
			
		if($model)
		{
			return $model->delete();
		}

		return  false;
	}

	/**
     * Get All
     *
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAll($orderBy = 'id', $sort = 'asc', $max = 100)
    {
    	$user = access()->user();

    	if($user && $user->id != 1)
    	{
    		$categories 	= access()->getPermissionByTier($user->user_level);
    		$categoryIds 	= $categories->pluck('category_id')->unique()->toArray();

    		return  $this->model->whereIn('id', $categoryIds)->limit($max)->orderBy($orderBy)->get();
    	}
        return $this->model->orderBy($orderBy)->limit($max)->get();
    }

	/**
     * Get by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id = null)
    {
    	if($id)
    	{
    		return $this->model->find($id);
    	}
        
        return false;
    }   

    /**
     * Get Table Fields
     * 
     * @return array
     */
    public function getTableFields()
    {
    	return [
			$this->model->getTable().'.id as id',
			$this->model->getTable().'.title',
			$this->model->getTable().'.image',
		];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
    	return  $this->model->select($this->getTableFields())
    				->get();
        
    }

    /**
     * Set Admin
     *
     * @param boolean $isAdmin [description]
     */
    public function setAdmin($isAdmin = false)
    {
    	$this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Prepare Input Data
     * 
     * @param array $input
     * @param bool $isCreate
     * @return array
     */
    public function prepareInputData($input = array(), $isCreate = false)
    {
    	return $input;
    }

    /**
     * Get Table Headers
     * 
     * @return string
     */
    public function getTableHeaders()
    {
    	if($this->isAdmin)
    	{
    		return json_encode($this->setTableStructure($this->tableHeaders));
    	}

    	$clientHeaders = $this->tableHeaders;

    	unset($clientHeaders['username']);

    	return json_encode($this->setTableStructure($clientHeaders));
    }

	/**
     * Get Table Columns
     *
     * @return string
     */
    public function getTableColumns()
    {
    	if($this->isAdmin)
    	{
    		return json_encode($this->setTableStructure($this->tableColumns));
    	}

    	$clientColumns = $this->tableColumns;

    	unset($clientColumns['username']);
    	
    	return json_encode($this->setTableStructure($clientColumns));
    }

    public function getPermissionByTier($tierId)
    {
    	return TierLevel::where('user_level', $tierId)->get();	
    }

    public function getFirstLevelCategories()
    {
    	return TierLevel::where('user_level', 1)->get();
    }

    public function getSecondLevelCategories()
    {
    	return TierLevel::where('user_level', 2)->get();
    }

    public function updateTierPermissions($input = array())
    {
    	$tier = $input['tierLevel'];

		$values = explode(',', $input['values']);

		if(count($values) < 1)
		{
			return true;
		}

    	TierLevel::where('user_level', $tier)->delete();
    	
		$insertData = [];

		foreach($values as $value)
		{
			$insertData[] = [
				'user_level' 	=> $tier,
				'category_id' 	=> $value
			];
		}

		if(count($insertData))
		{
			return TierLevel::insert($insertData);
		}

		return true;
    }
}