<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<style>
    .input-validation-error~.select2 {
        border: 1px solid red;
        border-radius: 5px;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slide-in {
        animation: slideIn 0.5s ease-in-out;
    }

    .custom-dropdown {
        min-width: 1;
        border: none;
    }

    .completed-task {
        text-decoration: line-through;
        color: #888;
    }
</style>

<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header" style="background-color:#FF6868;color:white;">
                                        To Do <span data-card-widget="collapse" style="float:right;" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </span>
                                    </div>
                                    <div class="card-body kanban-column" id="todo-list">
                                        <!-- Todo list items will be dynamically added here -->
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header" style="background-color:#503C3C;color:white;">
                                        In Progress <span data-card-widget="collapse" style="float:right;" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </span>
                                    </div>
                                    <div class="card-body kanban-column" id="inprogress-list">
                                        <!-- In Progress list items will be dynamically added here -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header" style="background-color:#0D9276;color:white;">
                                        Done <span data-card-widget="collapse" style="float:right;" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </span>
                                    </div>
                                    <div class="card-body kanban-column" id="done-list">
                                        <!-- Done list items will be dynamically added here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
</div>

<!-- Create Task Modal -->

<!-- Create Task Modal End here -->
</section>
</div>

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="assets/js/commonfunctions.js"></script>
<script>
    $(function() {
        getTaskStatus();
    });

    function getTaskStatus() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getTaskStatus";
        obj.JSON = {};
        TransportCall(obj);
    }

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getTaskStatus":
                    populateBoard(rc.return_data);
                    break;
                default:
                    notify('warning', rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }


//   Populate Kanban Board
    function populateBoard(list) {
        for (var i = 0; i < list.length; i++) {
            var task = list[i];
            if (task.TODO === '1') {
                appendToColumn(task, 'todo-list');
            } else if (task.Progress === '1') {
                appendToColumn(task, 'inprogress-list');
            } else if (task.Completed === '1') {
                appendToColumn(task, 'done-list');
            }
        }
    }

    // Helper function to append task to the corresponding column
    function appendToColumn(task, containerId) {
        debugger;
        var container = $("#" + containerId);
        container.append('<div class="card mb-2">' +
            '<div class="card-body">' +
            '<p style="font-size:15px;"><span class="badge badge-info">Task Name:</span>&nbsp;' + task.TaskName + '</p>' +
            '<p style="font-size:15px;"><span class="badge badge-primary">Duration:</span>&nbsp;' + task.Duration + ' min <i class="fas fa-clock"></i></p>' +
            '<p style="font-size:15px;"><span class="badge badge-danger">Description:</span>&nbsp;' + task.Description + '</p>' +
            '</div>' +
            '</div>');
    }

</script>