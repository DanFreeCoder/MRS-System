$(document).ready(function () {
    $('.select2').select2();

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


    //add row
    var count = 1;
    $(document).on('click', '#addrow', function () {
        count = count + 1;
        var html = `<tr id="row${count}">`;
        html += `
              <td contenteditable class="editable-cell" hidden></td>
              <td contenteditable class="editable-cell qty"></td>
              <td contenteditable class="editable-cell"></td>
              <td contenteditable class="editable-cell code"></td>
              <td contenteditable class="editable-cell desc"></td>
              <td contenteditable class="editable-cell"></td>
              <td style="width:2px; margin-right:0px;"><div class="removes btn btn-danger btn-sm" id="remove" data-row="row${count}" style="border-radius:100%; border:none;"><i class="bi bi-x"></i></div></td>
              </tr>
              `;
        $('table tbody').append(html);


    });

    $('#clear').on('click', function () {
        $('.editable-cell').text('');
    })

    //remove existing data from database
    $('.remove').on('click', function () {
        var drafted_id = $(this).attr('value');

        $.ajax({
            type: 'POST',
            url: 'controls/remove_item_edit_form.php',
            data: {
                id: drafted_id
            },
            success: (response) => {
                if (response > 0) {
                    toastr.info(`Remove Successfully`).css("background-color", "#67e6dc");
                    reload(2000);
                }
            }

        })
    });

    $('#update').on('click', function () {
        const id = $('#id').val();
        const user_id = $('#user_id').val();
        const project = $('#project option:selected').val();
        const project_type = $('#project_type option:selected').val();
        const classification = $('#classification option:selected').val();
        const sub_class = $('#sub_class').val();
        const cip_account = $('#cip_account option:selected').val();
        const approver = $('#approver').val();

        // alert(classification)
        // alert(cip_account)
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

        var mydata = 'id=' + id + '&user_id=' + user_id + '&project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&data=' + JSON.stringify(data) + '&id=' + id + '&count=' + count;

        if (project != '' && project_type != '' && classification != '' && cip_account != '') {
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
                case r2_col1.length != 0 && r2_col2.length == 0 && r2_col3.length == 0 && r2_col4.length == 0 || r2_col1.length == 0 && r2_col2.length != 0 && r2_col3.length == 0 && r2_col4.length == 0 || r2_col1.length == 0 && r2_col2.length == 0 && r2_col3.length != 0 && r2_col4.length == 0 || r2_col1.length == 0 && r2_col2.length == 0 && r2_col3.length == 0 && r2_col4.length != 0 || r2_col1.length != 0 && r2_col2.length != 0 && r2_col3.length == 0 && r2_col4.length == 0 || r2_col1.length != 0 && r2_col2.length != 0 && r2_col3.length != 0 && r2_col4.length == 0 || r2_col1.length != 0 && r2_col2.length != 0 && r2_col3.length == 0 && r2_col4.length == 0 || r2_col1.length != 0 && r2_col2.length == 0 && r2_col3.length == 0 && r2_col4.length != 0 || r2_col1.length == 0 && r2_col2.length != 0 && r2_col3.length != 0 && r2_col4.length == 0 || r2_col1.length == 0 && r2_col2.length != 0 && r2_col3.length == 0 && r2_col4.length != 0 || r2_col1.length == 0 && r2_col2.length == 0 && r2_col3.length != 0 && r2_col4.length != 0:
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
                case r3_col1.length != 0 && r3_col2.length == 0 && r3_col3.length == 0 && r3_col4.length == 0 || r3_col1.length == 0 && r3_col2.length != 0 && r3_col3.length == 0 && r3_col4.length == 0 || r3_col1.length == 0 && r3_col2.length == 0 && r3_col3.length != 0 && r3_col4.length == 0 || r3_col1.length == 0 && r3_col2.length == 0 && r3_col3.length == 0 && r3_col4.length != 0 || r3_col1.length != 0 && r3_col2.length != 0 && r3_col3.length == 0 && r3_col4.length == 0 || r3_col1.length != 0 && r3_col2.length != 0 && r3_col3.length != 0 && r3_col4.length == 0 || r3_col1.length != 0 && r3_col2.length == 0 && r3_col3.length == 0 && r3_col4.length == 0 || r3_col1.length != 0 && r3_col2.length == 0 && r3_col3.length == 0 && r3_col4.length != 0 || r3_col1.length == 0 && r3_col2.length != 0 && r3_col3.length != 0 && r3_col4.length == 0 || r3_col1.length == 0 && r3_col2.length != 0 && r3_col3.length == 0 && r3_col4.length != 0 || r3_col1.length == 0 && r3_col2.length == 0 && r3_col3.length != 0 && r3_col4.length != 0:
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
                case r4_col1.length != 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length == 0 || r4_col1.length == 0 && r4_col2.length != 0 && r4_col3.length == 0 && r4_col4.length == 0 || r4_col1.length == 0 && r4_col2.length == 0 && r4_col3.length != 0 && r4_col4.length == 0 || r4_col1.length == 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length != 0 || r4_col1.length != 0 && r4_col2.length != 0 && r4_col3.length == 0 && r4_col4.length == 0 || r4_col1.length != 0 && r4_col2.length != 0 && r4_col3.length != 0 && r4_col4.length == 0 || r4_col1.length != 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length == 0 || r4_col1.length != 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length != 0 || r4_col1.length == 0 && r4_col2.length != 0 && r4_col3.length != 0 && r4_col4.length == 0 || r4_col1.length == 0 && r4_col2.length != 0 && r4_col3.length == 0 && r4_col4.length != 0 || r4_col1.length == 0 && r4_col2.length != 0 && r4_col3.length == 0 && r4_col4.length != 0 || r4_col1.length == 0 && r4_col2.length == 0 && r4_col3.length != 0 && r4_col4.length != 0:
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
                case r5_col1.length != 0 && r5_col2.length == 0 && r5_col3.length == 0 && r5_col4.length == 0 || r5_col1.length == 0 && r5_col2.length != 0 && r5_col3.length == 0 && r5_col4.length == 0 || r5_col1.length == 0 && r5_col2.length == 0 && r5_col3.length != 0 && r5_col4.length == 0 || r5_col1.length == 0 && r5_col2.length == 0 && r5_col3.length == 0 && r5_col4.length != 0 || r5_col1.length != 0 && r5_col2.length != 0 && r5_col3.length == 0 && r5_col4.length == 0 || r5_col1.length != 0 && r5_col2.length != 0 && r5_col3.length != 0 && r5_col4.length == 0 || r5_col1.length != 0 && r5_col2.length == 0 && r5_col3.length == 0 && r5_col4.length == 0 || r5_col1.length != 0 && r5_col2.length == 0 && r5_col3.length == 0 && r5_col4.length != 0 || r5_col1.length == 0 && r5_col2.length != 0 && r5_col3.length != 0 && r5_col4.length == 0 || r5_col1.length == 0 && r5_col2.length != 0 && r5_col3.length == 0 && r5_col4.length != 0 || r5_col1.length == 0 && r5_col2.length == 0 && r5_col3.length != 0 && r5_col4.length != 0:
                    toastr.error(`Please complete the item descriptions.`).css("background-color", "#ff5e57");
                    break;
                //
                //fifth row end
                //if the other row is blank
                case (r2_col1.length == 0 && r2_col2.length == 0 && r2_col3.length == 0 && r2_col4.length == 0) || (r3_col1.length == 0 && r3_col2.length == 0 && r3_col3.length == 0 && r3_col4.length == 0) || (r3_col1.length == 0 && r3_col2.length == 0 && r3_col3.length == 0 && r3_col4.length == 0) || (r4_col1.length == 0 && r4_col2.length == 0 && r4_col3.length == 0 && r4_col4.length == 0) || (r5_col1.length == 0 && r5_col2.length == 0 && r5_col3.length == 0 && r5_col4.length == 0):
                    form_update(mydata);
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
                        form_update(mydata);
                    }
            }
        } else {
            //show toast
            toastr.error(`Fields with asterisks(*) are required`).css("background-color", "#ff5e57");

        }
    })
    form_update = (mydata) => {
        $.ajax({
            type: 'POST',
            url: 'controls/update_data_edit_form.php',
            data: mydata,

            success: function (response) {
                if (response > 0) {
                    toastr.success(`Updated Successfully!`).css("background-color", "#05c46b");
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
    }

    reload = (duration) => {
        setTimeout(function () {
            location.reload();
        }, duration)
    }
    //end of document
});