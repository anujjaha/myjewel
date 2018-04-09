<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Transformers\SettingsTransformer;
use App\Http\Controllers\Api\BaseApiController;
use App\Repositories\Settings\EloquentSettingsRepository;

class APISettingsController extends BaseApiController
{
    /**
     * Settings Transformer
     *
     * @var Object
     */
    protected $settingsTransformer;

    /**
     * Repository
     *
     * @var Object
     */
    protected $repository;

    /**
     * PrimaryKey
     *
     * @var string
     */
    protected $primaryKey = 'settingsId';

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository                       = new EloquentSettingsRepository();
        $this->settingsTransformer = new SettingsTransformer();
    }

    /**
     * List of All Settings
     *
     * @param Request $request
     * @return json
     */
    public function index(Request $request)
    {
        $paginate   = $request->get('paginate') ? $request->get('paginate') : false;
        $orderBy    = $request->get('orderBy') ? $request->get('orderBy') : 'id';
        $order      = $request->get('order') ? $request->get('order') : 'ASC';
        $items      = $paginate ? $this->repository->model->orderBy($orderBy, $order)->paginate($paginate)->items() : $this->repository->getAll($orderBy, $order);

        if(isset($items) && count($items))
        {
            $itemsOutput = $this->settingsTransformer->transformCollection($items);

            return $this->successResponse($itemsOutput);
        }

        return $this->setStatusCode(400)->failureResponse([
            'message' => 'Unable to find Settings!'
            ], 'No Settings Found !');
    }

    /**
     * Create
     *
     * @param Request $request
     * @return string
     */
    public function create(Request $request)
    {
        $model = $this->repository->create($request->all());

        if($model)
        {
            $responseData = $this->settingsTransformer->transform($model);

            return $this->successResponse($responseData, 'Settings is Created Successfully');
        }

        return $this->setStatusCode(400)->failureResponse([
            'reason' => 'Invalid Inputs'
            ], 'Something went wrong !');
    }

    /**
     * View
     *
     * @param Request $request
     * @return string
     */
    public function show(Request $request)
    {
        $itemId = (int) hasher()->decode($request->get($this->primaryKey));

        if($itemId)
        {
            $itemData = $this->repository->getById($itemId);

            if($itemData)
            {
                $responseData = $this->settingsTransformer->transform($itemData);

                return $this->successResponse($responseData, 'View Item');
            }
        }

        return $this->setStatusCode(400)->failureResponse([
            'reason' => 'Invalid Inputs or Item not exists !'
            ], 'Something went wrong !');
    }

    /**
     * Edit
     *
     * @param Request $request
     * @return string
     */
    public function edit(Request $request)
    {
        $itemId = (int) hasher()->decode($request->get($this->primaryKey));

        if($itemId)
        {
            $status = $this->repository->update($itemId, $request->all());

            if($status)
            {
                $itemData       = $this->repository->getById($itemId);
                $responseData   = $this->settingsTransformer->transform($itemData);

                return $this->successResponse($responseData, 'Settings is Edited Successfully');
            }
        }

        return $this->setStatusCode(400)->failureResponse([
            'reason' => 'Invalid Inputs'
        ], 'Something went wrong !');
    }

    /**
     * Delete
     *
     * @param Request $request
     * @return string
     */
    public function delete(Request $request)
    {
        $itemId = (int) hasher()->decode($request->get($this->primaryKey));

        if($itemId)
        {
            $status = $this->repository->destroy($itemId);

            if($status)
            {
                return $this->successResponse([
                    'success' => 'Settings Deleted'
                ], 'Settings is Deleted Successfully');
            }
        }

        return $this->setStatusCode(404)->failureResponse([
            'reason' => 'Invalid Inputs'
        ], 'Something went wrong !');
    }

    /**
     * Get Privacy Policy
     * 
     * @param Request $request
     * @return json
     */
    public function getPrivacyPolicy(Request $request)
    {
        $key        = 'privacy-policy';
        $response   = access()->getSetting($key);

        if(isset($response) && count($response))
        {
            $itemsOutput = $this->settingsTransformer->getSetting($key, $response);

            return $this->ApiSuccessResponse($itemsOutput);
        }

        return $this->setStatusCode(400)->failureResponse([
            'message' => 'Unable to find Privacy Policy!'
        ], 'No Settings Found !');
    }

     /**
     * Get Terms & Conditions
     * 
     * @param Request $request
     * @return json
     */
    public function getTermsConditions(Request $request)
    {
        $key        = 'legal-terms-page';
        $response   = access()->getBlock($key);

        if(isset($response) && count($response))
        {
            $itemsOutput = $this->settingsTransformer->getSetting($key, $response);

            return $this->ApiSuccessResponse($itemsOutput);
        }

        return $this->setStatusCode(400)->failureResponse([
            'message' => 'Unable to find Privacy Policy!'
        ], 'No Settings Found !');
    }
}