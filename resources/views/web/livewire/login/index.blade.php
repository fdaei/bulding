<section class="container">
    <script src="{{asset("vendor/sweetalert/sweetalert.all.js")}}"></script>
    <div class="row d-flex align-items-center vh-100">
        <div class="col-md-6 p-3 ">
            <form wire:submit.prevent="login">
                <div class="mb-3 row">
                    <h1 class="p-4 mb-3 text-center">ورود</h1>
                    <label for="telephone" class="col-sm-2 col-form-label">تلفن همراه</label>
                    <div class="col-sm-10 authInput">
                        <input wire:model="loginTel" type="text" class="form-control border-0 border-bottom rounded-0" id="telephone" placeholder="تلفن همراه را وارد کنید">
                        @error("loginTel")<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">رمز عبور</label>
                    <div class="col-sm-10 authInput">
                        <input wire:model="loginPassword" type="password" class="form-control border-0 border-bottom rounded-0" placeholder="رمز عبور را وارد کنید" id="inputPassword">
                        @error("loginPassword")<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-5">ورود</button>
                </div>
            </form>
            <div class="p-3 text-center">
                <span>ثبت نام نکرده اید؟</span>
                <a href="{{route("register")}}">ثبت نام کنید</a>
            </div>
        </div>
    </div>
    @include("layouts.partial.sweet-alert-script")
    @include('sweetalert::alert')
</section>
