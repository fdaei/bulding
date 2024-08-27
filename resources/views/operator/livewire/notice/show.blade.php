@section('title','پنل مدیریت | نمایش اگهی')
<div class="bg-white rounded shadow-sm p-3">
    <div class="float-left h3 mr-4">
        <a href="{{route("operator.notice")}}" style="color: black"><i class="fa fa-arrow-left"></i></a>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="statbox widget box box-shadow w-100">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="border-bottom pb-3">{{$model->title}}</h1>
                        <div class="text-secondary border-bottom p-2"> {!! $model->category->full_title !!}</div>
                        <div class="m-2">
                            <span class="title text-secondary">
                                وضعیت:
                            </span>
                            <div class="value d-inline">
                                {{$model->status}}
                            </div>
                        </div>
                        <div  class="m-2">
                            <span class="title text-secondary">
                                ادرس:
                            </span>
                            <div class="value d-inline">
                                {{$model->address}}
                            </div>
                        </div>
                        <div  class="m-2">
                            <span class="title text-secondary">
                                شهر:
                            </span>
                            <div class="value d-inline">
                                {{$model->city->name}}
                            </div>
                        </div>
                        <div  class="m-2">
                            <span class="title text-secondary">
                                استان:
                            </span>
                            <div class="value d-inline">
                                {{$model->state->name}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" style="height: 22rem; width: 10rem;"  src="{{\App\Helper\Utility::pathImage($model->image)}}" alt="First slide">
                                </div>
                                @forelse($images as $img)
                                <div class="carousel-item">
                                    <img class="d-block w-100" style="height: 22rem; width: 10rem;" src="{{\App\Helper\Utility::pathImage($img->path)}}" alt="First slide">
                                </div>
                                @empty
                                    @endforelse
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3 bg-light p-3">
                        <div>
                            <div class="title d-inline  mb-5 text-bold">
                                توضیحات:
                            </div>
                            <div class="value mt-3">
                                {{$model->context}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
