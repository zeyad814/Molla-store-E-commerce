<table class="table table-bordered">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">

    </div>


    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Product category</th>
        <th scope="col">Price</th>
        <th scope="col">Stock</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
        <tr>
            <th scope="row">{{ $product->id }}</th>
            <td>Image</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->category->category_name }}</td>
            <td>{{ $product->final_price }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <div class="table-actions">
                    @if($product->status==1)
                    <a class="updatebrandStatus btn btn-primary" href="javascript:void(0)" id="brand-{{ $product->id }}" brand_id="{{ $product->id }}"  ><i class="fas fa-toggle-on" status="Active" ></i></a>
                    @endif
                    @if($product->status==0)
                    <a class="updatebrandStatus btn btn-primary" href="javascript:void(0)" id="brand-{{ $product->id }}" brand_id="{{ $product->id }}"  ><i class="fas fa-toggle-off" status="Inactive" ></i></a>
                    @endif
                    <a href="" title="edit" class="btn btn-warning" data-color="#265ed7"><i class="ri-edit-box-line"></i></a>


                    <a class="btn btn-danger" href="" onclick="confirmation(event)" title="Delete" ><i class="fas fa-trash" style="color:azure"></i></a>

                </div>
            </td>
          </tr>
        @empty
          <h1>we dont have products has this name</h1>
        @endforelse
    </tbody>
</table>
<div class="col-md-12" id="ajax_search_pagination">
{{ $products->links() }}
</div>
