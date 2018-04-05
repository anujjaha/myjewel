<?php namespace App\Repositories\Schedule;

/**
 * Class EloquentScheduleRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\Schedule\Schedule;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentScheduleRepository extends DbRepository
{
    /**
     * Schedule Model
     *
     * @var Object
     */
    public $model;

    /**
     * Schedule Title
     *
     * @var string
     */
    public $moduleTitle = 'Schedule';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'                => 'Id',
        'title'             => 'Title',
        'start_date'        => 'Start Date',
        'end_date'          => 'End Date',
        'address_line_one'  => 'Address Line One',
        'address_line_two'  => 'Address Line Two',
        'city'              => 'City',
        'state'             => 'State',
        'zip'               => 'Zip',
        'actions'           => "Actions"
    ];

    /**
     * Table Columns
     *
     * @var array
     */
    public $tableColumns = [
        'id' =>   [
                'data'          => 'id',
                'name'          => 'id',
                'searchable'    => true,
                'sortable'      => true
            ],
		'title' =>   [
                'data'          => 'title',
                'name'          => 'title',
                'searchable'    => true,
                'sortable'      => true
            ],
		'start_date' =>   [
                'data'          => 'start_date',
                'name'          => 'start_date',
                'searchable'    => true,
                'sortable'      => true
            ],
		'end_date' =>   [
                'data'          => 'end_date',
                'name'          => 'end_date',
                'searchable'    => true,
                'sortable'      => true
            ],
		'address_line_one' =>   [
                'data'          => 'address_line_one',
                'name'          => 'address_line_one',
                'searchable'    => true,
                'sortable'      => true
            ],
		'address_line_two' =>   [
                'data'          => 'address_line_two',
                'name'          => 'address_line_two',
                'searchable'    => true,
                'sortable'      => true
            ],
		'city' =>   [
                'data'          => 'city',
                'name'          => 'city',
                'searchable'    => true,
                'sortable'      => true
            ],
		'state' =>   [
                'data'          => 'state',
                'name'          => 'state',
                'searchable'    => true,
                'sortable'      => true
            ],
		'zip' =>   [
                'data'          => 'zip',
                'name'          => 'zip',
                'searchable'    => true,
                'sortable'      => true
            ],
		'actions' => [
            'data'          => 'actions',
            'name'          => 'actions',
            'searchable'    => false,
            'sortable'      => false
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
        'listRoute'     => 'schedule.index',
        'createRoute'   => 'schedule.create',
        'storeRoute'    => 'schedule.store',
        'editRoute'     => 'schedule.edit',
        'updateRoute'   => 'schedule.update',
        'deleteRoute'   => 'schedule.destroy',
        'dataRoute'     => 'schedule.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'schedule.index',
        'createView'    => 'schedule.create',
        'editView'      => 'schedule.edit',
        'deleteView'    => 'schedule.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new Schedule;
    }

    /**
     * Create Schedule
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
     * Update Schedule
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
     * Destroy Schedule
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
        return $this->model->orderBy($orderBy, $sort)->get();
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
            $this->model->getTable().'.*'
        ];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->select($this->getTableFields())->get();
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

        if(isset($input['start_date']))
        {
            $input['start_date'] = date('Y-m-d H:i:s', strtotime($input['start_date']));
        }
        
        if(isset($input['end_date']))
        {
            $input['end_date'] = date('Y-m-d H:i:s', strtotime($input['end_date']));
        }

        if($isCreate)
        {
            $input = array_merge($input, ['user_id' => access()->user()->id]);
        }

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
}