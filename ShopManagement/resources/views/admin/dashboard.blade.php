<head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    @if(session('message'))
        <p class="alert alert-success d-inline-block m-4 absolute top-5">{{session('message')}}</p>
    @endif
    <div class="buttons flex">
        <div class="products">
            <a href="{{route('productsPage')}}"><button class='btn btn-primary m-3 text-white'>Products</button></a>
        </div>
        <div class="approval">
            <a href="{{route('approvalPage')}}"><button class='btn btn-primary m-3 text-white'>Approvals</button></a>
        </div> 
        <div class="users ml-auto">
            <a href="{{route('usersPage')}}"><button class='btn btn-primary m-3 text-white'>Users</button></a>
        </div> 
        <div class="block">
            <a href="{{route('blockedPage')}}"><button class='btn btn-primary m-3 text-white'>Blocked List</button></a>
        </div> 
    </div>
    <h1 class='text-white text-center text-3xl m-3'>Shop Table</h1>
    <table class="table table-dark table-striped table-hover table-bordered w-4/5 m-auto text-center text-white">
    <tr>
        <th>#</th>
        <th>Owner Name</th>
        <th>Shop Name</th>
        <th>Shop Contact</th>
        <th>Shop Email</th>
        <th>Owner Email</th>
        <th>Action</th>
    </tr>

        @foreach($shops as $shop)
    <tr>
        <td>{{($shops->currentPage()-1)*$shops->perPage()+$loop->index+1}}</td>
        <td>{{$shop->owner_name}}</td>
        <td>{{$shop->shop_name}}</td>
        <td>{{$shop->shop_contact}}</td>
        <td>{{$shop->shop_email}}</td>
        <td>{{$shop->owner_email}}</td>  
        <td>
        <a href="{{route('deleteShop',$shop->id)}}" class='btn btn-danger'>Delete Shop</a>
        </td>
        </tr>
        @endforeach
    </table>
    <div class='p-3'>
        {{$shops->links()}}
    </div>
</x-app-layout>
<script>
     const resultbtn=document.querySelector('.alert');
        setTimeout(() => {
            resultbtn.parentNode.removeChild(resultbtn);
        }, 2000);
</script>