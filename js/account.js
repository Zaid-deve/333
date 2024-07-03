$(document).ready(function () {
    const errorElement = $("#file-error");
    const submitButton = $('#submit-btn');
    const imgPreview = $('#profile-img');

    $('#profile').change(function (event) {
        imgPreview.attr('src', "../images/download.png");
        errorElement.text("");

        const file = event.target.files[0];
        submitButton.addClass('d-none');

        if (file) {
            const fileType = file.type;
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp'];

            if ($.inArray(fileType, validImageTypes) === -1) {
                errorElement.text("Please select a valid image file.");
            } else {
                const blob = URL.createObjectURL(file);
                imgPreview.attr('src', blob);
                submitButton.removeClass('d-none');
            }
        }
    });

    $("#name").on('input',function(){
        submitButton.addClass('d-none');
        $("#name").next().text('')

        if(!$("#name").val()){
            return;
        }

        if($("#name").val().length < 24){
            submitButton.removeClass('d-none');
        } else {
            $("#name").next().text('name is not valid');
        }
    })
});
