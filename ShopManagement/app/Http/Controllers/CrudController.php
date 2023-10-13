<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Shop;
use App\Models\Approval;
use App\Models\Product;
use App\Models\BlockList;

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
   
    //Approval--

    //Sending Approval To Admin--
    public function sentApproval(Request $request){
        Approval::create([
            'name'=> session('name'),
            'email'=> session('email'),
            'password'=>session('password'),
        ]);

        return redirect()->route('welcome')->with('message','Approved Send Successfully');
    }

    //Approval Page  Admin--
    public function approvalPage(){
        $approvals=Approval::latest()->paginate(10);
        return view ('admin.approval',compact('approvals'));
    }

    //When Approved by Admin--
    public function approved($id){
        $approval=Approval::find($id);
       
        $user = User::create([
            'name' => $approval->name,
            'email' => $approval->email,
            'password' => $approval->password,
            'user_type'=>'shopowner',
        ]);
        $approval->delete();
        return redirect()->route('approvalPage')->with('message','Approved Successfully');
    }
    //When Approved Reject by Admin --
    public function rejectedApproval($id){
        $approval=Approval::find($id);
        $approval->delete();
        return redirect()->route('approvalPage')->with('message','Approved Rejected Successfully');
    }

    /****/

    //Shop Registration--

    //Register Shop Page --
    public function registerShopPage(){
        return view('shop.create');
    }

    //When Shop Registered --
    public function createShop(Request $request){
        request()->validate([
            'name'=>'required',
            'contactno'=>'required',
            'email'=>'required',
        ]);

        Shop::create([
            'shop_name'=>$request->name,
            'shop_contact'=>$request->contactno,
            'shop_email'=>$request->email,
            'user_id'=>Auth::id()
        ]);
        return redirect()->route('home')->with('message','Added Successfully');
    }

    /****/

    //Shop --

    //Adding Products Page --
    public function addProductPage(){
        return view('shop.addproduct');
    }

    //Add Products --
    public function addProduct(){
        request()->validate([
            'name'=>'required',
            'category'=>'required',
            'price'=>'required',
            'visibility'=>'required'
        ]);

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


    //Edit Product Page --
    public function editProductPage($id){
        $product=Product::find($id);
        return view('shop.editproduct',compact('product'));
    }

    //Edit Product --
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

    //Delete Product --
    public function deleteProduct($id){
        $product=Product::find($id);
        $product->delete();
        return redirect()->route('home')->with('message','Product Deleted Successfully');
    }

    /****/


    //Admin --

    //Products Page for Admin
    public function productsPage(){
        $products=Product::leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->latest()->paginate(10);
        return view('admin.product',compact('products'));
    }

    //Delete shop for Admin
    public function deleteShop($id){
        $shop=Shop::find($id);
        $products = Product::where('shop_id',$shop->id)->get();
        foreach($products as $product){
            $product->delete();
        }
        $shop->delete();
        return redirect()->route('home')->with('message','Shop Deleted Successfully');
    }

    //User Page for Admin
    public function usersPage(){
        $users=User::whereNot('user_type','admin')->latest()->paginate(10);
        return view('admin.users',compact('users'));
    }

    //Delete user for Admin 
    // public function deleteUser($id){
    //     $user=User::find($id);
    //     $user->delete();
    //     return redirect()->route('home')->with('message','User Deleted Successfully');
    // }
    
    //Block user for Admin 
    public function blockUser($id){
        $user=User::find($id);
        BlockList::create([
            'name'=>$user->name,
            'email'=>$user->email,
        ]);
        $user->delete();
        return redirect()->route('home')->with('message','User Blocked Successfully');
    }

    public function blockedPage(){
        $blocks = BlockList::latest()->paginate(20);
        return view('admin.blocklist',compact('blocks'));
    }
    public function removeBlock($id){
        $block = BlockList::find($id);
        $block->delete();
        return redirect()->route('home')->with('message','Block removed Successfully');
    }
    /****/

    //Customer --

    //Filtering at Customer's Page --
    public function filtering(Request $request){
        $shopId = $request->post('filter');
        if($shopId=='all'){
        $products=Product::leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->latest()->paginate(20);
        return view('products',compact('products'));
        }
        $products=Product::where('shop_id',$shopId)->orWhere('visibility', 'public')->leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->latest()->paginate(20);
        return view('products',compact('products'));
    }
    public function filterCategory(Request $request){
        $category = $request->post('filter');
        if($category=='all'){
            $products=Product::leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->latest()->paginate(20);
            return view('products',compact('products'));
        }else{
            $products=Product::where('category',$category)->leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->latest()->paginate(20);
            return view('products',compact('products'));
        }
    }
    public function sortByHigher(Request $request){
        $shopId = $request->post('shopId');
        if($shopId=='undefined' || $shopId=='all'){
            $products=Product::leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->orderByRaw('CAST(price AS DECIMAL(10,2)) DESC')->latest()->paginate(20);
        }else{
            $products=Product::where('shop_id',$shopId)->orWhere('visibility','public')->leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->orderByRaw('CAST(price AS DECIMAL(10,2)) DESC')->latest()->paginate(20);
        }
        return view('products',compact('products'));
    }
    public function sortByLower(Request $request){
        $value = $request->post('filter');
        $shopId = $request->post('shopId');
        
        if($shopId !='all' &&  $shopId !='undefined'){
            $products=Product::where('shop_id',$shopId)->orWhere('visibility','public')->leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->orderByRaw('CAST(price AS DECIMAL(10,2)) ASC')->latest()->paginate(20);
            return view('products',compact('products'));
        }else if($value=='all' || $shopId='all'|| $shopId=='undefined' ){
            $products=Product::leftJoin('shops','shops.id','=','products.shop_id')->select('products.*','shops.shop_name as shop_name' ,'shops.shop_email as shop_email','shops.shop_contact as shop_contact')->orderByRaw('CAST(price AS DECIMAL(10,2)) ASC')->latest()->paginate(20);
            return view('products',compact('products'));
        }
        // return $shopId;
        return $value;
    }
    /****/

}
