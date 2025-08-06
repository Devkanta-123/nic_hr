<link href="assets/js/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->


<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <br>
                    <br>

                    <div class="invoice p-3 mb-3" id="invoice">
                        <div class="row">
                            <div class="col-12">
                                <p>
                                    <img src="assets/img/itpllogo.png" alt="Image description" class="mr-2" style="width: 40px; height: 40px;"> <!-- Insert your image here -->
                                    IEWDUH , Techz.<br>
                                    <span style="margin-left: 50px;margin-top: -20px;">JN Complex, Polo Hills</span><br>
                                    <span style="margin-left: 50px;">Shillong, Meghalaya 793001</span>

                                </p>


                                <span style="margin-top: -65px;" class="float-right">Payslip For the Month <br><span id="PayForMonthOf"></span></span>


                            </div>

                        </div>
                        <hr>

                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                EMPLOYEE SUMMARY </br>
                                Employee Name :<strong><span style="float:right;" id="staffName"></span></strong></br>
                                <span style="display: block; margin-bottom: 5px;"></span> <!-- Adjust the margin-bottom value as needed -->

                                <!-- Contact No : <strong><span id="EmployeeContact"></span></strong></br></br> -->
                                Designation : <strong><span style="float:right;" id="DesignationName"></span></strong></br>
                                <span style="display: block; margin-bottom: 5px;"></span> <!-- Adjust the margin-bottom value as needed -->
                                Date of Joining : <strong><span style="float:right;" id="JoinedDate"></span></strong></br>
                                <span style="display: block; margin-bottom: 5px;"></span> <!-- Adjust the margin-bottom value as needed -->
                                Pay Peroid : <strong><span style="float:right;" id="PayPeroid"></span></strong></br>
                                <span style="display: block; margin-bottom: 5px;"></span> <!-- Adjust the margin-bottom value as needed -->
                                Pay Date : <strong><span style="float:right;" id="PaymentDate"></span></strong></br>
                                <span style="display: block; margin-bottom: 5px;"></span> <!-- Adjust the margin-bottom value as needed -->
                            </div>

                            <div class="col-md-3 ml-auto">
                                <div class="card">
                                    <div class="card-header" style="background-color: rgba(155, 207, 83, 0.4);">
                                        <h3 class="card-title" id="NetAmount2"></h3><br>
                                        <p>Employee Net Pay</p>
                                    </div>
                                    <div class="card-body">
                                        <p>Paid days: <strong>31 </strong></p>
                                        <p>LOP days: <strong> 0</strong> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Earning</h3>
                                    </div>

                                    <div class="card-body">
                                        <table class="table" id="EarningTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Earning</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>


                                        </table>
                                        <!-- <p id="TotalAmount" style="float:right;"></p> -->
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header" style="background-color:#EE99C2;">
                                        <h3 class="card-title" style="color:white;">Deduction</h3>

                                    </div>

                                    <div class="card-body p-0">
                                        <table class="table" id="DeductionTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Deduction</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>

                                        </table>
                                        <!-- <p id="TotalDeduction" style="float:right;"></p> -->

                                    </div>

                                </div>


                            </div>

                        </div>
                        <div class="row">

                            <div class="col-6">

                            </div>

                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Total Earning : </th>
                                                <td id="TotalEarning"></td>
                                            </tr>
                                            <tr>
                                                <th>Total Deduction :</th>
                                                <td id="TotalDeduction"></td>
                                            </tr>

                                            <tr>
                                                <th style="font-size:15px;">Net Pay : (Total Earning - Total Deduction)</th>
                                                <td id="NetAmount"></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="callout callout col-12">Amount in words:
                                <span id="NetAmountInWords"></span>

                            </div>
                        </div>
                        <div class="row no-print">
                            <div class="col-12">
                                <!-- <a href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
                                <a href="#" class="btn btn-primary btn-xs float-right" rel="noopener" target="_blank" class="btn btn-default" onclick="printInvoice()"><i class="fas fa-print"></i> Print</a>
                            </div>
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

