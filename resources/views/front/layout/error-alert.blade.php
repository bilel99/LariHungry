@if (Session::has('error'))
    <script>
        iziToast.error({
            position: 'topRight', // center, bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: '',
            backgroundColor: '',
            messageSize: '',
            messageColor: '',
            icon: 'fas fa-times',
            image: '',
            imageWidth: 50,
            balloon: true,
            drag: true,
            progressBar: true,
            timeout: 6000,
            title: 'Error',
            message: '{{ session('error') }}',
        });
    </script>
@endif