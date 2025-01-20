$(function () {

    'use strict';








    // repeater
let repeater = []
let repeaterBox = []
$('.repeater-container .repeater:first-child').each(function(index) {
    repeater[index] = $(this)
    repeaterBox[index] = $(this).closest('.repeater-container')

    repeater[index].find('[name]').each(function() {
        this.name = repeaterBox[index].attr('repeater-field-name') + '[0]' + '[' + $(this).attr('data-name') + ']';
    })


    repeaterBox[index].on('click', '.add_new_file', function() {
        
        if(repeaterBox[index].find('.repeater').length < repeaterBox[index].attr('repeater-limit') || repeaterBox[index].attr('repeater-limit') == undefined){
            let clone = repeater[index].first().clone();
            clone.find('[name]').val('');
            $(this).closest('.repeater-container').find('.repeater-box').append(clone)

            repeaterBox[index].find('.repeater').each(function(repeaterIndex) {
                $(this).find('[name]').each(function() {
                    this.name = repeaterBox[index].attr('repeater-field-name') + '[' +
                        repeaterIndex +
                        ']' + '[' + $(this).attr('data-name') + ']';
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
        repeaterBox[index].find('.repeater').each(function(repeaterIndex) {
            $(this).find('[name]').each(function() {
                this.name = repeaterBox[index].attr('repeater-field-name') + '[' +
                    repeaterIndex +
                    ']' + '[' + $(this).attr('data-name') + ']';
            })
        });
    });


    

});








    // Showing page loader
    $(window).on('load', function () {
        setTimeout(function () {
            $(".page_loader").fadeOut("fast");
        }, 100);

        if ($('body .filter-portfolio').length > 0) {
            $(function () {
                $('.filter-portfolio').filterizr(
                    {
                        delay: 0
                    }
                );
            });
            $('.filteriz-navigation li').on('click', function () {
                $('.filteriz-navigation .filtr').removeClass('active');
                $(this).addClass('active');
            });
        }
    });


    // Made the left sidebar's min-height to window's height
    var winHeight = $(window).height();
    $('.dashboard-nav').css('min-height', winHeight);


    // Magnify activation
    $('.portfolio-item').magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery:{enabled:true}
    });


    // Header shrink while page scroll
    doSticky();
    placedDashboard();
    $(window).on('scroll', function () {
        // adjustHeader();
        doSticky();
        placedDashboard();
    });

    // Header shrink while page resize
    $(window).on('resize', function () {
        // adjustHeader();
        doSticky();
        placedDashboard();
    });



    function doSticky()
    {
        if ($(document).scrollTop() > 40) {
            $('.do-sticky').addClass('sticky-header');
            //$('.do-sticky').addClass('header-shrink');
        }
        else {
            $('.do-sticky').removeClass('sticky-header');
            //$('.do-sticky').removeClass('header-shrink');
        }
    }

    function placedDashboard() {
        var headerHeight = parseInt($('.main-header').height(), 10);
        $('.dashboard').css('top', headerHeight);
    }


    // Banner slider
    (function ($) {
        //Function to animate slider captions
        function doAnimations(elems) {
            //Cache the animationend event in a variable
            var animEndEv = 'webkitAnimationEnd animationend';
            elems.each(function () {
                var $this = $(this),
                    $animationType = $this.data('animation');
                $this.addClass($animationType).one(animEndEv, function () {
                    $this.removeClass($animationType);
                });
            });
        }

        //Variables on page load
        var $myCarousel = $('#carousel-example-generic')
        var $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
        //Initialize carousel
        $myCarousel.carousel();

        //Animate captions in first slide on page load
        doAnimations($firstAnimatingElems);
        //Pause carousel
        $myCarousel.carousel('pause');
        //Other slides to be animated on carousel slide event
        $myCarousel.on('slide.bs.carousel', function (e) {
            var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
            doAnimations($animatingElems);
        });
        $('#carousel-example-generic').carousel({
            interval: 3000,
            pause: "false"
        });
    })(jQuery);

    // Page scroller initialization.
    $.scrollUp({
        scrollName: 'page_scroller',
        scrollDistance: 300,
        scrollFrom: 'top',
        scrollSpeed: 500,
        easingType: 'linear',
        animation: 'fade',
        animationSpeed: 200,
        scrollTrigger: false,
        scrollTarget: false,
        scrollText: '<i class="fa fa-chevron-up"></i>',
        scrollTitle: false,
        scrollImg: false,
        activeOverlay: false,
        zIndex: 2147483647
    });

    // Counter
    function isCounterElementVisible($elementToBeChecked) {
        var TopView = $(window).scrollTop();
        var BotView = TopView + $(window).height();
        var TopElement = $elementToBeChecked.offset().top;
        var BotElement = TopElement + $elementToBeChecked.height();
        return ((BotElement <= BotView) && (TopElement >= TopView));
    }

    $(window).on('scroll', function () {
        $(".counter").each(function () {
            var isOnView = isCounterElementVisible($(this));
            if (isOnView && !$(this).hasClass('Starting')) {
                $(this).addClass('Starting');
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text('+' + Math.ceil(now));
                    }
                });
            }
        });
    });


    // Countdown activation
    $( function() {
        // Add background image
        //$.backstretch('../img/nature.jpg');
        var endDate = "December  27, 2019 15:03:25";
        $('.countdown.simple').countdown({ date: endDate });
        $('.countdown.styled').countdown({
            date: endDate,
            render: function(data) {
                $(this.el).html("<div>" + this.leadingZeros(data.days, 3) + " <span>Days</span></div><div>" + this.leadingZeros(data.hours, 2) + " <span>Hours</span></div><div>" + this.leadingZeros(data.min, 2) + " <span>Minutes</span></div><div>" + this.leadingZeros(data.sec, 2) + " <span>Seconds</span></div>");
            }
        });
        $('.countdown.callback').countdown({
            date: +(new Date) + 10000,
            render: function(data) {
                $(this.el).text(this.leadingZeros(data.sec, 2) + " sec");
            },
            onEnd: function() {
                $(this.el).addClass('ended');
            }
        }).on("click", function() {
            $(this).removeClass('ended').data('countdown').update(+(new Date) + 10000).start();
        });

    });

    $(".range-slider-ui").each(function () {
        var minRangeValue = $(this).attr('data-min');
        var maxRangeValue = $(this).attr('data-max');
        var minName = $(this).attr('data-min-name');
        var maxName = $(this).attr('data-max-name');
        var unit = $(this).attr('data-unit');

        $(this).append("" +
            "<span class='min-value'></span> " +
            "<span class='max-value'></span>" +
            "<input class='current-min' type='hidden' name='"+minName+"'>" +
            "<input class='current-max' type='hidden' name='"+maxName+"'>"
        );
        $(this).slider({
            range: true,
            min: minRangeValue,
            max: maxRangeValue,
            values: [minRangeValue, maxRangeValue],
            slide: function (event, ui) {
                event = event;
                var currentMin = parseInt(ui.values[0], 10);
                var currentMax = parseInt(ui.values[1], 10);
                $(this).children(".min-value").text( currentMin + " " + unit);
                $(this).children(".max-value").text(currentMax + " " + unit);
                $(this).children(".current-min").val(currentMin);
                $(this).children(".current-max").val(currentMax);
            }
        });

        var currentMin = parseInt($(this).slider("values", 0), 10);
        var currentMax = parseInt($(this).slider("values", 1), 10);
        $(this).children(".min-value").text( currentMin + " " + unit);
        $(this).children(".max-value").text(currentMax + " " + unit);
        $(this).children(".current-min").val(currentMin);
        $(this).children(".current-max").val(currentMax);
    });

    // Select picket
    $('.selectpicker').selectpicker();

    // Search option's icon toggle
    $('.search-options-btn').on('click', function () {
        $('.search-section').toggleClass('show-search-area');
        $('.search-options-btn .fa').toggleClass('fa-chevron-down');
    });

    // Carousel with partner initialization
    (function () {
        $('#ourPartners').carousel({interval: 3600});
    }());

    (function () {
        $('.our-partners .item').each(function () {
            var itemToClone = $(this);
            for (var i = 1; i < 4; i++) {
                itemToClone = itemToClone.next();
                if (!itemToClone.length) {
                    itemToClone = $(this).siblings(':first');
                }
                itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-" + (i))
                    .appendTo($(this));
            }
        });
    }());

    // Background video playing script
    $(document).ready(function () {
        $(".player").mb_YTPlayer(
            {
                mobileFallbackImage: 'img/banner/banner-1.jpg'
            }
        );
    });

    // Multilevel menuus
    $('[data-submenu]').submenupicker();

    // Expending/Collapsing advance search content
    $('.show-more-options').on('click', function () {
        if ($(this).find('.fa').hasClass('fa-minus-circle')) {
            $(this).find('.fa').removeClass('fa-minus-circle');
            $(this).find('.fa').addClass('fa-plus-circle');
        } else {
            $(this).find('.fa').removeClass('fa-plus-circle');
            $(this).find('.fa').addClass('fa-minus-circle');
        }
    });

    var videoWidth = $('.sidebar-widget').width();
    var videoHeight = videoWidth * .61;
    $('.sidebar-widget iframe').css('height', videoHeight);


    // Megamenu activation
    $(".megamenu").on("click", function (e) {
        e.stopPropagation();
    });

    // Dropdown activation
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

        return false;
    });

    // Datetimepicker init
    $('.datetimes').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });
    $('.datetimes-left').daterangepicker({
        opens: 'left',
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });
    $('.datetimes-left, .datetimes').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
    $('.datetimes-left, .datetimes').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });


    // Full  Page Search Activation
    $(function () {
        $('a[href="#full-page-search"]').on('click', function(event) {
            event.preventDefault();
            $('#full-page-search').addClass('open');
            $('#full-page-search > form > input[type="search"]').focus();
        });

        $('#full-page-search, #full-page-search button.close').on('click keyup', function(event) {
            if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                $(this).removeClass('open');
            }
        });
    });


    // Slick Sliders
    $('.slick-carousel').each(function () {
        var slider = $(this);
        $(this).slick({
            infinite: true,
            dots: false,
            arrows: true,
            centerMode: true,
            centerPadding: '0',
            prevArrow:'<span class="slick-carousel-arrows prev-arrow"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>',
            nextArrow:'<span class="slick-carousel-arrows next-arrow"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>'
        });
        
        $(this).closest('.slick-slider-area').find('.slick-prev').on("click", function () {
            slider.slick('slickPrev');
        });
        $(this).closest('.slick-slider-area').find('.slick-next').on("click", function () {
            slider.slick('slickNext');
        });
    });


    $(".dropdown.btns .dropdown-toggle").on('click', function() {
        $(this).dropdown("toggle");
        return false;
    });



    // Dropzone initialization
    Dropzone.autoDiscover = false;
    $(function () {
        $("div#myDropZone").dropzone({
            url: "/file-upload"
        });
    });

    // Filterizr initialization
    $(function () {
        //$('.filtr-container').filterizr();
    });

    function toggleChevron(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".fa")
            .toggleClass('fa-minus fa-plus');
    }

    $('.panel-group').on('shown.bs.collapse', toggleChevron);
    $('.panel-group').on('hidden.bs.collapse', toggleChevron);

    $(document).on('click', '.color-plate', function () {
        var name = $(this).attr('data-color');
        $('link[id="style_sheet"]').attr('href', 'css/skins/' + name + '.css');
    });

    $(document).on('click', '.setting-button', function () {
        $('.option-panel').toggleClass('option-panel-collased');
    });



    // Form Stepper Starts

    const navigateToFormStep = (stepNumber) => {
        document.querySelectorAll(".form-step").forEach((formStepElement) => {
            formStepElement.classList.add("d-none");
        });
        document.querySelectorAll(".form-stepper-list").forEach((formStepHeader) => {
            formStepHeader.classList.add("form-stepper-unfinished");
            formStepHeader.classList.remove("form-stepper-active", "form-stepper-completed");
        });
        document.querySelector("#step-" + stepNumber).classList.remove("d-none");
        const formStepCircle = document.querySelector('li[step="' + stepNumber + '"]');
        formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-completed");
        formStepCircle.classList.add("form-stepper-active");
        for (let index = 0; index < stepNumber; index++) {
            const formStepCircle = document.querySelector('li[step="' + index + '"]');
            if (formStepCircle) {
                formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-active");
                formStepCircle.classList.add("form-stepper-completed");
            }
        }
    };
    document.querySelectorAll(".btn-navigate-form-step").forEach((formNavigationBtn) => {
        formNavigationBtn.addEventListener("click", () => {
            const stepNumber = parseInt(formNavigationBtn.getAttribute("step_number"));
            navigateToFormStep(stepNumber);
            window.scrollTo(0,0);
        });
    });

    // Form Stepper Ends


    // Multiple Select Starts
    $('.multiple-select').select2({
        placeholder: function(){
            $(this).data('placeholder');
        }
    });
    // Multiple Select Ends


});

