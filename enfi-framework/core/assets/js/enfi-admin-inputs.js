jQuery(function ($) {

    // ColorPicker
    $('.enfi_color_field').each(function () {
        $(this).wpColorPicker();
    });

    // add Image button
    $(".enfi-settings-input-image").on("click", ".enfi-settings-image-set", function () {

        var myClasses = this.classList;
        var send_attachment_bkp = wp.media.editor.send.attachment;

        var insertButton = $(this).parent().find(".enfi-settings-image-set");
        var valueInput = $(this).parent().find(".enfi-settings-image-input");
        var removeButton = $(this).parent().find(".enfi-settings-image-remove");



        wp.media.editor.send.attachment = function (props, attachment) {
            insertButton.css('background-image', 'url(' + attachment.url + ')');
            insertButton.addClass('isset');
            removeButton.show();
            valueInput.val(attachment.id);
        }

        wp.media.editor.open(insertButton);

        return false;

    });

    // remove Image button
    $(".enfi-settings-input-image").on("click", ".enfi-settings-image-remove", function () {

        var myClasses = this.classList;

        var insertButton = $(this).parent().find(".enfi-settings-image-set");
        var valueInput = $(this).parent().find(".enfi-settings-image-input");
        var removeButton = $(this).parent().find(".enfi-settings-image-remove");

        insertButton.css('background-image', '');
        insertButton.removeClass('isset');
        removeButton.hide();
        valueInput.val('');

    });

    $(".enfi-settings-remove-field-button").on("click", function () {

        var element = this.classList;

        $('#' + element[1]).remove();
        this.remove();

    });



    $(".add").on("click", function () {

        var id = $(this).attr('data-field');
        var placeholder = $(this).attr('data-placeholder');

        var length = $(this).parent().children('.sortableList').children('.field').length;

        var textfield = '<div class="field sortable"><a class="move"><i class="fas fa-arrows-alt-v"></i></a><a class="remove"><i class="fas fa-trash-alt"></i></a><input type="text" class="enfi-admin-input" id="' + id + '-field"  name="' + id + '[' + length + ']" placeholder="' + placeholder + '" value="" /></div>';

        $(this).parent().children("div").append(textfield);


        if (length > 1) {
            $(this).parent().parent().find('.remove-disable').toggleClass('remove-disable').toggleClass('remove');
        }

    });

    $(document).on("click", ".remove", function () {
        var length = $(this).parent().parent().children('div').length;

        if (length == 2) {

            $(this).parent().parent().parent().find('.remove').toggleClass('remove-disable').toggleClass('remove');
        } else {

        }

        $(this).parent().remove();
    });

    $(".enfi-admin-input-button-group").on("click", "a", function () {

        if ($(this).hasClass('current')) {

            $(this).toggleClass('current');
            $(this).parent().find("input").val('');

        } else {

            $(this).each(function () {
                $(this).parent().find("a").removeClass('current');
            });

            var data = $(this).data('value');

            $(this).toggleClass('current');

            $(this).parent().find("input").val(data);

        }

    });

    $(".enfi-admin-input-button-group-vertical").on("click", "a", function () {

        if ($(this).hasClass('current')) {

            $(this).toggleClass('current');
            $(this).parent().find("input").val('');

        } else {

            $(this).each(function () {
                $(this).parent().find("a").removeClass('current');
            });

            var data = $(this).data('value');

            $(this).toggleClass('current');

            $(this).parent().find("input").val(data);

        }

    });

    /* $('.sortableList').sortable({
        items: '.sortable'
    }); */

  


});