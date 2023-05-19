$(document).ready(function () {

    $('#admin_side').on('click', function () {
        window.location = "adminpage/dashboard.php?click=" + 'man';
    })

    $('#logout').on('click', function () {
        $('#log_out').modal('show');
    });
    $('#out').on('click', function () {
        window.location = "../mrf/controls/logout.php";
    });
    // user settings
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
                            $('#user_current_pass').modal('show');
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

    })


    $('.select2').select2();

    $('#generate').click(function () {


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
        var oums = [];
        var codes = [];
        // var brands = [];
        var descs = [];
        // var specs = [];
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
        var r1_col1 = data[0][0];
        var r1_col2 = data[0][1];
        var r1_col3 = data[0][2];
        var r1_col4 = data[0][3];
        var r2_col1 = data[1][0];
        var r2_col2 = data[1][1];
        var r2_col3 = data[1][2];
        var r2_col4 = data[1][3];
        var r3_col1 = data[2][0];
        var r3_col2 = data[2][1];
        var r3_col3 = data[2][2];
        var r3_col4 = data[2][3];
        var r4_col1 = data[3][0];
        var r4_col2 = data[3][1];
        var r4_col3 = data[3][2];
        var r4_col4 = data[3][3];
        var r5_col1 = data[4][0];
        var r5_col2 = data[4][1];
        var r5_col3 = data[4][2];
        var r5_col4 = data[4][3];

        var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&data=' + JSON.stringify(data);

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
                case r4_col1.length != 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length == 0 || r4_col1.length == 0 && r4_col2.length != 0 && r4_col3.length == 0 && r4_col4.length == 0 || r4_col1.length == 0 && r4_col2.length == 0 && r4_col3.length != 0 && r4_col4.length == 0 || r4_col1.length == 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length != 0 || r4_col1.length != 0 && r4_col2.length != 0 && r4_col3.length == 0 && r4_col4.length == 0 || r4_col1.length != 0 && r4_col2.length != 0 && r4_col3.length != 0 && r4_col4.length == 0 || r4_col1.length != 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length == 0 || r4_col1.length != 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length != 0 || r4_col1.length == 0 && r4_col2.length != 0 && r4_col3.length != 0 && r4_col4.length == 0 || r4_col1.length == 0 && r4_col2.length != 0 && r4_col3.length == 0 && r4_col4.length != 0:
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

        } else {
            //show toast
            toastr.error(`Fields with asterisks(*) are required`).css("background-color", "#ff5e57");

        }





        function exe_generate() {

            $.ajax({
                type: 'POST',
                url: 'controls/insert.php',
                data: mydata,

                success: function (response) {
                    if (response > 0) {
                        window.open("TCPDF-main/examples/MRF_report.php", '_blank');
                        toastr.success(`Generated Successfully`).css("background-color", "#05c46b");
                    } else {
                        toastr.error(`ERROR! Please get in touch with the system administrator at local number 124.`).css("background-color", "#ff5e57");
                    }

                }
            });
        }


    });
    //add row
    var count = 1;
    $('#addrow').on('click', function () {
        count = count + 1;
        var html = `<tr id="row${count}">`;
        html += `
            <td contenteditable class="editable-cell qty"></td>
            <td contenteditable class="editable-cell oum"></td>
            <td contenteditable class="editable-cell code"></td>
            <td contenteditable class="editable-cell desc"></td>
            <td contenteditable class="editable-cell remark"></td>
            <td style="width:2px; margin-right:0px;"><button class="remove btn-danger" id="remove" data-row="row${count}" style="border-radius:100%; border:none;"><i class="bi bi-x"></i></button></td>
            </tr>
            `;
        $('table tbody').append(html);


    });
    //remove row
    $(document).on('click', '.remove', function () {
        var delete_row = $(this).data('row');
        $('#' + delete_row).remove();
    })

    //save as draft
    $(document).on('click', '.draft', function () {
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

        var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&data=' + JSON.stringify(data);


        if (project != '' && project_type != '' && classification != '' && cip_account != '' && approver != '') {
            $.ajax({
                type: 'POST',
                url: 'controls/draft.php',
                data: mydata,

                success: function (response) {
                    if (response > 0) {
                        toastr.success(`Successfully save as a draft. You may check your dashboard.`).css("background-color", "#05c46b");
                        // window.location = "home.php";
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



});



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