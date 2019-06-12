export class Ajax {
    constructor() {
    }

    async postRatingStar() {
        $('.rating').on('click', function (e) {
            e.preventDefault();

            let form = $('#form-rating-star');
            let url = form.attr('action');
            let data = form.serialize();

            console.log(form);
            console.log(url);
            console.log(data);

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function (result) {
                    // show success message
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
                        message: result.message,
                    });
                    // Hide rating bloc HTML
                    $('.rating-bloc').slideUp();

                }, error: function (e) {
                    alert(e.message);
                }
            });
        });
    }

}
