<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6 style="float: left">All products</h6>
                        <button class="btn btn-sm btn-primary" style="float: right;"data-toggle="modal" data-target="#addProductModel">add new product</button>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th >Name</th>
                                    <th>Details</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td >{{ $product->name }}</td>
                                            <td>{{ $product->details }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-sm btn-primary" wire:click="showProductData({{ $product->id }})">View</button>
                                                <button class="btn btn-sm btn-secondary" wire:click="editProductData({{ $product->id }})">Edit</button>
                                                <button class="btn btn-sm btn-danger"wire:click="deleteConfirmation({{ $product->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="4">
                                                <span>No product found</span>
                                            </th>
                                        </tr>
                                    @endforelse

                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addProductModel" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif
        </div>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  class="model-body" wire:submit.prevent="storeProductData">

                    {{-- product name --}}
                    <div class="form-group row">
                        <label for="name"class="col-3">Product name</label>
                        <div class="col-9">
                            <input type="text" id="name" class="form-control" wire:model="name">
                            @error('name')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- product details --}}
                    <div class="form-group row">
                        <label for="details"class="col-3">Product Details</label>
                        <div class="col-9">
                            <input type="text" id="details" class="form-control" wire:model="details">
                            @error('details')
                                <span class="text-danger" style="font-size:11.5px;" >{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    {{-- product price --}}
                    <div class="form-group row">
                        <label for="price"class="col-3">Product price</label>
                        <div class="col-9">
                            <input type="number" id="price" class="form-control" wire:model="price">
                            @error('price')
                                <span class="text-danger" style="font-size:11.5px;" >{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    {{-- submit --}}
                    <div class="form-group row">
                        <div class="col-9">
                        <button class="btn btn-sm btn-primary" type="submit">Add Product</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- edit Modal -->
    <div wire:ignore.self class="modal  fade" id="editproductmodel" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif
        </div>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  class="model-body" wire:submit.prevent="updateProductData">

                    {{-- product name --}}
                    <div class="form-group row">
                        <label for="name"class="col-3">Product name</label>
                        <div class="col-9">
                            <input type="text" id="name" class="form-control" wire:model="name">
                            @error('name')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- product details --}}
                    <div class="form-group row">
                        <label for="details"class="col-3">Product Details</label>
                        <div class="col-9">
                            <input type="text" id="details" class="form-control" wire:model="details">
                            @error('details')
                                <span class="text-danger" style="font-size:11.5px;" >{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    {{-- product price --}}
                    <div class="form-group row">
                        <label for="price"class="col-3">Product price</label>
                        <div class="col-9">
                            <input type="number" id="price" class="form-control" wire:model="price">
                            @error('price')
                                <span class="text-danger" style="font-size:11.5px;" >{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    {{-- submit --}}
                    <div class="form-group row">
                        <div class="col-9">
                        <button class="btn btn-sm btn-primary" type="submit">Edit Product</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- delete Modal -->
    <div wire:ignore.self class="modal  fade" id="deleteProductModeal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif
        </div>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-4 pb-4">
                <h6>Are you sure you want to delete this product data </h6>
                <div class="model-footer">
                    <button class="btn btn-sm btn-primary" wire:click="cancel()" data-dismiss="modal" aria-label="close">Cancel</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteProductData()">Yes ! delete</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    {{-- show --}}
    <div wire:ignore.self class="modal  fade" id="showProductModeal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif
        </div>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID: </th>
                                <td>{{ $view_id }}</td>
                            </tr>
                            <tr>
                                <th>Name: </th>
                                <td>{{ $view_name }}</td>
                            </tr>
                            <tr>
                                <th>Details: </th>
                                <td>{{ $view_details }}</td>
                            </tr>
                            <tr>
                                <th>Price: </th>
                                <td>{{ $view_price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</div>

@push('scripts')
    <script>
        window.addEventListener('close-add-modal', event =>{
                    $('#addProductModel').modal('hide');
                    $('#editproductmodel').modal('hide');
                    $('#deleteProductModeal').modal('hide');
                });
        window.addEventListener('show-edit-product-modal', event =>{
                    $('#editproductmodel').modal('show');
                });
        window.addEventListener('show-delete-product-modal', event =>{
                    $('#deleteProductModeal').modal('show');
                });
        window.addEventListener('show-product-info-modal', event =>{
                    $('#showProductModeal').modal('show');
                });
    </script>
@endpush
