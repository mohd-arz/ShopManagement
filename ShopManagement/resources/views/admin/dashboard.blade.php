<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    @if(session('message'))
    <p class="alert alert-success d-inline-block m-4 absolute top-5 text-white">{{session('message')}}</p>
    @endif
    <div class="approval">
        <a href="{{route('approvalPage')}}"><button class='btn btn-primary m-3 text-white'>Approvals</button></a>
    </div> 
    <div class="products">
         <a href="{{route('productsPage')}}"><button class='btn btn-primary m-3 text-white'>Products</button></a>
    </div>
    <table class="table table-dark table-striped table-hover table-bordered w-4/5 m-auto text-center text-white">
    <tr>
        <th>#</th>
        <th>Shop Name</th>
        <th>Owner Name</th>
        <th>Shop Contact</th>
        <th>Shop Email</th>
        <th>Owner Email</th>
        <th>Action</th>
    </tr>

        @foreach($shops as $shop)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$shop->owner_name}}</td>
        <td>{{$shop->shop_name}}</td>
        <td>{{$shop->shop_contact}}</td>
        <td>{{$shop->shop_email}}</td>
        <td>{{$shop->owner_email}}</td>
        <td>{{$shop->category}}</td>  
        <td>
        <a href="{{route('deleteShop',$shop->id)}}" class='btn btn-danger w-1/3'>Delete Shop</a>
        </td>
        </tr>
        @endforeach
    </table>
</x-app-layout>
