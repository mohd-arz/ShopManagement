<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Shop;


class AuthController extends Controller
{
    public function authFn(){

        if(Auth::id()){
                $usertype = Auth()->user()->user_type; //From Auth -> user table -> user_type column--
                if($usertype=='user'){
                    $shops=Shop::all();
                    $products=Product::leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->latest()->paginate(20);
                    return view('dashboard',compact('products','shops'));
                }else if($usertype=='admin'){
                    $shops=Shop::leftJoin('users','users.id','=','shops.user_id')->select('shops.*','users.name as owner_name' ,'users.email as owner_email')->latest()->paginate(20);
                    $products=Product::leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->latest()->paginate(20);
                    return view('admin.dashboard',compact('shops','products'));
                }
                else if($usertype=='shopowner'){
                    $shop=Shop::where('user_id',Auth::id())->first();
                    if($shop!=null)
                    {
                    $products=Product::where('shop_id',$shop->id)->latest()->paginate(20);
                    return view('shop.dashboard',compact('shop','products'));
                    }
                    return view('shop.dashboard',compact('shop'));
                }else{
                    return redirect()->back();
                }
            }
    }
}
