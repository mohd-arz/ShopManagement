<table class="table table-dark table-striped table-hover table-bordered w-4/5 m-auto text-center text-white">
    <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Shop Name</th>
        <th>Shop Contact</th>
        <th>Shop Email</th>
        <th>Category</th>
        <th>Price</th>
    </tr>
        @foreach($products as $product)
    <tr>
       <td>{{($products->currentPage()-1)*$products->perPage()+$loop->index+1}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->shop_name}}</td>
        <td>{{$product->shop_contact}}</td>
        <td>{{$product->shop_email}}</td>
        <td>{{$product->category}}</td>   
        <td>{{$product->price}}</td>
    </tr>
        @endforeach
</table>
<div>
    {{$products -> links()}}
</div>