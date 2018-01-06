<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\EloquentProductRepository;
use App\Repositories\Order\EloquentOrderRepository;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
	/**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.user.dashboard');
    }

    public function showCart(Request $request)
    {
    	$user = access()->user();
    	return view('frontend.jewel.cart')->with('user', $user);
    }

    public function addProductToCart(Request $request)
    {
    	
    	$user 		= access()->user();
    	$productQty = $request->get('productQty') ? $request->get('productQty') : 1;
    	$repository = new EloquentProductRepository;
    	$status 	= $repository->addToCart($user->id, $request->get('productId'), $productQty);

        if($status)
        {
         	return response()->json((object) [
                    'status'    => true
                ], 200);
        }
    	
    	return response()->json((object) [
                    'status'    => false
            ], 200);
    }

    public function removeProductToCart(Request $request)
    {
    	$user 		= access()->user();
    	$repository = new EloquentProductRepository;
    	$status 	= $repository->removeProductFromCart($user->id, $request->get('productId'));

        if($status)
        {
         	return response()->json((object) [
                    'status'    => true
                ], 200);
        }
    	
    	return response()->json((object) [
                    'status'    => false
            ], 200);
    }

    public function createOrder(Request $request)
    {
        $userInfo = Auth()->user();

        if($userInfo->cart)
        {
        	$repository = new EloquentOrderRepository;
            $orderInfo 	= $repository->cartToOrder($userInfo, $userInfo->cart);

            if(isset($orderInfo) && $orderInfo)
            {
                return response()->json((object) [
                    'status'    => true
                ], 200);
            }
        }

        return response()->json((object) [
                    'status'    => false
            ], 200);
    }

    public function timePiece(Request $request)
    {
        $user = access()->user();
        return view('frontend.jewel.page-template')->with('user', $user);
    }
}
