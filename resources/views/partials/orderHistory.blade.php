<!-- Modal -->
<div class="modal fade" id="orderHistoryModal" tabindex="-1" aria-labelledby="orderHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderHistoryModalLabel">ประวัติการสั่งซื้อ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="resultHistory"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    var _xhr;
    function getOrderHistory() {
        _xhr = $.ajax({
            url: '{{ route('orderHistory')}}',
            method: 'GET',
            beforeSend: function () {
                _xhr && _xhr.abort();
            },
            success: function (response) {
                if (response.status == 1) {
                    $.each(response.data, function (index, item) {
                        let html_q =
                            `
                            <div class="jumbotron jumbotron-fluid">
                                <div class="container-fluid mt-2">
                                    <div class="row">
                                        <div class="col-md-4">จำนวน</div>
                                        <div class="col-md-4 ml-auto">${item.sum_qty}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">ราคา</div>
                                        <div class="col-md-4 ml-auto">${item.sum_total}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">สถานะการสั่งซื้อ</div>
                                        <div class="col-md-4 ml-auto">${item.order_status}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">วันที่จัดส่ง</div>
                                        <div class="col-md-4 ml-auto">${item.order_delivery}</div>
                                    </div>
                                </div>
                            </div>
                         `
                        $("#resultHistory").append(html_q);
                    });
                    $('#orderHistoryModal').modal('show');
                } else {
                    let html_q =
                            `
                            <div class="jumbotron jumbotron-fluid">
                                <h2>ไม่พบข้อมูล</h2>
                            </div>
                         `
                    $('#orderHistoryModal').modal('show');
                }
            },
            error : function () {
                _xhr && _xhr.abort();
            }
        });
    }
</script>