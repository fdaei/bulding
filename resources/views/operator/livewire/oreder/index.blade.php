@section('title',' پنل مدیریت | سفارشات')
<div class="bg-white rounded shadow-sm p-3">
    <div class="container mt-3">
        <div class="row">
                <div class="col-md-6">
                    <div class="form-group ">
                        <input wire:model="date" id="input1" class="form-control help"  type="text"  placeholder="جستوجو براساس تاریخ(روز/ماه/سال)" />
                    </div>
                </div>
                <div class="col-md-6">
                    <select wire:model="filter_base_category" class="form-control mb-4">
                        <option value="{{null}}">-- جستوجو براساس دسته بندی --</option>
                    @forelse($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @empty
                    @endforelse
                    </select>
                </div>

            <div class="statbox widget box box-shadow w-100">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th>تاریخ انتشار</th>
                            <th>دسته بندی</th>
                            <th>نام کاربری</th>
                            <th>عنوان آگهی</th>
                            <th>قیمت</th>
                            <th>وضعیت پرداخت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr class="text-center">
                                    <td >{{ \App\Helper\Utility::convertToSWithTime($item->created_at) }}</td>
                                @if($filter_base_category)
                                    <td >{{ $item->name }}</td>
                                    <td>{{ $item->User->first_name }}</td>
                                    <td>{{ $item->title }}</td>
                                @else
                                    <td >{{ $item->Notice->category->name }}</td>
                                    <td>{{ $item->User->first_name }}</td>
                                    <td>{{ $item->Notice->title }}</td>
                                @endif
                                    <td>{{ number_format($item->price) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button wire:key="{{ $loop->index }}" class="btn btn-secondary btn-sm dropdown-toggle"  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{$item->is_paid ? "پرداخت شده" : "پرداخت نشده"}}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @for($i=0 ; $i<2 ; $i++)
                                                    <a class="dropdown-item" wire:click="is_paid({{$item->id}},{{$i}})" href="#">{{$i? "پرداخت شده" : "پرداخت نشده"}}</a>
                                                @endfor
                                            </div>
                                        </div>
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
@section("script")
    <script>
        document.addEventListener('livewire:load', function () {
            $("#input1").persianDatepicker({
                cellWidth: 30,
                cellHeight: 25,
                fontSize: 15,
                onSelect: function () {
                    @this.date = document.getElementById("input1").value;
                }
            });
        })
    </script>
@endsection
