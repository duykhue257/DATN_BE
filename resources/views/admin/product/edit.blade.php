@extends('layouts.layout_admin')
@section('body')
    <!-- Main row -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning">Sửa sản phẩm</h6>
            </div>
            <div class="card-body">
                <div class="">
                    <div class="m-8">
                        <form class="max-w-md mx-auto" action="{{ route('product.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <select id="product_id" name="product_id" class="form-select">
                                    <option value="{{ $product->products->id }}">{{ $product->products->name }} </option>
                                    @foreach ($products as $prd)
                                        <option value="{{ $prd->id }}">{{ $prd->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">price</label>
                                <input type="text" name="price" id="price" class="form-control" placeholder=""
                                    value="{{ $product->price }}" />
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price Reduced</label>
                                <input type="text" name="price_reduced" id="price_reduced" class="form-control"
                                    placeholder="" value="{{ $product->price_reduced }}" />
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Color</label>
                                <option value="{{ $product->colors->id }}">{{ $product->colors->color }} </option>
                                <select id="color_id" name="color_id" class="form-select">
                                    @foreach ($colors as $cl)
                                        <option value="{{ $cl->id }}">{{ $cl->color }} </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Size</label>
                                <div class="col-sm-9">
                                    <option value="{{ $product->sizes->id }}">{{ $product->sizes->size }} </option>
                                    <select id="size_id" name="size_id" class="form-select">
                                        @foreach ($sizes as $sz)
                                            <option value="{{ $sz->id }}">{{ $sz->size }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">quantity</label>
                                <input type="text" name="quantity" id="quantity" class="form-control" placeholder=""
                                    value="{{ $product->quantity }}" />
                            </div>
                            <div class="mb-3">
                                <label for="img" class="form-label">Image</label>
                                <div class="input-group">
                                    <input type="file" name="image" id="image" class="form-control file-input"
                                        placeholder="" aria-describedby="inputGroupFileAddon"
                                        onchange="previewImage(event)">
                                </div>
                                <br>
                                <img id="preview" style="max-width:100px"
                                    src="{{ $product->image ? Storage::url($product->image) : '' }}" alt="">
                            </div>

                            <button type="submit" class="btn btn-warning">Sửa</button>
                            <button class="btn btn-primary"><a class="text-white text-decoration-none"
                                    href="{{ route('product.index') }}">List</a></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/image_preview.js') }}"></script>
    <!-- /.row (main row) -->
@endsection
