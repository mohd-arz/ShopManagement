<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <table class="table table-dark table-striped table-hover table-bordered w-4/5 m-auto text-center tasks-table text-white">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    @foreach($approvals as $approval)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$approval->name}}</td>
        <td>{{$approval->email}}</td>
        <td>
            <div>
            <a href="{{route('approved',$approval->id)}}" class="btn btn-primary text-white">Approve ?</a>
            </div>
        </td>
    </tr>
    @endforeach
</table>
</x-app-layout>
