<?php
namespace App\Traits;

use RealRashid\SweetAlert\Facades\Alert;

trait AlertTrait{
    public function successAlert(string $message = "عملیات با موفقیت انجام شد."){
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=> $message
        ]);
    }
    public function alertConfirm(int $id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'آیا مطمئن هستید؟',
            'text' => 'در صورت حذف قادر به باگردانی نخواهید بود.',
            "id" => $id,
        ]);
    }
    public function dangerAlert(string $message = "خطایی رخ داده است."){
        $this->dispatchBrowserEvent('alert',[
            'type' => 'error',
            'message' => $message,
        ]);
    }
    public function warningAlert(string $message = "هشدار"){
        $this->dispatchBrowserEvent('alert',[
            'type' => 'warning',
            'message' => $message,
        ]);
    }
    public  function ToastSuccessAlertWithRedirect (string $message = "عملیات با موفقیت انجام شد."){
        toast($message,'success');
    }
    public  function SuccessAlertWithRedirect (string $message = "عملیات با موفقیت انجام شد."){
        Alert::success('تبریک', $message);
    }

}

