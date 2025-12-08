
var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];



function inWords(num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return;
    var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
    $('#totalInwords').text(str)
}



const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
const okButton = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true,
    timerProgressBar: true,
})

function completeInvoice() {
    var complete = 'complete';

    //   console.log([complete,total]);
}
// currency Symble
function currency1() {
    var currencysmb = document.getElementById("currencyList").value;
    $('[id="currency"]').text(currencysmb);
}



// add new Product ajax request
function addData() {
    // Invoice data
    var id = $('#id').val();
    // Product data
    var product_name = $('#product_name').val();
    var product_quantity = $('#product_quantity').val();
    var product_rate = $('#product_rate').val();

    var invoice_to = $('#invoice_to').val();
    var invoice_form = $('#invoice_form').val();
    var invoice_id = $('#invoice_id').val();
    var invoice_dou_date = $('#invoice_dou_date').val();
    var invoice_date = $('#invoice_date').val();
    var discount_amounts = $('#discount_amounts').val();
    var invoice_tax_amounts = $('#invoice_tax_amounts').val();
    var final_total = $('#final_total').val();
    var invoice_po_number = $('#invoice_po_number').val();


    $('#completeInvoice').removeClass("d-none");
    $('#draft_btn').removeClass("d-none");
    $('#previw_id').addClass("d-none");
    $('#complate_invoice_id').addClass("d-none");


    if ((product_name != '') && (product_quantity != '') && (product_rate != '')) {
        $.ajax({
            url: '/product/store',
            method: 'post',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                product_name: product_name,
                product_quantity: product_quantity,
                product_rate: product_rate,
                id: id,
                invoice_to: invoice_to,
                invoice_form: invoice_form,
                invoice_id: invoice_id,
                invoice_dou_date: invoice_dou_date,
                invoice_date: invoice_date,
                discount_amounts: discount_amounts,
                invoice_tax_amounts: invoice_tax_amounts,
                final_total: final_total,
                invoice_po_number: invoice_po_number,
            },
            dataType: 'json',
            success: function (response) {
                $('#id').val(response[1]);
                clearData();
                allData();
                document.getElementById("completeInvoice").disabled = false;
                document.getElementById("draft_btn").disabled = false;
            },
            error: function (error) {
                console.log(error);
                if (error.responseJSON.errors.product_name != null) {
                    $('#product_name').addClass("is-invalid");
                    $('#name_error').text(error.responseJSON.errors.product_name);
                } else {
                    $('#product_name').removeClass("is-invalid");
                    $('#product_name').addClass("is-valid");
                }

                if (error.responseJSON.errors.product_quantity != null) {
                    $('#product_quantity').addClass("is-invalid");
                    $('#quantity_error').text(error.responseJSON.errors.product_quantity);
                } else {
                    $('#product_quantity').removeClass("is-invalid");
                    $('#product_quantity').addClass("is-valid");
                }

                if (error.responseJSON.errors.product_rate != null) {
                    $('#product_rate').addClass("is-invalid");
                    $('#product_rate_error').text(error.responseJSON.errors.product_rate);
                } else {
                    $('#product_rate').removeClass("is-invalid");
                    $('#product_rate').addClass("is-valid");
                }

            }
        });

    }
}

