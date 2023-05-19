$(document).ready(function () {

    function reload(duration) {
        setTimeout(function () {
            location.reload();
        }, duration)
    }
    $('#admin_side').on('click', function () {
        window.location = "adminpage/dashboard.php?click=" + 'man';
    })

    $('#logout').on('click', function () {
        $('#log_out').modal('show');
    });
    $('#out').on('click', function () {
        window.location = "../mrf/controls/logout.php";
    });


    $('#settings').on('click', function (e) {
        e.preventDefault();
        $('#settingmodal').modal('show');
    });

    $('#clear').on('click', function () {
        $('.editable-cell').text('');
    })
    //modal update user settings
    $('#save_upd').on('click', function (e) {
        e.preventDefault();
        const password = $('#password').val();
        const retype = $('#retype_password').val();
        const id = $('#upd-id').val();
        const mydata = 'id=' + id + '&password=' + password;
        if (password != '') {
            if (password == retype) {
                $.ajax({
                    type: 'POST',
                    url: 'controls/update-pass.php',
                    data: mydata,
                    success: function (response) {
                        if (response > 0) {
                            $('#settingmodal').modal('toggle')
                            $('#user_current_pass').modal('show')
                            setTimeout(function () {
                                window.location = "../mrf/controls/logout.php";
                            }, 5000);
                        }
                    }
                })
            } else {
                toastr.error(`password is not match`).css("background-color", "#ff5e57");
            }
        } else {
            toastr.error(`All fields are required`).css("background-color", "#ff5e57");
        }
    });

    $('.remove').on('click', function () {
        var drafted_id = $(this).attr('value');

        $.ajax({
            type: 'POST',
            url: 'controls/remove_draft.php',
            data: {
                id: drafted_id
            },
            success: function (response) {
                if (response > 0) {
                    toastr.info(`Remove Successfully`).css("background-color", "#67e6dc");
                    reload(2000);
                }
            }

        })
    });



    $('.generate').hide();
    $('.draft').hide();
    $('.upd_gen').hide();
    $('.draft_as_draft').hide();
    $('#clear').hide();


    $('#addrow').on('click', function () {
        $('.update').hide();
        $('.upd_gen').show();
        $('.draft').hide();
        $('.generate').hide();
        $('.draft_as_draft').show();

    })

    var dataf = [];
    $('table tbody tr').each(function () {
        var row = [];
        $(this).find('td').each(function () {
            row.push($(this).text());
        });
        dataf.push(row);
    });

    $('.select2').select2();

    $('.update').on('click', function () {
        var id = $('#id').val();
        var project = $('#project').val();
        var project_type = $('#project_type').val();
        var classification = $('#classification').val();
        var sub_class = $('#sub_class').val();
        var cip_account = $('#cip_account').val();
        var approver = $('#approver').val();

        var data = [];

        $('table tbody tr').each(function () {
            var row = [];
            $(this).find('td').each(function () {
                row.push($(this).text());
            });
            data.push(row);
        });

        var countf = dataf.length //current number of row
        var count = data.length //total number of row when its added
        var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&data=' + JSON.stringify(data) + '&id=' + id + '&count=' + count + '&countf=' + countf;

        if (project != '' && project_type != '' && classification != '' && cip_account != '' && approver != '') {
            $.ajax({
                type: 'POST',
                url: 'controls/update.php',
                data: mydata,

                success: function (response) {
                    if (response > 0) {
                        toastr.success(`Update Successfullly`).css("background-color", "#05c46b");
                    }
                    $('.update').hide();
                    $('.generate').show();
                    $('.draft').show();
                    $('#clear').show();
                },
                error: function (xhr, status, error) {
                    alert(xhr);
                    alert(status);
                    alert(error);
                }
            });
        } else {
            //show toast
            alert('Fields with asterisks(*) are required');

        }

    });
    //add row
    var count = 1;
    $('#addrow').on('click', function () {
        count = count + 1;
        var html = `<tr id="row${count}">`;
        html += `
            <td contenteditable class="editable-cell" hidden></td>
            <td contenteditable class="editable-cell qty"></td>
            <td contenteditable class="editable-cell" oum></td>
            <td contenteditable class="editable-cell code"></td>
            <td contenteditable class="editable-cell desc"></td>
            <td contenteditable class="editable-cell remark"></td>
            <td style="width:2px; margin-right:0px;"><div class="removes btn btn-danger btn-sm" id="remove" data-row="row${count}" style="border-radius:100%; border:none;"><i class="bi bi-x"></i></div></td>
            </tr>
            `;
        $('table tbody').append(html);


    });


    //remove row
    $(document).on('click', '.removes', function () {
        var delete_row = $(this).data('row');
        $('#' + delete_row).remove();

    });
    // var delete_row = $(this).data('row');
    // var drafted_id = $('.remove').attr('value');
    // var remove_row = delete_row.substr(3);

    //save as draft
    $(document).on('click', '.draft', function () {
        var id = $('#id').val();
        var project = $('#project').val();
        var project_type = $('#project_type').val();
        var classification = $('#classification').val();
        var sub_class = $('#sub_class').val();
        var cip_account = $('#cip_account').val();
        var approver = $('#approver').val();

        var data = [];

        $('table tbody tr').each(function () {
            var row = [];
            $(this).find('td').each(function () {
                row.push($(this).text());
            });
            data.push(row);
        });
        var countf = dataf.length //current number of row
        var count = data.length //total number of row when its added
        var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&data=' + JSON.stringify(data) + '&id=' + id + '&count=' + count + '&countf=' + countf;


        if (project != '' && project_type != '' && classification != '' && cip_account != '' && approver != '') {
            $.ajax({
                type: 'POST',
                url: 'controls/update.php',
                data: mydata,

                success: function (response) {
                    if (response > 0) {
                        $('#modal_save_as_draft').modal('show');
                    } else {
                        toastr.error(`ERROR! Save as draft Failed. Please get in touch with the system administrator at local number 124.`).css("background-color", "#ff5e57");
                    }

                    // window.location = "home.php";
                },
                error: function (xhr, status, error) {
                    alert(xhr);
                    alert(status);
                    alert(error);
                }
            });
        } else {
            //show toast
            toastr.error(`Fields with asterisks(*) are required`).css("background-color", "#ff5e57");

        }

    });

    //modal save as draft
    $(document).on('click', '#ok_save_as_draft', function () {
        window.location = "addmrf.php";
    });

    $('#project_type').on('change', function () {
        var selectedVal = $(this).val();

        $.ajax({
            type: 'POST',
            url: 'controls/get_cip_acc.php',
            data: {
                id: selectedVal
            },
            success: function (response) {

                $('#cip_account').html(response);
            }
        })
    })

}); //end of document
//save to print
$('.generate').on('click', function () {
    var id = $('#id').val();
    var project = $('#project').val();
    var project_type = $('#project_type').val();
    var classification = $('#classification').val();
    var sub_class = $('#sub_class').val();
    var cip_account = $('#cip_account').val();
    var approver = $('#approver').val();

    var data = [];

    $('table tbody tr').each(function () {
        var row = [];
        $(this).find('td').each(function () {
            row.push($(this).text());
        });
        data.push(row);
    });
    //initialize a variables to handle that will be a push array
    var qtys = [];
    var codes = [];
    var descs = [];
    var oums = [];
    var remarks = [];
    $('table tr').each(function () {
        var qty = $(this).find(".qty").html();
        var oum = $(this).find(".oum").html();
        var code = $(this).find(".code").html();
        // var brand = $(this).find(".brand").html();
        var desc = $(this).find(".desc").html();
        // var spec = $(this).find(".specs").html();
        var remark = $(this).find(".remark").html();
        qtys.push(qty);
        oums.push(oum);
        codes.push(code);
        // brands.push(brand);
        descs.push(desc);
        // specs.push(spec);
        remarks.push(remark)
    });
    //extract the qty value
    for (q of qtys) {
        var x = q;
    }
    //extract the uom value
    for (u of oums) {
        var o = u;
    }
    //extract the brand value
    // for (b of brands) {
    //     var br = b;
    // }
    //extract the specs value
    // for (s of specs) {
    //     var sp = s;
    // }
    //extract the itemcode value
    for (c of codes) {
        var y = c;
    }
    //extract the description value
    for (d of descs) {
        var z = d;
    }
    //extract the remarks value
    for (r of remarks) {
        var re = r;
    }
    var r1_col_id1 = data[0][0];//id
    var r1_col1 = data[0][1];
    var r1_col2 = data[0][2];
    var r1_col3 = data[0][3];
    var r1_col4 = data[0][4];
    var r2_col_id2 = data[1][0];//id
    var r2_col1 = data[1][1];
    var r2_col2 = data[1][2];
    var r2_col3 = data[1][3];
    var r2_col4 = data[1][4];
    var r3_col_id3 = data[2][0];//id
    var r3_col1 = data[2][1];
    var r3_col2 = data[2][2];
    var r3_col3 = data[2][3];
    var r3_col4 = data[2][4];
    var r4_col_id4 = data[3][0];//id
    var r4_col1 = data[3][1];
    var r4_col2 = data[3][2];
    var r4_col3 = data[3][3];
    var r4_col4 = data[3][4];
    var r5_col_id5 = data[4][0];//id
    var r5_col1 = data[4][1];
    var r5_col2 = data[4][2];
    var r5_col3 = data[4][3];
    var r5_col4 = data[4][4];


    var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&data=' + JSON.stringify(data) + '&id=' + id;


    if (project != '' && project_type != '' && classification != '' && cip_account != '' && approver != '') {
        switch (true) {
            case r1_col1.length == 0 || r1_col2.length == 0 || r1_col3.length == 0 || r1_col4.length == 0:
                toastr.error(`Please fill out the item descriptions.`).css("background-color", "#ff5e57");
                break;
            // second row start
            case r2_col1.length == 0 && r2_col2.length != 0 && r2_col3.length != 0 && r2_col4.length != 0:
                toastr.error(`Quantity is mandatory.`).css("background-color", "#ff5e57");
                break;
            case r2_col1.length != 0 && r2_col2.length == 0 && r2_col3.length != 0 && r2_col4.length != 0:
                toastr.error(`UOM is mandatory.`).css("background-color", "#ff5e57");
                break;
            case r2_col1.length != 0 && r2_col2.length != 0 && r2_col3.length == 0 && r2_col4.length != 0:
                toastr.error(`Item code is mandatory.`).css("background-color", "#ff5e57");
                break;
            case r2_col1.length != 0 && r2_col2.length != 0 && r2_col3.length != 0 && r2_col4.length == 0:
                toastr.error(`Descriptions is mandatory.`).css("background-color", "#ff5e57");
                break;
            //
            case r2_col1.length != 0 && r2_col2.length == 0 && r2_col3.length == 0 && r2_col4.length == 0 || r2_col1.length == 0 && r2_col2.length != 0 && r2_col3.length == 0 && r2_col4.length == 0 || r2_col1.length == 0 && r2_col2.length == 0 && r2_col3.length != 0 && r2_col4.length == 0 || r2_col1.length == 0 && r2_col2.length == 0 && r2_col3.length == 0 && r2_col4.length != 0 || r2_col1.length != 0 && r2_col2.length != 0 && r2_col3.length == 0 && r2_col4.length == 0 || r2_col1.length != 0 && r2_col2.length != 0 && r2_col3.length != 0 && r2_col4.length == 0 || r2_col1.length != 0 && r2_col2.length != 0 && r2_col3.length == 0 && r2_col4.length == 0 || r2_col1.length != 0 && r2_col2.length == 0 && r2_col3.length == 0 && r2_col4.length != 0 || r2_col1.length == 0 && r2_col2.length != 0 && r2_col3.length != 0 && r2_col4.length == 0 || r2_col1.length == 0 && r2_col2.length != 0 && r2_col3.length == 0 && r2_col4.length != 0:
                toastr.error(`Please complete the item descriptions.`).css("background-color", "#ff5e57");
                break;
            //
            //second row end
            // third row start
            case r3_col1.length == 0 && r3_col2.length != 0 && r3_col3.length != 0 && r3_col4.length != 0:
                toastr.error('Quantity is mandatory.').css("background-color", "#ff5e57");
                break;
            case r3_col1.length != 0 && r3_col2.length == 0 && r3_col3.length != 0 && r3_col4.length != 0:
                toastr.error('UOM is mandatory.').css("background-color", "#ff5e57");
                break;
            case r3_col1.length != 0 && r3_col2.length != 0 && r3_col3.length == 0 && r3_col4.length != 0:
                toastr.error('Item code is mandatory.').css("background-color", "#ff5e57");
                break;
            case r3_col1.length != 0 && r3_col2.length != 0 && r3_col3.length != 0 && r3_col4.length == 0:
                toastr.error('Descriptions is mandatory.').css("background-color", "#ff5e57");
                break;
            //
            case r3_col1.length != 0 && r3_col2.length == 0 && r3_col3.length == 0 && r3_col4.length == 0 || r3_col1.length == 0 && r3_col2.length != 0 && r3_col3.length == 0 && r3_col4.length == 0 || r3_col1.length == 0 && r3_col2.length == 0 && r3_col3.length != 0 && r3_col4.length == 0 || r3_col1.length == 0 && r3_col2.length == 0 && r3_col3.length == 0 && r3_col4.length != 0 || r3_col1.length != 0 && r3_col2.length != 0 && r3_col3.length == 0 && r3_col4.length == 0 || r3_col1.length != 0 && r3_col2.length != 0 && r3_col3.length != 0 && r3_col4.length == 0 || r3_col1.length != 0 && r3_col2.length == 0 && r3_col3.length == 0 && r3_col4.length == 0 || r3_col1.length != 0 && r3_col2.length == 0 && r3_col3.length == 0 && r3_col4.length != 0 || r3_col1.length == 0 && r3_col2.length != 0 && r3_col3.length != 0 && r3_col4.length == 0 || r3_col1.length == 0 && r3_col2.length != 0 && r3_col3.length == 0 && r3_col4.length != 0:
                toastr.error(`Please complete the item descriptions.`).css("background-color", "#ff5e57");
                break;
            //
            //third row end
            // fourth row start
            case r4_col1.length == 0 && r4_col2.length != 0 && r4_col3.length != 0 && r4_col4.length != 0:
                toastr.error('Quantity is mandatory.').css("background-color", "#ff5e57");
                break;
            case r4_col1.length != 0 && r4_col2.length == 0 && r4_col3.length != 0 && r4_col4.length != 0:
                toastr.error('UOM is mandatory.').css("background-color", "#ff5e57");
                break;
            case r4_col1.length != 0 && r4_col2.length != 0 && r4_col3.length == 0 && r4_col4.length != 0:
                toastr.error('Item code is mandatory.').css("background-color", "#ff5e57");
                break;
            case r4_col1.length != 0 && r4_col2.length != 0 && r4_col3.length != 0 && r4_col4.length == 0:
                toastr.error('Descriptions is mandatory.').css("background-color", "#ff5e57");
                break;
            //
            case r4_col1.length != 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length == 0 || r4_col1.length == 0 && r4_col2.length != 0 && r4_col3.length == 0 && r4_col4.length == 0 || r4_col1.length == 0 && r4_col2.length == 0 && r4_col3.length != 0 && r4_col4.length == 0 || r4_col1.length == 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length != 0 || r4_col1.length != 0 && r4_col2.length != 0 && r4_col3.length == 0 && r4_col4.length == 0 || r4_col1.length != 0 && r4_col2.length != 0 && r4_col3.length != 0 && r4_col4.length == 0 || r4_col1.length != 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length == 0 || r4_col1.length != 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length != 0 || r4_col1.length == 0 && r4_col2.length != 0 && r4_col3.length != 0 && r4_col4.length == 0 || r4_col1.length == 0 && r4_col2.length != 0 && r4_col3.length == 0 && r4_col4.length != 0 || r4_col1.length == 0 && r4_col2.length != 0 && r4_col3.length == 0 && r4_col4.length != 0:
                toastr.error(`Please complete the item descriptions.`).css("background-color", "#ff5e57");
                break;
            //
            //fourth row end
            // fifth row start
            case r5_col1.length == 0 && r5_col2.length != 0 && r5_col3.length != 0 && r5_col4.length != 0:
                toastr.error('Quantity is mandatory.').css("background-color", "#ff5e57");
                break;
            case r5_col1.length != 0 && r5_col2.length == 0 && r5_col3.length != 0 && r5_col4.length != 0:
                toastr.error('UOM is mandatory.').css("background-color", "#ff5e57");
                break;
            case r5_col1.length != 0 && r5_col2.length != 0 && r5_col3.length == 0 && r5_col4.length != 0:
                toastr.error('Item code is mandatory.').css("background-color", "#ff5e57");
                break;
            case r5_col1.length != 0 && r5_col2.length != 0 && r5_col3.length != 0 && r5_col4.length == 0:
                toastr.error('Descriptions is mandatory.').css("background-color", "#ff5e57");
                break;
            //
            case r5_col1.length != 0 && r5_col2.length == 0 && r5_col3.length == 0 && r5_col4.length == 0 || r5_col1.length == 0 && r5_col2.length != 0 && r5_col3.length == 0 && r5_col4.length == 0 || r5_col1.length == 0 && r5_col2.length == 0 && r5_col3.length != 0 && r5_col4.length == 0 || r5_col1.length == 0 && r5_col2.length == 0 && r5_col3.length == 0 && r5_col4.length != 0 || r5_col1.length != 0 && r5_col2.length != 0 && r5_col3.length == 0 && r5_col4.length == 0 || r5_col1.length != 0 && r5_col2.length != 0 && r5_col3.length != 0 && r5_col4.length == 0 || r5_col1.length != 0 && r5_col2.length == 0 && r5_col3.length == 0 && r5_col4.length == 0 || r5_col1.length != 0 && r5_col2.length == 0 && r5_col3.length == 0 && r5_col4.length != 0 || r5_col1.length == 0 && r5_col2.length != 0 && r5_col3.length != 0 && r5_col4.length == 0 || r5_col1.length == 0 && r5_col2.length != 0 && r5_col3.length == 0 && r5_col4.length != 0:
                toastr.error(`Please complete the item descriptions.`).css("background-color", "#ff5e57");
                break;
            //
            //fifth row end
            //if the other row is blank
            case (r2_col1.length == 0 && r2_col2.length == 0 && r2_col3.length == 0 && r2_col4.length == 0) || (r3_col1.length == 0 && r3_col2.length == 0 && r3_col3.length == 0 && r3_col4.length == 0) || (r3_col1.length == 0 && r3_col2.length == 0 && r3_col3.length == 0 && r3_col4.length == 0) || (r4_col1.length == 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length == 0) || (r5_col1.length == 0 && r5_col2.length == 0 && r5_col3.length == 0 && r5_col4.length == 0):
                exe_generate();
                break;

            default:
                if (x == '') {
                    toastr.error('Quantity is mandatory.').css("background-color", "#ff5e57");
                } else if (o == '') {
                    toastr.error('UOM is mandatory.').css("background-color", "#ff5e57");
                } else if (y == '') {
                    toastr.error('Item code is mandatory.').css("background-color", "#ff5e57");
                } else if (z == '') {
                    toastr.error('Descriptions is mandatory.').css("background-color", "#ff5e57");
                } else {
                    exe_generate();
                }
        }

        exe_generate = () => {
            $.ajax({
                type: 'POST',
                url: 'controls/generate.php',
                data: mydata,

                success: function (response) {
                    if (response > 0) {
                        window.open("TCPDF-main/examples/MRF_report.php", '_blank');
                    } else {
                        toastr.error(`ERROR! Generate Failed.  Please get in touch with the system administrator at local number 124.`).css("background-color", "#ff5e57");
                    }

                },
                error: function (xhr, status, error) {
                    alert(xhr);
                    alert(status);
                    alert(error);
                }
            });
        }

    } else {
        //show toast
        toastr.error(`Fields with asterisks(*) are required`).css("background-color", "#ff5e57");
    }

});




