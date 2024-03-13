@extends('layouts.client.layout_base')
@section('main')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="#">Sản Phẩm </a>
                        <span>{{ $product->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Details Section Begin -->

    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            @foreach ($product->variants as $index => $variant)
                                <a class="pt" href="#product-{{ $numbers[$index] }}">
                                    <img class="variant-image" src="{{ Storage::url($variant->image) }}" alt=""
                                        data-variant-id="{{ $variant->id }}">
                                </a>
                            @endforeach
                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach ($product->variants as $index => $variant)
                                    <img data-hash="product-{{ $numbers[$index] }}" class="product__big__img"
                                        src="{{ Storage::url($variant->image) }}" alt=""
                                        data-variant-id="{{ $variant->id }}">
                                @endforeach
                            </div>
                        </div>
                    </div>




                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3>{{ $product->name }}<span>Thương Hiệu: ClassicMan</span></h3>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <span>( 138 đánh giá )</span>
                        </div>
                        <div class="product__details__price">{{ Number_format($product->price_reduced) }}
                            đ<span>{{ Number_format($product->price) }} đ</span></div>
                        - Hình ảnh sản phẩm là ảnh thật, các hình hoàn toàn do shop tự thiết kế.</br>
                        - Kiểm tra cẩn thận trước khi gói hàng giao cho Quý Khách</br>
                        - Hàng có sẵn, giao hàng ngay khi nhận được đơn </br>
                        - Hoàn tiền nếu sản phẩm không giống với mô tả</br>
                        - Chấp nhận đổi hàng khi size không vừa trong 3 ngày.
                        </p>
                        <div class="product__details__button">
                            <div class="quantity">
                                <span>Số lượng:</span>
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                            {{-- <a  class="cart-btn"><span class="icon_bag_alt"></span> </a> --}}

                            <a href="javascript:void(0)"
                                onclick="event.preventDefault();document.getElementById('addtocart').submit();"
                                id="cartEffect" class="btn btn-solid hover-solid btn-animation">

                                <form id="addtocart" method="post" action="{{ route('cart.store') }}">
                                    @csrf
                                    <span class="cart-btn"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</span>
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="variant_id" value="{{ $product->variants->first()->id }}">
                                    {{-- @php
                                        dd( $product->variants );
                                    @endphp --}}
                                    <input type="hidden" name="quantity" id="qty" value="1" min="1"
                                        max="{{ $product->variants->max('quantity') }}">
                                </form>
                            </a>
                           

                        </div>

                        <div class="product__details__widget">
                            <ul>
                                <li>
                                    <span>Khả dụng còn :</span>
                                    <div class="stock__checkbox">
                                        {{ $product->variants->first()->quantity }}
                                    </div>
                                </li>
                                <li>
                                    <span>Màu sẵn có:</span>
                                    <div class="size__btn">
                                        @php
                                            $uniqueColors = [];
                                        @endphp
                                        @foreach ($product->colors as $color)
                                            @if (!in_array($color->color, $uniqueColors))
                                                <label for="{{ $color->color }}-btn">
                                                    <input type="radio" id="{{ $color->color }}-btn">
                                                    {{ $color->color }}
                                                </label>
                                                @php
                                                    $uniqueColors[] = $color->color;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </div>
                                </li>




                                <li>
                                    <span>Kích thước sẵn có:</span>
                                    <div class="size__btn">
                                        @php
                                            $uniqueSizes = [];
                                        @endphp
                                        @foreach ($product->sizes as $size)
                                            @if (!in_array($size->size, $uniqueSizes))
                                                <label for="{{ $size->size }}-btn">
                                                    <input type="radio" id="{{ $size->size }}-btn">
                                                    {{ $size->size }}
                                                </label>
                                                @php
                                                    $uniqueSizes[] = $size->size;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </div>
                                </li>

                                <li>
                                    <span>Khuyến mãi:</span>
                                    <p>Miễn phí vận chuyển</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Mô tả</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Đánh giá ( 2 )</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Mô tả</h6>
                                <p>{{ $product->description }}
                                </p>
                            </div>

                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <h6>Đánh giá ( 2 )</h6>
                                <p> - Có thể hơi dày và cồng kềnh khi mặc trong những ngày hè nóng bức.</br>
                                    - Giá thành có thể cao hơn so với một số loại áo khoác khác.</p>
                                <p>Áo khoác dài cổ Vest, form rộng, chất Flannel cao cấp là một
                                    lựa chọn tuyệt vời cho những ai đang tìm kiếm một chiếc áo
                                    khoác vừa thời trang, vừa ấm áp. Áo có thiết kế đa năng, phù
                                    hợp với nhiều phong cách thời trang và có thể kết hợp với
                                    nhiều loại trang phục khác nhau. Tuy nhiên, áo có thể hơi dày
                                    và cồng kềnh khi mặc trong những ngày hè nóng bức, và giá
                                    thành có thể cao hơn so với một số loại áo khoác khác.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="related__title">
                        <h5>NHỮNG SẢM PHẨM TƯƠNG TỰ</h5>
                    </div>
                </div>
                @foreach ($categoryProducts as $Prd_type)
                    @if ($Prd_type->id != $product->id)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                @if(isset($Prd_type->variants[0]->image)) data-setbg="{{ Storage::url($Prd_type->variants[0]->image) }}" @endif>
                                <ul class="product__hover">
                                    @if(isset($Prd_type->variants[0]->image))
                                        <li><a href="{{ Storage::url($Prd_type->variants[0]->image) }}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    @endif
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                                <div class="product__item__text">
                                    <h6><a
                                            href="{{ route('detail_product') }}?id={{ $Prd_type->id }}">{{ $Prd_type->name }}</a>
                                    </h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">{{ Number_format($Prd_type->price_reduced) }}đ
                                        <span>{{ Number_format($Prd_type->price) }}đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach


            </div>
        </div>
    </section>
    
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Lắng nghe sự kiện khi ảnh biến thể được chọn
        $('.variant-image').on('click', function() {
            // Lấy giá trị variant_id từ data-attribute của ảnh đã chọn
            var variantId = $(this).data('variant-id');
            
            // Cập nhật giá trị của input hidden variant_id trong form
            $('input[name="variant_id"]').val(variantId);
        });
    });
</script>
