<link href="assets/js/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<style>
    .table-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0;
        /* Remove margin bottom */
    }

    .table {
        margin: 0;
        /* Remove all margins */
        padding: 0;
        /* Remove all paddings */
        width: 50%;
        /* Set width to 50% for each table */
    }

    .small-input {
        width: 50px;
        /* Adjust the width as per your requirement */
    }
</style>
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Staff Salary
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="training_name">Staff</label>
                                        <select class="form-control" id="staffs">
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="table-container">
                                <table class="table table-bordered table-striped" style="width: 50%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Earning <span class="add-earning-field" style="float:right; margin-right: 40px; cursor:pointer; font-size: 10px; border-radius: 20px; padding: 5px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);background-color: #41B06E;color: white;">Add Row</span> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                                <table class="table table-bordered table-striped" style="width: 50%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Deduction <span class="add-deduction-field" style="float:right; margin-right: 40px; cursor:pointer; font-size: 10px; border-radius: 20px; padding: 5px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);background-color: #C0D6E8;color: white;">Add Row</span> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <button class="btn-primary btn-xs" id="btnAddSalary"> Save</button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require_once(VIEWPATH . "/basic/footer.php"); ?>


<!-- Jasny File -->
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
<script>
    $(function() {
        getStaff();
        // getAllStaffSalarySettings();
        getAllEarningSalaryHead();
        getAllDeductionSalaryHead();
    });


    $('#staffs').change(function() {
        if (!$(this).val() == -1) {
            // $('#error-msg').show();
            notify("error", "No Staff Selected");
        } else {
            $('#error-msg').hide();
        }
    });



    function getStaff() {
        var obj = new Object();
        obj.Module = "Staff";
        obj.Page_key = "getStaff";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }


    function getAllEarningSalaryHead() {
        var obj = new Object();
        obj.Module = "Staff";
        obj.Page_key = "getAllEarningSalaryHead";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }


    function getAllDeductionSalaryHead() {
        var obj = new Object();
        obj.Module = "Staff";
        obj.Page_key = "getAllDeductionSalaryHead";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }





    // function getAllStaffSalarySettings() {
    //     var obj = new Object();
    //     obj.Module = "Staff";
    //     obj.Page_key = "getAllStaffSalarySettings";
    //     var json = new Object();
    //     obj.JSON = json;
    //     SilentTransportCall(obj);
    // }


    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "addStaffSalary":
                    notify("success", rc.return_data);
                    location.reload();
                    break;
                    // case "getAllStaffSalarySettings":
                    //     console.log(rc.return_data);
                    //     loaddata(rc.return_data);
                    //     break;

                case "editSalaryHead":
                    notify("success", rc.return_data);
                    // getAllStaffSalarySettings();
                    $("#EditModal").modal("hide");
                    break;

                case "getStaff":
                    loadSelect("#staffs", rc.return_data);
                    break;

                case "getAllEarningSalaryHead":
                    loadEarningSalaryHead(rc.return_data);
                    break;

                case "getAllDeductionSalaryHead":
                    console.log(rc.return_data);
                    loadDeductionSalaryHead(rc.return_data);
                    break;


                case "updateSalarySettings":
                    notify("success", rc.return_data);
                    // getAllStaffSalarySettings();
                    $("#EditModal").modal("hide");
                    break;

                default:
                    notify("error", rc.Page_key);
            }
        } else {
            //alert(rc.return_data);
            notify("error", rc.return_data);
        }
        // alert(JSON.stringify(args));
    }





    var earningOptions;
    var deductionOptions;

    function loadEarningSalaryHead(data) {
        earningOptions = Object.values(data).map(option => {
            return {
                label: option.Salary_Head, //Salary_HeadAlias
                value: option.Salary_HeadID
            };
        });
    }

    function loadDeductionSalaryHead(data) {
        deductionOptions = Object.values(data).map(option => {
            return {
                label: option.Salary_Head, //Salary_HeadAlias
                value: option.Salary_HeadID
            };
        });
    }

    document.querySelector('.add-deduction-field').addEventListener('click', function() {
        addField('deduction', deductionOptions);
    });

    document.querySelector('.add-earning-field').addEventListener('click', function() {
        addField('earning', earningOptions);
    });


    function addField(type, options) {
        var selectDropdown = document.createElement('select');

        // Populate select dropdown with options
        options.forEach(option => {
            var optionElement = document.createElement('option');
            optionElement.textContent = option.label;
            optionElement.value = option.value;
            selectDropdown.appendChild(optionElement);
        });

        var inputField = document.createElement('input');
        inputField.setAttribute('type', 'number');
        inputField.setAttribute('placeholder', 'Enter Amount');
        // Add spaces between the input field and the delete button
        var space1 = document.createTextNode('\u00A0'); // Unicode for non-breaking space
        var deleteButton = document.createElement('button');
        deleteButton.textContent = '❌'; // You can use any icon or text for delete

        // Add click event listener to the delete button
        deleteButton.addEventListener('click', function() {
            // Remove the row when the delete button is clicked
            this.parentNode.parentNode.remove();
        });

        var newRow = document.createElement('tr');

        // Create the first cell for the select dropdown
        var selectCell = document.createElement('td');
        selectCell.appendChild(selectDropdown);

        // Create the cell for the input field
        var inputCell = document.createElement('td');
        inputCell.appendChild(inputField);

        // Append the delete button directly after the input field
        inputCell.appendChild(deleteButton);

        // Append the cells to the new row
        newRow.appendChild(selectCell);
        newRow.appendChild(inputCell); // Add input cell with delete button

        // Get the correct tbody based on the type
        var tbody;
        if (type === 'earning') {
            tbody = document.querySelector('.table:nth-of-type(1) tbody');
        } else if (type === 'deduction') {
            tbody = document.querySelector('.table:nth-of-type(2) tbody');
        }

        tbody.appendChild(newRow);
    }
    var totalEarningAmount = 0; // Initialize total earning amount to zero
    var totalDeductionAmount = 0; // Initialize total deduction amount to zero
    var netAmount = 0; // Initialize net amount to zero

    function collectData() {
        debugger;
        var earningData = [];
        var deductionData = [];

        // Collect data from the earning table
        document.querySelectorAll('.table:nth-of-type(1) tbody tr').forEach(row => {
            var SalaryHeadID = row.querySelector('select').value;
            var Value = parseFloat(row.querySelector('input').value); // Parse input value as float

            earningData.push({
                SalaryHeadID: SalaryHeadID,
                Value: Value
            });

            // Add the value to the total earning amount
            totalEarningAmount += isNaN(Value) ? 0 : Value;
        });

        // Collect data from the deduction table
        document.querySelectorAll('.table:nth-of-type(2) tbody tr').forEach(row => {
            var SalaryHeadID = row.querySelector('select').value;
            var Value = parseFloat(row.querySelector('input').value); // Parse input value as float

            deductionData.push({
                SalaryHeadID: SalaryHeadID,
                Value: Value
            });

            // Add the value to the total deduction amount
            totalDeductionAmount += isNaN(Value) ? 0 : Value;
        });

        // Calculate the net amount (total earning amount - total deduction amount)
        netAmount = totalEarningAmount - totalDeductionAmount;

        var data = {
            earning: earningData,
            deduction: deductionData
        };

        // Return only the data object
        return data;
    }



    function loaddata(data) {
        var table = $("#table");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length == 0) {
            text += "No Data Found";
        } else {

            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';

                text += '<th> ' + (i + 1) + '</th>'; //\'' + escape(JSON.stringify(data[i])) + '\'
                // text += '<td> ' + data[i].Salary_Head + '&nbsp;&nbsp;<span onClick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"><i style="cursor:pointer;" class="fas fa-edit"></i></span></td>';
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> ' + data[i].NetAmount + '</td>';
                text += '<td> ' + data[i].Earning + '</td>';
                text += '<td style="color:red;"> ' + data[i].Deduction + '</td>';
                // text += '<td>';
                // if (data[i].isActive == 1) {
                //     text += '<span class="badge badge-success">  Active </button>';
                // } else {
                //     text += '<span class="badge badge-danger">Not Active</button>';
                // }
                text += '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += ' <a class="btn btn-info btn-sm text-white" title="Edit Staff" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pen"> </i> </a>';
                // text += '   <a class="btn btn-danger btn-sm text-white" title="Delete Staff"  onclick="onDelete(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-trash-alt"> </i> </a>';
                text += '</td>';
                text += '</tr >';
            }
        }

        $("#table tbody").html("");
        $("#table tbody").append(text);

        $(table).DataTable({
            responsive: true,
            "order": [],
            dom: 'Bfrtip',
            "bInfo": true,
            exportOptions: {
                columns: ':not(.hidden-col)'
            },
            "deferRender": true,
            "pageLength": 10,
            buttons: [{
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'excel',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'A4'
                }
            ]
        });
    }

    var Payroll_StaffSalaryID, StaffID;
    $("#btnAddSalary").click(function() {
        debugger;
        var salaryData = collectData();
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "addStaffSalary";
        obj.JSON = { // campaign_name  ,campaign_message , 
            StaffID: $("#staffs").val(),
            SalaryData: salaryData,
            TotalEarningAmount: totalEarningAmount, // Initialize total earning amount to zero
            TotalDeductionAmount: totalDeductionAmount,
            NetAmount: netAmount,
        };
        console.log(obj);
        if ($("#staffs").val() == -1) {
            notify("error", "Please Select Staff");
            return false;
        } else {
            //alert();
            TransportCall(obj);
        }

    });

</script>