$("#invoiceForm").submit(function (e) {
    e.preventDefault();
    const fd = new FormData(this);
    const submitStatus = fd.get('invoice_status') || 'complete';
    // alert("Invoice Form Submit");
    $.ajax({
        url: '/invoices/store',
        method: 'post',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (response) {
            console.log(response);
            if (response['message'] != null) {

                Swal.fire({
                    // title: '<span style="color:#FFB317;">Your package limit is over!</span> ',
                    title: `<span style="color:#FFB317;">${response['message']}</span> `,
                    // text: "Please Update Your Package..!",
                    text: "",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#FFB317',
                    cancelButtonColor: '#686868',
                    confirmButtonText: 'Go to Package Page',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = '/';
                    }
                })

            } else {
                if (response.redirect) {
                    window.location = response.redirect;
                    return;
                }

                $("#downlodeInvoice").attr("href", "/invoice/download/" + response);
                if (submitStatus === 'incomplete') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Draft saved',
                    });
                    $('#draft_btn').addClass("d-none");
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Successfuly Invoice Created ',

                    });
                    $('#previw_id').removeClass("d-none");
                    $('#complate_invoice_id').removeClass("d-none");
                    $('#completeInvoice').addClass("d-none");
                    $('#draft_btn').addClass("d-none");
                }
            }
        },
        error: function (error) {
            okButton.fire({
                icon: 'error',
                title: '<span style="color: #ffb317;">Fill up invoice form properly</span>',
            })

            // Invoice Validation
            if (error.responseJSON.errors.invoice_form != null) {
                $('#invoice_form').addClass("is-invalid");
                $('#invoice_form_error').text(error.responseJSON.errors.invoice_form);
            } else {
                $('#invoice_form').removeClass("is-invalid");
                $('#invoice_form').addClass("is-valid");
            }

            if (error.responseJSON.errors.invoice_to != null) {
                $('#invoice_to').addClass("is-invalid");
                $('#invoice_to_error').text(error.responseJSON.errors.invoice_to);
            } else {
                $('#invoice_to').removeClass("is-invalid");
                $('#invoice_to').addClass("is-valid");
            }

            if (error.responseJSON.errors.invoice_id != null) {
                $('#invoice_id').addClass("is-invalid");
                $('#invoice_id_error').text();
            } else {
                $('#invoice_id').removeClass("is-invalid");
                $('#invoice_id').addClass("is-valid");
            }

            if (error.responseJSON.errors.invoice_date != null) {
                $('#invoice_date').addClass("is-invalid");
                $('#invoice_date_error').text(error.responseJSON.errors.invoice_date);
            } else {
                $('#invoice_date').removeClass("is-invalid");
                $('#invoice_date').addClass("is-valid");
            }

            if (error.responseJSON.errors.invoice_dou_date != null) {
                $('#invoice_dou_date').addClass("is-invalid");
                $('#invoice_dou_date_error').text('The invoice due date is not a valid date,The invoice due date must be a date after invoice date.');
            } else {
                $('#invoice_dou_date').removeClass("is-invalid");
                $('#invoice_dou_date').addClass("is-valid");
            }

            if (error.responseJSON.errors.invoice_tax != null) {
                $('#invoice_tax').addClass("is-invalid");
                $('#invoice_tax_error').text(error.responseJSON.errors.invoice_tax);
            } else {
                $('#invoice_tax').removeClass("is-invalid");
                $('#invoice_tax').addClass("is-valid");
            }

            if (error.responseJSON.errors.invoice_amu_paid != null) {
                $('#invoice_amu_paid').addClass("is-invalid");
                $('#invoice_amu_paid_error').text(error.responseJSON.errors.invoice_amu_paid);
            } else {
                $('#invoice_amu_paid').removeClass("is-invalid");
                $('#invoice_amu_paid').addClass("is-valid");
            }

            if (error.responseJSON.errors.invoice_notes != null) {
                $('#invoice_notes').addClass("is-invalid");
                $('#invoice_notes_error').text(error.responseJSON.errors.invoice_notes);
            } else {
                $('#invoice_notes').removeClass("is-invalid");
                $('#invoice_notes_error').addClass("is-valid");
            }
            if (error.responseJSON.errors.invoice_terms != null) {
                $('#invoice_terms').addClass("is-invalid");
                $('#invoice_terms_error').text(error.responseJSON.errors.invoice_terms);
            } else {
                $('#invoice_terms').removeClass("is-invalid");
                $('#invoice_terms_error').addClass("is-valid");
            }


        }
    });

});

$('#completeInvoice').on('click', function () {
    $('#invoice_status').val('complete');
});

$('#draft_btn').on('click', function () {
    $('#invoice_status').val('incomlete');
    $('#invoiceForm').trigger('submit');
});

