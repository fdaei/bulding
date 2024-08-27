@section('title','درج آگهی در صنعت ساختمان کرمان |'.config('app.name') )
@section('description','سایت ثبت آگهی اولین آگهی نامه صنعت ساختمان کرمان می باشد. جهت درج آگهی رایگان ساختمانی در کرمان اقدام نمایید ')
<main>
    <section class="components  py-5">
            <div class="container">
                <div  class="row d-flex justify-content-center p-3" >
                    @forelse($categories as $item)
                        <button wire:click="ShowNotices({{$item->id}})" type="submit"  class="col-4 col-md-2 p-3 text-center component-box m-2 btn border-0" style="background-color: {{$item->background}};color: {{$item->color}}" >
                            @if($item->icon)
                            <i class="{{$item->icon}}"></i>
                            @endif
                            @if($item->image)
                                    <img src="{{\App\Helper\Utility::pathImage($item->image)}}" class="card-img-top rounded-circle" style="height: 70px;width: 70px;">
                                @endif
                            <p class="pt-3">{{$item->name}}</p>
                        </button>
                    @empty
                    @endforelse
                </div>
            </div>
    </section>
    <section class="last-notices bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="underline">آخرین آگهی های ویژه</h2>
            </div>
            <div class="row">
                @forelse($especialnotice as $item)
                    <div  class="col-lg-3 col-sm-6 col-md-4 my-3">
                        <a href="{{route("shownotice",['id'=>$item->id])}}">
                            <div  class="item">
                                <div dir="rtl" class="card h-100 special-notice">
                                    <div class="position-relative">
                                        <img src="{{  \App\Helper\Utility::pathImage($item->image)}}" class="card-img-top" alt="special-ad" style="object-fit: cover;height: 250px;">
                                        <div class="summary-title">
                                            <h5 class="px-2">{{$item->title}}</h5>
                                            <div class="bg-dark text-white float-end px-1 ms-auto">
                                                <span>{{count($item->gallerys)}}</span>
                                                <i class="fa fa-camera"></i>
                                            </div>
                                        </div>
                                        <div class="special-label">
                                           <div style="transform: rotate(-45deg) ;padding: 0px;"> ویژه</div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$item->city->name}}</h5>
                                        <span>{{\App\Helper\Utility::limitWords($item->context,15)}}</span>
                                        <p class="card-text">
                                            @if( round((time() - strtotime($item->created_at)) /86400)>10)
                                                {{\App\Helper\Utility::convertToSWithOutTime($item->created_at)}}
                                            @else
                                            <i class="fas fa-calendar-day"></i>  {{
 round((time() - strtotime($item->created_at)) /86400)
}}    <span>روز</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="card-footer text-center">
                                     <span class="text-white text-center">مشاهده آگهی</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
        <section class="notice-info p-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-sm-none d-md-block d-flex align-item-end ">
                        <img class="image-content img-fluid" src="{{asset("/asset/web/images/201.jpg")}}" alt="">
                    </div>
                    <div class="col-md-8  p-2">
                        <div class="d-flex">
                            <div class="d-inline-block rounded-circle circle-image-background p-3 m-2">
                                <img class="d-block m-auto circle-image" src="{{asset("/asset/web/images/logo.png")}}" alt="">
                            </div>
                            <div class="px-3 d-flex justify-content-center flex-column">
                                <h4 class="text-white">آگهی ساختمان</h4>
                                <span class="d-block subtitle">0 تا 100 لوازم ساختمانی</span>
                            </div>
                        </div>
                        <p class="text-white">
                            امروزه افراد بسیار زیادی هستند که محصول و یا خدمتی برای عرضه دارند و یا اینکه بدنبال خدمات و محصولاتی می گردند و وبسایت آگهی
                            ساختمان می تواند به راحتی این افراد را به یکدیگر برساند. آگهی ساختمان جدای بر آنکه مخاطبین بسیار زیادی دارد، نسبت به سایت های دیگر
                            یک سرمایه گذاری زود بازده بوده و حتی زمان زیادی برای مدیریت آن نیاز ندارد و می تواند به عنوان کار اول و یا حتی دوم و یا سوم شما یک منبع
                            درآمد پرسود و کم ریسک باشد.
                            مطمئنا شما هم مثل ما از آگهی های تکراری و بی حتوا سایت های آگهی و نیاز مندی موجود در ایران خسته شده اید و به دنبال یک وبسایت
                            حرفه ای تر با پشتیبانی معتبر و فیمتی مناسب می گردید.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="last-notices bg-light py-5">
            <div class="container">
                <div class="text-center">
                    <h2 class="underline">آخرین آگهی ها </h2>
                    <a href="{{route('search.notices')}}" class="d-inline-block  p-3">مشاهده همه</a>
                </div>
                <div id="owl-demo" dir="ltr" class="owl-carousel owl-theme">
                    @forelse($noticeitems as $item)
                        <a href="{{route("shownotice",['id'=>$item->id])}}"  >
                            <div class="item">
                                <div dir="rtl" class="card h-100 special-notice">
                                    <div class="position-relative">
                                        <img src="{{  \App\Helper\Utility::pathImage($item->image)}}" class="card-img-top" style="object-fit: cover;height: 250px;">
                                        <div class="summary-title">
                                            <h5 class="px-2">{{$item->title}}</h5>
                                            <div class="bg-dark text-white float-end px-1 ms-auto">
                                                <span>{{count($item->gallerys)}}</span>
                                                <i class="fa fa-camera"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$item->city->name}}</h5>
                                        <span>{{\App\Helper\Utility::limitWords($item->context,15)}}</span>
                                        <p class="card-text">   <i class="fas fa-calendar-day"></i> {{
 round((time() - strtotime($item->created_at)) /86400)
}} <span>روز</span></p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <span class=" text-center text-white ">مشاهده آگهی</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@section("script")
    <script type="text/javascript">
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                loop:true,
                autoplay:true,
                autoplayTimeout:5000,
                autoplayHoverPause:true,
                rtl:false,
                nav:false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:4
                    }
                }
            });
        });
    </script>
@endsection

