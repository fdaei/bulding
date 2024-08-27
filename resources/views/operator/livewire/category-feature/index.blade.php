@section('title','پنل مدیریت | مشخصه دسته بندی ')
<div class="bg-white rounded shadow-sm p-3">
    <div class="container">
        <div class="row">
            <div class="statbox widget box box-shadow w-100">
                <form wire:submit.prevent="{{$update_mode ? 'update' : 'insert'}}">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-4">
                            <label for="name">نام<span class="text-danger">*</span></label>
                            <input type="text" id="name" class="form-control" wire:model="model.name">
                            @error('model.name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="type">نوع<span class="text-danger">*</span></label>
                            <select  wire:model="type" id="type" class="form-control">
                                <option value=""  selected>--انتخاب کنید--</option>
                                <option value="0">متن</option>
                                <option value="1">لیست انتخابی</option>
                                <option value="2">رادیو</option>
                                <option value="3">چک باکس</option>
                            </select>
                            @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        @if($type !=null &&$type == \App\Enums\InputTypeEnum::text)
                        <div class="col-md-6">
                            <label for="prefix">پیشوند</label>
                            <input wire:model="model.prefix" type="text" class="form-control" id="prefix">
                            @error('model.prefix')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="suffix">پسوند</label>
                            <input wire:model="model.suffix" type="text" class="form-control" id="suffix">
                            @error('model.suffix')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        @endif
                    </div>
                        <div class="form-floating mb-3 mt-3">
                            <label for="dataBox">داده<span class="text-danger">*</span></label>
                            <textarea wire:model="data" class="form-control" rows="5" placeholder="{{$type === 0 ? "متن پیشفرض خود را وارد کنید." : "هر آیتم را در یک خط وارد کنید."}}" id="dataBox" ></textarea>
                            @error('data')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">ضرورت</label>
                        <input wire:model="required" type="checkbox" id="switch" class="input-switch" /><label class="label-switch" for="switch">Toggle</label>
                    </div>
                    <div class="form-group mb-4 d-flex justify-content-start">
                        @if($update_mode)
                            <input type="button" value="انصراف" wire:click="cancel" class="btn btn-outline-danger m-2" >
                        @endif
                        <button class="btn {{$update_mode ? 'btn-outline-primary' : 'btn-outline-info'}} m-2 px-3" type="submit">
                            {{$update_mode ? 'ویرایش مشخصه' : 'ثبت مشخصه'}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="statbox widget box box-shadow w-100">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>نام</th>
                            <th>نوع</th>
                            <th>ضروری</th>
                            <th>پیشوند</th>
                            <th>پسوند</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr class="text-center">
                                <td >{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{ $item->type }}</td>
                                @if($item->required)
                                    <td>دارد</td>
                                @else
                                    <td>ندارد</td>
                                @endif
                                <td>{{ $item->prefix }}</td>
                                <td>{{ $item->suffix }}</td>
                                <td>
                                    <button data-toggle="tooltip" title="ویرایش" wire:click.prevent="edit({{$item->id}})" class="btn btn-outline-primary btn-sm">
                                        <span class="fa fa-pencil-alt"></span>
                                    </button>
                                    <button data-toggle="tooltip" title="حذف"
                                            wire:click="alertConfirm({{$item->id}})"
                                            class="btn btn-outline-danger btn-sm">
                                             <span class="fa fa-trash"></span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <p>اطلاعاتی جهت نمایش وجود ندارد.</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{$items->links()}}
            </div>
        </div>
    </div>
</div>