function allData() {
    var id = $('#id').val();
    // console.log(id);
    var value = "";

    $.ajax({
        type: "POST",
        dataType: 'json',
        data: { id: id },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/products/create',
        success: function (responce) {
            var data = '';
            var totalamount = 0;
            $.each(responce, function (key, value) {
                // totalamount = totalamount + value.product_amount
                let amount = parseFloat((value.product_amount + '').replace(/,/g, '')) || 0;
                totalamount += amount;

                // console.log('main calpit:' + totalamount);


                data = data + "<tr id='tableRow-" + value.id + "'>"
                data = data + "<th class='d-none'  onClick='editData(" + value.id + ")' scope='row' id='key-" + value.id + "'>" + ++key + "</th>"
                data = data + "<td style='border-bottom: 1px solid #d9d8d8;padding: 8px 10px;color: #686868; font-weight: 500;' onClick='editData(" + value.id + ")' id='product_name-" + value.id + "'>" + value.product_name + "</td>"
                data = data + "<td style='border-bottom: 1px solid #d9d8d8;padding: 8px 10px;color: #686868; font-weight: 500;'  onClick='editData(" + value.id + ")' id='product_quantity-" + value.id + "'>" + value.product_quantity + "</td>"
                data = data + "<td style='border-bottom: 1px solid #d9d8d8;padding: 8px 10px;color: #686868; font-weight: 500;' onClick='editData(" + value.id + ")' id='product_rate-" + value.id + "'>" + value.product_rate + "</td>"
                data = data + "<td style='border-bottom: 1px solid #d9d8d8;padding: 8px 10px;color: #686868; font-weight: 500;' onClick='editData(" + value.id + ")' >" + value.product_amount + "</td>"
                data = data + "<td style='border-bottom: 1px solid #d9d8d8;padding: 8px 10px;color: #686868; font-weight: 500;' class='ps-3'>"
                data = data + "<button type='button' onClick='deleteData(" + value.id + ")' class='btn btn-sm btn-danger fw-bolder'><i class='bi bi-trash'></i></button>"
                data = data + "</td>"
                data = data + "</tr>"
                if(key==6){
                    $('#id_row_limit').addClass("d-none");
                    $('#row_limit_alert').removeClass("d-none");
                }
                $('#id_conut_row').html(key);
            })
            $('#tableBody').html(data);
            total(totalamount);



        }
    })
}



function clearData() {
    $('#product_name').val('');
    $('#product_quantity').val('');
    $('#product_rate').val('');
    $('#product_amount').text('');

    $('#product_name').removeClass("is-valid");
    $('#product_quantity').removeClass("is-valid");
    $('#product_rate').removeClass("is-valid");
    $('#invoice_form').removeClass("is-valid");
    $('#invoice_to').removeClass("is-valid");
    $('#invoice_id').removeClass("is-valid");
    $('#invoice_date').removeClass("is-valid");
    $('#invoice_dou_date').removeClass("is-valid");
    $('#invoice_tax').removeClass("is-valid");
    $('#invoice_amu_paid').removeClass("is-valid");

    $('#product_name').removeClass("is-invalid");
    $('#product_quantity').removeClass("is-invalid");
    $('#product_rate').removeClass("is-invalid");
    $('#invoice_form').removeClass("is-invalid");
    $('#invoice_to').removeClass("is-invalid");
    $('#invoice_id').removeClass("is-invalid");
    $('#invoice_date').removeClass("is-invalid");
    $('#invoice_dou_date').removeClass("is-invalid");
    $('#invoice_tax').removeClass("is-invalid");
    $('#invoice_amu_paid').removeClass("is-invalid");

}


function ptotal() {
    var product_quantity = $('#product_quantity').val();
    var product_rate = $('#product_rate').val();

    var ptotal = product_quantity * product_rate;

    $('#product_amount').text(ptotal);
}

function pclear() {
    $('#product_name').val("");
    $('#product_quantity').val("");
    $('#product_rate').val("");
    $('#product_amount').text("");

    $('#product_name').removeClass("is-valid");
    $('#product_quantity').removeClass("is-valid");
    $('#product_rate').removeClass("is-valid");
    $('#product_name').removeClass("is-invalid");
    $('#product_quantity').removeClass("is-invalid");
    $('#product_rate').removeClass("is-invalid");

}

// Sub total
// function total(itemAmount) {
//     $('#subtotal').text(itemAmount);
// }

