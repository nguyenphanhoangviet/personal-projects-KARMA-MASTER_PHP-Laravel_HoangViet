@extends('layouts.user')
@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shop Category Page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Fashon Category</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Browse Categories</div>
                    <ul class="main-categories">
                        @foreach ($categories as $category)
                            <li class="main-nav-list">
                                <a href="{{ route('category', array_merge(request()->all(), ['category' => $category->id])) }}">
                                    <span class="lnr lnr-arrow-right"></span>{{ $category->name }}
                                    <span class="number">({{ $category->products->count() }})</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="sidebar-filter mt-50">
					<div class="top-filter-head">Product Filters</div>
					<div class="common-filter">
                        <div class="head">Brands</div>
                        <form id="filterForm" action="{{ route('category') }}" method="GET">
                            <ul>
                                @foreach($brands as $brand)
                                    <li class="filter-list">
                                        <input class="pixel-checkbox" type="checkbox" id="brand{{ $brand->id }}" name="brand" value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'checked' : '' }} onchange="this.form.submit()">
                                        <label for="brand{{ $brand->id }}">{{ $brand->name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
					<div class="common-filter">
                        <div class="head">Color</div>
                        <form id="filterForm" action="{{ route('category') }}" method="GET">
                            <ul>
                                @foreach($colors as $color)
                                    <li class="filter-list">
                                        <input class="pixel-checkbox" type="checkbox" id="color{{ $color->id }}" name="color" value="{{ $color->id }}" {{ request('color') == $color->id ? 'checked' : '' }} onchange="this.form.submit()">
                                        <label for="color{{ $color->id }}">{{ $color->name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>        
					{{-- <div class="common-filter">
						<div class="head">Price</div>
						<div class="price-range-area">
							<div id="price-range"></div>
							<div class="value-wrapper d-flex">
								<div class="price">Price:</div>
								<span>$</span>
								<div id="lower-value"></div>
								<div class="to">to</div>
								<span>$</span>
								<div id="upper-value"></div>
							</div>
						</div>
					</div> --}}
				</div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting">
                        <select>
                            <option value="1">Default sorting</option>
                            <option value="1">Default sorting</option>
                            <option value="1">Default sorting</option>
                        </select>
                    </div>
                    <div class="sorting mr-auto">
                        <form id="itemsPerPageForm" action="{{ route('category') }}" method="GET">
                            <select name="itemsPerPage" onchange="this.form.submit()">
                                <option value="10" {{ request('itemsPerPage') == 10 ? 'selected' : '' }}>Show 10</option>
                                <option value="20" {{ request('itemsPerPage') == 20 ? 'selected' : '' }}>Show 20</option>
                                <option value="30" {{ request('itemsPerPage') == 30 ? 'selected' : '' }}>Show 30</option>
                            </select>
                            @foreach (request()->except('itemsPerPage') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                        </form>
                    </div>
                    <div class="pagination">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        @if (isset($products) && $products->count() > 0)
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-product">
                                        <img class="img-fluid" src="{{ asset('imgs/products/' . $product->img) }}"
                                            alt="{{ $product->name }}">
                                        <div class="product-details">
                                            <h6>{{ $product->name }}</h6>
                                            <div class="price">
                                                <h6>{{ number_format($product->price, 0) }} VNĐ</h6>
                                                @if ($product->original_price)
                                                    <h6 class="l-through">{{ number_format($product->original_price, 0) }}
                                                        VND
                                                    </h6>
                                                @endif
                                            </div>
                                            <div class="prd-bottom">
                                                <a href="" class="social-info">
                                                    <span class="ti-bag"></span>
                                                    <p class="hover-text">add to bag</p>
                                                </a>
                                                <a href="" class="social-info">
                                                    <span class="lnr lnr-heart"></span>
                                                    <p class="hover-text">Wishlist</p>
                                                </a>
                                                <a href="" class="social-info">
                                                    <span class="lnr lnr-sync"></span>
                                                    <p class="hover-text">compare</p>
                                                </a>
                                                <a href="{{ route('single-product', $product->id) }}" class="social-info">
                                                    <span class="lnr lnr-move"></span>
                                                    <p class="hover-text">view more</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @elseif(isset($category) && $category->products->count() > 0)
                            @foreach ($category->products as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-product">
                                        <img class="img-fluid" src="{{ asset('imgs/products/' . $product->img) }}"
                                            alt="{{ $product->name }}">
                                        <div class="product-details">
                                            <h6>{{ $product->name }}</h6>
                                            <div class="price">
                                                <h6>{{ number_format($product->price, 0) }} VNĐ</h6>
                                                @if ($product->original_price)
                                                    <h6 class="l-through">{{ number_format($product->original_price, 0) }}
                                                        VND
                                                    </h6>
                                                @endif
                                            </div>
                                            <div class="prd-bottom">
                                                <a href="" class="social-info">
                                                    <span class="ti-bag"></span>
                                                    <p class="hover-text">add to bag</p>
                                                </a>
                                                <a href="" class="social-info">
                                                    <span class="lnr lnr-heart"></span>
                                                    <p class="hover-text">Wishlist</p>
                                                </a>
                                                <a href="" class="social-info">
                                                    <span class="lnr lnr-sync"></span>
                                                    <p class="hover-text">compare</p>
                                                </a>
                                                <a href="{{ route('single-product', $product->id) }}" class="social-info">
                                                    <span class="lnr lnr-move"></span>
                                                    <p class="hover-text">view more</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No products found.</p>
                        @endif
                        <!-- single product -->
                        {{-- <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                <img class="img-fluid" src="img/product/p2.jpg" alt="">
                                <div class="product-details">
                                    <h6>addidas New Hammer sole
                                        for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                <img class="img-fluid" src="img/product/p3.jpg" alt="">
                                <div class="product-details">
                                    <h6>addidas New Hammer sole
                                        for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                <img class="img-fluid" src="img/product/p4.jpg" alt="">
                                <div class="product-details">
                                    <h6>addidas New Hammer sole
                                        for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                <img class="img-fluid" src="img/product/p5.jpg" alt="">
                                <div class="product-details">
                                    <h6>addidas New Hammer sole
                                        for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                <img class="img-fluid" src="img/product/p6.jpg" alt="">
                                <div class="product-details">
                                    <h6>addidas New Hammer sole
                                        for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </section>
                <!-- End Best Seller -->
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting mr-auto">
                        <form id="itemsPerPageForm" action="{{ route('category') }}" method="GET">
                            <select name="itemsPerPage" onchange="this.form.submit()">
                                <option value="10" {{ request('itemsPerPage') == 10 ? 'selected' : '' }}>Show 10</option>
                                <option value="20" {{ request('itemsPerPage') == 20 ? 'selected' : '' }}>Show 20</option>
                                <option value="30" {{ request('itemsPerPage') == 30 ? 'selected' : '' }}>Show 30</option>
                            </select>
                            @foreach (request()->except('itemsPerPage') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                        </form>
                    </div>
                    <div class="pagination">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
                <!-- End Filter Bar -->
            </div>
        </div>
    </div>

    <!-- Start related-product Area -->
    <section class="related-product-area section_gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Deals of the Week</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore
                            magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('imgs/karma-master/r1.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('imgs/karma-master/r2.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('imgs/karma-master/r3.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('imgs/karma-master/r5.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('imgs/karma-master/r6.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('imgs/karma-master/r7.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('imgs/karma-master/r9.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('imgs/karma-master/r10.jpg') }}"
                                        alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('imgs/karma-master/r11.jpg') }}"
                                        alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ctg-right">
                        <a href="#" target="_blank">
                            <img class="img-fluid d-block mx-auto" src="{{ asset('imgs/karma-master/category/c5.jpg') }}"
                                alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End related-product Area -->

    <!-- start footer Area -->
    {{-- <footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>About Us</h6>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
							magna aliqua.
						</p>
					</div>
				</div>
				<div class="col-lg-4  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Newsletter</h6>
						<p>Stay update with our latest</p>
						<div class="" id="mc_embed_signup">

							<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
							 method="get" class="form-inline">

								<div class="d-flex flex-row">

									<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
									 required="" type="email">


									<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
									<div style="position: absolute; left: -5000px;">
										<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
									</div>

									<!-- <div class="col-lg-4 col-md-4">
													<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
												</div>  -->
								</div>
								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget mail-chimp">
						<h6 class="mb-20">Instragram Feed</h6>
						<ul class="instafeed d-flex flex-wrap">
							<li><img src="img/i1.jpg" alt=""></li>
							<li><img src="img/i2.jpg" alt=""></li>
							<li><img src="img/i3.jpg" alt=""></li>
							<li><img src="img/i4.jpg" alt=""></li>
							<li><img src="img/i5.jpg" alt=""></li>
							<li><img src="img/i6.jpg" alt=""></li>
							<li><img src="img/i7.jpg" alt=""></li>
							<li><img src="img/i8.jpg" alt=""></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Follow Us</h6>
						<p>Let us be social</p>
						<div class="footer-social d-flex align-items-center">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
			</div>
		</div>
	</footer> --}}
    <!-- End footer Area -->

    <!-- Modal Quick Product View -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="container relative">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="product-quick-view">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="quick-view-carousel">
                                <div class="item" style="background: url(img/organic-food/q1.jpg);">

                                </div>
                                <div class="item" style="background: url(img/organic-food/q1.jpg);">

                                </div>
                                <div class="item" style="background: url(img/organic-food/q1.jpg);">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="quick-view-content">
                                <div class="top">
                                    <h3 class="head">Mill Oil 1000W Heater, White</h3>
                                    <div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span
                                            class="ml-10">$149.99</span></div>
                                    <div class="category">Category: <span>Household</span></div>
                                    <div class="available">Availibility: <span>In Stock</span></div>
                                </div>
                                <div class="middle">
                                    <p class="content">Mill Oil is an innovative oil filled radiator with the most modern
                                        technology. If you are
                                        looking for something that can make your interior look awesome, and at the same time
                                        give you the pleasant
                                        warm feeling during the winter.</p>
                                    <a href="#" class="view-full">View full Details <span
                                            class="lnr lnr-arrow-right"></span></a>
                                </div>
                                <div class="bottom">
                                    <div class="color-picker d-flex align-items-center">Color:
                                        <span class="single-pick"></span>
                                        <span class="single-pick"></span>
                                        <span class="single-pick"></span>
                                        <span class="single-pick"></span>
                                        <span class="single-pick"></span>
                                    </div>
                                    <div class="quantity-container d-flex align-items-center mt-15">
                                        Quantity:
                                        <input type="text" class="quantity-amount ml-15" value="1" />
                                        <div class="arrow-btn d-inline-flex flex-column">
                                            <button class="increase arrow" type="button" title="Increase Quantity"><span
                                                    class="lnr lnr-chevron-up"></span></button>
                                            <button class="decrease arrow" type="button" title="Decrease Quantity"><span
                                                    class="lnr lnr-chevron-down"></span></button>
                                        </div>

                                    </div>
                                    <div class="d-flex mt-20">
                                        <a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
                                        <a href="#" class="like-btn"><span class="lnr lnr-layers"></span></a>
                                        <a href="#" class="like-btn"><span class="lnr lnr-heart"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