// when row is added it will save and print
$('.upd_gen').on('click', function () {

    var id = $('#id').val();
    var project = $('#project').val();
    var project_type = $('#project_type').val();
    var classification = $('#classification').val();
    var sub_class = $('#sub_class').val();
    var cip_account = $('#cip_account').val();
    var approver = $('#approver').val();

    var data = [];

    $('table tbody tr').each(function () {
        var row = [];
        $(this).find('td').each(function () {
            row.push($(this).text());
        });
        data.push(row);
    });
    //initialize a variables to handle that will be a push array
    var qtys = [];
    var codes = [];
    var descs = [];
    $('table tr').each(function () {
        var qty = $(this).find(".qty").html();
        var code = $(this).find(".code").html();
        var desc = $(this).find(".desc").html();
        qtys.push(qty);
        codes.push(code);
        descs.push(desc);
    });
    //extract the qty value
    for (q of qtys) {
        var x = q;
    }
    //extract the itemcode value
    for (c of codes) {
        var y = c;
    }
    //extract the description value
    for (d of descs) {
        var z = d;
    }
    if (x == "") {
        toastr.error(`All quantities are required.`).css("background-color", "#ff5e57")
    } else if (y == "") {
        toastr.error(`All item codes are required.`).css("background-color", "#ff5e57");
    } else if (z == "") {
        toastr.error(`All descriptions are required.`).css("background-color", "#ff5e57");
    } else {
        // var countf = dataf.length //current number of row
        var count = data.length //total number of row when its added
        var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&data=' + JSON.stringify(data) + '&id=' + id + '&count=' + count;



        if (project != '' && project_type != '' && classification != '' && cip_account != '') {
            $.ajax({
                type: 'POST',
                url: 'controls/upd_gen.php',
                data: mydata,

                success: function (response) {
                    if (response > 0) {
                        window.open("TCPDF-main/examples/MRF_report.php", '_blank');
                    } else {
                        toastr.error(`ERROR! Please get in touch with the system administrator at local number 124.`).css("background-color", "#ff5e57");
                    }
                },
                error: function (xhr, status, error) {
                    alert(xhr);
                    alert(status);
                    alert(error);
                }
            });
        } else {
            //show toast
            toastr.error(`Fields with asterisks(*) are required`).css("background-color", "#ff5e57");

        }
    }
})

