<div class="container">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-20">
        <div class="row">
            <div id="carousel-example-generic" class="carousel slide border-shadow-bottom" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="{{ asset('images/image2.jpg') }}" alt="...">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/image1.jpg') }}" alt="...">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/image3.jpg') }}" alt="...">
                        <div class="carousel-caption">
                        </div>
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">@lang('title.previous')</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">@lang('title.next')</span>
                </a>
            </div>
        </div>
    </div>
</div>
