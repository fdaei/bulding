@section('title','پنل مدیریت | اگهی ها')
<div class="bg-white rounded shadow-sm p-3">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="statbox widget box box-shadow w-100">
                <div>
                    <div class="row">
                        <div class=" col-lg-4  mb-2 ">
                            <input type="text" class="form-control" placeholder="جستجوبرحسب نام اگهی" wire:model="name">
                        </div>
                        <div class=" col-lg-4  mb-2 ">
                            <input type="text" class="form-control" placeholder=" جستجوبرحسب کداگهی" wire:model="code">
                        </div>
                        <div class=" col-lg-4  mb-2 ">
                            <input type="text" class="form-control" placeholder=" جستجوبرحسب نام کاربر" wire:model="username">
                        </div>
                    </div>
                    <div class="filter-product row">
                        <div class=" col-lg-4  mb-2 ">
                            <select class="form-control " wire:model="status">
                                <option disabled value="">  وضعیت اگهی را مشخص کنید</option>
                                    <option value="1">ثبت شده</option>
                                <option value="0">لفو شده</option>
                                <option value="2">در حال انتظار</option>
                            </select>
                        </div>
                        <div class="col-lg-4  mb-2">
                            <label>اگهی ویژه </label>
                            <input type="checkbox" class="float-left mt-2" wire:model="changetype" />
                        </div>
                        <div class="col-lg-4">
                            <select class=" form-control" wire:model="changecategory">
                                <option selected value="" >دسته بندی محصولات</option>
                                @forelse($categorys as $item)
                                    <option value={{$item->id}}>{{$item->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>عکس</th>
                            <th>کد آگهی</th>
                            <th>نام</th>
                            <th> نام کاربر</th>
                            <th>دسته بندی</th>
                            <th> نوع آگهی</th>
                            <th> وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td><img style="width: 3em" class="rounded-circle" src={{$item->image? \App\Helper\Utility::pathImage($item->image):asset("asset/web/images/logo.png")}} ></td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$username?$item->phone_number:$item->user->phone_number}}</td>
                                <td>{{$item->category->name}}</td>
                                <td>{{$item->especial?"ویژه":"معمولی"}}</td>
                                <td class="d-flex">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle"  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{$item->status}}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                                            @foreach(\App\Enums\TypeCommentEnum::READ as $key => $value)
                                                <a class="dropdown-item" href="#" wire:click="changeStatus({{$item->id}},{{$key}})">{{$value}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger btn-sm" wire:click="alertConfirm({{$item->id}})" >
                                        <span class="fa fa-trash"></span>
                                    </button>
                                    <a type="button" class="btn btn-outline-warning btn-sm" href="{{route('operator.notice.show',['id'=>$item->id])}}">
                                        <span class="fa fa-eye"></span>
                                    </a>
                                    <span class="dropdown">
                                        <button class="btn btn-outline-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <span class="fa fa-pencil"></span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{route('operator.notice.update',['id'=>$item->id])}}">ویرایش آگهی </a>
                                            <a class="dropdown-item" href="{{route('operator.noticefeature.update',['id'=>$item->id])}}">ویرایش مشخصه های آگهی</a>
                                        </div>
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <p>اطلاعاتی جهت نمایش وجود ندارد.</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{$items->links()}}
            </div>
        </div>
    </div>
</div>
