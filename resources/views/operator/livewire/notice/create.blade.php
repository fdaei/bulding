@section('title','پنل مدیریت | ثبت اگهی ')
<div>
    <div class="container ">
        <form wire:submit.prevent="secondStepSubmit" class="row mb-3 d-flex">
            <div class="col-lg-4 order-md-2 pe-lg-0 ">
                <div class="border rounded p-2 mb-3 bg-white">
                    <div class="border-bottom mb-2">
                        <label class="form-label" for="state"><i class="fa fa-location me-2"></i><strong>استان</strong></label>
                        <select wire:model.defer="model.state_id" wire:change="chooseState($event.target.value)" id="state" class="form-control mb-2">
                            <option>--استان خود را مشخص کنید--</option>
                            @forelse($state as $item)
                                <option value="{{$item->id}}" {{$item->id==21?"selected":""}}>{{$item->name}}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('model.state_id')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                    <div class="border-bottom mb-2">
                        <label class="form-label" for="city"><i class="fas fa-map-marker-minus me-2"></i><strong>شهر</strong></label>
                        <select wire:model="model.city_id"  class="form-control mb-2">
                            @isset($city)
                                @foreach($city as $item)
                                    <option value="{{$item->id}}" {{$item->id==298 ? "selected":""}}>{{$item->name}}</option>
                                @endforeach
                            @else
                                <option>--ابتدا استان خود را مشخص کنید--</option>
                            @endif
                        </select>
                        @error('model.city_id')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                    <div class="border-bottom mb-2" >
                        <label>آگهی ویژه</label>
                        <input value=0 wire:model="model.especial" type="checkbox">
                        @error('model.especial')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                    <div class="border-bottom mb-2" >
                        <label class="form-label" for="map-id"><i class="far fa-map-marked-alt me-2"></i><strong>موقعیت جغرافیایی</strong></label>
                        <div style="height: 330px">
                            <livewire:web.map-wire />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 order-1 border rounded bg-white">
                <div>
                    <div class="mb-2">
                        <label class="form-label" for="state"><i class="fa fa-user me-2"></i><strong>کاربر</strong><span class="text-danger">*</span></label>
                        <select wire:model="model.user_id"   class="form-control mb-2">
                            <option value="">--کاربر مورد نظر خود را مشخص کنید--</option>
                        @forelse($users as $item)
                            <div class=" col-md-3  p-0 ">
                                <option value="{{$item->id}}">{{$item->first_name}}</option>
                            </div>
                        @empty
                        @endforelse
                        </select>
                        @error('model.user_id')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="state"><i class="fa fa-user me-2"></i><strong>دسته بندی</strong><span class="text-danger">*</span></label>
                        <select wire:model="model.category_id" class="form-control mb-2">
                            <option value="">--دسته بندی  مورد نظر خود را مشخص کنید--</option>
                            @forelse($categorys as $item)
                                <div class=" col-md-3  p-0 ">
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                </div>
                            @empty
                            @endforelse
                        </select>
                        @error('model.category_id')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label pt-2" for="title"><i class="far fa-pen me-2"></i>عنوان آگهی<span class="text-danger">*</span></label>
                        <input wire:model.defer="model.title" class="form-control mb-3" id="title">
                        @error('model.title')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="context"><i class="far fa-comment-alt-dots me-2"></i>توضیحات آگهی</label>
                        <textarea wire:model.defer="model.context" class="form-control mb-3" style="height: 10rem;" id="context"></textarea>
                        @error('model.context')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="image"><i class="fal fa-upload me-2"></i>تصویر شاخص</label>
                        @if($image)
                            <i wire:loading.remove wire:target="image" class="far fa-check text-success"></i>
                        @endif
                        <div wire:loading wire:target="image">
                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <input wire:model="image" class="form-control" type="file" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="gallery"><i class="fal fa-upload me-2"></i>تصاویر دیگر</label>
                        @if($gallery)
                            <i wire:loading.remove wire:target="gallery" class="far fa-check text-success"></i>
                        @endif
                        <div wire:loading wire:target="gallery">
                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <input wire:model="gallery" class="form-control" type="file" multiple>
                        @error('gallery')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                    {{--                        <!-- features -->--}}
{{--                    @forelse(\App\Models\Category::ancestorsAndSelf($category_id) as $i)--}}
{{--                        @forelse($i->categoryFeatures as $item)--}}
{{--                            @if( $item->type == "select")--}}
{{--                                <div class="mb-2">--}}
{{--                                    <label class="form-label" for="{{$item->name}}">--}}
{{--                                        {{$item->name}}--}}
{{--                                        @if($item->required)--}}
{{--                                            <span class="text-danger">*</span>--}}
{{--                                        @endif--}}
{{--                                    </label>--}}
{{--                                    <select wire:model="selectInputs.{{$item->id}}" class="form-select" id="{{$item->name}}" {{$item->required? "required" : ""}}>--}}
{{--                                        <option value="">--انتخاب کنید--</option>--}}
{{--                                        @forelse($item->category_feature_values as $val)--}}
{{--                                            @php--}}
{{--                                                $array = explode("#" , $val->feature_value);--}}
{{--                                            @endphp--}}
{{--                                            @forelse($array as $value)--}}
{{--                                                <option value="{{$value}}">{{$value}}</option>--}}
{{--                                            @empty--}}
{{--                                            @endforelse--}}
{{--                                        @empty--}}
{{--                                        @endforelse--}}
{{--                                    </select>--}}
{{--                                    @error('model.title')<span class="text-danger" >{{ $message }}</span>@enderror--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        @empty--}}
{{--                        @endforelse--}}

