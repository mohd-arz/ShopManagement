<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <table class="table table-dark table-striped table-hover table-bordered w-4/5 m-auto text-center text-white">
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
            <a href="{{route('editProductPage',$product->id)}}" class="btn btn-primary w-1/4">Edit</a>
            <a href="{{route('deleteProduct',$product->id)}}" class='btn btn-danger w-1/3'>Delete</a>
        </td>
        </tr>
        @endforeach
    </table>
</x-app-layout>
