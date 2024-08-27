@section('title','پنل مدیریت | اطلاعات حساب')
<div class="bg-white rounded shadow-sm p-3">
    <div class="container">
        <form wire:submit.prevent="update">
            @csrf
            <div class="row mb-3">
                <div class="col-sm-6 mb-3">
                    <label for="fname" >نام<span class="text-danger">*</span></label>
                    <input wire:model="model.first_name" type="text" id="fname" class="form-control">
                    @error('model.first_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="lname" class="form-label" >نام خانوادگی<span class="text-danger">*</span></label>
                    <input wire:model="model.last_name" type="text" id="lname" class="form-control">
                    @error('model.last_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="username" class="form-label" >نام کاربری<span class="text-danger">*</span></label>
                    <input wire:model="model.username" type="text" id="username" class="form-control">
                    @error('model.username') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="email" class="form-label" >ایمیل<span class="text-danger">*</span></label>
                    <input wire:model="model.email" type="text" id="email" class="form-control">
                    @error('model.email') <span class="text-danger">{{ $message }}</span> @enderror

                </div>
                <div class="col-sm-6 mb-3">
                    <label for="tel" class="form-label" >تلفن همراه<span class="text-danger">*</span></label>
                    <input wire:model="model.phone_number" type="tel" id="tel" class="form-control">
                    @error('model.phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <button type="submit" class="btn btn-outline-info">اعمال تغییرات</button>
            </div>
        </form>
    </div>
</div>
