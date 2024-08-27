@section('title','پنل مدیریت | تغییر رمز عبور')
<div class="bg-white rounded shadow-sm p-3">
    <div class="container">
        <form wire:submit.prevent="update">
            @csrf
            <div class="row mb-3 justify-content-center">
                <div class="col-12 mb-3" style="text-align: center">
                <label for="currentPassword">کلمه عبور فعلی<span class="text-danger">*</span></label>
                    <input wire:model="currentPassword" class="form-control col-5 mx-auto " type="password" id="currentPassword" >
                    @error('currentPassword') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 mb-3" style="text-align: center">
                    <label for="newPassword" >کلمه عبور جدید<span class="text-danger">*</span></label>
                    <input wire:model="newPassword" class="form-control col-5 mx-auto" type="password" id="newPassword">
                    @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 mb-3" style="text-align: center">
                    <label for="newPassword">تکرار کلمه عبور<span class="text-danger">*</span></label>
                    <input wire:model="confirmationPassword" class="form-control col-5 mx-auto" type="password" id="newPassword">
                    @error('confirmationPassword') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="d-flex ">
                <button type="submit" class="btn btn-outline-info mx-auto">اعمال تغییرات</button>
            </div>
        </form>
    </div>
</div>
