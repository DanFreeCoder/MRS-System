
const ItemcodeGenerator = () => {
    //AUTO SELECT ITEM CODE & DESCRIPTION --start//
    var click = 0; //initializing values for clicking into specific description fields
    $('#findcode').on('change', function () {
        click += 1;
        $('body').css('cursor', 'grabbing'); //change cursor once select in dropdown
        //auto replace & to and
        $('.desc').click(function () {
            var text = $(this).text();
            var special = new RegExp('&');
            if (special.test(text)) {
                var result = text.replace("&", "and");
                $(this).text(result)
            }
        })
        //clicking specific field
        $(".desc").focus(function () {
            if (click != 0) {
                var codeb = $('#findcode option:selected').val(); //value of selected description(itemcode)
                var id = $(this).attr('id');//id of clicked fields 
                //if id of description field is equal to the id of itemcode
                $('.code').attr('id', function () {
                    const code_id = $(this).attr('id');
                    if (code_id.substring(4) == id.substring(4)) {
                        $(this).text(codeb)
                    }
                })
                var codefind = $('#findcode option:selected').text();//text of selected description
                $(this).text(codefind);//insert value to clicked fields
                $('body').css('cursor', 'default');//back cursor to default
                click -= 1;//reset to deafult value
            }
        });
    });
    //AUTO SELECT ITEM CODE & DESCRIPTION --end//
}
const ItemDescGenerator = () => {
    //AUTO SELECT ITEM CODE & DESCRIPTION --start//
    var clicks = 0; //initializing values for clicking into specific description fields
    $('#finddesc').on('change', function () {
        clicks += 1;
        $('body').css('cursor', 'grabbing'); //change cursor once select in dropdown

        //clicking specific field
        $(".code").focus(function () {
            if (clicks != 0) {
                var codefind = $('#finddesc option:selected').text();//text of selected description
                var id = $(this).attr('id');//id of clicked fields 

                //if id of description field is equal to the id of itemcode
                $('.desc').attr('id', function () {
                    const desc_id = $(this).attr('id');
                    if (desc_id.substring(4) == id.substring(4)) {
                        var result;
                        $.ajax({
                            type: 'post',
                            url: 'controls/descriptionby_id.php',
                            data: { itemcode: codefind },
                            async: false,
                            dataType: 'html',

                            success: function (response) {
                                result = response.replace("[", "").replace("]", "").replace('"', "").replace('"', "").replace(' "', "").replace('" ', ""); // remove unnecessary characters
                            }
                        })
                        $(this).text(result);
                        //auto replace & to and
                        var text = $(this).text();
                        var special = new RegExp('&');
                        if (special.test(text)) {
                            var result = text.replace("&", "and");
                            $(this).text(result)
                        }
                    }
                })

                $(this).text(codefind);//insert value to clicked fields
                $('body').css('cursor', 'default');//back cursor to default
                clicks -= 1;//reset to deafult value
            }
        });
    });
    //AUTO SELECT ITEM CODE & DESCRIPTION --end//
}
const restrictSpecialChar = () => {
    // auto change '&' to 'and'
    $(document).on('keyup', '.editable-cell', function () {
        var text = $(this).text();
        var special = new RegExp('&');
        if (special.test(text)) {
            var result = text.replace("&", "and");
            $(this).text(result)
        }
    });
    // auto change '&' to 'and'
    $(document).on('keyup', 'input', function () {
        var text = $(this).val();
        var special = new RegExp('&');
        if (special.test(text)) {
            var result = text.replace("&", "and");
            $(this).val(result)
        }
    });
}
////////////////////////////////////////////////////////