// Tax
function total(itemAmount) {
    $('#subtotal').text(itemAmount);
    // var itemAmount = $('#subtotal').text() * 1;
    var itemAmountText = $('#subtotal').text().replace(/[^0-9.]/g, '');
    var itemAmount = parseFloat(itemAmountText);



    $('#subtotal_no_vat').val(itemAmount);
    console.log('subtotal_no_vat', itemAmount);

    var tax = $('#invoice_tax').val() * 1;
    var persent = (itemAmount * tax) / 100
    $('#invoice_tax_amounts').val(persent);
    $('#text_pecent_amount').text(persent);
    var total = itemAmount + persent;


    var discount_persent = $('#discount_persent').val() * 1;

    if (discount_persent >= 100) {
        $('#discount_persent').addClass("is-invalid");
        $('#discount_persent_realtime').removeClass("d-none");

    } else {
        $('#discount_persent').removeClass("is-invalid");
        $('#discount_persent_realtime').addClass("d-none");

        var discount_amount = (total * discount_persent) / 100
        $('#discount_amount').text(discount_amount);
        $('#discount_amounts').val(discount_amount);
        var balance_due_After_dis = total - discount_amount;
        $('#total').text(balance_due_After_dis);

        inWords(balance_due_After_dis);

        $('#final_total').val(balance_due_After_dis);
        $('#balanceDue').text(total - discount_amount);
        $('#balanceDue_amounts').val(total - discount_amount);
    }

    var advance = $('#receive_advance_amount').val() * 1;

    if (advance > balance_due_After_dis) {
        $('.dateForm_recived').addClass("border_real");
        $('#receive_advance_amount').addClass("is-invalid");
        $('#receive_amount_realtime').removeClass("d-none");

    } else {
        $('.dateForm_recived').removeClass("border_real");
        $('#receive_advance_amount').removeClass("is-invalid");
        $('#receive_amount_realtime').addClass("d-none");
        var paid = balance_due_After_dis - advance;
        $('#balanceDue').text(paid);
        $('#balanceDue_amounts').val(paid);

    }
    // $('#balanceDue').text(balance_due_After_dis);
}

function editData(id) {
    var key = $('#key-' + id).text();
    var product_name = $('#product_name-' + id).text();
    var product_quantity = $('#product_quantity-' + id).text();
    var product_rate = $('#product_rate-' + id).text();

    var product_amount = product_quantity * product_rate;

    // $("#tableRow-"+id).css("display", "none");
    var input = '';
    input = input + "<tr id='editInput-" + id + "'>"
    // input = input + "<th scope='row' class='p-3' id='row-" + id + "'>" + key + "</th>"
    input = input + "<td>"
    input = input + "<textarea type='text' name='product_name' id='product_name" + id + "' class='form-control edit_data_invoice  edit_data_textarea' placeholder='Description of service or product' rows='1' onchange='addData();'>" + product_name + "</textarea>"
    input = input + "<div id='name_error' class='invalid-feedback'></div>"
    input = input + "</td>"
    input = input + "<td class='px-0'>"
    input = input + "<div class=''>"
    input = input + "<input type='number' name='product_quantity' id='product_quantity" + id + "' class='form-control edit_data_invoice edit_data_input1' value='" + product_quantity + "' placeholder='Quantity' onchange='ptotal();addData();'>"

    input = input + "<div id='quantity_error' class='invalid-feedback'></div>"
    input = input + "</div>"
    input = input + " </td>"
    input = input + "<td class='px-0'>"
    input = input + "<div class=''>"
    input = input + "<input type='number' name='product_rate' id='product_rate" + id + "' class='form-control edit_data_invoice edit_data_input2' value='" + product_rate + "' placeholder='Rate' onchange='ptotal();addData();'>"
    input = input + "<div id='product_rate_error' class='invalid-feedback'></div>"
    input = input + "</div>"
    input = input + "</td>"
    input = input + "<td class='pe-0'>"
    input = input + "<div class='rounded'>"
    input = input + "<span id='product_amount' class='fw-bolder form-control edit_data_invoice edit_data_input3'>" + product_amount + "</span>"
    input = input + "</div>"
    input = input + "</td>"
    input = input + "<td>"
    input = input + "<button type='button' onClick='saveData(" + id + ")' class='btn btn-success btn-sm ms-3 fw-bolder edit_data_invoice'><i class='bi bi-check-circle-fill'></i></button>"
    input = input + "</td>"
    input = input + "</tr>"
    $("#tableRow-" + id).replaceWith(input);


}

function deleteData(id) {

    var id = id;

    $.ajax({
        type: "delete",
        dataType: "json",
        data: { id: id },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/products/delete/" + id,
        success: function (data) {
            $('#product_amount').text("");
            allData();
        },
        error: function (error) {
        }
    });
    $('#id_row_limit').removeClass("d-none");
    $('#row_limit_alert').addClass("d-none");
}



