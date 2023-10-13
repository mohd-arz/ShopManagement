<head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>
    @if(session('message'))
    <p class="alert alert-success d-inline-block m-4 absolute top-5">{{session('message')}}</p>
    @endif
    <select name="filter_category" id="filter_category" class='text-white bg-gray-800 text-center rounded-md  hover:border-gray-500 leading-tight focus:outline-none focus:shadow-outline m-3'>
        <option value='all'>Sort by Category</option>
        <option value="Electronics">Electronics</option>
        <option value="Fruits">Fruits</option>
        <option value="Furnitures">Furnitures</option>
    </select>
    <select name="filter" id="filter" class='text-white bg-gray-800 text-center rounded-md  hover:border-gray-500 leading-tight focus:outline-none focus:shadow-outline m-3'>
        <option value='all'>Sort by Shop</option>
        @foreach($shops as $shop)
        <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
        @endforeach
    </select>
    <select name="sort_by_price" id="sort_by_price" class='text-white bg-gray-800 text-center rounded-md  hover:border-gray-500 leading-tight focus:outline-none focus:shadow-outline m-3'>
        <option value='all'>Sort by Price</option>
        <option value="higher">Sort by Higher</option>
        <option value="lower">Sort by Lower</option>
    </select>
    <h1 class='text-white text-center text-3xl mb-3'>Products</h1>
    <div class="products-container">
        @include('products',compact('products'))
    </div>
</x-app-layout>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script>
    jQuery('document').ready(function(){
    let shopId;
      jQuery('#filter').change(function(){
            shopId=jQuery(this).val();
            jQuery.ajax({
                url:'/filter',
                type:'post',
                data:'filter='+shopId+'&_token={{csrf_token()}}',
                success:function(response){
                // console.log(response);
                jQuery('.products-container').html(response);
                },
            })
        })
        jQuery('#filter_category').change(function(){
            let filter=jQuery(this).val();
            jQuery.ajax({
                url:'/filter_category',
                type:'post',
                data:'filter='+filter+'&_token={{csrf_token()}}',
                success:function(response){
                // console.log(response);
                jQuery('.products-container').html(response);
                },
            })
        })
        jQuery('#sort_by_price').change(function(){
            let value=jQuery(this).val();
            if(value=='higher'){
                 jQuery.ajax({
                url:'/sort_by_higher',
                type:'post',
                data:'shopId='+shopId+'&_token={{csrf_token()}}',
                success:function(response){
                // console.log(response);
                jQuery('.products-container').html(response);
                },
            })

            }
            else{
                jQuery.ajax({
                    url:'/sort_by_lower',
                    type:'post',
                    data:'filter='+value+'&shopId='+shopId+'&_token={{csrf_token()}}',
                    success:function(response){
                    // console.log(response);
                    jQuery('.products-container').html(response);
                    },
                })
            }
           
        })
        
    })
    const resultbtn=document.querySelector('.alert');
        setTimeout(() => {
            resultbtn.parentNode.removeChild(resultbtn);
        }, 2000);
</script>
