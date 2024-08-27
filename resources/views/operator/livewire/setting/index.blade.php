@section('title','پنل مدیریت | تنظیمات')
<div class="bg-white rounded shadow-sm p-3">
    <div class="container">
        <form wire:submit.prevent="createOrUpdate">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="instagram">اینستاگرام</label>
                    <input wire:model="instagram" class="form-control" type="text" id="instagram" placeholder="username">
                    @error('instagram') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tel">تلفن</label>
                    <input wire:model="tel" class="form-control" type="text" id="tel"  placeholder="مثال:09*********">
                    @error('tel') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email">ایمیل</label>
                    <input  wire:model="email" class="form-control" type="text" id="email"  placeholder="@example.com">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <button type="submit" class="btn btn-outline-info">اعمال تغییرات</button>
            </div>
        </form>
    </div>
</div>
