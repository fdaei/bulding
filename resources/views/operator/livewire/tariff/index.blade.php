@section('title','پنل مدیریت | تعرفه ها')
<div class="bg-white rounded shadow-sm p-3">
    <div class="container mt-3">
        <div class="row">
            <div class="statbox widget box box-shadow w-100">
                <form wire:submit.prevent={{$update_mode?"update":"insert"}}>
                    @csrf
                    <legend>اطلاعات تعرفه</legend>
                    <hr>
                    <div class="alert bootstrap-new-warning" role="alert">
                        برای ثبت تعرفه با مدت بینهایت عدد -1 را وارد کنید
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 ">
                            <label for="time">مدت زمان<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input type="text"  class="form-control" wire:model="model.time">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">روز</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <label for="price">قیمت<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                            <input type="text" class="form-control" wire:model="model.price">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">تومان</span>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <label for="price">تمدید<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" wire:model="model.revival">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">تومان</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1" id="click">
                            <label for="status"> اگهی ویژه</label>
                            <input wire:model="model.notice_type" type="checkbox" id="switch" class="input-switch" /><label class="label-switch" for="switch">Toggle</label>
                            @error('model.notice_type')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-2 justify-content-start p-2 mt-4">
                            <button class="btn btn-outline-info " type="submit">{{$update_mode?"ویرایش تعرفه":"ثبت تعرفه"}}</button>
                        </div>
                        <div class="col-md-3 text-right">                      @error('model.time')<span class="text-danger">{{ $message }}</span>@enderror</div>
                        <div class="col-md-3 text-right">
                            @error('model.price')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-3 text-right">
                            @error('model.revival')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </form>
            </div>
            <table class="table mt-2">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>زمان</th>
                    <th>نوع اگهی</th>
                    <th>قیمت</th>
                    <th>تمدید</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>

                            @if($item->time == -1)
                            &infin;
                            @else
                                {{$item->time}}
                            @endif
                        </td>
                        <td>{{$item->notice_type?"ویژه":"معمولی"}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->revival}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle"  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$item->status?"فعال":"غیرفعال"}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                                    <a class="dropdown-item" wire:click="changestatus({{$item->id}},{{1}})">فعال</a>
                                    <a class="dropdown-item" wire:click="changestatus({{$item->id}},{{0}})">غیرفعال</a>
                                </div>
                            </div>
                        <td>
                            <a class="btn btn-outline-info btn-sm" wire:click="edit({{$item->id}})">
                        <span class="fa fa-pencil">
                        </span>
                            </a>
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
    </div>
</div>

