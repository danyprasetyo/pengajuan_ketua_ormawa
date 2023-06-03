<script>
    $('input[type="file"]').change(function (e) {

        var reader = new FileReader();
        reader.onload = function (e) {

            // get loaded data and render thumbnail.
            $('.image-preview').append(
                `
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <button type="button" class="close position-relative" aria-label="Close">
                        <span aria-hidden="true" class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger">&times;</span>
                    </button>
                </div> 
                    <img src="#" id="preview" class="img-thumbnail position-relative">
                `
            );
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
    $(document).on("click", ".close", function () {
        $('.image-preview').empty();
        $(".file").val("");
    });
</script>
