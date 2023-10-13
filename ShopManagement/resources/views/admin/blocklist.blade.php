<head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <h1 class='text-white text-center text-3xl mt-3'>Block List</h1>

    <table class="table table-dark table-striped table-hover table-bordered w-4/5 m-auto text-center tasks-table text-white mt-3">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    @foreach($blocks as $block)
    <tr>
        <td>{{($blocks->currentPage()-1)*$blocks->perPage()+$loop->index+1}}</td>
        <td>{{$block->name}}</td>
        <td>{{$block->email}}</td>
        <td>
            <a href="{{route('removeBlock',$block->id)}}" class='btn btn-danger'>Remove Block</a>
        </td>
    </tr>
    @endforeach
</table>
<div class='p-3'>
    {{$blocks->links()}}
</div>
</x-app-layout>
