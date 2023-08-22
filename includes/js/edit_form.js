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
        var id = $('#id').val();
        var user_id = $('#user_id').val();
        var project = $('#project option:selected').val();
        var project_type = $('#project_type option:selected').val();
        var classification = $('#classification option:selected').val();
        var sub_class = $('#sub_class').val();
        var cip_account = $('#cip_account option:selected').val();
        var approver = $('#approver').val();

        var data = [];
        $('table tbody tr').each(function () {
            var row = [];
            $(this).find('td').each(function () {
                row.push($(this).text());
            });
            data.push(row);
        });

        var mydata = 'id=' + id + '&user_id=' + user_id + '&project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&data=' + JSON.stringify(data) + '&id=' + id + '&count=' + count;
        if (project != '' || project_type != '' || classification != '' || cip_account != '' || approver.length != 0) {
            var yes = false;
            check_param = (param, mydata) => {
                for (let i of param) {
                    i.pop();//remove the last parameter where the button is placed
                    i.pop();//remove remarks, it not mandatory
                    i.shift();//remove first parameter, id
                    // console.log(i)
                    $.each(i, function (index, value) {
                        if (value == '') {
                            yes = true;
                        }
                    })
                }
                if (yes) {
                    toastr.error(`All fields are mandatory, except the remarks field.`).css("background-color", "#ff5e57");
                } else {
                    form_update(mydata);
                }
            }
            check_param(data, mydata);
        } else {
            //show toast
            toastr.error(`Fields with asterisks(*) are required`).css("background-color", "#ff5e57");
        }
    });
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
});//end of document