// <!-- Image Upload Start-->
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function () {
    readURL(this);
    $('.logo_text').hide();
    $('.hide_image').hide();
});


function deleteInvoice(id) {
    console.log(id);

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/delete/invoices/' + id,
                method: 'delete',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: '',
                dataType: "json",
                success: function (data) {
                    location.reload()
                }
            })
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
}
// <!-- Image Upload End-->

function requestingAdvanceAmount() {
    var reqAdvAmo = document.getElementById("requesting_advance_amount").value;
    var total = $("#total").text() * 1;

    var requestingAdvanceAmount = (reqAdvAmo * total) / 100;

    $('#requesting_advance_amount_number').text(requestingAdvanceAmount);
    console.log(requestingAdvanceAmount);
}

function saveData(id) {
    var key = $('#row-' + id).text();
    var product_name = $('#product_name' + id).val();
    var product_quantity = $('#product_quantity' + id).val();
    var product_rate = $('#product_rate' + id).val();
    // alert([product_name,product_quantity,product_rate]);
    var id = id;
    $.ajax({
        url: '/products/update',
        type: 'PUT',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {
            key: key,
            id: id,
            product_name: product_name,
            product_quantity: product_quantity,
            product_rate: product_rate
        },
        dataType: 'json',
        success: function (responce) {
            var data = '';
            data = data + "<tr onClick='editData(" + responce.id + ")' id='tableRow-" + responce.id + "'>"
            data = data + "<th scope='row' id='key-" + responce.id + "'>" + responce.key + "</th>"
            data = data + "<td id='product_name-" + responce.id + "'>" + responce.product_name + "</td>"
            data = data + "<td id='product_quantity-" + responce.id + "'>" + responce.product_quantity + "</td>"
            data = data + "<td id='product_rate-" + responce.id + "'>" + responce.product_rate + "</td>"
            data = data + "<td>" + responce.productAmount + "</td>"
            data = data + "<td class='text-center'>"
            data = data + "<button type='button' onClick='deleteData(" + responce.id + ")' class='btn btn-sm btn-danger fw-bolder'><i class='bi bi-trash'></i></button>"
            data = data + "</td>"
            data = data + "</tr>"
            $("#editInput-" + id).replaceWith(data);
            allData();
        },
        error: function (error) {

        }
    });
}
// payemnt getway set up


// new getway payemnt setup

$("#getway_setup").submit(function (e) {
    e.preventDefault();
    const fd = new FormData(this);
    var new_package_price = document.getElementById('new_package_price').value;
    var package_price = document.getElementById('package_price').value;
    var package_id = document.getElementById('package_id').value;
    // var auth_user_id = document.getElementById('auth_user_id').value;
    // alert(package_id)

    $.ajax({
        url: '/payment/store',
        type: 'post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            new_package_price:new_package_price,
            package_id:package_id,
            auth_user_id:auth_user_id,
            package_price:package_price
        },
        dataType: 'json',
        success: function (responce) {

           if(responce.message==='error'){
            okButton.fire({
                icon: 'error',
                title: 'Please type Correct value',
              })
           }else{
            button =
            Toast.fire({
              icon: 'success',
              title: ' Package succesfuly purchase ',

            })
              $('#new_package_price').removeClass("is-valid");
              document.getElementById("submit_button").disabled = true;
              document.getElementById('new_package_price').value="";
           }

        },

    });



});


