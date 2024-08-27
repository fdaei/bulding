<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-left',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 5000,
        timerProgressBar:true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    window.addEventListener('alert',({detail:{type,message}})=>{
        Toast.fire({
            icon:type,
            title:message
        })
    })
    window.addEventListener('swal:confirm', event => {
        swal({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.livewire.emit('delete',event.detail.id);
                }
            });
    });
</script>
