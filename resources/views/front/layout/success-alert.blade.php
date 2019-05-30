@if (Session::has('success'))
    <script>
        iziToast.success({
            position: 'topRight', // center, bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: '',
            backgroundColor: '',
            messageSize: '',
            messageColor: '',
            icon: 'fas fa-check',
            image: '',
            imageWidth: 50,
            balloon: true,
            drag: true,
            progressBar: true,
            timeout: 6000,
            title: 'Success',
            message: '{{ session('success') }}',
        });
    </script>
@endif