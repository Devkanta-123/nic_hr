<?php require_once(VIEWPATH . "/basic/header.php"); ?>
<?php require_once(VIEWPATH . "/basic/sidebar.php"); ?>

<link href="assets/js/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                   
                        <div class="card-header">
                            <div class="card-title">
                             Marksheet
                            </div>
                        </div>
                        <div class="card text-left">
                            <caption>  Name : __________________________Class : ___________________ sec: _________ Roll-No : __________ House : _________ year : ___________</caption>
                           <table border="1" class=" text-info text-center table-bordered">
                            <tr class="bg-primary text-center text-white h4">
                                <th>Subject</th>
                                <th>Full <br> Marks</th>
                                <th>Pass <br> mark</th>
                                <th colspan="3">Unit-I <br> 30</th> 
                                <th colspan="3">H.Yearly <br> 70</th>
                                <th>Total <br> (X)</th>
                                <th colspan="3">Unit-II <br> 30</th>
                                <th colspan="3">Promotion <br> 70</th>
                                <th>Total <br> (Y)</th>
                                <th>Final <br>   (X+Y %)</th>
                                <th>Remarks</th>
                            </tr>
                            <tr>
                                <td rowspan="2" class="text-left p-2">English</td>
                                <td rowspan="2">100</td>    
                                <td rowspan="2">40</td>
                                <td>15</td>
                                <td>15</td>
                                <td>30</td>
                                <td>35</td>
                                <td>35</td>
                                <td>70</td>
                                <td>100</td>
                                <td>15</td>
                                <td>15</td>
                                <td>30</td>
                                <td>35</td>
                                <td>35</td>
                                <td>70</td>
                                <td>100</td>
                                <td rowspan="2" class="text-dark">17</td>
                                <td rowspan="4" class="align-top  bg-info ">UNIT TEST I</td>
                            </tr>
                            <tr class="text-dark">
                                <td >03</td>
                                <td>02</td>
                                <td>05</td>
                                <td>07</td>
                                <td>03</td>
                                <td>10</td>
                                <td>15</td>
                                <td>01</td>
                                <td>01</td>
                                <td>02</td>
                                <td>08</td>
                                <td>09</td>
                                <td>17</td>
                                <td>19</td>
                            </tr>
                            <tr class="text-dark">
                                <td  class="text-left text-info p-2 ">Mathematics</td>
                                <td class="text-info">100</td>
                                <td class="text-info">40</td>
                                <td colspan="3">03</td>
                                <td colspan="3">08</td>
                                <td>11</td>
                                <td colspan="3">01</td>
                                <td colspan="3">08</td>
                                <td >09</td>
                                <td>10</td>
                            </tr>
                            <tr class="text-dark">
                                <td  class="text-left text-info p-2">Science</td>
                                <td class="text-info">100</td>
                                <td class="text-info">40</td>
                                <td colspan="3">01</td>
                                <td colspan="3">09</td>
                                <td>10</td>
                                <td colspan="3">05</td>
                                <td colspan="3">12</td>
                                <td >17</td>
                                <td>14</td>
                            </tr>
                            <tr class="text-dark">
                                <td  class="text-left text-info p-2">Social Science</td>
                                <td class="text-info">100</td>
                                <td class="text-info">40</td>
                                <td colspan="3">02</td>
                                <td colspan="3">16</td>
                                <td>18</td>
                                <td colspan="3">01</td>
                                <td colspan="3">15</td>
                                <td >16</td>
                                <td>17</td>
                                <td rowspan="5" class="align-top  bg-info">HALF YEARLY</td>
                            </tr>
                            <tr class="text-dark">
                                <td  class="text-left text-info p-2">A.E / KHASI / HINDI </td>
                                <td class="text-info">100</td>
                                <td class="text-info">40</td>
                                <td colspan="3">04</td>
                                <td colspan="3">14</td>
                                <td>18</td>
                                <td colspan="3">01</td>
                                <td colspan="3">08</td>
                                <td >09</td>
                                <td>15</td>
                            </tr>
                            <tr class="text-info">
                                <td rowspan="2"  class="text-left p-2">COMPUTER <br> (Theory=80 Practical=20)</td>
                                <td rowspan="2">100</td>
                                <td rowspan="2">40</td>
                                <td colspan="3" rowspan="2" class="text-dark">13</td>
                                <td>50</td>
                                <td>20</td>
                                <td >70</td>
                                <td rowspan="2" class="text-dark">31</td>
                                <td colspan="3" rowspan="2" class="text-dark">10</td>
                                <td>50</td>
                                <td>20</td>
                                <td>70</td>
                                <td rowspan="2" class="text-dark">36</td>
                                <td rowspan="2" class="text-dark">34</td>
                            </tr>
                            <tr class="text-dark">
                                <td>08</td>
                                <td>10</td>
                                <td>18</td>
                                <td>15</td>
                                <td >11</td>
                                <td >26</td>
                            </tr>
                            <tr>
                                <td  class="text-left p-2">Value Edn / Catechism</td>
                                <td rowspan="7" >G <br> R <br> A <br> D <br> E <br>  S</td>
                                <td rowspan="7" colspan="4">
                                    Keys to Grades <br><br>
                                    A = 85% and above <br>
                                    B = 60% to 84% <br>
                                    C = 40% to 59% <br>
                                    D = Below 40%
                                </td>
                                <td colspan="3">&nbsp;</td>
                                <td colspan=""class="text-dark">D</td>
                                <td colspan="3" rowspan="7">&nbsp;</td>
                                <td colspan="3">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-dark">C</td>
                            </tr>
                            <tr>
                                <td  class="text-left p-2">General Knowledge</td>
                                <td colspan="3">&nbsp;</td>
                                <td class="text-dark">D</td>
                                <td colspan="3">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-dark">D</td>
                                <td rowspan="4" class="align-top  bg-info">UNIT TEST II</td>
                               
                            </tr>
                            <tr>
                                <td  class="text-left p-2">Handwritting / Drawing</td>
                                <td colspan="3">&nbsp;</td>
                                <td class="text-dark">D/C</td>
                                <td colspan="3">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-dark">c/c</td>
                               
                           
                            </tr>
                            <tr>
                                <td  class="text-left p-2">Dictation / Spelling</td>
                                <td colspan="3">&nbsp;</td>
                                <td class="text-dark">D</td>
                                <td colspan="3">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-dark">B</td>
                            
                            </tr>
                            <tr>
                                <td  class="text-left p-2">Elocution / Reading</td>
                                <td colspan="3">&nbsp;</td>
                                <td class="text-dark">D</td>
                                <td colspan="3">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-dark">B</td>
                               
                              
                            </tr>
                            <tr>
                                <td  class="text-left p-2">Physical Education </td>
                                <td colspan="3">&nbsp;</td>
                                <td class="text-dark">B</td>
                                <td colspan="3">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-dark">D</td>
                                <td rowspan="4" class="align-top  bg-info">PROMOTION EXAM</td>
                               
                                
                            </tr>
                            <tr>
                                <td  class="text-left p-2">Dictation / Spelling</td>
                                <td colspan="3">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td colspan="3">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-dark">C</td> 
                            </tr>
                            <tr class="bg-primary text-white text-center">
                                <th colspan="2" class="h6">Non-Scholarship(Final Only)</th>
                                <!-- <td colspan="2">Non-Scholarship(Final Only)</td> -->
                                <th colspan="4">Games & Sport</th>
                                <th colspan="4">Literacy</th>
                                <th colspan="8">Theatrical</th>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                                <td colspan="4">&nbsp;</td>
                                <td colspan="4">&nbsp;</td>
                                <td colspan="8">&nbsp;</td>
                            </tr>
                            <tr class="bg-primary text-white text-center">
                                <th colspan="2" class="h6">Personality Traits Half Yearly</th>
                                <th>Final</th>
                                <th colspan="5">Signature</th>
                                <th colspan="2">U.T.I</th>
                                <th colspan="3">Half-Yearly</th>
                                <th colspan="3">U.T.II</th>
                                <th colspan="2">Final</th>
                                <th rowspan="7" class="text-info align-top text-left p-4 bg-white h6">
                                <br>
                                Promoted to : ____ <br><br>
                                Detained in :  ____ <br><br>
                                School re-opens on : _________ <br>
                                
                            </th>
                            </tr>
                            <tr>
                                <td class="text-left p-2">Percentage</td>
                                <td>-</td>
                                <td>-</td>
                                <td colspan="5" rowspan="2">Class-Teacher</td>
                                <td colspan="2" rowspan="2">&nbsp;</td>
                                <td colspan="3" rowspan="2">&nbsp;</td>
                                <td colspan="3" rowspan="2">&nbsp;</td>
                                <td colspan="2" rowspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td  class="text-left p-2">Attendance</td>
                                <td class="text-dark">65/75</td>
                                <td class="text-dark">69/78   </td>
                                <!-- <td colspan="2">&nbsp;</td>
                                <td colspan="4">&nbsp;</td>
                                <td colspan="3">&nbsp;</td> -->
                            </tr>
                            <tr>
                                <td  class="text-left p-2">Deportment</td>
                                <td class="text-dark">C</td>
                                <td class="text-dark">B</td>
                                <td colspan="5" rowspan="2">Parents/Guardian</td>
                                <td colspan="2" rowspan="2">&nbsp;</td>
                                <td colspan="3" rowspan="2">&nbsp;</td>
                                <td colspan="3" rowspan="2">&nbsp;</td>
                                <td colspan="2" rowspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="text-left p-2">Conduct</td>
                                <td class="text-dark">B</td>
                                <td class="text-dark">B</td>
                            </tr>
                            <tr>
                                <td  class="text-left p-2">Application</td>
                                <td class="text-dark">C</td>
                                <td class="text-dark">C</td>
                                <td colspan="5" rowspan="2">Headmaster</td>
                                <td colspan="2" rowspan="2">&nbsp;</td>
                                <td colspan="3" rowspan="2">&nbsp;</td>
                                <td colspan="3" rowspan="2">&nbsp;</td>
                                <td colspan="2" rowspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                             
                            </tr>
                           </table>
                        </div>                                                                              
                </div>
            </div>
            <!-- /.row -->

            <!-- kg marksheet -->
            <div class="row">
                <div class="col-6 mt-3">
                    <div class="card">
                        <caption> <h2 class="text-center">K.G</h2> </caption>
                        <table border="1" class=" text-info text-center table-bordered">
                            <tr class="bg-info text-center h4">
                                <td class="text-danger">Subject</td>
                                <td class="text-danger">Half Yearly</td>
                                <td class="text-danger">Final</td>  
                            </tr>
                            <tr class="text-dark">
                                <td class="text-info text-left p-3 h5 bg-info">Conversation</td>
                                <td >C</td>
                                <td>B</td>
                            </tr>
                            <tr class="text-dark">
                                <td class="text-info text-left p-3 h5 bg-info">English</td>
                                <td>E</td>
                                <td>D</td>
                            </tr>
                            <tr class="text-dark">
                                <td class="text-info text-left p-3 h5 bg-info">Arithmetic</td>
                                <td>C</td>
                                <td>C</td>
                            </tr>
                            <tr class="text-dark">
                                <td class="text-info text-left p-3 h5 bg-info">Spelling</td>
                                <td>C</td>
                                <td>D</td>
                            </tr>
                            <tr class="text-dark">
                                <td class="text-info text-left p-3 h5 bg-info">Reading</td>
                                <td>C</td>
                                <td>C</td>
                            </tr>
                            <tr class="text-dark">
                                <td class="text-info text-left p-3 h5 bg-info">Peotry</td>
                                <td>B</td>
                                <td>B</td>
                            </tr>
                            <tr class="text-dark">
                                <td class="text-info text-left p-3 h5 bg-info">Handwritting</td>
                                <td>C</td>
                                <td>B</td>
                            </tr>
                            <tr class="text-dark">
                                <td class="text-info text-left p-3 h5 bg-info">Drawing</td>
                                <td>C</td>
                                <td>B</td>
                            </tr>
                            <tr class="text-dark">
                                <td class="text-info text-left p-3 h5 bg-info">Singing</td>
                                <td>B</td>
                                <td>B</td>
                            </tr>
                            <tr class="text-dark">
                                <td class="text-info text-left p-3 h5 bg-info">Games / Activities</td>
                                <td>A</td>
                                <td>B</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-danger"> GENERAL REMARK </td>
                            </tr>
                            <tr> 
                                <td colspan="1" class="text-danger align-top text-center">Half Yearly
                                    <br>
                                    <br>
                                </td>
                                <td colspan="2" class="text-danger align-top text-center">Final Exam</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td class="text-danger">Half Yearly</td>
                                <td class="text-danger">Final Exam</td>
                            </tr>
                            <tr>
                                <td class="text-left p-3">Class Teacher</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="text-left p-3">Head Master</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="text-left p-3">Parents / Guardian</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="col-6 mt-3">
                    <div class="card">
                        <table border="1">
                            <tr class="bg-info">
                                <td colspan="3">photo <br><br><br></td>
                            </tr>
                            <tr class="text-center text-danger">
                                <td colspan="3">PERSONAL AND SOCIAL ATTITUDES AND PERSONAL DEVELOPMENT</td>
                            </tr>
                            <tr class="bg-info">
                                <td>&nbsp;</td>
                                <td class="text-danger">Half Yearly</td>
                                <td class="text-danger">Final</td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left p-3 bg-info">Attendance</td>
                                <td>B</td>
                                <td>C</td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left p-3 bg-info">Punctuality</td>
                                <td>D</td>
                                <td>A</td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left p-3 bg-info">Personal Neatness</td>
                                <td>B</td>
                                <td>A</td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left p-3 bg-info">Class work</td>
                                <td>D</td>
                                <td>C</td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left p-3 bg-info">Home Work</td>
                                <td>A</td>
                                <td>B</td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left p-3 bg-info">Application to Studies</td>
                                <td>C</td>
                                <td>C</td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left p-3 bg-info">Conduct</td>
                                <td>D</td>
                                <td>C</td>
                            </tr>

                        </table><br>
                            <div class="row">
                                <div class="col-4">
                                    photo
                                </div>
                                <div class="col-4 border bg-info">
                                        <h5 class="text-center text-danger">Key Grades</h3>
                                        <p class="text-center"> 
                                        <ul > 
                                                <li>A . Very Good</li>
                                                <li>B . Good</li>
                                                <li>C . Fairly Good</li>
                                                <li> D. Fair</li>
                                                <li> E . Unsatisfactory</li>
                                            </ul>  
                                        </p>
                                </div>
                                <div class="col-4">
                                    photo
                                </div>
                            </div>

                            <div class="row mt-3 align-center">
                                <div class="col-12 d-flex justify-content-center">
                                    <div class=" card border-dark w-75">
                                        <table class="align-center text-center">
                                            <tr>
                                                <td class="text-danger" rowspan="2">Promotion : </td>
                                                <td class="border-bottom">Granted</td>
                                                <td><input type="checkbox"  id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Not Granted</td>
                                                <td><input type="checkbox"  id=""></td>
                                                
                                            </tr>
                                        </table>
                                </div>

                            </div>
                       

                    </div>
                </div>
            </div>
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
    // $(function() {
    //     getAllDistrict();
    //     getState();
       
    // });
    // function clearform() {
    //     $('#state_name').val('');
    //     $('#district_name').val('');
      
    // }

    // function getState(){
    //     var obj=new Object();
    //     obj.Module = "Settings";
    //     obj.Page_key = "getState";
    //     var json = new Object();
    //     obj.JSON = json;
    //     TransportCall(obj);
    // }
    

    // function getAllDistrict(){
    //     var obj=new Object();
    //     obj.Module = "Settings";
    //     obj.Page_key = "getAllDistrict";
    //     var json = new Object();
    //     obj.JSON = json;
    //     TransportCall(obj);
    // }

 

    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                // case "getAllDistrict":
                //     //debugger;
                //     loaddata(rc.return_data);
                //     break;
                // case "getState":
                // //debugger;
                //     loadSelect("#state_name", rc.return_data); 
                //     break; 

                // case "addDistrict":
                //     $("#modal-lg").modal("hide");
                //     alert(rc.return_data);
                //     getAllDistrict();

                //     clearform();
                //     break;
                                   
                default:
                    alert(rc.Page_key);
            }
        } else {
            alert(rc.return_data);
        }
        // alert(JSON.stringify(args));
    }

    // function loaddata(data) 
    // {
    //     var table = $("#table");

    //     try {
    //         if ($.fn.DataTable.isDataTable($(table))) {
    //             $(table).DataTable().destroy();
    //         }
    //     } catch (ex) {}

    //     var text = ""

    //     if (data.length == 0) {
    //         text += "No Data Found";
    //     } else {

    //         for (let i = 0; i < data.length; i++) {
    //         text += '<tr> ';
                
    //             text += '<th> ' + data[i].DistrictID + '</th>';
    //             text += '<td> ' + data[i].DistrictName + '</td>';
    //             text += '<td> ' + data[i].StateName + '</td>';
    //             text += '</tr >';
    //         }
    //     }

    //     $("#table tbody").html("");
    //     $("#table tbody").append(text);

    //     $(table).DataTable({
    //         responsive: true,
    //         "order": [],
    //         dom: 'Bfrtip',
    //         "bInfo": true,
    //         exportOptions: {
    //             columns: ':not(.hidden-col)'
    //         },
    //         "deferRender": true,
    //         "pageLength": 10,
    //         buttons: [{
    //             exportOptions: {
    //                 columns: ':not(.hidden-col)'
    //             },
    //             extend: 'excel',
    //             orientation: 'landscape',
    //             pageSize: 'A4'
    //         },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'pdfHtml5',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'print',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             }
    //         ]
    //     });
    // }

    // $("#btnAddState").click(function (){ 
    //     let obj = {};
    //     obj.Module = "Settings";
    //     obj.Page_key = "addDistrict";
    //     let json = {};
    //     // if(ProductID!==undefined){
    //     //     json.ProductID = ProductID;
    //     // }     
    //     //json.StateID = $("#state_id").val();
    //     json.StateId = $("#state_name").val(); 
    //     json.DistrictName = $("#district_name").val();
    //     obj.JSON = json; 
    //     console.log(JSON.stringify(obj));
    //     TransportCall(obj);
    // });
</script>