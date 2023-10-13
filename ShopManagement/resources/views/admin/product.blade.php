<head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <h1 class='text-white text-center text-3xl mt-3'>Product Table</h1>
    <table class="table table-dark table-striped table-hover table-bordered w-4/5 m-auto text-center text-white mt-2">
    <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Shop Name</th>
        <th>Shop Contact</th>
        <th>Shop Email</th>
        <th>Category</th>
        <th>Price</th>
        <th>Visiblity</th>
        <th>Action</th>
    </tr>

        @foreach($products as $product)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->shop_name}}</td>
        <td>{{$product->shop_contact}}</td>
        <td>{{$product->shop_email}}</td>
        <td>{{$product->category}}</td>   
        <td> 
            {{$product->price}}
        </td>
        <td>{{$product->visibility}}</td>
        <td>
            <a href="{{route('editProductPage',$product->id)}}" class="btn btn-primary">Edit</a>
            <a href="{{route('deleteProduct',$product->id)}}" class='btn btn-danger'>Delete</a>
        </td>
        </tr>
        @endforeach
    </table>
    <div class='p-3'>
    {{$products->links()}}
    </div>
</x-app-layout>
