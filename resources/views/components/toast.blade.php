@if (session()->has('success'))
    <script>
        $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Success',
        body: '{{ session('message') }}'
      })
    </script>
@elseif (session()->has('error'))
    <script>
        $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Error',
        body: '{{ session('message') }}'
    })
    </script>
@endif
