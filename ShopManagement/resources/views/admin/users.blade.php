<head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <h1 class='text-white text-center text-3xl mt-3'>User Table</h1>
    <table class="table table-dark table-striped table-hover table-bordered w-4/5 m-auto text-center text-white mt-2">
    <tr>
        <th>#</th>
        <th>User</th>
        <th>Email</th>
        <th>User Type</th>
        <th>Action</th>
    </tr>
        @foreach($users as $user)
    <tr>
        <td>{{($users->currentPage()-1)*$users->perPage()+$loop->index+1}}</td>  
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->user_type}}</td>
        <td>
            <a href="{{route('blockUser',$user->id)}}" class='btn btn-danger'>Delete and Block User</a>
        </td>
        </tr>
        @endforeach
    </table>
    <div class='p-3'>
    {{$users->links()}}
    </div>
</x-app-layout>
