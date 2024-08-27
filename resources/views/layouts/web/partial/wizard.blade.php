<h2 class="text-center p-3">ثبت آگهی</h2>
<div class="stepwizard mb-3">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <button  type="button" class="btn btn-circle  {{ $currentStep >= 1 ? 'btn-outline-blue' : 'btn-default' }}" disabled="disabled">1</button>
            <p>دسته بندی</p>
        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn btn-circle {{ $currentStep >= 2 ? 'btn-outline-blue' : 'btn-default' }}" disabled="disabled">2</button>
            <p>توضیحات آگهی</p>
        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn btn-circle {{ $currentStep >= 3 ? 'btn-outline-blue' : 'btn-default' }}" disabled="disabled">3</button>
            <p>تعرفه</p>
        </div>
        <div class="stepwizard-step">
            <button  type="button" class="btn btn-circle {{ $currentStep >= 4 ? 'btn-outline-blue' : 'btn-default' }}" disabled="disabled">4</button>
            <p>ثبت سفارش</p>
        </div>
    </div>
</div>
