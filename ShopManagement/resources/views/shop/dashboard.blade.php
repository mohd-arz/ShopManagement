<head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shop Owner Dashboard') }}
        </h2>
    </x-slot>
    
    @if(session('message'))
    <p class="alert alert-success d-inline-block m-4 absolute top-5">{{session('message')}}</p>
    @endif
    @if($shop == null)
    <a href="{{route('registerShopPage')}}"><button class='btn btn-primary m-3 text-white'>Register as a Shop</button></a>
    @else
    <a href="{{route('addProductPage')}}" class="btn btn-primary text-white m-3">Add Product</a>
    <table class="table table-dark table-striped table-hover table-bordered w-4/5 m-auto text-center text-white">
    <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Visiblity</th>
        <th>Action</th>
    </tr>

        @foreach($products as $product)
    <tr>
        <td>{{($products->currentPage()-1)*$products->perPage()+$loop->index+1}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->category}}</td>   
        <td> 
            {{$product->price}}
        </td>
        <td>{{$product->visibility}}</td>
        <td>
            <a href="{{route('editProductPage',$product->id)}}" class="btn btn-primary w-1/4">Edit</a>
            <a href="{{route('deleteProduct',$product->id)}}" class='btn btn-danger w-1/3'>Delete</a>
        </td>
        </tr>
        
        @endforeach
    </table>
    <div>
        {{$products->links()}}
    </div>
    @endif
</x-app-layout>
<script>
     const resultbtn=document.querySelector('.alert');
        setTimeout(() => {
            resultbtn.parentNode.removeChild(resultbtn);
        }, 2000);
</script>