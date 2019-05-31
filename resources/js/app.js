/**
 *  Ajax
 */
export function getVille () {
    // if selector cp exist
    if ($('#cp').length !== 0) {
        // If field is not filled
        $('#cp').keyup(function (e) {
            let cp = $('#cp').val();
            if (cp.length === 5) {
                let url = $('#url_getVille').val().replace(':CP', cp);

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (res) {
                        $('#ville').val(res.ville);
                    }, error: function () {
                        alert('error request Ajax');
                    }
                });
            }
        });
        // If fields is filled
        let cp = $('#cp').val();
        if (cp.length === 5) {
            let url = $('#url_getVille').val().replace(':CP', cp);
            $.ajax({
                type: 'GET',
                url: url,
                success: function (res) {
                    $('#ville').val(res.ville);
                }, error: function () {
                    alert('error request Ajax');
                }
            });
        }
    }

}


