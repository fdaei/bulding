@section('title','پنل کاربری | داشبورد')
<div class="container">
    <div class="d-flex justify-content-end px-5 mb-3">
        <div class="p-3 bg-c-yellow rounded-bottom shadow-sm ">
            <span class="px-5 text-white ">داشبورد</span>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-md-4 col-xl-3">
            <div class="card-dashboard bg-c-blue order-card">
                <div class="card-block">
                    <h6>تیکت های باز</h6>
                    <h2 class="text-right"><i class="fa fa-cart-plus float-end"></i><span>{{$openedTicket}}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3">
            <div class="card-dashboard bg-c-green order-card">
                <div class="card-block">
                    <h6>تعداد سفارشات</h6>
                    <h2 class="text-right"><i class="fa fa-rocket float-end"></i><span>{{$orders}}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3">
            <div class="card-dashboard bg-c-yellow order-card">
                <div class="card-block">
                    <h6>آگهی های فعال</h6>
                    <h2 class="text-right"><i class="fas fa-sync-alt float-end"></i><span>{{$activeNotice}}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3">
            <div class="card-dashboard bg-c-pink order-card">
                <div class="card-block">
                    <h6>تاریخ عضویت</h6>
                    <h2 class="text-right"><i class="fa fa-credit-card float-end"></i><span class=" register-date">{{$joinDate}}</span></h2>
                </div>
            </div>
        </div>
    </div>
</div>
