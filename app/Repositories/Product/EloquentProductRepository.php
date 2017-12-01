<?php namespace App\Repositories\Product;

use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Models\Access\User\User;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\Cart\Cart;

class EloquentProductRepository extends DbRepository
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
	public $moduleTitle = 'Product';

	/**
	 * Table Headers
	 *
	 * @var array
	 */
	public $tableHeaders = [
		'title' 		=> 'Title',
		'category' 		=> 'Category',
		'price' 		=> 'Price',
		'qty' 			=> 'Qty',
		'image' 		=> 'Image',
		'image1' 		=> 'Image 1',
		'image2' 		=> 'Image 2',
		'image3' 		=> 'Image 3',
		'actions' 		=> 'Actions'
	];

	/**
	 * Table Columns
	 *
	 * @var array
	 */
	public $tableColumns = [
		'title' => [
			'data' 			=> 'title',
			'name' 			=> 'title',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'category' => [
			'data' 			=> 'category',
			'name' 			=> 'category',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'price' => [
			'data' 			=> 'price',
			'name' 			=> 'price',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'qty' => [
			'data' 			=> 'qty',
			'name' 			=> 'qty',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'image' => [
			'data' 			=> 'image',
			'name' 			=> 'image',
			'searchable' 	=> false, 
			'sortable'		=> false
		],
		'image1' => [
			'data' 			=> 'image1',
			'name' 			=> 'image1',
			'searchable' 	=> false, 
			'sortable'		=> false
		],
		'image2' => [
			'data' 			=> 'image2',
			'name' 			=> 'image2',
			'searchable' 	=> false, 
			'sortable'		=> false
		],
		'image3' => [
			'data' 			=> 'image3',
			'name' 			=> 'image3',
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
		'listRoute' 	=> 'products.index',
		'createRoute' 	=> 'products.create',
		'storeRoute' 	=> 'products.store',
		'editRoute' 	=> 'products.edit',
		'updateRoute' 	=> 'products.update',
		'deleteRoute' 	=> 'products.destroy',
		'dataRoute' 	=> 'product.get-list-data'
	];

	/**
	 * Module Views
	 * 
	 * @var array
	 */
	public $moduleViews = [
		'listView' 		=> 'product.index',
		'createView' 	=> 'product.create',
		'editView' 		=> 'product.edit',
		'deleteView' 	=> 'product.destroy',
	];

	/**
	 * Construct
	 *
	 */
	public function __construct()
	{
		$this->model 			= new Product;
		$this->categoryModel 	= new Category;
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
    public function getAll($orderBy = 'id', $sort = 'asc')
    {
    	if(isset($orderBy) && $sort)
    	{
    		return $this->model->orderBy($orderBy, $sort)->get();	
    	}

    	return $this->model->all();
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
			$this->model->getTable().'.price',
			$this->model->getTable().'.qty',
			$this->model->getTable().'.image',
			$this->model->getTable().'.image1',
			$this->model->getTable().'.image2',
			$this->model->getTable().'.image3',
			$this->categoryModel->getTable().'.title as category',

		];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
    	return  $this->model->select($this->getTableFields())
    				->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.id', '=', $this->model->getTable().'.category_id')
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

    /**
     * Get User Cart
     * 
     * @param int $userId
     * @return bool
     */
    public function getUserCart($userId = null)
    {
    	if($userId)
    	{
    		return Cart::where('user_id', $userId)->with('product')->orderBy('product_id')->get();
    	}

    	return false;
    }

    public function addToCart($userId = null, $productId = null, $qty = 1)
    {
    	if($userId && $productId)
    	{
    		// Delete Old Values
    		Cart::where(['product_id' => $productId, 'user_id' => $userId])->delete();

    		// Added to Cart
    		return Cart::create([
    			'user_id' 		=> $userId,
    			'product_id' 	=> $productId,
    			'qty'			=> $qty
    		]);
    	}

    	return false;
    }

    public function removeProductFromCart($userId = null, $productId = null)
    {
    	if($userId && $productId)
    	{
    		// Delete Old Values
    		return Cart::where(['product_id' => $productId, 'user_id' => $userId])->delete();
    	}

    	return false;
    }
}