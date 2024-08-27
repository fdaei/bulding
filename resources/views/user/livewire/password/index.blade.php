@section('title','پنل کاربری | تغییر رمز عبور')
<div class="container">
    <div class="d-flex justify-content-end px-5 mb-3">
        <div class="p-3 bg-c-yellow rounded-bottom shadow-sm ">
            <span class="px-5 text-white ">تغییر رمز عبور</span>
        </div>
    </div>
    <form class="p-3" wire:submit.prevent="update">
        @csrf
        <div class="mb-3 row">
            <label for="currentPassword" class="col-sm-2 col-form-label">کلمه عبور فعلی<span class="text-danger">*</span></label>
            <div class="col-sm-10 authInput">
                <input wire:model="currentPassword" type="password" class="form-control border-0 border-bottom rounded-0" placeholder="رمز عبور فعلی را وارد کنید" id="currentPassword">
                @error("currentPassword")<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="newPassword" class="col-sm-2 col-form-label">کلمه عبور جدید<span class="text-danger">*</span></label>
            <div class="col-sm-10 authInput">
                <input wire:model="newPassword" type="password" class="form-control border-0 border-bottom rounded-0" placeholder="رمز عبور جدید را وارد کنید" id="newPassword">
                @error("newPassword")<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="confirmationPassword" class="col-sm-2 col-form-label">تکرار کلمه عبور<span class="text-danger">*</span></label>
            <div class="col-sm-10 authInput">
                <input wire:model="confirmationPassword" type="password" class="form-control border-0 border-bottom rounded-0" placeholder="رمز عبور جدید را تکرار کنید" id="confirmationPassword">
                @error("confirmationPassword")<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="d-flex justify-content-start">
            <button type="submit" class="btn btn-outline-info">اعمال تغییرات</button>
        </div>
    </form>
</div>
