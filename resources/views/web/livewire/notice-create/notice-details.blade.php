@push('custom-script')
    <script>
        $("button[type='submit']").click(function (){
            $("div.required").each(function (){
                if($(this).children("input[type='checkbox']").is(":checked"))
                {
                    $(this).children("input[type='checkbox']").removeAttr("required")
                }
            })
        })
    </script>
@endpush
@section("title" , config('app.name')." | توضیحات آگهی")
<div class="container p-3">
    @include("layouts.web.partial.wizard")
        <form wire:submit.prevent="secondStepSubmit" class="row mb-3 d-flex">
            <div class="alert alert-warning px-5 col-12">
                <p class="m-0">
                    دسته بندی انتخاب شده :
                    {!! \App\Models\Category::find(session()->get("noticeData.category_id"))->fullTitle !!}
                </p>
            </div>
            <div class="col-lg-4 order-md-2 pe-lg-0">
                <div class="border rounded p-2 mb-3">
                    <div class="border-bottom mb-2">
                        <label class="form-label" for="state"><i class="fa fa-location me-2"></i><strong>استان</strong></label>
                        <select wire:model="state_id" wire:change="chooseState($event.target.value)" id="state" class="form-select mb-2">
                            <option value="{{0}}">--استان خود را مشخص کنید--</option>
                            @forelse($state as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('state_id')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                    <div class="border-bottom mb-2">
                        <label class="form-label" for="city"><i class="fas fa-map-marker-minus me-2"></i><strong>شهر</strong></label>
                        <select wire:model="city_id" id="city" class="form-select mb-2">
                            @isset($city)
                                @foreach($city as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            @else
                                <option value="{{{0}}}">--ابتدا استان خود را مشخص کنید--</option>
                            @endif
                        </select>
                        @error('city_id')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                    <div class="border-bottom mb-2">
                        <label class="form-label" for="map-id"><i class="far fa-map-marked-alt me-2"></i><strong>موقعیت جغرافیایی</strong></label>
                        <div style="height: 330px">
                            <livewire:web.map-wire />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 order-1 border rounded">
                <div class="bg-white">
                    <div class="mb-2">
                        <label class="form-label pt-2" for="title"><i class="far fa-pen me-2"></i>عنوان آگهی<span class="text-danger">*</span></label>
                        <input wire:model.defer="title" class="form-control mb-3" id="title">
                        @error('title')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="context"><i class="far fa-comment-alt-dots me-2"></i>توضیحات آگهی</label>
                        <textarea wire:model.defer="context" class="form-control mb-3" style="height: 10rem;" id="context"></textarea>
                        @error('context')<span class="text-danger" >{{ $message }}</span>@enderror
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
                        <input wire:model="image" class="form-control" type="file" id="image">
{{--                        preview image--}}
{{--                        <img wire:ignore id="blah" src="#" alt="your image" />--}}
                        @if($this->image and $this->previewBoxIndex)
                            <div class="container-fluid border rounded px-1 mt-3 bg-light">
                                <div class="row d-flex justify-content-end py-2 px-3">
                                    <div class=" d-flex justify-content-center align-items-center p-2">پیش نمایش</div>
                                    <div class=" col-md-3  p-0 ">
                                        <img  class="rounded border image img-fluid" src="{{$previewImage}}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endif
{{--                        end--}}
                        @if($this->image)
                            {{\Illuminate\Support\Facades\Session::put("noticeData.image" , \App\Helper\Utility::getTempImageName($this->image->getRealPath()))}}
                        @endif
                        @error('image')<span class="text-danger" >{{ $message }}</span>@enderror
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
                        <input wire:model="gallery" class="form-control" type="file" id="gallery" multiple>
                        @if($this->gallery and $this->previewBoxGallery)
                            <div class="container-fluid border rounded px-1 mt-3 bg-light">
                                <div class="row d-flex justify-content-end py-2 px-3">
                                    <div class=" d-flex justify-content-center align-items-center p-2">پیش نمایش</div>
                                    @forelse($this->previewGallery as $item)
                                        <div class=" col-md-3  p-0 ">
                                            <img class="rounded border image img-fluid" src="{{$item}}" alt="">
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        @endif
                        @if($this->gallery)
                            @php
                                foreach($this->gallery as $item)
                                {
                                    $array[] = \App\Helper\Utility::getTempImageName($item->getRealPath());
                                }
                            @endphp
                            {{\Illuminate\Support\Facades\Session::put("noticeData.gallery" , $array)}}
                        @endif
                        @error('gallery')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
{{--                        <!-- features -->--}}
                    @forelse(\App\Models\Category::ancestorsAndSelf($category_id) as $i)
                        @forelse($i->categoryFeatures as $item)
                            @if( $item->type == "select")
                                <div class="mb-2">
                                    <label class="form-label" for="{{$item->name}}">
                                        {{$item->name}}
                                        @if($item->required)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>
                                    <select wire:model="selectInputs.{{$item->id}}" class="form-select" id="{{$item->name}}" {{$item->required? "required" : ""}}>
                                        <option value="">--انتخاب کنید--</option>
                                        @forelse($item->category_feature_values as $val)
                                        @php
                                            $array = explode("#" , $val->feature_value);
                                        @endphp
                                        @forelse($array as $value)
                                            <option value="{{$value}}">{{$value}}</option>
                                        @empty
                                        @endforelse
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('model.title')<span class="text-danger" >{{ $message }}</span>@enderror
                                </div>
                            @endif
                        @empty
                        @endforelse

                        @forelse($i->categoryFeatures as $item)
                            @if($item->type == "radio")
                                <div class="mb-3 row">
                                    <h6>{{$item->name}}
                                        @if($item->required)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </h6>
                                    <div class="col-md-4">
                                        @forelse($item->category_feature_values as $val)
                                            @php
                                                $array = explode("#" , $val->feature_value);
                                            @endphp
                                            @forelse($array as $value)
                                                <label class="form-check-label px-2" for="{{$value}}">{{$value}}</label>
                                                <input wire:model="radioInputs.{{$item->id}}" type="radio" name="{{$item->name}}" {{($item->required)? "required=required" : ""}}  class="form-check-input" value="{{$value}}" id="{{$value}}" >
                                                @error('model.title')<span class="text-danger" >{{ $message }}</span>@enderror
                                            @empty
                                            @endforelse
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            @endif
                        @empty
                        @endforelse
                        @forelse($i->categoryFeatures as $item)
                            @if($item->type == "checkbox")
                                <div class="mb-3 row">
                                    <h6>{{$item->name}}
                                        @if($item->required)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </h6>
                                    <div class="col-md-4">
                                        @forelse($item->category_feature_values as $val)
                                            @php
                                                $array = explode("#" , $val->feature_value);
                                            @endphp
                                            <div class="checkbox-group {{$item->required? "required" : ""}}">
                                                @forelse($array as $value)
                                                    <label class="form-check-label px-2" for="{{$value}}">{{$value}}</label>
                                                    <input wire:model="checkboxInputs.{{$item->id}}.{{$loop->index}}" type="checkbox" class="form-check-input" value="{{$value}}" id="{{$value}}" {{$item->required? "required" : ""}}>
                                                @empty
                                                @endforelse
                                                    <span class="text-danger error d-none" >مشخصه {{$item->name}} الزامی است.</span>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            @endif
                        @empty
                        @endforelse
                        @forelse($i->categoryFeatures as $item)
                            @if($item->type == "text")
                                <div class="mb-2 row">
                                    <label class="col-sm-2 col-form-label" for="{{$item->name}}">
                                        {{$item->name}}
                                        @if($item->required)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>

                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            @if($item->prefix)
                                                <span class="input-group-text">{{$item->prefix}}</span>
                                            @endif
                                            <input wire:model="textInputs.{{$item->id}}" type="text" class="form-control" {{$item->required? "required" : ""}} id="{{$item->name}}">
                                            @if($item->suffix)
                                                <span class="input-group-text">{{$item->suffix}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                        @endforelse
                    @empty
                    @endforelse



{{--                        <!-- end features -->--}}

                    <div class="mb-2">
                        <label class="form-label" for="address"><i class="fal fa-map me-2"></i>آدرس</label>
                        <textarea wire:model.defer="address" class="form-control mb-3" style="height: 10rem;" id="address"></textarea>
                        @error('address')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>

                </div>
            </div>
            <div class="d-flex justify-content-between pb-2 order-3 mt-3">
                <div class="d-flex align-items-center">
                    <a href="{{route("notice-create-category")}}" class="btn btn-secondary ">مرحله قبل</a>
                </div>
                <button class="btn btn-success px-3 next" type="submit">
                    مرحله بعد
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
    <script>
        document.addEventListener('livewire:load', function () {
            image.onchange = evt => {
                const [file] = image.files
                if (file) {
                    @this.previewImage = URL.createObjectURL(file)
                }
                @this.previewBoxIndex = true
            }
            gallery.onchange = evt => {
                var fileUrls = []
                Array.from(gallery.files).forEach(file => {
                    fileUrls.push(URL.createObjectURL(file))
                });
                @this.previewGallery = fileUrls
                @this.previewBoxGallery = true
            }
        })
    </script>
@endsection


