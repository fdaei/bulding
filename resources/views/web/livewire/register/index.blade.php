 <div class="container">
    <div class="row d-flex align-items-center vh-100">
        <div class="col-md-6 p-3 ">
            <form wire:submit.prevent="registerUser">
                <div class="mb-3 row">
                    <h1 class="p-4 mb-3 text-center">ثبت نام</h1>
                    <label for="name" class="col-sm-2 col-form-label">نام</label>
                    <div class="col-sm-10 authInput">
                        <input wire:model="name" type="text" class="form-control border-0 border-bottom rounded-0" placeholder="نام خود را وارد کنید" id="name">
                        @error("name")<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="telephone" class="col-sm-2 col-form-label">تلفن همراه</label>
                    <div class="col-sm-10 authInput">
                        <input wire:model="tel" type="text" class="form-control border-0 border-bottom rounded-0" id="telephone" placeholder="تلفن همراه را وارد کنید">
                        @error("tel")<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">رمز عبور</label>
                    <div class="col-sm-10 authInput">
                        <input wire:model="password" type="password" class="form-control border-0 border-bottom rounded-0" placeholder="رمز عبور را وارد کنید" id="inputPassword">
                        @error("password")<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="confirmPassword" class="col-sm-2 col-form-label">تایید رمز عبور</label>
                    <div class="col-sm-10 authInput">
                        <input  wire:model="passwordConfirmation" type="password" class="form-control border-0 border-bottom rounded-0" placeholder="رمز عبور را تکرار کنید" id="confirmPassword">
                        @error("passwordConfirmation")<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-5">ثبت نام</button>
                </div>
            </form>
            <div class="p-3 text-center">
                <span>قبلا ثبت نام کرده اید؟</span>
                <a href="{{route("login")}}">وارد شوید</a>
            </div>
        </div>
    </div>
 </div>
