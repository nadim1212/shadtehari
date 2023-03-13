@extends('front.layout')

@section('content')
    <!--====== PAGE TITLE PART START ======-->

    <section class="page-title-area d-flex align-items-center" style="background-image:url('{{asset('assets/front/img/'.$bs->breadcrumb)}}')">
     >
    </section>

    <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
.row{
    margin-left: auto;
    margin-right: auto;
}
</style>

    <!--====== PAGE TITLE PART ENDS ======-->

    <!--====== FOOD MENU PART START ======-->

    @if ($bs->menu_page == 1)
        <section class="food-menu-area food-menu-2-area food-menu-3-area pt-90">
        <div class="row justify-content-center">
      <div class="col-lg-6">
      <table id="customers">
                                    <tr>
 
 <th>Item name</th>
 <th>Price </th>
 <th>Order</th>

</tr>
                                    @foreach ($categories as $key => $category)
  @if($category->products()->where('status', 1)->count() > 0)
                    @foreach ($category->products()->where('status', 1)->get() as $product)
 
  <tr>
 
    <td>{{convertUtf8($product->title)}}</td>
    <td>{{convertUtf8($product->current_price)}}</td>
    <td> <div class="menu-price-btn"><a  class="cart-link" data-href="{{route('add.cart',$product->id)}}" style="cursor:default" >{{__('Add to Cart')}}</a></div></td>
  
  </tr>
  @endforeach
    @endif
    @endforeach
