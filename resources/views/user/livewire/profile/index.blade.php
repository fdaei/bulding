@section('title','پنل کاربری | پروفایل')
<div class="container">
    <div class="d-flex justify-content-end px-5  mb-3">
        <div class="p-3 bg-c-yellow alert-success rounded-bottom shadow-sm ">
            <span class="px-5 text-white ">پروفایل</span>
        </div>
    </div>
    <form class="p-3" wire:submit.prevent="insert">
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">نام</label>
            <div class="col-sm-10 authInput">
                <input wire:model="model.first_name" type="text" class="form-control border-0 border-bottom rounded-0" placeholder="نام خود وارد کنید" id="name">
                @error("model.first_name")<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="lastName" class="col-sm-2 col-form-label">نام خانوادگی</label>
            <div class="col-sm-10 authInput">
                <input wire:model="model.last_name" type="text" class="form-control border-0 border-bottom rounded-0" placeholder="نام خانوادگی را وارد کنید" id="lastName">
                @error("model.last_name")<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="tel" class="col-sm-2 col-form-label">تلفن همراه</label>
            <div class="col-sm-10 authInput">
                <input wire:model="model.phone_number" type="text" class="form-control border-0 border-bottom rounded-0" placeholder="تلفن همراه خود را وارد کنید" id="tel">
                @error("model.phone_number")<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">ایمیل</label>
            <div class="col-sm-10 authInput">
                <input wire:model="model.email" type="text" class="form-control border-0 border-bottom rounded-0" placeholder="ایمیل خود را وارد کنید" id="email">
                @error("model.email")<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="instagram" class="col-sm-2 col-form-label">اینستاگرام</label>
            <div class="col-sm-10 authInput">
                <input wire:model="model.instagram" type="text" class="form-control border-0 border-bottom rounded-0" placeholder="آیدی اینستاگرام خود را وارد کنید" id="instagram">
                @error("model.instagram")<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="instagram" class="col-sm-2 col-form-label">
                تصویر
                @if($image)
                    <i wire:loading.remove wire:target="image" class="far fa-check text-success"></i>
                @endif
                <div wire:loading wire:target="image">
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </label>
            <div class="col-sm-10 authInput">

                <input wire:model="image" type="file" class="form-control border-0 border-bottom rounded-0" placeholder="لطفا تصویر خود را اپلود کنید" id="img">

                @error("image")<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="website" class="col-sm-2 col-form-label">وبسایت</label>
            <div class="col-sm-10 authInput">
                <input wire:model="model.website" type="text" class="form-control border-0 border-bottom rounded-0" placeholder="وبسایت خود را وارد کنید" id="website">
                @error("model.website")<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="d-flex justify-content-center justify-content-lg-start m-3">
            <button type="submit" class="btn btn-success px-5">اعمال تغییرات</button>
        </div>
    </form>
</div>
