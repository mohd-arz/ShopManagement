<table class="table table-dark table-striped table-hover table-bordered w-4/5 m-auto text-center text-white">
    <tr>
        <th>#</th>
        <th>Shop Name</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Shop Email</th>
        <th>Shop Contact</th>
    </tr>
        @foreach($products as $product)
    <tr>
       <td>{{($products->currentPage()-1)*$products->perPage()+$loop->index+1}}</td>
       <td>{{$product->shop_name}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->category}}</td>   
        <td>{{$product->shop_email}}</td>
        <td>{{$product->shop_contact}}</td>
    </tr>
        @endforeach
</table>
<div class='p-3'>
    {{$products -> links()}}
</div>