@section('description','سایت ثبت آگهی اولین آگهی نامه صنعت ساختمان کرمان می باشد. جهت درج آگهی رایگان ساختمانی در کرمان اقدام نمایید ')
@section('title',' آگهی نامه صنعت ساختمان|'.config('app.name'))
<div class="multi-page py-3">
    <div class="container-fluid">
        <div class="row">
            <aside class="col-md-4 d-none d-md-block">
                <div class="container">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="جستجو" aria-describedby="basic-addon2" wire:model="input_search">
                        <div class="input-group-append">
                        </div>
                    </div>
                    <p class="sidebar-multi"><b>دسته بندی آگهی ها</b></p>
                    <div class="list-group border mb-3">
                        @forelse($roots as $key => $value)
                            <input type="button" class="list-group-item  main-title-list" value="{{$value->name}}"  name="{{$key}}" onclick="myFunction()" />
                            <ul class="sub-menu{{$key}}" style="display: none">
                                <li class=" d-flex justify-content-between p-2 cursor-pointer" wire:click="parent({{$value->id}})" >
                                    نمایش همه
                                </li>
                                @forelse($value->children as $item)
                                    <li class=" d-flex justify-content-between p-2 cursor-pointer" wire:click="changesidebar({{$item->id}})">
                                        {{$item->name}}
                                        <span>({{ \App\Http\Livewire\Web\EspecialWire::countn($item->id)}})</span>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        @empty
                        @endforelse
                    </div>
                    <p class="sidebar-multi"><b>دسته بندی بر حسب شهر</b></p>
                    <div class="mb-3">
                        <div class="d-flex">
                            <select class="p-2 m-1 form-control" wire:model="searchstate" wire:change="selectstate">
                                <option value=""> استان خود را انتخاب کنید </option>
                                @if($states)
                                    @forelse($states as $item)
                                        <option value="{{$item->id}}" >{{$item->name}}</option>
                                    @empty
                                    @endforelse
                                @endif
                            </select>
                        </div>
                        <div class="d-flex">
                            <select class=" p-2 m-1 form-control" wire:model="searchcity" wire:change="selectcity">
                                <option value=""> شهر خود را انتخاب نمایید </option>
                                @if($cities)
                                    @forelse($cities as $item)
                                        <option value="{{$item->id}}" >{{$item->name}}</option>
                                    @empty
                                    @endforelse
                                @endif
                            </select></div>
                        <div>
                            <br/>
                            @if($searchcity||$choice||$searchstate)
                                <label class="mt-2">فیلتر ها :</label>
                            @endif
                            @if($searchstate)
                                <span class="badge bg-danger m-1 p-1">
                                    {{\App\Models\State::find($searchstate)->name}}
                                  <i class="fas fa-times cursor-pointer" wire:click={{"statefilter()"}}></i>
                                </span>
                            @endif
                            @if($searchcity)
                                <span class="badge bg-danger m-1 p-1">
                                    {{\App\Models\City::find($searchcity)->name}}
                                  <i class="fas fa-times cursor-pointer" wire:click={{"cityfilter()"}}></i>
                                </span>
                            @endif
                            @if($choice)
                                @forelse(\App\Models\Category::descendantsAndSelf($choice->id) as $i=>$item)
                                    @if($item->id==$delete && $i>0)
                                        @break
                                    @else
                                        <span class="badge bg-danger p-1 m-1">
                                        {{$item->name}}
                                   <i class="fas fa-times cursor-pointer" wire:click="categoryfilter({{$item->id}})"></i>
                                    </span>
                                    @endif
                                @empty
                                @endforelse
                            @endif
                        </div>
                    </div>
                </div>
            </aside>
            <div class="col-md-8">
                <div class="container">
                    <div class="row">
                        @if($items)
                            @forelse($items as $item)
                                <div class="col-md-6 col-sm-12 col-lg-4 mb-3">
                                    <a  href="{{route("shownotice",['id'=>$item->id])}}" >
                                    <div dir="rtl" class="card h-100 special-notice">
                                        <div class="position-relative">
                                            <img src="{{  \App\Helper\Utility::pathImage($item->image)}}" class="card-img-top" alt="special-ad" style="height: 250px;object-fit: cover" >
                                            <div class="summary-title">
                                                <h5 class="px-2">{{$item->title}}</h5>
                                                <div class="bg-dark text-white float-end px-1 ms-auto">
                                                    <span>{{count($item->gallerys)}}</span>
                                                    <i class="fa fa-camera"></i>
                                                </div>
                                            </div>
                                            {!!  $item->especial? "     <div class='special-label'>
                                               <div> ویژه</div>
                                            </div>": ""!!}
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{$item->city->name}}</h5>
                                            <span>{{\App\Helper\Utility::limitWords($item->context,15)}}</span>
                                            <p class="card-text">
                                                <i class="fas fa-calendar-day"></i>  {{
 round((time() - strtotime($item->created_at)) /86400)
}}    <span>روز</span></p>
                                        </div>
                                        <span class="btn form-control card-footer">مشاهده آگهی</span>
                                    </div>
                                    </a>
                                </div>
                            @empty
                                <div>
                                    <P>اطلاعاتی جهت نمایش وجود ندارد.</P>
                                </div>
                            @endforelse
                            {{$items->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section("script")
    <script>
        function myFunction() {
            console.log("45678");
            $address=".sub-menu"+event.target.name;
            $($address).slideToggle("slow");
        }

    </script>
@endsection

