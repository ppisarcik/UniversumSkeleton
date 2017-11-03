$(window).on('load', function () {
    $("#loader-wrapper").fadeOut("slow");
});

$(document).ready(function () {

    $.nette.init(); // nette ajax init

    $(window).resize(function(){
        if ($(window).width() > 768) {
            $("body").removeClass('toggled-special')
        }
    });

    if ($(window).width() < 768) {
        $("#menu-toggle").on('click', function () {
            $("body").toggleClass('toggled-special')
        });
    }

    if ($(window).width() <= 768) {  // remove sidebar on mobile devices
        $('#wrapper').removeClass('toggled');
    }

    $(document).on("click", "#menu-toggle", function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled"); // open/close sidebar
    });

    $('[data-toggle="tooltip"]').tooltip(); // bootstrap tooltip

    $('.trumbowyg').trumbowyg({
        resetCss: true,
        removeformatPasted: true,
        autogrow: true,
        btnsDef: {
            // Customizables dropdowns
            image: {
                dropdown: ['insertImage', 'upload', 'base64', 'noEmbed'],
                ico: 'insertImage'
            }
        }
    }).on('tbwinit', function () {
        $('._trumbowyg.sass-editor').addClass('advanced');
    });

    $('.imageUpload').fileuploader({
        changeInput: '<div class="fileuploader-input">' +
        '<div class="fileuploader-input-inner">' +
        '<img src="../../../admin-module/plugins/fileuploader/src/fileuploader-dragdrop-icon.png">' +
        '<h3 class="fileuploader-input-caption">Drag and drop images here</h3>' +
        '<p>or</p>' +
        '<div class="fileuploader-input-button">Browse Files</div>' +
        '</div>' +
        '</div>',
        theme: 'dragdrop',
        afterRender: function () {
            $('.fileuploader-items-list').append($('li.formImage'))
        }
    });

    $('.contactUpload').fileuploader({
        afterRender: function () {
            $('.fileuploader-items-list').append($('li.formImage'))
        }
    });

    $('label.remove').click(function () {
        $(this).closest('li').slideUp('normal', function () {
            $(this).remove();
        });
    });

    $.nette.ext('modal', {
       success: function (payload, status, jqXHR, settings) {
           if (settings.nette.el.attr('data-toggle')) {
               var modal = $('#editModal').modal('show');
               modal.find('.modal-body').html(payload);
               modal.find('.modal-title').html(settings.nette.el.attr('data-heading'));
               modal.find('.modal-body form').css("margin-top", "0");
           }
       }
    });

    $('.fileuploader-items input[type="radio"]').each(function () {
        if ( $(this).is(':checked') ) {
            $(this).closest('div').hide();
        } else {
            $(this).closest('div').show();
        }
    });

    $('label.main-image').on('click', function (e) {
        var check = confirm('Are you sure you want to change this image to main?');
        if (check === true) {
            $('.fileuploader-items [type="radio"]').each(function () {
                if ($(this).is(":checked")) {
                    $(this).closest('div').fadeOut('fast');
                } else {
                    $(this).closest('div').fadeIn('fast');
                }
            })
        } else {
            e.preventDefault();
            return false;
        }
    });

    if ( $( "#frm-modalContactForm" ).length ) {
        $("#frm-modalContactForm").appendTo('.modal-body').removeClass("hidden").css('margin', '0');
        $(".modal-title").append("Add new");
    }

    $("form#frm-contactForm-contactForm .title i, form#frm-contactForm-contactForm h1").click( function () {
        var i = $("form#frm-contactForm-contactForm .title i");
        var val = $(i).siblings("input").val();
        $(i).toggleClass("fa-pencil fa-check").siblings(".title input, .title h1").toggleClass("hidden");
        $(i).siblings("h1").html(val);
    });

    $('.contact-action a.remove').click(function () {
        $(this).closest(".form-group").slideUp(200, function(){ $(this).remove();});
    });

    // try {
    //     var list = document.getElementById("snippet-contactForm-contact");
    //     Sortable.create(list);
    // } catch (err) {
    // }

    var container = document.getElementById("snippet-contactForm-contact");
    var sort = Sortable.create(container, {
        animation: 100,
        handle: ".reorder",
        onEnd: function () {
            function sort(){
                var array = [];
                $(".form-group").each(function () {
                    $(this).data("sort", $(this).index() + 1);
                    array.push({
                        sort : $(this).data("sort"),
                        id : $(this).attr("id")
                    });
                });
                return array;
            }
            $.nette.ajax({
                url: "?do=reorder",
                type: "GET",
                data: {
                  'data' : sort()
                }
            });
        }
    });
});