$("#send_mail_data").on("click", function () {

    var template_id = document.getElementById('last_invoice_id').value;
    var emai_to = document.getElementById('emai_to').value;
    var email_subject = document.getElementById('email_subject').value;
    var email_body = document.getElementById('email_body').value;
//  alert(template_id)
    if (emai_to == "") {
        $('#emai_to').addClass("is-invalid");
    } else {
        $('#emai_to').removeClass("is-invalid");
    }
    if (email_subject == "") {
        $('#email_subject').addClass("is-invalid");
    } else {
        $('#email_subject').removeClass("is-invalid");
    }
    if (email_subject == "" || emai_to == "") {

    } else {
        $('#emai_to').removeClass("is-invalid");
        $('#email_subject').removeClass("is-invalid");
        $.ajax({
            url: '/create/invoice/send',
            method: 'post',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                template_id: template_id,
                emai_to: emai_to,
                email_subject: email_subject,
                email_body: email_body
            },
            success: function (data) {
                console.log(data);
                if (data['message'] != null) {

                    button =
                        Toast.fire({
                            icon: 'success',
                            title: 'Mail Successfully Send ',

                        })

                    // Alert disable

                    $('#staticBackdrop').css("d-none");
                    $('.modal-backdrop').css("display", "none");
                    $('#body_alert').removeClass("modal-open");
                    $('#body_alert').css("overflow", "auto");
                    $('#body_alert').css("padding-right", "0");
                    $('#staticBackdrop').removeClass("show");
                    $('.modal-backdrop').removeClass("show");
                // Alert disable
                $('#emai_to').val("");
                setTimeout( () => location.reload(), 1000 )
                } else {
                    button =
                        Toast.fire({
                            icon: 'warning',
                            title: ' Mail Not Send',

                        })
                }


            }
        })
    }
});

// send  invoice user deshboard
$(document).on("click", ".send_invoice_mail", function (e) {
    e.preventDefault();
    var template_id = $(this).closest(".data_table_id").find("#invoice_id_user").val();
//    alert("user" + template_id);
   $('#last_invoice_id').val(template_id);

});


// priview invoice user
$(document).on("click", ".preview_image_user", function (e) {
    e.preventDefault();
    var template_id = $(this).closest(".data_table_id").find("#invoice_id_user").val();

    //  alert("user" + template_id);
    $.ajax({
        url: '/create/invoice/view/' + template_id,
        method: 'get',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            $('.preview_invoice_show').html(data);
        }
    })

});

// priview invoice Due payemnt user
$(document).on("click", "#submit_btn", function (e) {
    e.preventDefault();
    var old_recived_amount = document.getElementById('old_recived_amount').value;
    var balanceDue_amounts_user = document.getElementById('balanceDue_amounts_user').value;
    var invoice_user_id = document.getElementById('invoice_user_id').value;
    var invoice_id = document.getElementById('invoice_id').value;
    var date_id = document.getElementById('date_id').value;
    var amount_id = document.getElementById('amount_id').value;
    var invoice_id = document.getElementById('invoice_id').value;

    $.ajax({
        url: '/create/invoice/payment/save',
        method: 'post',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {
            old_recived_amount: old_recived_amount,
            balanceDue_amounts_user: balanceDue_amounts_user,
            invoice_user_id: invoice_user_id,
            invoice_id: invoice_id,
            date_id: date_id,
            amount_id: amount_id
        },
        success: function (data) {
            console.log(data);
            if (data['message'] != null) {
                button =
                    Toast.fire({
                        icon: 'success',
                        title: 'Payment success',
                    })

               $("#cart_realaod_table").load(location.href + " #cart_realaod_table");
               location.reload();
            } else {
                button =
                    Toast.fire({
                        icon: 'warning',
                        title: 'Payment Not success',
                  })
                  $('#amount_id').addClass("is-invalid");
                  $('#message_error').removeClass("d-none");
            }
          }
    })
});

// payment user priview
$(document).on("click", ".preview_payment_user", function (e) {
    e.preventDefault();
    var invoice_id = $(this).closest(".data_table_id").find("#invoice_id_user").val();

    // alert("user" + invoice_id);
    $.ajax({
        url: '/create/invoice/payment/' + invoice_id,
        method: 'get',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            $('.preview_invoice_show1').html(data);
        }
    })

});

$(document).on("change", "#date_id , #amount_id", function (e) {
    e.preventDefault();
    var new_date_id = document.getElementById('date_id').value;
    var new_amount_id = document.getElementById('amount_id').value;
    var balanceDue_amounts_user_id = document.getElementById('balanceDue_amounts_user').value;
    var balanceDue_amounts_user = parseInt(balanceDue_amounts_user_id);
    var amount_id = parseInt(new_amount_id);

    document.getElementById("amount_id").readOnly = false;

    if (new_date_id !="" && new_amount_id !="") {
        $('#submit_btn').removeClass("disabled");
    }

    if (balanceDue_amounts_user < amount_id) {
        $('#amount_id').addClass("is-invalid");
        $('#message_error').removeClass("d-none");
        $('#submit_btn').addClass("disabled");
    } else {

        if(new_date_id != "" && new_amount_id!=""){
            $('#amount_id').removeClass("is-invalid");
            $('#amount_id').addClass("is-valid");
            $('#submit_btn').removeClass("disabled");
            $('#message_error').addClass("d-none");

        }


    }

});

