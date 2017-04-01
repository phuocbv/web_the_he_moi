<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12 col-lg-3 anc">
        <div class="categories list-group border-shadow-bottom">
            <a href="javascript:void(0)" class="list-group-item active">
                <h4>@lang('user.products-category')</h4>
            </a>
            @foreach ($categories as $key => $category)
                <div class="cate">
                    <a href="{{ route('category.show', $category->id) }}" class="list-group-item item-menu">
                        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>{{ $category->name }}
                    </a>
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 submenu border-shadow-bottom">
                        <div class="categories list-group border-shadow-bottom">
                            @foreach ($category->categories as $key => $value)
                                <a href="{{ route('category.show', $value->id) }}" class="list-group-item">
                                    <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>{{ $value->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-9 col-sm-12 col-xs-12 col-lg-9">
        <div class="row">
            <div id="carousel-example-generic" class="carousel slide border-shadow-bottom" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="{{ asset('images/image2.jpg') }}" alt="">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/image1.jpg') }}" alt="">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/image3.jpg') }}" alt="">
                        <div class="carousel-caption">
                        </div>
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">@lang('categories.previous')</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">@lang('categories.next')</span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6 img-title-right border-shadow-bottom">
                <a href="">
                    <img src="{{ asset('images/image4.jpg') }}" class="img-responsive img-title">
                </a>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 img-title-left border-shadow-bottom">
                <a href="">
                    <img src="{{ asset('images/image5.jpg') }}" class="img-responsive img-title">
                </a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('user/js/menu.js') }}"></script>
