@section('title',' پنل مدیریت | دسته بندی ')
<div class="bg-white rounded shadow-sm p-3">
    <div class="container">
        <div class="row">
            <div class="statbox widget box box-shadow w-100">
                <form wire:submit.prevent="{{$update_mode ? 'update' : 'insert'}}">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-4">
                            <label for="name">عنوان<span class="text-danger">*</span></label>
                            <input type="text" id="name" class="form-control" wire:model="model.name">
                            @error('model.name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="parent_id">سردسته</label>
                            <select class="form-control" wire:model="model.parent_id">
                                <option value="" selected>-- انتخاب نمایید --</option>
                                @forelse($parents as $parent)
                                    <option value="{{$parent->id}}">{!! $parent->full_title !!}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('model.parent_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4">
                            <label>وزن:</label>
                            <input type="number" class="form-control" wire:model="model.Weight" value="0" />
                            @error('model.Weight')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4">
                            <label>آیکون:</label>
                            <input type="button" class="btn btn-outline-secondary btn-sm d-block" data-toggle="modal" data-target="#exampleModal" value="انتخاب ایکون" {{$img?"disabled":""}} >

                            <!-- Modal -->
                            <div class="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                        <div class="row">
                                        <div  class="container-fluid" style="height: 400px; overflow-y: auto;">
                                            @include('operator.livewire.category.-icon')
                                        </div>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="select-icon">انتخاب</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('model.icon')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4">
                            <label>رنگ:</label>
                            <input type="color" class="form-control" wire:model="model.color" >
                            @error('model.color')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4">
                            <label>رنگ پس زمینه:</label>
                            <input type="color" class="form-control" wire:model="model.background"  />
                            @error('model.background')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>تصویر:</label>
                            <input type="file" wire:model="img"  {{$icon?"disabled":""}} />
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group my-4">
                        @if($update_mode)
                            <input type="button" value="انصراف" wire:click="cancel" class="btn btn-outline-danger" >
                        @endif
                        <button class="btn {{$update_mode ? 'btn-outline-primary' : 'btn-outline-info'}} " type="submit">
                            {{$update_mode ? 'ویرایش دسته بندی' : 'ثبت دسته بندی'}}
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
                            <th >#</th>
                            <th>عنوان</th>
                            <th>سردسته</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr class="text-center">
                                <td >{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>
                                <td>{!! $item->full_title !!}</td>
                                <td>
                                    <button data-toggle="tooltip" title="ویرایش" wire:click.prevent="edit({{$item->id}})" class="btn btn-outline-primary btn-sm">
                                        <span class="fa fa-pencil-alt"></span>
                                    </button>
                                    <button data-toggle="tooltip" title="حذف"
                                            wire:click="alertConfirm({{$item->id}})"
                                            class="btn btn-outline-danger btn-sm">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                    <a href="{{route('operator.category.feature.show',['id'=>$item->id])}}"  class="btn btn-outline-info btn-sm">
                                        مشخصه ها
                                        <badge>({{count($item->categoryFeatures)}})</badge>
                                    </a>

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
<script>
    document.addEventListener('livewire:load', function () {
        $('.fa-icon-list i').on('click', function() {
            var item = $(this);
            $('.icon-selected').css('border', '1px solid #aaa').css('color', '#000').removeClass('icon-selected');

            item.attr( 'id', 'icon-selected' );
            item.css('border', '1px dashed #3B7CB3');
            item.css('color', '#3B7CB3');
         });
        $("#select-icon").click(function(){
            $("#icon-selected").attr('class')
            @this.icon=$("#icon-selected").attr('class').replace('d-inline','');
        })

    });
</script>
