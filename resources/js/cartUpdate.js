

$(document).ready(function () {
    $('.button-update').on('click', function () {
        var url = $(this).data('url');
        listCart = [];
        var total = 0;
        var amount = 0;

        $('table tbody tr td').each(function () {
            $(this).find('input.qty').each(function () {
                var data = {
                    key: $(this).data('id'),
                    value: $(this).val(),
                    quantity: $(this).data('qty'),
                    productId: $(this).data('product')
                };
                listCart.push(data);
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                data: listCart,
            },
            success: function (response) {
                $.each(response.carts, function (key, item) {
                    amount += parseInt(item.qty);
                    total += item.price * item.qty;
                    totalCost = '$' + total.toLocaleString('en-US');
                    totalItem = '$' + (item.price * item.qty).toLocaleString('en-US');
                    $('#totalCost').text(totalCost);
                    $("#quantity-" + item.rowId).data("qty", item.qty);
                    $('#cost-' + item.rowId).text(totalItem);
                    $('.totalCart').text(totalCost);
                    $('.total').text(amount);
                });
            }
        });
    });

    $(document).on('click', '.btn-delete', function () {
        var url = $(this).attr('data-url');
        var itemName = $(this).data('name');
        var _this = $(this);
        var total = 0;
        var amount = 0;
        if (confirm('Do you want to delete item ' + itemName + '?')) {
            $.ajax({
                method: 'GET',
                url: url,
                type: 'delete',
                success: function (response) {
                    $.each(response.carts, function (key, item) {
                        amount += parseInt(item.qty);
                        total += item.price * item.qty;
                        totalCost = '$' + total.toLocaleString('en-US');
                        totalItem = item.price * item.qty;
                    });

                    if (jQuery.isEmptyObject(response.carts)) {
                        $('#totalCost').text("0");
                        $('.totalCart').text("0");
                        $('.total').text("0");
                    } else {
                        $('#totalCost').text(totalCost);
                        $('.totalCart').text(totalCost);
                        $('.total').text(amount);
                    }

                    _this.parent().parent().remove()
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        }
    });

    $(document).on('click', '.quantityUpdate', function () {
        var status = $(this).attr('data-status');
        var rowId = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        var urlDelete = $(this).attr('data-urlDelete');
        var quantity = $('#quantity-' + rowId).val();
        var _this = $(this);
        var total = 0;
        var amount = 0;
        if (quantity == 1) {
            if (status == 'minusCart') {
                if (confirm('Do you want to delete item ' + '?')) {
                    $.ajax({
                        method: 'GET',
                        url: urlDelete,
                        type: 'delete',
                        success: function (response) {
                            $.each(response.carts, function (key, item) {
                                amount += parseInt(item.qty);
                                total += item.price * item.qty;
                                totalCost = '$' + total.toLocaleString('en-US');
                                totalItem = item.price * item.qty;
                            });

                            if (jQuery.isEmptyObject(response.carts)) {
                                $('#totalCost').text("0");
                                $('.totalCart').text("0");
                                $('.total').text("0");
                            } else {
                                $('#totalCost').text(totalCost);
                                $('.totalCart').text(totalCost);
                                $('.total').text(amount);
                            }

                            _this.parent().parent().parent().parent().remove()
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            //xử lý lỗi tại đây
                        }
                    })
                }
            } else {
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        status: status,
                        rowId: rowId,
                    },
                    success: function (response) {
                        $.each(response.carts, function (key, item) {
                            amount += parseInt(item.qty);
                            totalItem = '$' + (item.price * item.qty).toLocaleString('en-US');
                            total += item.price * item.qty;
                            totalCost = '$' + total.toLocaleString('en-US');
                            $('#cost-' + item.rowId).text(totalItem);
                            $('#quantity-' + item.rowId).val(item.qty);
                            $('#totalCost').text(totalCost);
                            $('.totalCart').text(totalCost);
                            $('.total').text(amount);
                        });
                    }
                });
            }
        } else {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                data: {
                    status: status,
                    rowId: rowId,
                },
                success: function (response) {
                    $.each(response.carts, function (key, item) {
                        amount += parseInt(item.qty);
                        totalItem = '$' + (item.price * item.qty).toLocaleString('en-US');
                        total += item.price * item.qty;
                        totalCost = '$' + total.toLocaleString('en-US');
                        $('#cost-' + item.rowId).text(totalItem);
                        $('#quantity-' + item.rowId).val(item.qty);
                        $('#totalCost').text(totalCost);
                        $('.totalCart').text(totalCost);
                        $('.total').text(amount);
                    });
                }
            });
        }
    })

});


