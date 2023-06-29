(function ($) {
    "use strict";

    $('#submitted_table').dataTable({
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
            'url': '../controls/all_submitted_form.php',
            'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": 'true',
            "aTargets": [9]
        },],
        aoColumnDefs: [{
            bSortable: false,
            aTargets: [0, 9]
        }]
    });
    function reload() {
        setTimeout(function () {
            location.reload();
        }, 2000);
    }

    $('#logout').on('click', function () {
        toastr["error"](`Are you sure you want to log out?<br><div class="btn btn-light btn-sm" id="yes_logout">Yes</div>`);
    });
    $(document).on('click', '#yes_logout', function () {
        window.location = "../controls/logout.php";
    })
    var click = location.search.split('click=')[1] // get the GET value 
    clickActive(click);

    $('#settings').on('click', function (e) {
        e.preventDefault();
        $('#settingmodal').modal('show');
    });

    // $('#out').on('click', function () {
    //     window.location = "../mrf/controls/logout.php";
    // });
    //modal update user settings
    $('#save_upd').on('click', (e) => {
        e.preventDefault();
        const fname = $('#upd-fname').val();
        const lname = $('#upd-lname').val();
        const uname = $('#upd-uname').val();
        const password = $('#password').val();
        const retype = $('#retype_password').val();
        const id = $('#upd-id').val();
        const mydata = 'id=' + id + '&fname=' + fname + '&lname=' + lname + '&username=' + uname + '&password=' + password;

        if (password != '') {
            if (password == retype) {
                $.ajax({
                    type: 'POST',
                    url: '../controls/update-pass.php?module=with_password',
                    data: mydata,
                    success: function (response) {
                        if (response > 0) {
                            $('#settingmodal').modal('toggle')
                            $('#user_current_pass').modal('show')
                            setTimeout(function () {
                                window.location = "../controls/logout.php";
                            }, 6000);
                        }
                    }
                })
            } else {
                toastr.error(`password is not match`).css("background-color", "#ff5e57");
            }
        } else {
            //update user dettails only
            $.ajax({
                type: 'POST',
                url: '../controls/update-pass.php?module=details_only',
                data: mydata,
                success: function (response) {
                    if (response > 0) {
                        $('#settingmodal').modal('toggle')
                        $('#user_current_pass').modal('show')
                        setTimeout(function () {
                            window.location = "../controls/logout.php";
                        }, 6000);
                    }
                }
            })
        }
    });

    $('#user_table').dataTable();
    $('#project_table').dataTable();
    $('#project_type_table').dataTable();
    $('#classification_table').dataTable();
    $('#cip_type_table').dataTable();
    $('#pro_code_table').dataTable();


    //Update User
    $(document).on('click', '#btn_user', function () {
        var upd_id = $('.upd-id').val();
        var upd_fname = $('#upd-firstname').val();
        var upd_lname = $('#upd-lastname').val();
        var upd_email = $('#upd-email').val();
        var upd_user_type = $('#upd-account_user_type').val();

        // alert(upd_id)
        var myData = 'id=' + upd_id + '&fname=' + upd_fname + '&lname=' + upd_lname + '&email=' + upd_email + '&user_type=' + upd_user_type;

        $.ajax({
            type: 'POST',
            url: '../controls/update_user.php',
            data: myData,

            success: function (response) {
                if (response > 0) {
                    toastr["success"](`User's successfully Update.`);
                }

            }
        })
    })

    $(document).on('click', '.detail', function () {

        var id = $(this).attr('value');

        $.ajax({
            type: 'POST',
            url: '../controls/view_item_details.php',
            data: {
                id: id
            },

            success: function (response) {
                $('#view_item').modal('show');
                $('#item-body').html(response);
            }
        })
    });

    //remove submitted form
    $('#remove').on('click', function () {

        var id = [];
        $('input:checkbox[name=form_sub]:checked').each(function () {
            id.push($(this).val());
        })

        if (id <= 1) {
            toastr["error"]("Please select the specific user");
        } else {
            toastr["error"]("Are you sure you want to remove this users?<br /><br /><button type='button' class='btn- btn-sm yes'>Yes</button>")
            $('.yes').on('click', function () {
                $.ajax({
                    type: 'POST',
                    url: '../controls/remove_submitted_byadmin.php',
                    data: {
                        id: id
                    },

                    success: function (response) {
                        if (response > 0) {
                            toastr["success"]("User's successfully Removed!");
                            reload();
                        } else {
                            toastr["error"]("Something is wrong, please check your code!")
                        }
                    }
                })
            })
        }
    })

    //add users
    $('#save_user').on('click', function () {
        var fname = $('#firstname').val();
        var lname = $('#lastname').val();
        var email = $('#email').val();
        var acc_type = $('#account_user_type').val();

        var mydata = 'firstname=' + fname + '&lastname=' + lname + '&email=' + email + '&acc_type=' + acc_type;

        $.ajax({
            type: 'POST',
            url: '../controls/add_user.php',
            data: mydata,

            success: function (response) {
                if (response > 0) {
                    toastr["success"]("User's Successfully Added");
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    });

    //edit user
    $(document).on('click', '.user_editt', function () {
        var id = $(this).attr('value');

        $.ajax({
            type: 'POST',
            url: '../controls/edit_user.php',
            data: { id: id },
            success: function (response) {
                $('#modal-users').modal('show');
                $('#edit_user_modal').html(response);

            }
        })
    })

    //remove user
    $(document).on('click', '.user_remove', function () {
        var id = $(this).attr('value');
        toastr["error"]("Are you sure you want to remove this user?<br /><br /><button type='button' class='btn- btn-sm yes_user'>Yes</button>")
        $('.yes_user').on('click', function () {
            $.ajax({
                type: 'POST',
                url: '../controls/remove_user.php',
                data: { id: id },

                success: function (response) {
                    if (response > 0) {
                        toastr["success"]("User's Successfully Removed");
                        reload();
                    } else {
                        toastr["error"]("Something is wrong, please check your code!")
                    }
                }
            })
        })

    });

    //hide all update button in manage section
    $('#upd_proj').hide();
    $('#upd_pro_type').hide();
    $('#upd_class').hide();
    $('#upd_cip').hide();
    $('#upd_code').hide();
    //hide all cancel button in manage section
    $('#cancel_proj').hide();
    $('#cancel_proj_type').hide();
    $('#cancel_class').hide();
    $('#cancel_cip').hide();
    $('#cancel_code').hide();


    //cancel clicked
    $('#cancel_proj').on('click', function () {
        $(this).hide();
        $('#upd_proj').hide();
        $('#f_project').val('');
        $('#add_proj').show();
    })
    $('#cancel_proj_type').on('click', function () {
        $(this).hide();
        $('#upd_pro_type').hide();
        $('#f_project_type').val('');
        $('#add_pro_type').show();
    })
    $('#cancel_class').on('click', function () {
        $(this).hide();
        $('#upd_class').hide();
        $('#f_item_id').val('');
        $('#f_items').val('');
        $('#add_class').show();
    })
    $('#cancel_cip').on('click', function () {
        $(this).hide();
        $('#upd_cip').hide();
        $('#f_cip_id').val('');
        $('#f_cip_account').val('');
        $('#add_cip').show();
    })
    $('#cancel_code').on('click', function () {
        $(this).hide();
        $('#upd_code').hide();
        $('#f_pro_code').val('');
        $('#add_code').show();
    })



    //add project
    $('#add_proj').on('click', function () {
        var project = $('#f_project').val();

        if (project != '') {
            $.ajax({
                type: 'POST',
                url: '../controls/add_project.php',
                data: { project: project },

                success: function (response) {
                    if (response > 0) {
                        toastr["success"]("Projects have been successfully added!");
                        reload();
                    } else {
                        toastr["error"]("Something is wrong, please check your code!")
                    }
                }
            })
        } else {
            $('#pro_restrict').attr('hidden', false);
        }

    })
    //add project type
    $('#add_pro_type').on('click', function () {
        var project_type = $('#f_project_type').val();

        if (project_type != '') {
            $.ajax({
                type: 'POST',
                url: '../controls/add_project_type.php',
                data: { project_type: project_type },

                success: function (response) {
                    if (response > 0) {
                        toastr["success"]("Project Type Successfully Added!");
                        reload();
                    } else {
                        toastr["error"]("Something is wrong, please check your code!")
                    }
                }
            })
        } else {
            $('#protype_restrict').attr('hidden', false);
        }

    })
    //add classification
    $('#add_class').on('click', function () {
        var item_id = $('#f_item_id').val();
        var items = $('#f_items').val();
        var mydata = 'item_id=' + item_id + '&items=' + items

        if (item_id != '' || items != '') {
            $.ajax({
                type: 'POST',
                url: '../controls/add_classification.php',
                data: mydata,

                success: function (response) {
                    if (response > 0) {
                        toastr["success"]("Classification items successfully added!");
                        reload();
                    } else {
                        toastr["error"]("Something is wrong, please check your code!")
                    }
                }
            })
        } else {
            toastr["error"]("All fields are required.")
        }
    });

    //add CIP Type
    $('#add_cip').on('click', function () {
        var cip_id = $('#f_cip_id').val();
        var cip_account = $('#f_cip_account').val();
        var mydata = 'cip_id=' + cip_id + '&cip_account=' + cip_account;
        if (cip_id != '' || cip_account != '') {
            $.ajax({
                type: 'POST',
                url: '../controls/add_cip.php',
                data: mydata,

                success: function (response) {
                    if (response > 0) {
                        toastr["success"]("CIP Account has been successfully added!");
                        reload();
                    } else {
                        toastr["error"]("Something is wrong, please check your code!")
                    }
                }
            })
        } else {
            toastr["error"]("All fields are required.");
        }
    })
    //add project code
    $('#add_code').on('click', function () {
        var proj_code = $('#f_pro_code').val();

        if (proj_code != '') {
            $.ajax({
                type: 'POST',
                url: '../controls/add_pro_code.php',
                data: { proj_code: proj_code },

                success: function (response) {
                    if (response > 0) {
                        toastr["success"]("Project code has been successfully added!");
                        reload();
                    } else {
                        toastr["error"]("Something is wrong, please check your code!")
                    }
                }
            })
        } else {
            $('#procode_restrict').attr('hidden', false);
        }

    })

    //edit project
    $(document).on('click', '.edit_pro', function () {
        var id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: '../controls/edit_pass_any_id.php',
            data: { pro_id: id },
            dataType: 'json',

            success: function (data) {
                if (data[0] > 0) {
                    $('#f_project').val(data[1]);
                    $('#add_proj').hide();
                    $('#upd_proj').show();
                    $('#cancel_proj').show();
                    $('#upd_id_project').val(id);//hidden id for update


                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    })

    //edit project type
    $(document).on('click', '.edit_pro_type', function () {
        var pro_type_id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: '../controls/edit_pass_any_id.php',
            data: { pro_type_id: pro_type_id },
            dataType: 'json',

            success: function (data) {
                if (data[0] > 0) {
                    $('#f_project_type').val(data[1]);
                    $('#add_pro_type').hide();
                    $('#upd_pro_type').show();
                    $('#cancel_proj_type').show();
                    $('#upd_id_project_type').val(pro_type_id);//hidden id for update
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    });

    //edit classification
    $(document).on('click', '.edit_class', function () {
        var class_id = $(this).attr('value');

        $.ajax({
            type: 'POST',
            url: '../controls/edit_pass_any_id.php',
            data: { class_id: class_id },
            dataType: 'json',

            success: function (data) {
                if (data[0] > 0) {
                    $('#f_item_id').val(data[1]);
                    $('#f_items').val(data[2]);
                    $('#add_class').hide();
                    $('#upd_class').show();
                    $('#cancel_class').show();
                    $('#upd_id_class').val(class_id);//hidden id for update
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    });
    //edit CIP
    $(document).on('click', '.edit_cip', function () {
        var cip_type_id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: '../controls/edit_pass_any_id.php',
            data: { cip_type_id: cip_type_id },
            dataType: 'json',

            success: function (data) {

                if (data[0] > 0) {
                    $('#f_cip_id').val(data[1]);
                    $('#f_cip_account').val(data[2]);
                    $('#add_cip').hide();
                    $('#upd_cip').show();
                    $('#cancel_cip').show();
                    $('#upd_id_cip').val(cip_type_id);//hidden id for update
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    });

    //edit project code
    $(document).on('click', '.edit_code', function () {
        var code_id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: '../controls/edit_pass_any_id.php',
            data: { code_id: code_id },
            dataType: 'json',

            success: function (data) {

                if (data[0] > 0) {
                    $('#f_pro_code').val(data[1]);
                    $('#add_code').hide();
                    $('#upd_code').show();
                    $('#cancel_code').show();
                    $('#upd_id_code').val(code_id);//hidden id for update
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    });

    //remove project
    $(document).on('click', '.remove_pro', function () {
        var del_pro_id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: '../controls/remove_pass_any_id.php',
            data: { del_pro_id: del_pro_id },

            success: function (response) {
                if (response > 0) {
                    toastr["success"]("Project's successfully removed!");
                    reload();
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    })
    //remove project type
    $(document).on('click', '.remove_pro_type', function () {
        var del_pro_type_id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: '../controls/remove_pass_any_id.php',
            data: { del_pro_type_id: del_pro_type_id },

            success: function (response) {
                if (response > 0) {
                    toastr["success"]("Project Types successfully removed!");
                    reload();
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    })
    //remove classification
    $(document).on('click', '.remove_class', function () {
        var del_class_id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: '../controls/remove_pass_any_id.php',
            data: { del_class_id: del_class_id },

            success: function (response) {
                if (response > 0) {
                    toastr["success"]("Classification's successfully removed!");
                    reload();
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    })
    //remove CIP type
    $(document).on('click', '.remove_cip', function () {
        var del_cip_type_id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: '../controls/remove_pass_any_id.php',
            data: { del_cip_type_id: del_cip_type_id },

            success: function (response) {
                if (response > 0) {
                    toastr["success"]("CIP Type has been successfully removed!");
                    reload();
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    })
    //remove project code
    $(document).on('click', '.remove_code', function () {
        var del_code_id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: '../controls/remove_pass_any_id.php',
            data: { del_code_id: del_code_id },

            success: function (response) {
                if (response > 0) {
                    toastr["success"]("Project Code has been successfully removed!");
                    reload();
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    })

    //update project
    $(document).on('click', '#upd_proj', function () {
        var upd_project = $('#f_project').val();
        var upd_id_project = $('#upd_id_project').val();

        var mydata = 'upd_project=' + upd_project + '&upd_id_project=' + upd_id_project;
        if (upd_project != '') {
            $.ajax({
                type: 'POST',
                url: '../controls/update_project.php',
                data: mydata,

                success: function (response) {
                    if (response > 0) {
                        toastr["success"]("Project's successfully updated");
                        reload();
                    } else {
                        toastr["error"]("Something is wrong, please check your code!")
                    }
                }
            })
        } else {
            $('#pro_restrict').attr('hidden', false);
        }
    });
    //update project type
    $(document).on('click', '#upd_pro_type', function () {
        var upd_project_type = $('#f_project_type').val();
        var upd_id_project_type = $('#upd_id_project_type').val();

        var mydata = 'upd_project_type=' + upd_project_type + '&upd_id_project_type=' + upd_id_project_type;

        if (upd_project_type != '') {

        } else {
            $('#protype_res')
        }
        $.ajax({
            type: 'POST',
            url: '../controls/update_project_type.php',
            data: mydata,

            success: function (response) {
                if (response > 0) {
                    toastr["success"]("Project type has been successfully updated");
                    reload();
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    });
    //update classification
    $(document).on('click', '#upd_class', function () {
        var upd_item_id = $('#f_item_id').val();
        var upd_items = $('#f_items').val();
        var upd_id_class = $('#upd_id_class').val();

        var mydata = 'upd_item_id=' + upd_item_id + '&upd_items=' + upd_items + '&upd_id_class=' + upd_id_class;

        $.ajax({
            type: 'POST',
            url: '../controls/update_classification.php',
            data: mydata,

            success: function (response) {
                if (response > 0) {
                    toastr["success"]("Classification has been successfully updated");
                    reload();
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    });
    //update CIP
    $(document).on('click', '#upd_cip', function () {
        var upd_cip_id = $('#f_cip_id').val();
        var upd_cip_account = $('#f_cip_account').val();
        var upd_id_cip = $('#upd_id_cip').val();

        var mydata = 'upd_cip_id=' + upd_cip_id + '&upd_cip_account=' + upd_cip_account + '&upd_id_cip=' + upd_id_cip;

        $.ajax({
            type: 'POST',
            url: '../controls/update_cip.php',
            data: mydata,

            success: function (response) {
                if (response > 0) {
                    toastr["success"]("CIP has been successfully updated");
                    reload();
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    });
    //update project code
    $(document).on('click', '#upd_code', function () {
        var upd_code_id = $('#f_pro_code').val();
        var upd_id_code = $('#upd_id_code').val();

        var mydata = 'upd_code_id=' + upd_code_id + '&upd_id_code=' + upd_id_code;

        $.ajax({
            type: 'POST',
            url: '../controls/update_pro_code.php',
            data: mydata,

            success: function (response) {
                if (response > 0) {
                    toastr["success"]("Project code been successfully updated");
                    reload();
                } else {
                    toastr["error"]("Something is wrong, please check your code!")
                }
            }
        })
    });
    //for active btn
    function clickActive(click) {

        switch (click) {
            case 'pro':
                $('#pro').addClass('active');
                break;
            case 'man':
                $('#dash').addClass('active');
                break;
            case 'usr':
                $('#usr').addClass('active');
                break;
            default:
                $('#man').addClass('active');
        }
    }

    //  <!--select and hide the EDIT button when multiple selection happens-->

    $(document).on('change', '#check_all', function (e) {
        e.preventDefault();
        if ($(this).prop('checked')) {
            var table = $(e.target).closest('table');
            $('tbody tr td input[type="checkbox"]').each(function () {
                $('td input:checkbox', table).prop('checked', true);
            });
            // $("#edit_user").hide(500);
        } else {
            $('tbody tr td input[type="checkbox"]').each(function () {
                $('td input:checkbox', table).prop('checked', false);
            });
            // $("#edit_user").show(500);
        }

    });

    $('#check_all').on('change', function () {
        if ($(this).prop('checked')) {
            $('#edit_form').fadeOut(500);
        } else {
            $('#edit_form').fadeIn(500);
        }

    })
    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();

    //open modal user
    $('#add_user').on('click', function () {
        $('#user_modal').modal('show');
    })

    // Sidebar Toggler
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });


    //toastr options
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

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // < !--USERNAME AUTO GENERATE-- >

    $(document).on('blur', '#upd-fname', function (e) {
        e.preventDefault();

        var str = $('#upd-fname').val();
        var fname = str.replace(/\s/g, '');
        var f = fname.toLowerCase();
        var str1 = $('#upd-lname').val();
        var lname = str1.replace(/\s/g, '');
        var l = lname.toLowerCase();
        var uname = f.concat('.').concat(l);
        $('#upd-uname').val(uname);
    });
    $(document).on('blur', '#upd-lname', function (e) {
        e.preventDefault();

        var str = $('#upd-fname').val();
        var fname = str.replace(/\s/g, '');
        var f = fname.toLowerCase();
        var str1 = $('#upd-lname').val();
        var lname = str1.replace(/\s/g, '');
        var l = lname.toLowerCase();
        var uname = f.concat('.').concat(l);
        $('#upd-uname').val(uname);
    });

})(jQuery);



