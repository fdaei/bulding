@section('title',' پنل مدیریت | ثبت کاربران')
<div class="bg-white rounded shadow-sm p-3">
    <div class="container mt-3">
        <div class="row">
            <div class="statbox widget box box-shadow w-100">
                <form wire:submit.prevent={{$update_mode?"update":"insert"}}>
                    @csrf
                        <legend>اطلاعات فردی</legend>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="first_name">نام<span class="text-danger">*</span></label>
                                <input type="text"  class="form-control" wire:model="model.first_name">
                                @error('model.first_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="last_name">نام خانوادگی</label>
                                <input type="text"  class="form-control" wire:model="model.last_name">
                                @error('model.last_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="phone_number"><span class="text-danger">*</span>شماره موبایل</label>
                                <input type="text" class="form-control" wire:model="model.phone_number">
                                @error('model.phone_number')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="email">ایمیل</label>
                                <input type="text"  class="form-control"
                                       wire:model="model.email">
                                @error('model.email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="instagram">اینستاگرام</label>
                                <input type="text"  class="form-control"
                                       wire:model="model.instagram" placeholder="مثال:fgpersian">
                                @error('model.instagram')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="website">وب سایت</label>
                                <input type="text"  class="form-control"
                                       wire:model="model.website" placeholder="مثال:https:/fgpersian.com">
                                @error('model.website')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="password">رمزعبور<span class="text-danger">*</span></label>
                                <input type="text"  class="form-control"
                                       wire:model="password"/>
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-4 mb-4" id="click">
                                <label for="status">وضعیت</label>
                                <input wire:model="model.status" type="checkbox" id="switch" class="input-switch" /><label class="label-switch" for="switch">Toggle</label>
                                @error('model.status')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                                <div class=" col-sm-12 form-group mb-4  justify-content-start">
                                    <button class="btn btn-outline-info m-2 px-3" type="submit">
                                        {{$update_mode?"ویرایش کاربر":"ثبت کاربر"}}
                                    </button>
                                </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
