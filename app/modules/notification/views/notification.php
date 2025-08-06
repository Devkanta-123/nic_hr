<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.css" integrity="sha512-QmxybGIvkSI8+CGxkt5JAcGOKIzHDqBMs/hdemwisj4EeGLMXxCm9h8YgoCwIvndnuN1NdZxT4pdsesLXSaKaA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-md-10">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Notification</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive-xl text-center my-3">
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Type</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Message</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <div class="ps-5" id="pagination-container"></div> <!--  // For Pagination -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- /.content-wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js" integrity="sha512-1zzZ0ynR2KXnFskJ1C2s+7TIEewmkB2y+5o/+ahF7mwNj9n3PnzARpqalvtjSbUETwx6yuxP5AJXZCpnjEJkQw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function() {
        getUserUnreadNotifications();
    })


    function getUserUnreadNotifications() {
        let obj = {};
        obj.Module = "Notification";
        obj.Page_key = "getUserUnreadNotifications";
        obj.JSON = {};
        TransportCall(obj);
    }

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getUserUnreadNotifications":
                    //use pagination plugins 
                    $('#pagination-container').pagination({
                        dataSource: rc.return_data,
                        pageSize: 10,
                        callback: function(data, pagination) {
                            loaddata(data);
                        }
                    });
                    $('#table').removeClass('d-none');
                    break;
                case "removeNotification":
                    notify('success', rc.return_data);
                    getUserUnreadNotifications();
                    break;

            }
        } else {
            notify("error", rc.return_data);
        }
    }

    function loaddata(data) {
        var text = "";
        if (data.length == 0) {
            $('#pagination-container').hide();
            text += '<tr><td colspan="6" class="text-center">No data found</td></tr>';
        } else {
            for (let i = 0; i < data.length; i++) {
                text += `<tr>
                            <th scope="row">` + data[i].NotificationType + `</th>
                            <td>` + moment(data[i].NotificationDateTime).format('MMMM Do YY, h:mm a') + `</td>
                        <td>` + escapeHtml(data[i].Message) + `</td>
                        <td><button class="btn btn-sm btn-link" onclick="onDelete(` + data[i].NotificationID + `)"> <i class="bx bx-trash font-size-18 align-middle me-2 text-danger"></i> </button></td>
                    </tr>`;
            }
            $('#pagination-container').show();
        }
        $('#table tbody').html(text);
    }

    function onDelete(ID) {
        if (confirm("Are you sure?")) {
            let obj = {};
            obj.Module = "Notification";
            obj.Page_key = "removeNotification";
            obj.JSON = {
                NotificationID: ID
            };
            TransportCall(obj);
        }
    }
    function escapeHtml(unsafe)
    {
            return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
</script>