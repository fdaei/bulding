<div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$users}}</h3>
                    <p>کاربرها </p>
                </div>
                <div class="icon">
                    <i class="far fa-user-plus"></i>
                </div>
                <a href="{{route("operator.index")}}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-12 col-md-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$order}}</h3>
                    <p>سفارش ها</p>
                </div>
                <div class="icon">
                    <i class="fab fa-first-order-alt"></i>
                </div>
                <a href="{{route("operator.notice")}}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-12 col-md-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$ticket}}</h3>
                    <p>تیکت ها</p>
                </div>
                <div class="icon">
                    <i class="fas fa-comments-alt"></i>
                </div>
                <a href="{{route("operator.notice")}}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-12 col-md-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$ads}}</h3>
                    <p>آگهی ها</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ad"></i>
                </div>
                <a href="{{route("operator.notice")}}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
    </div>
</div>
