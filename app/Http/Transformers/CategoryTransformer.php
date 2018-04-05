<?php

namespace App\Http\Transformers;

use App\Http\Transformers;
use URL;

class CategoryTransformer extends Transformer 
{
    /** Transform
     * 
     * @param array $data
     * @return array
     */
    public function transform($data) 
    {
        if(is_array($data))
        {
            $data = (object)$data;
        }
        
        return [
            'eventId'           => (int) $data->id,
            'eventName'         => $data->name,
            'eventTitle'        => $data->title,
            'eventStartDate'    => date('d-m-Y', strtotime($data->start_date)),
            'eventEndDate'      => date('d-m-Y', strtotime($data->end_date))
        ];
    }

    public function categoryData($categories)
    {
        $user               = Auth()->user();
        $wishlistProductIds = $user->cart->pluck('product_id')->toArray();
        $response = [];

        $i = 0;
        foreach($categories as $category)
        {
            $response[$i] = [
                'categoryId'    => (int) $category->id,
                'categoryTitle' => $category->title ? $category->title : '',
                'description'   => $category->description ? $category->description : '',
                'categoryImage' => URL::to('/').'/uploads/category/'.$category->image,
                'productsCount' => count($category->products),
                'wishListCount' => isset($wishlistProductIds) ? count($wishlistProductIds) : 0,
                'products'      => []
            ];

            if(count($category->products))
            {
                foreach($category->products as $product)
                {
                    $response[$i]['products'][] = [
                        'productId'     => (int) $product->id,
                        'isWishList'    => (isset($wishlistProductIds) && count($wishlistProductIds) && in_array($product->id, $wishlistProductIds)) ? 1 : 0,
                        'productTitle'  => $product->title,
                        'productPrice'  => (float) $product->price,
                        'productQty'    => (int) $product->qty,
                        'productImage'  => $product->image ? URL::to('/').'/uploads/product/'.$product->image : '',
                        'productImage1' => $product->image1 ? URL::to('/').'/uploads/product/'.$product->image1 : '',
                        'productImage2' => $product->image2 ? URL::to('/').'/uploads/product/'.$product->image2 : '',
                        'productImage3' => $product->image3 ? URL::to('/').'/uploads/product/'.$product->image3 : '',
                        'productDescription'  => $product->description ? $product->description : ''
                    ];
                }
            }

            $i++;
        }

        return $response;
    }

    public function productData($products)
    {
        $response = [] ;
        $user               = Auth()->user();
        $wishlistProductIds = $user->cart->pluck('product_id')->toArray();

        foreach($products as $product)
        {
            $response[] = [
                'productId'     => (int) $product->id,
                 'isWishList'    => (isset($wishlistProductIds) && count($wishlistProductIds) && in_array($product->id, $wishlistProductIds)) ? 1 : 0,
                'productTitle'  => $product->title,
                'wishListCount' => isset($wishlistProductIds) ? count($wishlistProductIds) : 0,
                'productPrice'  => (float) $product->price,
                'productQty'    => (int) $product->qty,
                'productImage'  => $product->image ? URL::to('/').'/uploads/product/'.$product->image : '',
                'productImage1' => $product->image1 ? URL::to('/').'/uploads/product/'.$product->image1 : '',
                'productImage2' => $product->image2 ? URL::to('/').'/uploads/product/'.$product->image2 : '',
                'productImage3' => $product->image3 ? URL::to('/').'/uploads/product/'.$product->image3 : '',
                'productDescription'  => $product->description ? $product->description : '',
                'categoryId'    => isset($product->category->id) ? (int) $product->category->id : 0,
                'categoryTitle' => isset($product->category->title) ? $product->category->title : '',
                'description'   => isset($product->category->description) ? $product->category->description : '',
                'categoryImage' => isset($product->category->image) ? URL::to('/').'/uploads/category/'.$product->category->image : ''
            ];
        }

        return $response;
    }

