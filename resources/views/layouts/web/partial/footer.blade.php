<footer class="bg-dark mt-4 text-white">
    <div class="container">
        <div class="row p-5">
            <div class="col-md-3">
                <div class="border-bottom">
                    <h4>آگهی ساختمان</h4>
                </div>
                <p class="text-white p-3">
                    امروزه افراد بسیار زیادی هستند که محصول و یا خدمتی برای عرضه دارند و یا اینکه بدنبال خدمات و محصولاتی می گردند و وبسایت آگهی ساختمان می تواند به راحتی این افراد را به یکدیگر برساند.
                </p>
            </div>
            <div class="col-md-3">
                <div class="border-bottom">
                    <h4>
                        دسترسی سریع
                    </h4>
                </div>
                <ul class="list-group footer-links">
                    <li class="list-group-item"><a href="{{route('home')}}" class="hover-underline-animation">صفحه اصلی</a></li>
                    <li class="list-group-item"><a href="" class="hover-underline-animation">وبلاگ</a></li>
                    <li class="list-group-item"><a href="" class="hover-underline-animation">درباره ما</a></li>
                    <li class="list-group-item"><a href="{{route('contactus')}}" class="hover-underline-animation">تماس با ما</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <div class="border-bottom">
                    <h4 >نماد اعتماد الکترونیکی</h4>
                </div>
                <img class="e-namad img-fluid" src="{{asset("/asset/web/images/e-namad.png")}}" alt="enamad">
            </div>
            <div class="col-md-3">
                <div class="border-bottom">
                    <h4>راه های ارتباطی</h4>
                </div>
                <ul class="list-group follow-us">
                    @forelse($footer as $item)
                    <li class="list-group-item">
                        <i class="text-white {{$item["icon"]}} me-2"></i>
                            <span class="text-white">{{$item['title']}}</span>
                        <a class="hover-underline-animation text-white" href="{{($item['check'] == "tel")? "tel:".$item["value"] : ( ($item['check'] == "email")? "mailto:".$item["value"] : "https://www.instagram.com/".$item["value"] ) }}" class="text-white">{{$item['value']}}</a>
                    </li>
                    @empty
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="d-flex justify-content-lg-center">
        </div>
        <div class="border-top d-flex justify-content-center flex-column align-items-center py-4">
            <p class="text-white">
                تمامی حقوق این وب سایت متعلق به شرکت می باشد.
            </p>
            <p>
                <a href="https://www.fgpersian.com" class="text-white hover-underline-animation">طراحی توسط شرکت فروغ گستر</a>
            </p>
            <span class="text-white">{{date('Y')}}<span class="px-1">&#169;</span></span>
        </div>
    </div>
</footer>
