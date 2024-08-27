<header class="top-content">
    <div class="top-header">
        <div class="container d-none d-lg-flex justify-content-between align-items-center">
            @if(\Illuminate\Support\Facades\Auth::guest())
                <div class="d-flex align-items-center">
                    <a class="text-center text-white p-2" href="{{route("login")}}">
                        <i class="fal fa-sign-in"></i>
                        <span>ورود</span>
                    </a>
                    <a class="text-center text-white p-2 ms-2" href="{{route("register")}}">
                        <i class="fal fa-plus"></i>
                        <span>ثبت نام</span>
                    </a>
                </div>
            @else
                <a class="text-white d-flex align-items-center" href="{{route("user.dashboard")}}">
                    <i class="fal fa-user-circle p-2"></i>
                    <span>ورود به پنل</span>
                </a>
            @endif
        </div>
        <div class="d-flex justify-content-end d-lg-none px-2 py-1 " >
            <a class="navbar-brand mx-auto" href="{{route("home")}}"><img style="height: 50px;" src="{{asset("/asset/web/images/logo.png")}}" alt="logo"></a>
            <button id="sidebar-button" onclick="openNav(this)" class="text-white btn border-white">
                <i class="fas fa-bars"></i>
            </button>
            <div id="sidebar-menu" class="position-fixed sidebar-menu col-8 col-sm-6 col-md-5">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-default text-secondary" onclick="closeNav()">
                        <i class="fal fa-times" ></i>
                    </button>

                </div>
                <ul class="list-group text-center li-container">
                    <li class="list-group-item p-0"><a class="d-block px-3 py-2" href="{{route('home')}}" >صفحه اصلی</a></li>
                    <li class="list-group-item p-0"><a class="d-block px-3 py-2" href="#">وبلاگ</a></li>
{{--                    <li class="list-group-item p-0"><a class="d-block px-3 py-2" href="#">درباره ما</a></li>--}}
                    <li class="list-group-item p-0"><a class="d-block px-3 py-2" href="{{route('contactus')}}">تماس با ما</a></li>
                </ul>
                <div class="d-flex flex-column align-items-center ms-auto p-3">
                    <a href="{{route("notice-create-category")}}" class=" create-notice rounded px-3 py-2 my-3">
                        <i class="fas fa-plus"></i>
                        <span>ثبت آگهی</span>
                    </a>
                    <button id="category-toggler" class="btn text-primary rounded px-3 py-2 my-3 category">
                        <i class="fas fa-align-justify"></i>
                        <span>دسته بندی ها</span>
                    </button>
                </div>
                    <ul class="list-group category-list">
                        @forelse(\App\Models\Category::where("parent_id" , null)->get() as $item)
                                @if($item->children->count() <> 0)
                                    <li class="list-group-item p-3">{{$item->name}}
                                    <i class="fal fa-chevron-down float-end rotate-0"></i>
                                    @include("layouts.web.partial.category-child-finder" , $item->children)
                                    @else
                                    <li wire:click="ShowNotices({{$item->id}})" class="list-group-item p-3 cursor-pointer">{{$item->name}}
                                @endif
                            </li>
                        @empty
                        @endforelse
                    </ul>
                <div class="d-flex justify-content-center flex-column align-items-center">
                    @if(\Illuminate\Support\Facades\Auth::guest())
                        <div class="d-flex align-items-center mt-3">
                            <a class="text-center text-dark p-2" href="{{route("login")}}">
                                <i class="fal fa-sign-in"></i>
                                <span>ورود</span>
                            </a>
                            <a class="text-center text-dark p-2 ms-2" href="{{route("register")}}">
                                <i class="fal fa-plus"></i>
                                <span>ثبت نام</span>
                            </a>
                        </div>
                    @else
                        <a class="text-white d-flex align-items-center my-3" href="{{route("user.dashboard")}}">
                            <i class="fal fa-user-circle p-2 text-primary"></i>
                            <span class="text-primary">ورود به پنل</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="banner p-1 pb-3">
        <div class="container">
            <div class="d-none d-lg-block">
                <nav class="navbar navbar-expand-lg navbar-light bg-light mt-5">
                    <a class="navbar-brand" href="{{route("home")}}"><img src="{{asset("/asset/web/images/logo.png")}}" alt="logo"></a>
                    <div class="collapse navbar-collapse text-center" id="navbarNav">
                        <ul class="navbar-nav">
                            @forelse($header as $item)
                            <li class="nav-item">
                                <a class="nav-link {{$item['is_active']}} mx-2" href="{{$item['link']}}">{{$item['title']}}</a>
                            </li>
                            @empty
                            @endforelse
                        </ul>

                        <div class="d-flex justify-content-center ms-auto p-3">
                            <a href="{{route("notice-create-category")}}" class="rounded px-3 py-2 mx-3 btn-outline-blue">
                                <i class="fas fa-plus"></i>
                                <span>ثبت آگهی</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            @if($currentUrl=='home')
                <div class="text-center mt-5 pt-5 text-white" style="padding-bottom: 140px;padding-top: 140px">
                    <h1>آگهی نامه صنعت ساختمان</h1>
                    <h4>از ایده تا اجرا</h4>
                </div>
                <form action="{{route("search.notices",['id'=>$category_id])}}" method="get" class="m-3">
                    <div class="row pb-5">
                        <div class="col-lg-5 mb-3 d-flex align-items-center"  >
                            <input name="Adv" type="text" class="form-control py-2" placeholder="جستوجو در همه آگهی ها">
                        </div>
                        <div class="col-lg-2 mb-3 d-flex align-items-center" >
                            <select   class="form-select py-2" name="state">
                                <option value="">استان ها</option>
                                @forelse($states as $item)
                                    <option value={{$item->id}}>{{$item->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-3 mb-3 d-flex align-items-center">
                            <select  wire:click="select_category($event.target.value)" class="form-select py-2">
                                <option value="">تمامی  دسته ها </option>
                                @forelse($categories as $item)
                                    <option value={{$item->id}}>{{$item->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-2 text-center">
                            <button class="btn btn-outline-blue form-control " type="submit" >جست وجو</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</header>
@section("script")

@endsection
