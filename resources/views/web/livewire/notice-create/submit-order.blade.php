@section("title" , config('app.name')."  | ثبت سفارش")
<div class="container p-3">
    @include("layouts.web.partial.wizard")
    @if(\Illuminate\Support\Facades\Auth::guest())
        <div class="row p-3">
            <form wire:submit.prevent="login" class="col-lg-6 p-3 border rounded bg-light mb-3 shadow-sm">
                <div class="mb-3 row">
                    <h1 class="p-4 mb-3 text-center">ورود</h1>
                    <label for="telephone" class="col-sm-2 col-form-label">تلفن همراه</label>
                    <div class="col-sm-10 authInput">
                        <input wire:model.defer="loginTel" type="text" class="form-control border-0 border-bottom rounded-0" id="telephone" placeholder="تلفن همراه را وارد کنید">
                        @error("loginTel")<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">رمز عبور</label>
                    <div class="col-sm-10 authInput">
                        <input wire:model.defer="loginPassword" type="password" class="form-control border-0 border-bottom rounded-0" placeholder="رمز عبور را وارد کنید" id="inputPassword">
                        @error("loginPassword")<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-5">ورود</button>
                </div>
            </form>
            <form wire:submit.prevent="register" class="col-lg-6 border rounded bg-light p-3 mb-3 shadow-sm">
                <div class="mb-3 row ">
                    <h1 class="p-4 mb-3 text-center">ثبت نام</h1>
                    <label for="name" class="col-sm-2 col-form-label">نام</label>
                    <div class="col-sm-10 authInput">
                        <input wire:model.defer="name" type="text" class="form-control border-0 border-bottom rounded-0" placeholder="نام خود را وارد کنید" id="name">
                        @error("name")<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="telephone" class="col-sm-2 col-form-label">تلفن همراه</label>
                    <div class="col-sm-10 authInput">
                        <input wire:model.defer="tel" type="text" class="form-control border-0 border-bottom rounded-0" id="telephone" placeholder="تلفن همراه را وارد کنید">
                        @error("tel")<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">رمز عبور</label>
                    <div class="col-sm-10 authInput">
                        <input wire:model.defer="password" type="password" class="form-control border-0 border-bottom rounded-0" placeholder="رمز عبور را وارد کنید" id="inputPassword">
                        @error("password")<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="confirmPassword" class="col-sm-2 col-form-label">تایید رمز عبور</label>
                    <div class="col-sm-10 authInput">
                        <input  wire:model.defer="passwordConfirmation" type="password" class="form-control border-0 border-bottom rounded-0" placeholder="رمز عبور را تکرار کنید" id="confirmPassword">
                        @error("passwordConfirmation")<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-5">ثبت نام</button>
                </div>
            </form>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 p-3 border rounded shadow-sm">
            <div class="table-responsive">
                <table class="table bg-light">
                    <thead class="table-dark">
                    <tr class="text-center">
                        <th colspan="2">اطلاعات آگهی</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(session()->has("noticeData"))
                            <tr>
                                <td><i class="fal fa-cubes me-2"></i>دسته بندی</td>
                                <td>{!! \App\Models\Category::find(session()->get("noticeData.category_id"))->fullTitle  !!}</td>
                            </tr>
                            <tr>
                                <td><i class="fal fa-pen-nib me-2"></i>عنوان آگهی</td>
                                <td>
                                    {{session()->get("noticeData.title")}}
                                    @if(session()->get("noticeData.special"))
                                        <span class="badge bg-warning">آگهی ویژه</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fal fa-align-right me-2"></i>توضیحات آگهی</td>
                                <td>
                                    <p>
                                        {{session()->get("noticeData.context")}}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fal fa-location me-2"></i>استان / شهر</td>
                                <td>
                                    {{ session()->get("noticeData.city_id")?\App\Models\City::find(session()->get("noticeData.city_id"))->name:""}}
                                    /
                                    {{session()->get("noticeData.state_id")?\App\Models\State::find(session()->get("noticeData.state_id"))->name:""}}
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fal fa-map me-2"></i>آدرس</td>
                                <td>{{session()->get("noticeData.address")}}</td>
                            </tr>
                            <tr>
                                <td><i class="fal fa-stopwatch me-2"></i>مدت زمان آگهی</td>
                                <td>
                                    @if(session()->get("noticeData.time") <> -1)
                                    {{session()->get("noticeData.time")}}روز
                                    @else
                                    &infin;
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fal fa-dollar-sign me-2"></i>مبلغ قابل پرداخت</td>
                                <td>{{number_format(session()->get("noticeData.price"))}} تومان</td>
                            </tr>
                            <tr class="bg-dark">
                                <td class="text-white text-center" colspan="2">مشخصه های آگهی</td>
                            </tr>
                            @if(session()->get("featureData"))
                                @forelse(session()->get("featureData") as $pointer => $item)
                                    @if($pointer <> "checkbox")
                                        @forelse($item as $key => $value)
                                            <tr>
                                                <td>{{\App\Models\CategoryFeature::find($key)->name}}</td>
                                                <td>{{$value}}</td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    @else
                                        @forelse($item as $key => $value)
                                            <tr>
                                                <td>{{\App\Models\CategoryFeature::find($key)->name}}</td>
                                                <td>
                                                    @forelse($value as $val)
                                                        {{$val}}
                                                        @if(!$loop->last)
                                                            <span>/</span>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                </td>
                                        @empty
                                        @endforelse
                                            </tr>
                                    @endif
                                @empty
                                @endforelse
                            @else
                                <tr>
                                    <td>هیچ مشخصه ای ثبت نشده است.</td>
                                </tr>
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <a href="{{route("notice-tariff")}}" class="btn btn-secondary">مرحله قبل</a>
        <button wire:click="submitOrder" class="btn btn-info">ثبت سفارش</button>
    </div>
</div>