// mCustomScrollbar initialization
(function ($) {
    $(window).resize(function () {
        $('#map').css('height', $(this).height() - 110);
        if ($(this).width() > 768) {
            $(".map-content-sidebar").mCustomScrollbar(
                {theme: "minimal-dark"}
            );
            $('.map-content-sidebar').css('height', $(this).height() - 110);
        } else {
            $('.map-content-sidebar').mCustomScrollbar("destroy"); //destroy scrollbar
            $('.map-content-sidebar').css('height', '100%');
        }
    }).trigger("resize");



    // start birthdate
    $(function () {
        $('.datedrop-box').each(function(){
            var parent = $(this)
            var years = $(this).find('.years')
            var months = $(this).find('.months')
            var future_year = $(this).find('.years').attr('future-year')

            years.append($('<option />').val('').html(years.attr('placeholder')).attr('disabled', 'disabled').attr('selected', 'selected'));
            months.append($('<option />').val('').html(months.attr('placeholder')).attr('disabled', 'disabled').attr('selected', 'selected'));

            for (i = (future_year == undefined ? (new Date().getFullYear()) : future_year ) ; i > 1900; i--) {
                years.append($('<option />').val(i).html(i));
            }
            for (i = 1; i < 13; i++) {
                months.append($('<option />').val(i).html(i));
            }
            updateNumberOfDays(months.val(), years.val(), parent);
            years.change(function () {updateNumberOfDays(months.val(), years.val(), parent);});
            months.change(function () {updateNumberOfDays(months.val(), years.val(), parent);});
        })
    });
    function updateNumberOfDays(month, year, parent) {
        parent.find('.days').html('');
        days = daysInMonth(month, year);
        parent.find('.days').append($('<option />').val('').html(parent.find('.days').attr('placeholder')).attr('disabled', 'disabled').attr('selected', 'selected'));
        for (i = 1; i < days + 1 ; i++) {
            parent.find('.days').append($('<option />').val(i).html(i));
        }
    }
    function daysInMonth(month, year) {
        return new Date(year, month, 0).getDate();
    }
     // end birthdate


    // stars 
    $('.stars').each(function(){
        var starsNumber = $(this).attr('data-stars-number')
        for (let index = 0; index < starsNumber; index++) {
            $(this).find( "i:eq( "+index+" )" ).css( "color", "#FFDB57" )
            
        }
    })

    $('.share_button').click(function(){
        window.open($(this).attr('data-href'), 'fbwin', 'left=20,top=20,width=500,height=300,toolbar=1,resizable=0');
    })


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

    // Hide the city and area selection dropdowns
    $('.city-selection option:not(:first-child)').hide();
    $('.area-selection option:not(:first-child)').hide();
    $('.city-selection').parent().hide();
    $('.area-selection').parent().hide();

    // Show the cities based on the selected country ID
    $('.country-selection').change(function() {
        var countryId = $(this).val();
        $('.city-selection option:not(:first-child)').hide();
        $('.area-selection option:not(:first-child)').hide(); 
        $('.area-selection').parent().hide();
        
        if($('.city-selection option[data-country-id="' + countryId + '"]').length > 0){
            $('.city-selection').parent().show();
            $('.city-selection option[data-country-id="' + countryId + '"]').show();
        }else{
            $('.city-selection').parent().hide();
            $('.city-selection option[data-country-id="' + countryId + '"]').hide();
        }
        
        // Display the option with value="0" in the city selection
        $('.city-selection option[value="0"]').show();

        $('.city-selection').val($('.city-selection option:first-child').val());
        $('.area-selection').val($('.area-selection option:first-child').val());
    });

    // Show the areas based on the selected city ID
    $('.city-selection').change(function() {
        var cityId = $(this).val();
        $('.area-selection option:not(:first-child)').hide();
        
        if($('.area-selection option[data-city-id="' + cityId + '"]').length > 0){
            $('.area-selection').parent().show();
            $('.area-selection option[data-city-id="' + cityId + '"]').show();
        }else{
            $('.area-selection').parent().hide();
            $('.area-selection option[data-city-id="' + cityId + '"]').hide();
        }

        // Display the option with value="0" in the area selection
        $('.area-selection option[value="0"]').show();

        $('.area-selection').val($('.area-selection option:first-child').val());
    });



    function onLoadUpdateAreas(){
        countryId = $('.country-selection').val()
        if($('.city-selection option[data-country-id="' + countryId + '"]').length > 0){
            $('.city-selection').parent().show();
            $('.city-selection option[data-country-id="' + countryId + '"]').show();
        }else{
            $('.city-selection').parent().hide();
            $('.city-selection option[data-country-id="' + countryId + '"]').hide();
        }

        cityId = $('.city-selection').val()
        if($('.area-selection option[data-city-id="' + cityId + '"]').length > 0){
            $('.area-selection').parent().show();
            $('.area-selection option[data-city-id="' + cityId + '"]').show();
        }else{
            $('.area-selection').parent().hide();
            $('.area-selection option[data-city-id="' + cityId + '"]').hide();
        }
    }
    onLoadUpdateAreas()


})(jQuery);







