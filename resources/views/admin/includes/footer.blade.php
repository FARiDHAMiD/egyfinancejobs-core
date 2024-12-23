<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ url('/admin_dashboard') }}/vendor/jquery/jquery.min.js"></script>
<script src="{{ url('/admin_dashboard') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ url('/admin_dashboard') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

<script src="{{ url('/admin_dashboard') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/admin_dashboard') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ url('/admin_dashboard') }}/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{ url('/admin_dashboard') }}/vendor/chart.js/Chart.min.js"></script>
<script src="{{ url('/website') }}/js/select2.min.js"></script>

<script src="{{ url('/admin_dashboard') }}/js/demo/datatables-demo.js"></script>

<script>
    // Hide the city and area selection dropdowns
    $('.city-selection option:not(:first-child)').hide();
    $('.area-selection option:not(:first-child)').hide();

    // Show the cities based on the selected country ID
    $('.country-selection').change(function() {
        var countryId = $(this).val();
        $('.city-selection option:not(:first-child)').hide();
        $('.area-selection option:not(:first-child)').hide();
        $('.city-selection option[data-country-id="' + countryId + '"]').show();
        $('.city-selection').val($('.city-selection option:first-child').val());
        $('.area-selection').val($('.area-selection option:first-child').val());
    });

    // Show the areas based on the selected city ID
    $('.city-selection').change(function() {
        var cityId = $(this).val();
        $('.area-selection option:not(:first-child)').hide();
        $('.area-selection option[data-city-id="' + cityId + '"]').show();
        $('.area-selection').val($('.area-selection option:first-child').val());
    });

    function changeCountryCityOnload(){
        var countryId = $('.country-selection').val();
        var cityId = $('.city-selection').val();
        if(countryId){
            $('.city-selection option[data-country-id="' + countryId + '"]').show();
        }
        if(cityId){
            $('.city-selection option[data-country-id="' + countryId + '"]').show();
            $('.area-selection option[data-city-id="' + cityId + '"]').show();
        }
    }
    changeCountryCityOnload()
    


// repeater
let repeater = []
let repeaterBox = []
$('.repeater-container .repeater:first-child').each(function(index) {
    repeater[index] = $(this)
    repeaterBox[index] = $(this).closest('.repeater-container')

    repeater[index].find('[name]').each(function() {
        this.name = repeaterBox[index].attr('repeater-field-name') + '['+index+']' + '[' + $(this).attr('data-name') + ']';
    })
    


    repeaterBox[index].on('click', '.add_new_file', function() {
        
        if(repeaterBox[index].find('.repeater').length < repeaterBox[index].attr('repeater-limit') || repeaterBox[index].attr('repeater-limit') == undefined){
            let clone = repeater[index].first().clone();
            clone.find('[name]').val('');
            $(this).closest('.repeater-container').find('.repeater-box').append(clone)

            $('.repeater').each(function(repeaterIndex) {
                $(this).find('[name]').each(function() {
                    this.name = repeaterBox[index].attr('repeater-field-name') + '[' + repeaterIndex + ']' + '[' + $(this).attr('data-name') + ']';
                })
            }); 
        }else{
            Swal.fire({
                title: '',
                text: `The number of inputs should not exceed ${repeaterBox[index].attr('repeater-limit')} inputs`,
                icon: "error",
            });
        }
        
    })

    repeaterBox[index].on('click', '.remove-repeater-row', function() {
        $(this).closest('.repeater').remove()
        $('.repeater').each(function(repeaterIndex) {
            $(this).find('[name]').each(function() {
                this.name = repeaterBox[index].attr('repeater-field-name') + '[' +
                    repeaterIndex +
                    ']' + '[' + $(this).attr('data-name') + ']';
            })
        });
    }); 
});
    
$('.multiple-select').select2({
    placeholder: function(){
        $(this).data('placeholder');
    }
});

$('.image-input').on('change', function() {
        var parent = $(this).closest('.upload-image-box')
        var file = this.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            parent.find('.image').attr('src', reader.result);
        }

        if (file) {
        reader.readAsDataURL(file);
        } else {
            parent.find('.image').attr('src', '');
        }
    });
</script>
<script>
    $(document).on('click', '.mark-as-read', function(){
        let btn = $(this);
        $.get(btn.attr('data-route'))
        .done(function(da){
            $('#'+btn.attr('data-id')).fadeOut(300, function(){
                $('#'+btn.attr('data-id')).remove()

            })
        });
    })
</script>