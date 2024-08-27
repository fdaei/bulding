@section('title','پنل مدیریت | ورود به پنل اپراتور ')
<div>
    <div class="bg-light border rounded shadow-sm p-4 text-right mt-4">
        <form wire:submit.prevent="login">
            @csrf
            <div class="form-group">
                <label for="username">نام کاربری</label>
                <input type="text" class="form-control" name="username" id="username" wire:model="username">
                @error('username')<span class="text-danger">{{$message}}</span>@enderror
            </div>
            <div class="form-group">
                <label for="password">گذرواژه</label>
                <input type="password" class="form-control" name="password" id="password" wire:model="password">
                @error('password')<span class="text-block text-danger">{{$message}}</span>@enderror
            </div>
            <button class="btn btn-primary btn-sm">ارسال</button>
        </form>
    </div>
</div>
