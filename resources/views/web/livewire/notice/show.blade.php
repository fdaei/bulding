@section('title',substr($model->title,0,50).config('app.name'))
@section('description',$model->context )
<div class="bg-light">
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-sm-12 mb-5">
            <div class="rounded shadow bg-white mt-5">
                <header class="p-4">
                    @if($model->especial !=null)
                        <span class="bg-danger px-3 py-2 text-white rounded ">
                            برای فروش ویژه
                        </span>
                    @endif
                    <h1 class="my-3">
                        {{$model->title}}
                    </h1>
                    <div class="mt-4">
                        <section id="features" class="blue">
                            <div class="content">
                                <div class="image-product">
                                    <a href="{{\App\Helper\Utility::pathImage($model->image)}}">
                                        <img src="{{\App\Helper\Utility::pathImage($model->image)}}" class="col-12 pr-0 " height="auto">
                                    </a>
                                    <div id="animated-thumbnails">
                                        @forelse($model->gallerys as $key=>$item)
                                            @if($key===3)
                                                <a href="{{\App\Helper\Utility::pathImage($item->path)}}" style="position: relative">
                                                    <img src="{{\App\Helper\Utility::pathImage($item->path)}}" class="col-3 mx-0 col-md-3 col-sm-3 col-xs-6 mt-1 px-0"  height="80"
                                                         style="width: 100px;opacity: 0.5;"/>
                                                    <i class="fas fa-plus text-white" style="position: absolute; top: 15px;left: 50%;"></i>
                                                </a>
                                            @elseif($key>3)
                                                <a href="{{\App\Helper\Utility::pathImage($item->path)}}">
                                                    <img src="{{\App\Helper\Utility::pathImage($item->path)}}" class="col-3 mx-0 col-md-3 col-sm-3 col-xs-6 mt-1 px-0"  height="80"
                                                         style="width: 100px;display: none"/>
                                                </a>
                                                @else
                                                    <a href="{{\App\Helper\Utility::pathImage($item->path)}}">
                                                        <img src="{{\App\Helper\Utility::pathImage($item->path)}}" class="col-3 mx-0 col-md-3 col-sm-3 col-xs-6 mt-1 px-0"  height="80"
                                                             style="width: 100px;"/>
                                                    </a>
                                                @endif
                                        @empty
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <ul class="show-notice-btn-header mt-4 text-center">
                        <li class="d-inline">
                            <a href="whatsapp://send?text={{url()->previous()}}" class="btn  m-2 btn-lg btn-outline-blue">
                                <i class="fab fa-whatsapp "></i>
                                </a>
                            <a href="instagram://camera"  class="btn  m-2 btn-lg btn-outline-blue">
                                <i class="fab fa-instagram  "></i>
                            </a>
                            <a  class="btn  m-2 btn-lg btn-outline-blue" href="tg://share?url={{url()->previous()}}">  <i class="fab fa-telegram"></i>
                            </a>
                        </li>
                    </ul>
                </header>
            </div>
            <div>
                <div class="rounded shadow bg-white mt-5 p-4">
                    <h4 class="border-bottom pb-3">توضیحات</h4>
                    <div class="show-notice-extra-line"></div>
                    <div class="text-justify p-3 text-secondary show-notice-text mt-3" style="text-align: justify">
                        {{$model->context}}
                    </div>
                </div>
            </div>
            <div>
                <div class="rounded shadow bg-white mt-5 p-4">
                    <h4 class="border-bottom pb-3">مشخصات</h4>
                    <div class="show-notice-extra-line mb-4">
                    </div>
                    <ul class="show-notice-details-specific">
                        @forelse($model->notice_features as $item)
                            @forelse($item->Category_features as $key)
                        <li class="bg-light">
                            <h5 class="d-inline">{{$key->name}}</h5>
                            <p class="d-inline h5">
                                {{$key->prefix}}
                                {{$item->value}}
                                {{$key->suffix}}
                            </p>
                        </li>
                            @empty
                            @endforelse
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="rounded shadow bg-white p-4 mt-5" >
                <h4 class="border-bottom pb-3" style="text-align: right">موقعیت</h4>
                <div class="show-notice-extra-line"></div>
                <div class="mt-4 show-notice-location" style="height: 330px">
                    <livewire:web.map-wire>
                </div>
            </div>
            <div class="rounded shadow bg-white mt-5 p-4">
                <h4 class="border-bottom pb-3">نظر
                    <span>{{count($model->commandshow)}}</span>
                </h4>
                <div class="show-notice-extra-line mb-4"></div>
                @forelse($model->commandshow as $key)
                <div class="bg-light m-2 p-4 rounded border">
                    <div>
                        @if($key->user->img)
                            <img  class="show-notice-img rounded-circle d-inline" src="{{\App\Helper\Utility::pathImage($key->user->img)}}" alt="review">
                        @else
                            <img class="rounded-circle show-notice-img mb-3" alt="avatar" src={{asset('/asset/user/images/unnamed.png')}}>
                        @endif
                        <div class="d-inline">
                            <span>{{$key->user->first_name}}{{$key->user->last_name}}</span>
                        </div>
                    </div>
                    <div class=" mt-3">
                        <div class="d-inline text-dark">
                            <span class="h5">{{$key->title}}</span>
                        </div>
                        <div class="text-secondary text-justify show-notice-text">
                            <p>{{$key->context}}</p>
                        </div>
                        <div>
                            <p class="clearfix">
                                <button class="btn btn-outline-blue" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{$key->id}}" aria-expanded="false" aria-controls="collapseExample{{$key->id}}" style="float: left">
                                    پاسخ
                                    <i class="fas fa-reply-all"></i>
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample{{$key->id}}">
                                    <textarea wire:model.defer="response_text" class="form-control card card-body">
                                    </textarea>
                                <button wire:click="SendResponse({{$key->id}},'comment')" class="btn-outline-info btn my-2">ارسال  <i class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
{{--                        <div>--}}
{{--                            @if($key->comments)--}}
{{--                                @include("layouts.web.partial.comment-child" , $key->comments)--}}
{{--                            @endif--}}
{{--                        </div>--}}
                    </div>
                </div>
                @empty
                @endforelse
                <div>
                    <form wire:submit.prevent="insert">
                        <div>
                            <div class="form-group">
                                <input type="text" class="form-control mt-4" placeholder="موضوع" wire:model.defer="comment.title">
                                @error('comment.title')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea  wire:model.defer="comment.context" class="form-control mt-4" style="height: 10rem" placeholder="توضیح"></textarea>
                            @error('comment.context')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <button class="btn btn-inline btn-outline-blue mt-4">
                            <i class="fas fa-paper-plane"></i>
                            <span>ارسال</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 d-lg-block d-sm-none  mt-5 text-center">
            <div class="rounded shadow bg-white p-4" style="position: sticky;top:1rem;">
                <div>
                    <div>
                        <div class="mt-5">
                            @if($model->user->img)
                                <img src="{{\App\Helper\Utility::pathImage($model->user->img)}}" class="rounded-circle show-notice-img mb-3" alt="avatar">
                            @else
                                <img src="{{asset('/asset/user/images/unnamed.png')}}" class="rounded-circle show-notice-img mb-3" alt="avatar">
                            @endif
                        </div>
                        <div>
                            <h5>{{$model->user->first_name}}</h5>
                            <h5>{{$model->user->last_name}}</h5>
                            <p>{{$model->user->email}}</p>
                        </div>
                        <ul class="show-notice-item">
                            <li>
                                <h6 class="d-inline">مجموع تبلیغ</h6>
                                <p class="d-inline ">{{count($model->user->Notices)}}</p>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/{{$model->user->instagram}}/">
                                    <i class="fab fa-instagram text-dark"></i>
                                </a>
                                <a href=tel:{{$model->user->phone_number}}/">
                                    <i class="fas fa-phone text-dark"></i>
                                </a>
                                <a href="{{$model->user->website}}">
                                    <i class="fas fa-browser text-dark"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section("script")
        <script>


            document.addEventListener('livewire:load', function () {

                initMap();
                function initMap() {
                    var lat = 30.2832993;
                    var lng = 57.0705093;
                    if (@this.lat && @this.lng) {
                        lat = @this.lat;
                        lng = @this.lng;
                    }
                    window.LeafletMap = L.map('map-id', {
                        center: [lat, lng],
                        zoom: 18,
                        doubleClickZoom: "center"
                    });

                    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                        attribution:
                            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(window.LeafletMap);
                    var marker = L.marker([lat, lng], {
                        clickable: true,
                        draggable: false,
                        icon: L.icon({
                            iconUrl: '/images/vendor/leaflet/dist/marker-icon.png',
                            iconSize: [32, 45],
                        })
                    }).addTo(window.LeafletMap);
                }
            })
        </script>
@endsection
