@if (Session::has('info'))
    <script>
        iziToast.info({
            position: 'topRight', // center, bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: '',
            backgroundColor: '',
            messageSize: '',
            messageColor: '',
            icon: 'fas fa-info',
            image: '',
            imageWidth: 50,
            balloon: true,
            drag: true,
            progressBar: true,
            timeout: 6000,
            title: 'Information',
            message: '{{ session('info') }}',
        });
    </script>
@endif