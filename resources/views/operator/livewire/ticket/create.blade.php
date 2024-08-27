@section('title','پنل مدیریت | ثبت تیکت ها ')
<div class="bg-white rounded shadow-sm p-3">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-3">
        <div class="row">
            <div class="statbox widget box box-shadow w-100">
                <form wire:submit.prevent="insert">
                    <div class="form-row">
                        <div class="col-md-6 mb-4">
                            <label for="first_name">عنوان<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" wire:model="model.title">
                            @error('model.title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="last_name">الویت<span class="text-danger">*</span></label>
                            <select class="js-example-basic-multiple form-control"
                                    wire:model="model.priority">
                                <option>انتخاب کنید</option>
                                @foreach(\App\Enums\PriorityEnum::READ as  $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            @error('model.priority')<span class="text-danger" >{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label>ارسال به:</label>
                            <div class="form-check" wire:change="visible()" >
                                <input class="form-check-input" type="radio" name="flexRadioDefault" value="همه" checked>
                                <span class="form-check-label ml-5" for="flexRadioDefault1">
                                   همه
                                </span>
                                <input class="form-check-input " type="radio" name="flexRadioDefault" value="انتخاب شخص" >
                                <span class="form-check-label" for="flexRadioDefault2">
                                  انتخاب شخص
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <select class="js-example-basic-multiple form-control" name="states[]" multiple="multiple"  {{$hidden?"visible":"hidden"}} wire:model="users_id" >
                                @forelse($users as $user)
                                    <option value={{$user->id}}>
                                        {{$user->phone_number}} - {{$user->first_name}}{{$user->last_name}}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-12 mt-4">
                            <textarea class="form-control" style="height: 35vh"
                                      wire:model="model.message" >
                            </textarea>
                            @error('model.message')<span class="text-danger" >{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 mt-4">
                            <label class="form-label" for="attachFile"><i class="fal fa-upload me-2"></i>افزودن فایل</label>
                            @if($file)
                                <i wire:loading.remove class="far fa-check text-success"></i>
                            @endif
                            <div wire:loading wire:target="file">
                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <input wire:model="file" class="form-control" type="file" id="attachFile">
                        </div>
                        <div class=" col-sm-12 form-group mb-4  justify-content-start">
                            <button class="btn btn-outline-info m-2 px-3" type="submit">
                               ارسال
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
