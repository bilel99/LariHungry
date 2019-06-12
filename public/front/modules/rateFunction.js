$(document).ready(function () {
    let options = {
        max_value: 5,
        step_size: 0.5,
        initial_value: 3,
        update_input_field_name: $("#rating_star_value"),
    };
    $(".rating").rate(options);
});
