<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Shop;
use App\Models\Approval;
use App\Models\Product;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function registerShopPage(){
        return view('shop.create');
    }

    public function sentApproval(Request $request){
        $id=Auth::id();
        $user=Auth::user();
        Approval::create([
            'shop_name'=> session('name'),
            'shop_contact'=>session('password'),
            'shop_email'=> session('email'),
            'user_id'=>'1'
        ]);
        // return $name;
        // return session('name');
        // return redirect()->route('welcome');
        // return redirect()->route('home')->with('message','Sent Approval Successfully');
    }

    public function approvalPage(){
        $approvals=Approval::all();
        return view ('admin.approval',compact('approvals'));
    }

    public function createShop(Request $request){
          Shop::create([
                'shop_name'=>$request->name,
                'shop_contact'=>$request->contactno,
                'shop_email'=>$request->email,
                'user_id'=>Auth::id()
        ]);
        return redirect()->route('home')->with('message','Added Successfully');

    }

    public function approved($id){
        $approval=Approval::find($id);
        // Shop::create([
        //         'shop_name'=>$approval->shop_name,
        //         'shop_contact'=>$approval->shop_contact,
        //         'shop_email'=>$approval->shop_email,
        //         'user_id'=>$id
        // ]);

        // return $approval->shop_contact;
       
        $user = User::create([
            'name' => $approval->shop_name,
            'email' => $approval->shop_email,
            'password' => $approval->shop_contact,
            'user_type'=>'shopowner',
        ]);

        event(new Registered($user));

        Auth::login($user);
        $approval->delete();

        return redirect(RouteServiceProvider::HOME);
        
        // return redirect()->route('home')->with('message','Approved Successfully');
    }

    public function addProductPage(){
        return view('shop.addproduct');
    }

    public function addProduct(){
        $shopId = Shop::where('user_id',Auth::id())->first();
        Product::create([
            'name'=>request('name'),
            'category'=>request('category'),
            'price'=>request('price'),
            'visibility'=>request('visibility'),
            'shop_id'=>$shopId->id,
        ]);
        return redirect()->route('home')->with('message','Product Added Successfully');
    }
    public function editProductPage($id){
        $product=Product::find($id);
        return view('shop.editproduct',compact('product'));
    }
    public function editProduct($id){
        $product=Product::find($id);
        $product->update([
            'name'=>request('name'),
            'category'=>request('category'),
            'price'=>request('price'),
            'visibility'=>request('visibility'),
        ]);
        return redirect()->route('home')->with('message','Product Edited Successfully');
    }
    public function deleteProduct($id){
        $product=Product::find($id);
        $product->delete();
        return redirect()->route('home')->with('message','Product Deleted Successfully');
    }
    public function productsPage(){
        $products=Product::leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->get();
        return view('admin.product',compact('products'));
    }
    public function deleteShop($id){
        $shop=Shop::find($id);
        $shop->delete();
        return redirect()->route('home')->with('message','Shop Deleted Successfully');
    }
    public function filtering(Request $request){
        $shopId = $request->post('filter');
        // $shop=Shop::find();
        if($shopId=='all'){
        $products=Product::leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->get();
        return view('products',compact('products'));
        }
        $products=Product::where('shop_id',$shopId)->orWhere('visibility', 'public')->leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->get();
        return view('products',compact('products'));
    }
}