    public function singleCategoryData($category)
    {
        $response = [];
        $user               = Auth()->user();
        $wishlistProductIds = $user->cart->pluck('product_id')->toArray();

        $response = [
                'categoryId'    => (int) $category->id,
                'categoryTitle' => $category->title ? $category->title : '',
                'description'   => $category->description ? $category->description : '',
                'categoryImage' => URL::to('/').'/uploads/category/'.$category->image,
                'productsCount' => count($category->products),
                'products'      => []
            ];

            if(count($category->products))
            {
                foreach($category->products as $product)
                {
                    $response['products'][] = [
                        'productId'     => (int) $product->id,
                        'isWishList'    => (isset($wishlistProductIds) && count($wishlistProductIds) && in_array($product->id, $wishlistProductIds)) ? 1 : 0,
                        'productTitle'  => $product->title,
                        'productPrice'  => (float) $product->price,
                        'productQty'    => (int) $product->qty,
                        'productImage'  => $product->image ? URL::to('/').'/uploads/product/'.$product->image : '',
                        'productImage1' => $product->image1 ? URL::to('/').'/uploads/product/'.$product->image1 : '',
                        'productImage2' => $product->image2 ? URL::to('/').'/uploads/product/'.$product->image2 : '',
                        'productImage3' => $product->image3 ? URL::to('/').'/uploads/product/'.$product->image3 : '',
                        'productDescription'  => $product->description ? $product->description : ''
                    ];
                }
            }

        return $response;
    }

    public function cartData($cartData)
    {
        $response = [];

        foreach($cartData as $cart)
        {
            $response[] = [
                'cartQty'       => $cart->qty,
                'productId'     => (int) $cart->product->id,
                'productTitle'  => $cart->product->title,
                'productPrice'  => (float) $cart->product->price,
                'productQty'    => (int) $cart->product->qty,
                'productImage'  => $cart->product->image ? URL::to('/').'/uploads/product/'.$cart->product->image : '',
                'productImage1' => $cart->product->image1 ? URL::to('/').'/uploads/product/'.$cart->product->image1 : '',
                'productImage2' => $cart->product->image2 ? URL::to('/').'/uploads/product/'.$cart->product->image2 : '',
                'productImage3' => $cart->product->image3 ? URL::to('/').'/uploads/product/'.$cart->product->image3 : '',
                'productDescription'  => $cart->product->description ? $cart->product->description : ''
            ];
        }

        return $response;
    }

    public function featuredCategoryData($data)
    {
        $response = [];

        if($data)
        {
            $response['featuredData'] = $data;
        }

        $oldData = [
            'featured'  => [
                'title'     => 'New Arrival',
                'subtitle'  => 'Fall Winter 2017-18 Fashion Show',
                'image'     =>  URL::to('/').'/uploads/category/featured.png'
            ]
        ];

        return array_merge($response, $oldData);
    }

    public function wishListCount()
    {
        $user               = Auth()->user();
        $wishlistProductIds = $user->cart->pluck('product_id')->toArray();        

        $response = [
            'wishListCount' => isset($wishlistProductIds) ? count($wishlistProductIds) : 0
        ];
        
        return $response;
    }

    /**
     * Login Banners
     * 
     * @param object $banners
     * @return array
     */
    public function loginBanners($banners)
    {
        $response = [];

        if($banners)
        {
            foreach($banners as $banner)   
            {
                $response[] = [
                    'loginBannerId' => (int) $banner->id,
                    'title'         => $banner->title,
                    'subTitle'      => isset($banner->sub_title) ? $banner->sub_title : '',
                    'contactNumber' => isset($banner->contact_number) ? $banner->contact_number : '',
                    'emailId'       => isset($banner->email_id) ? $banner->email_id : '',
                    'image'         => isset($banner->image) ? URL::to('/').'/uploads/login-banners/'.$banner->image : URL::to('/').'/uploads/login-banners/default.png',

                ];
            }
        }

        return $response;
    }

    /**
     * Feature Banners
     * 
     * @param object $banners
     * @return array
     */
    public function featureBanners($banners)
    {
        $response = [];

        if($banners)
        {
            foreach($banners as $banner)   
            {
                $response[] = [
                    'featureBannerId' => (int) $banner->id,
                    'title'         => $banner->title,
                    'subTitle'      => isset($banner->sub_title) ? $banner->sub_title : '',
                    'image'         => isset($banner->image) ? URL::to('/').'/uploads/feature-banners/'.$banner->image : URL::to('/').'/uploads/feature-banners/default.png',

                ];
            }
        }

        return $response;
    }
}
