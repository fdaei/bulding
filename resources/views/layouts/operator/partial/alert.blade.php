@if (session()->has('alert'))
    <script type="text/javascript">
        swal({
            icon: '{{ session('alert')['type'] }}',
            title: '{{ session('alert')['message'] }}',
            button: "تایید",
        });
    </script>
@endif