{{--                        @forelse($i->categoryFeatures as $item)--}}
{{--                            @if($item->type == "radio")--}}
{{--                                <div class="mb-3 row">--}}
{{--                                    <h6>{{$item->name}}--}}
{{--                                        @if($item->required)--}}
{{--                                            <span class="text-danger">*</span>--}}
{{--                                        @endif--}}
{{--                                    </h6>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        @forelse($item->category_feature_values as $val)--}}
{{--                                            @php--}}
{{--                                                $array = explode("#" , $val->feature_value);--}}
{{--                                            @endphp--}}
{{--                                            @forelse($array as $value)--}}
{{--                                                <label class="form-check-label px-2" for="{{$value}}">{{$value}}</label>--}}
{{--                                                <input wire:model="radioInputs.{{$item->id}}" type="radio" name="{{$item->name}}" {{($item->required)? "required=required" : ""}}  class="form-check-input" value="{{$value}}" id="{{$value}}" >--}}
{{--                                                @error('model.title')<span class="text-danger" >{{ $message }}</span>@enderror--}}
{{--                                            @empty--}}
{{--                                            @endforelse--}}
{{--                                        @empty--}}
{{--                                        @endforelse--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        @empty--}}
{{--                        @endforelse--}}
{{--                        @forelse($i->categoryFeatures as $item)--}}
{{--                            @if($item->type == "checkbox")--}}
{{--                                <div class="mb-3 row">--}}
{{--                                    <h6>{{$item->name}}--}}
{{--                                        @if($item->required)--}}
{{--                                            <span class="text-danger">*</span>--}}
{{--                                        @endif--}}
{{--                                    </h6>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        @forelse($item->category_feature_values as $val)--}}
{{--                                            @php--}}
{{--                                                $array = explode("#" , $val->feature_value);--}}
{{--                                            @endphp--}}
{{--                                            <div class="checkbox-group {{$item->required? "required" : ""}}">--}}
{{--                                                @forelse($array as $value)--}}
{{--                                                    <label class="form-check-label px-2" for="{{$value}}">{{$value}}</label>--}}
{{--                                                    <input wire:model="checkboxInputs.{{$item->id}}.{{$loop->index}}" type="checkbox" class="form-check-input" value="{{$value}}" id="{{$value}}" {{$item->required? "required" : ""}}>--}}
{{--                                                @empty--}}
{{--                                                @endforelse--}}
{{--                                                <span class="text-danger error d-none" >مشخصه {{$item->name}} الزامی است.</span>--}}
{{--                                            </div>--}}
{{--                                        @empty--}}
{{--                                        @endforelse--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        @empty--}}
{{--                        @endforelse--}}
{{--                        @forelse($i->categoryFeatures as $item)--}}
{{--                            @if($item->type == "text")--}}
{{--                                <div class="mb-2 row">--}}
{{--                                    <label class="col-sm-2 col-form-label" for="{{$item->name}}">--}}
{{--                                        {{$item->name}}--}}
{{--                                        @if($item->required)--}}
{{--                                            <span class="text-danger">*</span>--}}
{{--                                        @endif--}}
{{--                                    </label>--}}

{{--                                    <div class="col-sm-10">--}}
{{--                                        <div class="input-group mb-3">--}}
{{--                                            @if($item->prefix)--}}
{{--                                                <span class="input-group-text">{{$item->prefix}}</span>--}}
{{--                                            @endif--}}
{{--                                            <input wire:model="textInputs.{{$item->id}}" type="text" class="form-control" {{$item->required? "required" : ""}} id="{{$item->name}}">--}}
{{--                                            @if($item->suffix)--}}
{{--                                                <span class="input-group-text">{{$item->suffix}}</span>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        @empty--}}
{{--                        @endforelse--}}
{{--                    @empty--}}
{{--                    @endforelse--}}



                    {{--                        <!-- end features -->--}}
                    <div class="mb-2">
                        <label class="form-label" for="address"><i class="fal fa-map me-2"></i>آدرس</label>
                        <textarea wire:model.defer="model.address" class="form-control mb-3" style="height: 10rem;" id="address"></textarea>
                        @error('model.address')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between pb-2 order-3 mt-3">
                <button class="btn btn-success px-3 next" type="submit">
                    ثبت اگهی
                </button>
            </div>
        </form>
    </div>
    @section("script")

        <script>


            document.addEventListener('livewire:load', function () {

                initMap();
                function initMap() {
                    var lat = 30.2832993;
                    var lng = 57.0705093;
                    if (@this.lat && @this.lng) {
                        lat = @this.lat;
                        lng = @this.lng;
                    }
                    window.LeafletMap = L.map('map-id', {
                        center: [lat, lng],
                        zoom: 18,
                        doubleClickZoom: "center"
                    });

                    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                        attribution:
                            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(window.LeafletMap);
                    var marker = L.marker([lat, lng], {
                        clickable: true,
                        draggable: true,
                        icon: L.icon({
                            iconUrl: '/images/vendor/leaflet/dist/marker-icon.png',
                            iconSize: [32, 45],
                        })
                    }).addTo(window.LeafletMap).on('dragend', function (marker) {
                    @this.lat = marker.target._latlng.lat;
                    @this.lng = marker.target._latlng.lng;
                    });
                }
            })
        </script>

        <script>
            $('[required]')
                .on('invalid', function(){
                    return this.setCustomValidity("این فیلد الزامی است");
                })
                .on('input', function(){
                    return this.setCustomValidity('');
                });
        </script>

    @endsection
</div>