//draft as draft
$('.draft_as_draft').on('click', function () {
    var id = $('#id').val();
    var project = $('#project').val();
    var project_type = $('#project_type').val();
    var classification = $('#classification').val();
    var sub_class = $('#sub_class').val();
    var cip_account = $('#cip_account').val();
    var approver = $('#approver').val();

    var data = [];

    $('table tbody tr').each(function () {
        var row = [];
        $(this).find('td').each(function () {
            row.push($(this).text());
        });
        data.push(row);
    });

    var count = data.length //total number of row when its added
    var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&data=' + JSON.stringify(data) + '&id=' + id + '&count=' + count;


    if (project != '' && project_type != '' && classification != '' && cip_account != '' && approver != '') {
        $.ajax({
            type: 'POST',
            url: 'controls/save_draft_as_draft.php',
            data: mydata,

            success: function (response) {
                if (response > 0) {
                    $('#modal_draft').modal('show');
                }
            },
            error: function (xhr, status, error) {
                alert(xhr);
                alert(status);
                alert(error);
            }
        });
    } else {
        //show toast
        toastr.error(`Fields with asterisks(*) are required`).css("background-color", "#ff5e57");

    }

})

$('#ok_draft_as_draft').on('click', function () {
    window.location = "home.php";
})

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "1000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}