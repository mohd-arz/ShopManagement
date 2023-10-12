<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shop Owner Dashboard') }}
        </h2>
    </x-slot>
    @if(session('message'))
    <p class="alert alert-success d-inline-block m-4 absolute top-5 text-white">{{session('message')}}</p>
    @endif
    <a href="{{route('registerShopPage')}}"><button class='btn btn-primary m-3 text-white'>Register as a Shop</button></a>

    <a href="{{route('addProductPage')}}" class="btn btn-primary text-white">Add Product</a>
    <table class="table table-dark table-striped table-hover table-bordered w-4/5 m-auto text-center text-white">
   
           
</x-app-layout>
