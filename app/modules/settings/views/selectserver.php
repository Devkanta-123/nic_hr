<?php require_once(VIEWPATH . "/basic/header.php"); ?>
<?php require_once(VIEWPATH . "/basic/sidebar.php"); ?>


<link href="assets/js/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-3">
                    
        <div class="card-header">
                               
     </div>
     <div class="card">                 
        <div class="formbold-main-wrapper">
        <div class="formbold-form-wrapper">
        <form  method="POST" id="domainForm" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="formbold-steps">
                <ul>
                    <li class="formbold-step-menu1 active">
                        <span>1</span>
                    Server
                    </li>
                    <li class="formbold-step-menu2">
                        <span>2</span>
                    Domain
                    </li>
                    <li class="formbold-step-menu3">
                        <span>3</span>
                    Start Up
                    </li>

                </ul>
            </div>

            <div class="formbold-form-step-1 active">
                <div class="card-body">
                  <p>Select Server For The Domain</p>
              </div>
            <div class="form-group">
            <div class="form-group">
            <label for="server_name">Server Name </label>
            <select class="form-control"  name=" " id="server_name">
             </select>
             </div>

             </div>
              </div>
            <div class="formbold-form-step-2">
            <div class="card-body">
                  <p>Set Up Domain For First Time Use</p>
              </div>
            <div>
                <label for="address" class="formbold-form-label"> Domain Name : </label>
                <input type="text" id="domain_name" class="form-control"   placeholder="test.prayagedu.com"  class="formbold-form-input" required>
            </div>
            </div>

            <div class="formbold-form-step-3">
            <div class="card-body">
                    <i  class="icon fas fa-cog  fa-4x"></i>
                    <br>
                    <br>
                        <p>Set Up  For First Time Use</p>
              </div>
            </div>

            <div class="formbold-form-btn-wrapper">
            <button class="formbold-back-btn">
                Back
            </button>
         
            <button type="submit" class="formbold-btn" id="createDomain">
               Proceed
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_1675_1807)">
                <path d="M10.7814 7.33312L7.20541 3.75712L8.14808 2.81445L13.3334 7.99979L8.14808 13.1851L7.20541 12.2425L10.7814 8.66645H2.66675V7.33312H10.7814Z" fill="white"/>
                </g>
                <defs>
                <clipPath id="clip0_1675_1807">
                <rect width="16" height="16" fill="white"/>
                </clipPath>
                </defs>
                </svg>
</button>
            </div>
        </form>
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



<?php
 
    ?>

<?php require_once(VIEWPATH . "/basic/footer.php"); ?>

<script src="assets/js/plugins/icheck-bootstrap/icheck.min.js"></script>
<!-- Jasny File -->
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
<script>
    $(function() {
        getAllServer();
       
    });


    function getAllServer(){
        var obj=new Object();
        obj.Module = "Settings";
        obj.Page_key = "getAllServer";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }
    // case "getAllServer":
    //             //debugger;
    //                 loadSelect("#server_name", rc.return_data); 
    //                 break; 
 

    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getServer":
                    //debugger;
                    loaddata(rc.return_data);
                    break;
                case "getAllServer":
                //debugger;
                    loadSelect("#server_name", rc.return_data); 
                    break; 
                 case "createDomain":
                //debugger;
                    loadSelect(rc.return_data); 
                    break; 
                                   
                default:
                    alert(rc.Page_key);
            }
        } else {
            alert(rc.return_data);
        }
    }

    $("#createDomain").click(function (){ 
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "selectServer";
        let data = {};  
        data.domain_name = $("#domain_name").val();
        obj.JSON = data; 
        console.log(JSON.stringify(obj));
        TransportCall(obj);
    });
 

</script>

<script>
const stepMenuOne = document.querySelector('.formbold-step-menu1');
const stepMenuTwo = document.querySelector('.formbold-step-menu2');
const stepMenuThree = document.querySelector('.formbold-step-menu3');

const stepOne = document.querySelector('.formbold-form-step-1');
const stepTwo = document.querySelector('.formbold-form-step-2');
const stepThree = document.querySelector('.formbold-form-step-3');

const formSubmitBtn = document.querySelector('.formbold-btn');
const formBackBtn = document.querySelector('.formbold-back-btn');

// Define a variable to track the current step
let currentStep = 1;

formSubmitBtn.addEventListener("click", function(event) {
  event.preventDefault();

  if (currentStep === 1) {
    // Proceed to the next step
    stepMenuOne.classList.remove('active');
    stepMenuTwo.classList.add('active');

    stepOne.classList.remove('active');
    stepTwo.classList.add('active');

    formBackBtn.classList.add('active');
    currentStep = 2;
  } else if (currentStep === 2) {
    // Proceed to the next step
    stepMenuTwo.classList.remove('active');
    stepMenuThree.classList.add('active');

    stepTwo.classList.remove('active');
    stepThree.classList.add('active');

    formBackBtn.classList.remove('active');
    formSubmitBtn.textContent = 'Submit'; // Change button text for the final step
    currentStep = 3;
  } else if (currentStep === 3) {
    // This is the final step, submit the form
    document.querySelector('form').submit();
  }
});

// Add an event listener for the "Back" button
formBackBtn.addEventListener("click", function(event) {
  event.preventDefault();
  
  if (currentStep === 2) {
    // Go back to the previous step
    stepMenuOne.classList.add('active');
    stepMenuTwo.classList.remove('active');

    stepOne.classList.add('active');
    stepTwo.classList.remove('active');

    formBackBtn.classList.remove('active');
    currentStep = 1;
  } else if (currentStep === 3) {
    // Go back to the previous step
    stepMenuTwo.classList.add('active');
    stepMenuThree.classList.remove('active');

    stepTwo.classList.add('active');
    stepThree.classList.remove('active');

    formSubmitBtn.textContent = 'Proceed'; // Change button text back to "Proceed"
    currentStep = 2;
  }
});

</script>