<script src="assets/js/plugins/icheck-bootstrap/icheck.min.js"></script>
<!-- Jasny File -->
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
<script>
    function printInvoice() {
        var printContents = document.getElementById("invoice").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }


    debugger;
    let url = new URL(window.location.href);
    let StaffID = atob(url.searchParams.get("staff"));
    let SlipID = atob(url.searchParams.get("SlipID"));

    // alert(StaffID);


    $(function() {
        getStaff();
        //getAllStaffSalarySettings();
        getStaffEarningSalarySlip();
        getStaffDeductionSalarySlip();
        var currentDate = new Date();

        // Get the current month and year for Pay Period
        var currentMonth = currentDate.toLocaleString('default', {
            month: 'long'
        });
        var currentYear = currentDate.getFullYear();
        var payPeriod = currentMonth + ' ' + currentYear;

        // Set the Pay Period content
        $('#PayPeroid').text(payPeriod);
        $('#PayForMonthOf').text(payPeriod);

        // Get the today's date for Pay Date
        var payDate = currentDate.toLocaleDateString();

        // Set the Pay Date content
        $('#PaymentDate').text(payDate);
    });



    function getStaff() {
        var obj = new Object();
        obj.Module = "Staff";
        obj.Page_key = "getStaff";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }



    var Flag;

    function getStaffEarningSalarySlip() {
        debugger;
        var obj = new Object();
        var json = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffEarningSalarySlip";
        var json = new Object();
        json.StaffID = StaffID;
        json.Payroll_StaffSalaryID = SlipID;
        flag = 'earnings';
        json.Flag = flag;
        obj.JSON = json;
        // console.log(JSON.stringify(obj));
        SilentTransportCall(obj);
    }





    function getStaffDeductionSalarySlip() {
        debugger;
        var obj = new Object();
        var json = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffDeductionSalarySlip";
        var json = new Object();
        json.StaffID = StaffID;
        json.Payroll_StaffSalaryID = SlipID;
        flag = 'deductions';
        json.Flag = flag;
        obj.JSON = json;
        // console.log(JSON.stringify(obj));
        SilentTransportCall(obj);
    }






    function getAllStaffSalarySettings() {
        var obj = new Object();
        obj.Module = "Staff";
        obj.Page_key = "getAllStaffSalarySettings";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }


    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "addStaffSalarySettings":
                    notify("success", rc.return_data);
                    $("#modal-lg").modal("hide");
                    getAllStaffSalarySettings();
                    break;
                    // case "getAllStaffSalarySettings":
                    //     loaddata(rc.return_data);
                    //     break;

                case "editSalaryHead":
                    notify("success", rc.return_data);
                    getAllStaffSalarySettings();
                    $("#EditModal").modal("hide");
                    break;

                case "getStaff":
                    loadSelect("#staffs", rc.return_data);
                    break;

                case "updateSalarySettings":
                    notify("success", rc.return_data);
                    getAllStaffSalarySettings();
                    $("#EditModal").modal("hide");
                    break;

                case "getStaffEarningSalarySlip":
                    console.log(rc.return_data);
                    loadEarningSalarySlipData(rc.return_data);
                    break;

                case "getStaffDeductionSalarySlip":
                    console.log(rc.return_data);
                    loadDeductionSalarySlipData(rc.return_data);
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


    // function loadSalarySlipData(data) {


    // }
    function loadEarningSalarySlipData(data) {
        debugger;
        var totalAmount = 0; // Initialize total amount variable
        var StaffName = data[0].StaffName;
        $("#staffName").text(StaffName);
        var NetAmount = data[0].NetAmount;
        $("#NetAmount").text('₹ ' + NetAmount);
        $("#NetAmount2").text('₹ ' + NetAmount);

        var amountInWords = convertToWords(NetAmount);


        // Set the text of the <p> tag with id "NetAmountInWords" to the amount in words


        var Contact = data[0].ContactNo;
        $("#EmployeeContact ").text(Contact);
        var JoinedDate = data[0].JoinedDate;
        $("#JoinedDate ").text(JoinedDate);
        var DesignationName = data[0].DesignationName;
        $("#DesignationName").text(DesignationName);
        var TotalEarning = data[0].EarningAmount;
        $("#TotalEarning").text('₹ ' + TotalEarning);
        $('#EarningTable').find('tbody').empty();

        // Iterate through the data array and append rows to the table
        $.each(data, function(index, item) {
            // Create a new row
            var newRow = $('<tr>');

            // Add cells with the corresponding data
            newRow.append('<td>' + (index + 1) + '</td>'); // Index starts from 0, so add 1
            newRow.append('<td>' + item.Salary_Head + '</td>'); // Assuming 'Earning' is a property in the data object
            newRow.append('<td> ₹ ' + item.Earning + '</td>'); // Assuming 'Amount' is a property in the data object

            // Append the new row to the table body
            TotalAmount = parseFloat(item.EarningAmount); // Assuming 'Amount' is numeric

            $('#EarningTable tbody').append(newRow);
        });

        $("#TotalAmount").text('Total Earning: ₹ ' + TotalAmount);
        $("#NetAmountInWords").text(amountInWords);
        // $('#EarningTable').append('<p style="display: inline-block;">Total Earning: ₹ ' + totalAmount + '</p>');
        //         <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
        // <i class="fas fa-download"></i> Generate PDF
        // </button>
    }


    function loadDeductionSalarySlipData(data) {
        $('#DeductionTable').find('tbody').empty();
        var totalAmount = 0; // Initialize total amount variable
        // Iterate through the data array and append rows to the table
        var DeductionAmount = data[0].DeductionAmount;
        $("#TotalDeduction").text('₹ ' + DeductionAmount);
        $.each(data, function(index, item) {
            // Create a new row
            var newRow = $('<tr>');

            // Add cells with the corresponding data
            newRow.append('<td>' + (index + 1) + '</td>'); // Index starts from 0, so add 1
            newRow.append('<td>' + item.Salary_Head + '</td>'); // Assuming 'Earning' is a property in the data object
            newRow.append('<td> ₹ ' + item.Deduction + '</td>'); // Assuming 'Amount' is a property in the data object

            totalAmount = parseFloat(item.DeductionAmount); // Assuming 'Amount' is numeric

            // Append the new row to the table body   //DeductionAmount
            $('#DeductionTable tbody').append(newRow);
        });
        //TotalDeduction
        // $("#TotalDeduction").text('Total Deduction: ₹ ' + totalAmount);

        // $('#DeductionTable').append('<p style="font-size: smaller;">Total Deduction: ₹ ' + totalAmount + '</p>');

    }




    function convertToWords(number) {
        var ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
        var teens = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
        var tens = ['', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
        var scales = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];

        var words = '';

        if (number == 0) {
            return 'Zero';
        }

        // Convert each group of three digits
        for (var i = 0; number > 0; i++) {
            var group = number % 1000;
            number = Math.floor(number / 1000);

            var onesDigit = group % 10;
            var tensDigit = Math.floor(group / 10) % 10;
            var hundredsDigit = Math.floor(group / 100) % 10;

            var groupWords = '';

            if (hundredsDigit > 0) {
                groupWords += ones[hundredsDigit] + ' Hundred ';
            }

            if (tensDigit > 1) {
                groupWords += tens[tensDigit] + ' ';
                if (onesDigit > 0) {
                    groupWords += ones[onesDigit];
                }
            } else if (tensDigit == 1) {
                groupWords += teens[onesDigit];
            } else if (onesDigit > 0) {
                groupWords += ones[onesDigit];
            }

            if (groupWords != '') {
                if (words != '') {
                    words = groupWords + ' ' + scales[i] + ' ' + words;
                } else {
                    words = groupWords + ' ' + scales[i];
                }
            }
        }

        return words.trim() + ' only .';
    }



    function updateSalarySettings(column, data, ID, StaffID) {
        debugger;
        var obj = {};
        obj.Module = "Staff";
        var json = {};
        obj.Page_key = "updateSalarySettings";
        json.Column = column;
        json.Data = data;
        json.Payroll_StaffSalaryID = ID;
        json.StaffID = StaffID;
        obj.JSON = json;
        SilentTransportCall(obj);
    }
</script>