@if (Session::has('warning'))
    <script>
        iziToast.warning({
            position: 'topRight', // center, bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: '',
            backgroundColor: '',
            messageSize: '',
            messageColor: '',
            icon: 'fas fa-exclamation-triangle',
            image: '',
            imageWidth: 50,
            balloon: true,
            drag: true,
            progressBar: true,
            timeout: 6000,
            title: 'Ouuups',
            message: '{{ session('warning') }}',
        });
    </script>
@endif