</table>
      </div>
        </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <span>{{convertUtf8($be->menu_section_title)}}
                            
                                
                                <img src="{{asset('assets/front/img/title-icon.png')}}" alt=""></span>
                            <h3 class="title">{{convertUtf8($be->menu_section_subtitle)}}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs-btn pb-20">
                            <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                @foreach ($categories as $keys => $category)
                                <li class="nav-item">
                                    <a class="nav-link {{$keys == 0 ? 'active' : ''}}" id="{{convertUtf8($category->slug)}}-tab" data-toggle="pill" href="#{{convertUtf8($category->slug)}}" role="tab" aria-controls="{{convertUtf8($category->slug)}}" aria-selected="true">
                                        @php
                                            $path = str_replace ( 'core' , '' , base_path() ) . 'assets/front/img/category/' . $category->image;
                                        @endphp
                                        @if (file_exists($path) && $category->image)
                                            <img src="{{asset('assets/front/img/category/'.$category->image)}}" alt="menu">
                                        @endif
                                        <p>{{convertUtf8($category->name)}} ({{$category->products->count()}})</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content" id="pills-tabContent">
                            @foreach ($categories as $key => $category)
                            <div class="tab-pane fade {{$key == 0 ? 'show active' : ''}}"  id="{{convertUtf8($category->slug)}}" role="tabpanel" aria-labelledby="{{convertUtf8($category->slug)}}-tab">
                                <div class="row justify-content-center">
                                    @if($category->products()->where('status', 1)->count() > 0)
                                    @foreach ($category->products()->where('status', 1)->get() as $product)
                                   

                                    <div class="col-lg-6">
                                        <div class="food-menu-items">
                                            <div class="single-menu-item mt-30">
                                                <div class="menu-thumb">
                                                    <img src="{{asset('assets/front/img/product/featured/'.$product->feature_image)}}" alt="menu">
                                                    <div class="thumb-overlay">
                                                        <a href="{{route('front.product.details',[$product->slug,$product->id])}}"><i class="flaticon-add"></i></a>
                                                    </div>
                                                </div>
                                                <div class="menu-content ml-30">
                                                    <a class="title" href="{{route('front.product.details',[$product->slug,$product->id])}}">{{convertUtf8($product->title)}}</a>
                                                    <p>{{convertUtf8(strlen($product->summary)) > 70 ? substr(convertUtf8($product->summary), 0, 70) . '...' : convertUtf8($product->summary)}} </p>
                                                </div>
                                                <div class="menu-price-btn">
                                                    <a class="cart-link" data-href="{{route('add.cart',$product->id)}}">{{__('Add to Cart')}}</a>

                                                    <span>{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{convertUtf8($product->current_price)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                                    </span>
                                                    @if(convertUtf8($product->previous_price))
                                                    <del>  {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{convertUtf8($product->previous_price)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</del>
                                                    @endif
                                                </div>
                                                @if ($product->is_special == 1)
                                                    <div class="flag flag-2"><span>{{__('Special')}}</span></div>
                                                @endif

                                            </div>

                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-lg-12 bg-light py-5 mt-4">
                                        <h4 class="text-center">{{__('Product Not Found')}}</h4>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach



                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="food-menu-area pt-130">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center">
                            <span>{{convertUtf8($be->menu_section_title)}} <img src="{{asset('assets/front/imt/title-icon.png')}}" alt=""></span>
                            <h3 class="title">{{convertUtf8($be->menu_section_subtitle)}}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs-btn pb-20">
                            <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                @foreach ($categories as $keys => $category)
                                <li class="nav-item">
                                    <a class="nav-link {{$keys == 0 ? 'active' : ''}}" id="{{convertUtf8($category->slug)}}-tab" data-toggle="pill" href="#{{convertUtf8($category->slug)}}" role="tab" aria-controls="{{convertUtf8($category->slug)}}" aria-selected="true">
                                        @php
                                            $path = str_replace ( 'core' , '' , base_path() ) . 'assets/front/img/category/' . $category->image;
                                        @endphp
                                        @if (file_exists($path) && $category->image)
                                            <img src="{{asset('assets/front/img/category/'.$category->image)}}" alt="menu">
                                        @endif
                                        <p>{{convertUtf8($category->name)}} ({{$category->products->count()}})</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content" id="pills-tabContent">
                            @foreach ($categories as $key => $category)
                            <div class="tab-pane fade {{$key == 0 ? 'show active' : ''}}" id="{{convertUtf8($category->slug)}}"  role="tabpanel" aria-labelledby="{{convertUtf8($category->slug)}}-tab">
                                <div class="food-menu-items menu-2">
                                    @if($category->products()->where('status', 1)->count() > 0)
                                    @foreach ($category->products()->where('status', 1)->get() as $product)
                                    <div class="single-menu-item mt-30">
                                        <div class="menu-thumb">
                                            <img src="{{asset('assets/front/img/product/featured/'.$product->feature_image)}}" alt="menu">
                                            <div class="thumb-overlay">
                                                <a href="{{route('front.product.details',[$product->slug,$product->id])}}"><i class="flaticon-add"></i></a>
                                            </div>
                                        </div>
                                        <div class="menu-content ml-30">
                                            <a class="title" href="{{route('front.product.details',[$product->slug,$product->id])}}">{{convertUtf8($product->title)}}</a>
                                            <p>{{convertUtf8(strlen($product->summary)) > 180 ? convertUtf8(substr($product->summary, 0, 180)) . '...' : convertUtf8($product->summary)}} </p>
                                        </div>
                                        <div class="menu-price-btn menu-2">
                                            <span>{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{convertUtf8($product->current_price)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                            </span>
                                            @if(convertUtf8($product->previous_price))
                                                <del>  {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{convertUtf8($product->previous_price)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</del>
                                            @endif
                                            <a class="cart-link" data-href="{{route('add.cart',$product->id)}}">{{__('Add to Cart')}}</a>
                                        </div>
                                        @if ($product->is_special == 1)
                                            <div class="flag flag-2"><span>{{__('Special')}}</span></div>
                                        @endif
                                    </div>
                                    @endforeach
                                    @else
                                        <div class="col-lg-12 bg-light py-5 mt-4">
                                            <h4 class="text-center">{{__('Product Not Found')}}</h4>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </section>
    @endif

    <!--====== FOOD MENU PART ENDS ======-->
@endsection
