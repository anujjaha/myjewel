<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Transformers\CategoryTransformer;
use App\Http\Controllers\Api\BaseApiController;
use App\Repositories\Category\EloquentCategoryRepository;
use App\Repositories\Banner\EloquentBannerRepository;

class APICategoryController extends BaseApiController 
{   
    /**
     * Repository
     * 
     * @var Object
     */
    protected $repository;

    /**
     * __construct
     * 
     * @param EventTransformer $eventTransformer
     */
    public function __construct()
    {
        parent::__construct();

        $this->repository           = new EloquentCategoryRepository;
        $this->categoryTransformer  = new CategoryTransformer;
    }

    /**
     * List of All Events
     * 
     * @param Request $request
     * @return json
     */
    public function index(Request $request) 
    {
        $userInfo   = $this->getApiUserInfo();
        $categories = $this->repository->getAll('title');

        if($categories && count($categories))
        {
            $categoryData     = $this->categoryTransformer->categoryData($categories);

            return $this->ApiSuccessResponse($categoryData);
        }

        $error = [
            'reason' => 'Unable to find Category!'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'No Category Found !');
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
            $responseData = $this->eventTransformer->createEvent($model);

            return $this->successResponse($responseData, 'Event is Created Successfully');
        }

        $error = [
            'reason' => 'Invalid Inputs'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'Something went wrong !');
    }

    /**
     * Edit
     * 
     * @param Request $request
     * @return string
     */
    public function edit(Request $request)
    {
        $eventId    = (int) $request->event_id;
        $model      = $this->repository->update($eventId, $request->all());

        if($model)
        {
            $eventData      = $this->repository->getById($eventId);
            $responseData   = $this->eventTransformer->transform($eventData);

            return $this->successResponse($responseData, 'Event is Edited Successfully');
        }

        $error = [
            'reason' => 'Invalid Inputs'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'Something went wrong !');
    }

    /**
     * Delete
     * 
     * @param Request $request
     * @return string
     */
    public function delete(Request $request)
    {
        $eventId = (int) $request->event_id;

        if($eventId)
        {
            $status = $this->repository->destroy($eventId);

            if($status)
            {
                $responseData = [
                    'success' => 'Event Deleted'
                ];

                return $this->successResponse($responseData, 'Event is Deleted Successfully');
            }
        }

        $error = [
            'reason' => 'Invalid Inputs'
        ];

        return $this->setStatusCode(404)->failureResponse($error, 'Something went wrong !');
    }

    public function productsByCategory(Request $request)
    {
        if($request->get('category_id'))
        {
            $categories = $this->repository->getById($request->get('category_id'));

            if($categories && count($categories))
            {
                $categoryData     = $this->categoryTransformer->singleCategoryData($categories);

                return $this->ApiSuccessResponse($categoryData);
            }

            $error = [
                'reason' => 'Unable to find Category!'
            ];

            return $this->setStatusCode(400)->failureResponse($error, 'No Category Found !');
        }

        return $this->respondInternalError('Invalid Category Id');
    }

    public function featured(Request $request)
    {
        $repository = new EloquentBannerRepository;
        $banners    = $repository->getAll();
        $bannerData = [];

        if($banners && count($banners))
        {
            $bannerData = $this->categoryTransformer->featureBanners($banners);
        }

        
        $featureData = $this->categoryTransformer->featuredCategoryData($bannerData);

        return $this->ApiSuccessResponse($featureData);
    }
}