$("#previw_id").on("click", function () {
    var invoice_last_id = document.getElementById('id').value;
    $.ajax({
        url: '/preview/image/' + invoice_last_id,
        method: 'get',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            $('.preview_invoice_show').html(data);
        }
    });

});

$("#complate_invoice_id").on("click", function () {
    var invoice_last_id = document.getElementById('id').value;

    $.ajax({
        url: '/invoice/complate/page/' + invoice_last_id,
        method: 'get',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            if (data['message'] != null) {
                button =
                    Toast.fire({
                        icon: 'success',
                        title: 'Invoice Completed Success !!',
                    })

                    setTimeout( () => location.reload(), 1000 )

            } else {
                button =
                    Toast.fire({
                        icon: 'warning',
                        title: 'Invoice Completed Not Success',
                  })
            }
        }
    });

});

$(".save_btn_anable").on("click", function () {
    $('#completeInvoice').removeClass("d-none");
    $('#draft_btn').removeClass("d-none");
    $('#previw_id').addClass("d-none");

});



$(document).on("change", "#invoice_to,#invoice_form,#invoice_id,#invoice_dou_date,#invoice_date, #invoice_tax, #invoice_terms, #invoice_notes,  #invoice_po_number,#invoice_payment_term,  #currencyList, #imageUpload ", function (e) {
    e.preventDefault();
    $('#draft_btn').removeClass("d-none");
    $('#previw_id').addClass("d-none");
    $('#complate_invoice_id').addClass("d-none");
});


$(document).on("keyup", "#password_confirmation", function (e) {
    e.preventDefault();
    var password = document.getElementById('password').value;
    var password_confirmation = document.getElementById('password_confirmation').value;

    if(password==password_confirmation){
        $('#password').removeClass("is-invalid");
        $('#password_not_con').addClass("d-none");
        $('#register_btn_sbmt').removeClass("disabled");

    }else{
        $('#password').addClass("is-invalid");
        $('#register_btn_sbmt').addClass("disabled");
        $('#password_not_con').removeClass("d-none");


    }

});

$('#imageUpload').on('change', function() {
    let file = Math.round((this.files[0].size / 1024))
     if( file > 1024){
        $('#image_error').removeClass("text_color_img");
        $('#image_error').addClass("text-danger");
        $('#imagePreview').addClass("border_alert");

     }else{
        $('#image_error').removeClass("text-danger");
        $('#imagePreview').removeClass("border_alert");
        $('#image_error').addClass("text_color_img");
     }
   // alert('This file size is: ' + file );
 });
// invoice tamplate more data load function home page
var token = $('input[name="_token"]').val();
load_more('', token);
function load_more(id = '', token) {
    $.ajax({
        url: '/load-data',
        method: "POST",
        data: { id: id, _token: token },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            $('.load-more-template').addClass("d-none");
            $('.invoice_template_margin').append(data);
        }
    })
}
$('body').on('click', '#loadMoreBotton', function () {
    var id = $(this).data('id');

    $('#loadMoreBotton').html('loading...');
    load_more(id);

});
// invoice tamplate more data load function

// invoice create date and due date validation
function updateDueDate() {
    const invoiceInput = document.getElementById('invoice_current_date');
    const dueInput = document.getElementById('invoice_date_due');

    const invoiceDateValue = invoiceInput.value;
    if (!invoiceDateValue) return;

    const invoiceDate = new Date(invoiceDateValue);
    const dueDate = new Date(invoiceDate);
    dueDate.setDate(dueDate.getDate() + 7);

    const yyyy = dueDate.getFullYear();
    const mm = String(dueDate.getMonth() + 1).padStart(2, '0');
    const dd = String(dueDate.getDate()).padStart(2, '0');

    const formattedDueDate = `${yyyy}-${mm}-${dd}`;

    dueInput.value = formattedDueDate;
    dueInput.min = invoiceDateValue;
}

// On page load
window.addEventListener('DOMContentLoaded', updateDueDate);

// On invoice date change
document.getElementById('invoice_current_date')
    .addEventListener('change', updateDueDate);

