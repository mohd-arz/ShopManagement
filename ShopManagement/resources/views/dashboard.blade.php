<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>
    @if(session('message'))
    <p class="alert alert-success d-inline-block m-4 absolute top-5 text-white">{{session('message')}}</p>
    @endif
    <select name="filter" id="filter">
        <option value='all'>--Filter--</option>
        @foreach($shops as $shop)
        <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
        @endforeach
    </select>
    <div class="products-container">
        @include('products',compact('products'))
    </div>
</x-app-layout>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script>
    jQuery('document').ready(function(){
      jQuery('#filter').change(function(){
            let filter=jQuery(this).val();
            jQuery.ajax({
                url:'/filter',
                type:'post',
                data:'filter='+filter+'&_token={{csrf_token()}}',
                success:function(response){
                console.log(response);
                jQuery('.products-container').html(response);
                },
            })
        })
    })
</script>
