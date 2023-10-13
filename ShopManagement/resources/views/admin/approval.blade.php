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

    <h1 class='text-white text-center text-3xl mt-3'>Approvals</h1>

    <table class="table table-dark table-striped table-hover table-bordered w-4/5 m-auto text-center tasks-table text-white mt-3">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    @foreach($approvals as $approval)
    <tr>
        <td>{{($approvals->currentPage()-1)*$approvals->perPage()+$loop->index+1}}</td>
        <td>{{$approval->name}}</td>
        <td>{{$approval->email}}</td>
        <td>
            <div>
            <a href="{{route('approved',$approval->id)}}" class="btn btn-success text-white">Approve</a>
            <a href="{{route('rejectedApproval',$approval->id)}}" class="btn btn-danger text-white">Reject</a>
            </div>
        </td>
    </tr>
    @endforeach
</table>
<div class='p-3'>
    {{$approvals->links()}}
</div>
</x-app-layout>
<script>
const resultbtn=document.querySelector('.alert');
        setTimeout(() => {
            resultbtn.parentNode.removeChild(resultbtn);
        }, 2000);
</script>