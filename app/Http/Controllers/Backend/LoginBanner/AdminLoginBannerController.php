<?php

namespace App\Http\Controllers\Backend\LoginBanner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\LoginBanner\EloquentLoginBannerRepository;
use Html;

/**
 * Class AdminLoginBannerController
 */
class AdminLoginBannerController extends Controller
{
	/**
	 * Login Banner Repository
	 * 
	 * @var object
	 */
	public $repository;

    /**
     * Create Success Message
     * 
     * @var string
     */
    protected $createSuccessMessage = "Login Banner Created Successfully!";

    /**
     * Edit Success Message
     * 
     * @var string
     */
    protected $editSuccessMessage = "Login Banner Edited Successfully!";

    /**
     * Delete Success Message
     * 
     * @var string
     */
    protected $deleteSuccessMessage = "Login Banner Deleted Successfully";

	/**
	 * __construct
	 * 
	 */
	public function __construct()
	{
		$this->repository = new EloquentLoginBannerRepository;
	}

    /**
     * Login Banner Listing 
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->repository->setAdmin(true)->getModuleView('listView'))->with([
            'repository' => $this->repository
        ]);
    }

    /**
     * Login Banner View
     * 
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository' => $this->repository
        ]);
    }

    /**
     * Login Banner View
     * 
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $input = $request->all();

        if($request->file('image'))
        {
            $imageName  = rand(11111, 99999) . '_login-banner.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(base_path() . '/public/uploads/login-banners/', $imageName);
            $input = array_merge($input, ['image' => $imageName]);
        }

        $this->repository->create($input);

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * Login Banner View
     * 
     * @return \Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $event = $this->repository->findOrThrowException($id);

        return view($this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'          => $event,
            'repository'    => $this->repository
        ]);
    }

    /**
     * Login Banner Update
     * 
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        if($request->file('image'))
        {
            $imageName  = rand(11111, 99999) . '_login-banner.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(base_path() . '/public/uploads/login-banners/', $imageName);
            $input = array_merge($input, ['image' => $imageName]);
        }

        $status = $this->repository->update($id, $input);
        
        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * Login Banner Update
     * 
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        $status = $this->repository->destroy($id);
        
        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->deleteSuccessMessage);
    }

  	/**
     * Get Table Data
     *
     * @return json|mixed
     */
    public function getTableData()
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['title', 'sort'])
            ->escapeColumns(['sub_title', 'sort'])
            ->escapeColumns(['contact_number', 'sort'])
            ->escapeColumns(['email_id', 'sort'])
            ->addColumn('image', function ($item) 
            {
                if(file_exists(public_path('uploads/login-banners/'.$item->image)))
                {
                    return  Html::image('/uploads/login-banners/'.$item->image, 'Image', ['width' => 60, 'height' => 60]);    
                }

                return '';
            })
            ->addColumn('actions', function ($event) {
                return $event->admin_action_buttons;
            })
            ->make(true);
    }
}
