<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle/bootstrap-toggle.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="assets/admin/plugins/jquery-knob/jquery.knob.min.js"></script> 

<style>
  @media print {
    * {
      -webkit-print-color-adjust: exact !important;
      /*Chrome, Safari */
      -moz-print-color-adjust: exact !important;
      -ms-print-color-adjust: exact !important;
      /* print-color-adjust: exact !important; */
      color-adjust: exact !important;
      /*Firefox*/
    }

    .no-media {
      display: none !important;
    }

    a {
      text-decoration: none !important;
      border-color: transparent !important;
    }
  }

  @media only screen and (max-width: 600px) {
    .custom-center {
      text-align: center;
    }
  }

  .content-header {
    padding-top: 4px !important;
    padding-bottom: 4px !important;
  }

  .mailbox-attachment-icon.has-img>img {
    max-height: 93px !important;
    vertical-align: top !important;
  }

  .mailbox-attachment-name {
    font-size: small !important;
  }

  .mailbox-attachment-icon {
    max-height: 97px !important;
    padding-top: 2px !important;
  }

  .info-box .info-box-content {
    display: block !important;
    padding: 0 !important;
  }

  .info-box {
    padding: 0 !important;
  }

  .info-box .info-box-icon {
    height: 2rem !important;
    width: auto !important;
    padding: 4px 8px !important;
    border-radius: 1rem 0rem 0.25rem 0rem !important;
    float: right !important;
    font-size: 1.2rem !important;
  }

  /* .btn-app{
    color:red;
    border:0px solid red;
    height:30px !important;
    min-width:30px !important;
    padding-top:4px !important;
    padding-bottom:4px !important;
    margin-bottom:0 !important;
  } */
  .btnCustom {
    border: 0 !important;
    padding-bottom: 0 !important;
  }

  .btnCustom1 {
    border: 0 !important;
    padding: 2px 6px !important;
    float: right;
  }

  .custom_card-title {
    font-size: 1.25rem !important;
    font-weight: 300 !important;
  }

  .badge {
    font-size: 91% !important;
  }

  .error-page {
    margin-top: 0 !important;
  }
</style>

<div class="content-wrapper" style="padding-bottom:0px !important;">

  <div class="content-header">
    <div class="row" style="position:relative; margin:4px 0.5rem 4px 4px;">
      <button id="btnDownloadProfile" type="button" class="btn btn-sm bg-danger" title="DOWNLOAD PROFILE"><i class="fas fa-download mr-1"></i>DOWNLOAD</button>
    </div>
  </div>

  <section class="content" style="padding:2rem 0.5rem 1rem 0.5rem ;">
    <div class="container-fluid" style="padding:0;">
      <div class="row" style="padding:0;">
        <div class="container" style="padding:0;">

          <div class="col-md-12">
            <div class="card card-widget widget-user-2">
              <div class="widget-user-header bg-primary text-white">
                <div class="row float-left">
                </div>
                <div class="row float-right">
                  <button type="button" data-toggle="modal" data-target="#mdlSavePhoto" class="btn btn-outline-light btn-xs mr-1 btnEdit no-media" title="SAVE NEW PHOTO"><i class="fas fa-camera"></i></button>
                  <button type="button" data-toggle="modal" data-target="#mdlEditProfile" class="btn btn-outline-light btn-xs btnEdit no-media" title="EDIT PROFILE"><i class="fas fa-edit"></i></button>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-12 text-center">
                    <img id="v_photo" class="img-circle img-fluid" src="assets/parent/assets/images/users/avatar-1.jpg" style="width:8rem; height:8rem;" alt="Staff Photo" />
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12" style="display:flex; align-items:center;">
                    <div>
                      <h4 style="text-transform:uppercase;" id="v_name">-FULL NAME-</h4>
                      <h2 class="lead" style="text-transform:uppercase;" id="v_designation">-DESIGNATION-</h2>
                      <h6 style="text-transform:uppercase;" id="v_department"></h6>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12" style="display:flex; align-items:center;">
                    <ul class="fa-ul">
                      <li class="large">
                        <span class="fa-li">
                          <i class="fas fa-sm fa-phone"></i>
                        </span>
                        <span id="v_contactno">-Mobile Number-</span>
                      </li>
                      <li class="large">
                        <span class="fa-li">
                          <i class="fa fa-envelope prefix"></i>
                        </span>
                        <span id="v_emailid">-Email ID-</span>
                      </li>
                      <li class="large">
                        <span class="fa-li">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                        <span>Joined on <strong id="v_doj">DD/MM/YYYY</strong></span>
                      </li>
                      <li class="large">
                        <span class="fa-li">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                        <span>Born on <strong id="v_dob">DD/MM/YYYY</strong></span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-footer bg-gradient-white">
                <div class="row">
                  <div class="col-sm-3 border-right">
                    <div class="description-block">
                      <h5 id="v_age" class="description-header text-lg text-danger">-</h5>
                      <span class="description-text text-lg text-muted">AGE</span>
                    </div>
                  </div>
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 id="v_bloodgroup" class="description-header text-lg text-danger">-</h5>
                      <span class="description-text text-lg text-muted">BLOOD GROUP</span>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 id="v_yoe" class="description-header text-lg text-danger">-</h5>
                      <span class="description-text text-lg text-muted">YEAR OF EXPERIENCE</span>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-sm-12" id="div_additionaldetails_section">
            <div class="card bg-gradient-white">

              <div class="card-header border-0">
                <p class="card-title custom_card-title" style="font-size:1.25rem; font-weight:300;"><strong>MY ADDITIONAL DETAILS</strong></p>
              </div>

              <div class="card-body pt-0" id="div_additionaldetails">

                <p>GENDER : <span id="v_gender" style="text-transform:capitalize !important;">-</span>&emsp;||&emsp;RELIGION : <span id="v_religion" style="text-transform:capitalize !important;">-</span>&emsp;||&emsp;CASTE : <span id="v_caste" style="text-transform:capitalize !important;">-</span>&emsp;||&emsp;COMMUNITY : <span id="v_community" style="text-transform:capitalize !important;">-</span>&emsp;||&emsp;NATIONALITY : <span id="v_nationality" style="text-transform:capitalize !important;">-</span>&emsp;||&emsp;ADDRESS : <span id="v_address" style="text-transform:capitalize !important;">-</span></p>
                
              </div>

            </div>
          </div>

          <div class="col-sm-12" id="div_education_section">
            <div class="card bg-gradient-white">
              <div class="card-header border-0">
                <p class="card-title custom_card-title" style="font-size:1.25rem; font-weight:300;"><strong>MY EDUCATION HISTORY</strong></p>
                <div class="card-tools">
                  <button type="button" onclick="onResetAddEducation()" data-toggle="modal" data-target="#mdlAddEducation" class="btn btn-outline-danger btn-xs btnEdit no-media" title="SAVE EDUCATION INFORMATION"><i class="fas fa-plus"></i></button>

                </div>
              </div>
              <div class="card-body pt-0">
                <ul class="todo-list" data-widget="todo-list" id="div_education">

                </ul>
              </div>
            </div>
          </div>

          <div class="col-sm-12" id="div_iebd_section">
            <div class="card bg-gradient-white">
              <div class="card-header border-0">
                <p class="card-title custom_card-title" style="font-size:1.25rem; font-weight:300;"><strong>ASSOCIATION OF INTERNAL/EXTERNAL BODIES</strong></p>
                <div class="card-tools btnEdit no-media">
                  <button id="btnAddExternalBodyDetails" onclick="onResetAddIEBodyDetails()" type="button" data-toggle="modal" data-target="#mdlAddIEBodyDetails" class="btn btn-outline-danger btn-xs" title="ADD EXTENAL BODY DETIALS"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body pt-0">
                <div id="div_iebody">

                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-12" id="div_family_section">
            <div class="card bg-gradient-white">
              <div class="card-header border-0">
                <p class="card-title custom_card-title" style="font-size:1.25rem; font-weight:300;"><strong>MY FAMILY MEMBERS</strong></p>
                <div class="card-tools btnEdit no-media">
                  <button type="button" onclick="onResetFamilyMemberForm()" data-toggle="modal" data-target="#mdlFamilyMember" class="btn btn-outline-danger btn-xs" title="ADD FAMILY MEMBER / RELATIVE"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body pt-0">
                <div class="row" id="div_family">

                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-12" id="div_work_section">
            <div class="card bg-gradient-white">
              <div class="card-header border-0">
                <p class="card-title custom_card-title" style="font-size:1.25rem; font-weight:300;"><strong>WORK DETAILS</strong></p>
                <div class="card-tools btnEdit no-media">
                  <button id="btnAddExternalBodyDetails" onclick="onResetAddWorkDetails()" type="button" data-toggle="modal" data-target="#mdlAddWorkDetails" class="btn btn-outline-danger btn-xs" title="ADD WORK DETIALS"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body pt-0">
                <div id="div_workdetails">

                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-12" id="div_vehicle_section">
            <div class="card bg-gradient-white">
              <div class="card-header border-0">
                <p class="card-title custom_card-title" style="font-size:1.25rem; font-weight:300;"><strong>MY VEHICLE(S)</strong></p>
                <div class="card-tools no-media">
                  <button id="btnAddVehicleInfo" type="button" data-toggle="modal" data-target="#mdlAddVehicleInfo" class="btn btn-outline-danger btn-xs btnEdit" title="ADD VEHICLE"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body pt-0">
                <div class="row" id="div_vehicle">
                  <!--<div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="small-box bg-danger">
                      <a onclick="editVehicleInfo()" data-toggle="modal" data-target="#mdlFamilyMember" class="btn btn-outline-danger btnCustom1 btnEdit no-media" title="EDIT"><i class="fas fa-edit"></i></a>
                      <div class="inner">
                        <h2>ML 05 A 2014</h2>
                        <h5>Suzuki - M14AS (Red)</h5>
                      </div>
                      <div class="icon">
                        <i class="fas fa-car"></i>
                      </div>
                      <a class="small-box-footer"><em>Registered on Self Name</em></a>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="small-box bg-danger">
                      <a onclick="editVehicleInfo()" data-toggle="modal" data-target="#mdlFamilyMember" class="btn btn-outline-danger btnCustom1 btnEdit no-media" title="EDIT"><i class="fas fa-edit"></i></a>
                      <div class="inner">
                        <h2>ML 05 A 2014</h2>
                        <h5>Suzuki - M14AS (Red)</h5>
                      </div>
                      <div class="icon">
                        <i class="fas fa-motorcycle"></i>
                      </div>
                      <a class="small-box-footer"><em>Registered on Self Name</em></a>
                    </div>
                  </div>-->
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="mdlSavePhoto">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Save Photo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frmPhoto">
            <div class="container">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="required">Photo</label>
                  <input type="file" id="e_photo" accept="image/x-png,image/gif,image/jpeg" data-allowed-file-extensions="jpg jpeg png" data-max-file-size="10M" data-height="240" required />
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-sm-12">
                  <button type="submit" class="btn bg-danger float-sm-right">SUBMIT</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="mdlEditProfile">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Profile</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frmPersonalDetails">
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="e_name" class="required">Name</label>
                  <input id="e_name" name="e_name" type="text" class="form-control" autocomplete="off" required />
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="required">Designation</label>
                  <select class="form-control select2" style="width: 100%;" id="e_designation" name="e_designation" required>
                    <option value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="required">Department</label>
                  <select class="form-control select2" style="width: 100%;" id="e_department" name="e_department" required>
                    <option value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="e_contactno" class="required">Contact Number</label>
                  <input id="e_contactno" name="e_contactno" type="number" class="form-control" autocomplete="off" required />
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="e_emailid" class="required">Email ID</label>
                  <input id="e_emailid" name="e_emailid" type="email" class="form-control" autocomplete="off" required />
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="required">Date of Joining</label>
                  <input id="e_doj"   type="date" class="form-control" autocomplete="off" required>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="required">Date of Birth</label>
                  <input id="e_dob"  type="date" class="form-control" autocomplete="off" required>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="required">Blood Group</label>
                  <select class="form-control select2" style="width: 100%;" id="e_bloodgroup" name="e_bloodgroup">
                    <option value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="required">Gender</label>
                  <select class="form-control select2" style="width: 100%;" id="e_gender" name="e_gender" required>
                    <option selected="selected" value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="required">Religion</label>
                  <select class="form-control select2" style="width: 100%;" id="e_religion" name="e_religion" required>
                    <option selected="selected" value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="required">Caste</label>
                  <select class="form-control select2" style="width: 100%;" id="e_caste" name="e_caste" required>
                    <option selected="selected" value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="required">Community</label>
                  <select class="form-control select2" style="width: 100%;" id="e_community" name="e_community" required>
                    <option selected="selected" value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="required">Nationality</label>
                  <select class="form-control select2" style="width: 100%;" id="e_nationality" name="e_nationality" required>
                    <option value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="form-group">
                  <label for="e_address" class="required">Address</label>
                  <input id="e_address" name="e_address" type="text" class="form-control" autocomplete="off" required />
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-sm-12">
                  <button type="submit" class="btn bg-danger float-sm-right">SUBMIT</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="mdlAddEducation">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Education Information</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frmAddEducationInformation">
            <div class="row">
              <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label class="required">Qualification</label>
                  <select class="form-control select2" style="width:100%;" id="a_qt" required>
                    <option selected="selected" value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label class="required">Year of Passing</label>
                  <select class="form-control select2" style="width:100%;" id="a_yop" required>
                    <option selected="selected" value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label class="required">Board/University</label>
                  <select class="form-control select2" style="width:100%;" id="a_bu" required>
                    <option selected="selected" value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label class="required">Institute Name</label>
                  <input class="form-control" id="a_in" type="text" maxlength="99" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4 a_phd">
                <div class="form-group">
                  <label class="required">Percentage</label>
                  <input class="form-control" id="a_pg" type="number" min="0" max="100" step="0.1" />
                </div>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label class="required">Speciality/Topic</label>
                  <input class="form-control" id="a_spc" type="text" maxlength="99" required />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Attach Document</label>
                  <input type="file" id="a_doc" class="dropify" accept="application/pdf" data-allowed-file-extensions="pdf" data-max-file-size="2M" data-height="80" />
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="container">
                <div class="row float-sm-right">
                  <div class="col-sm-6">
                    <button type="button" class="btn btn-block btn-outline-secondary m-1" onclick="onResetAddEducation()">RESET</button>
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-block bg-danger m-1">SUBMIT</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="mdlEditEducation">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Education Information</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frmEditEducationInformation">
            <div class="row">
              <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label class="required">Qualification</label>
                  <select class="form-control select2" style="width:100%;" id="e_qt" required>
                    <option selected="selected" value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label class="required">Year of Passing</label>
                  <select class="form-control select2" style="width:100%;" id="e_yop" required>
                    <option selected="selected" value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label class="required">Board/University</label>
                  <select class="form-control select2" style="width:100%;" id="e_bu" required>
                    <option selected="selected" value="">-Select-</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label class="required">Institute Name</label>
                  <input class="form-control" id="e_in" type="text" maxlength="99" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4 phd">
                <div class="form-group">
                  <label>Percentage</label>
                  <input class="form-control" id="e_pg" type="number" min="0" max="100" step="0.1" />
                </div>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label class="required">Speciality/Topic</label>
                  <input class="form-control" id="e_spc" type="text" maxlength="99" required />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Attach Document</label>
                  <input type="file" id="e_doc" accept="application/pdf" data-allowed-file-extensions="pdf" data-max-file-size="20M" data-height="80" />
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="container">
                <div class="row float-sm-right">
                  <div class="col-sm-6">
                    <button type="button" class="btn btn-block btn-outline-secondary m-1" onclick="onResetEditEducation()">RESET</button>
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-block bg-danger m-1">SUBMIT</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="mdlAddIEBodyDetails">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">ADD INTERNAL/EXTERNAL BODY DETAILS</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frmAddIEBodyDetails">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label class="required">Type</label>
                  <select class="form-control select2" style="width:100%;" id="ie_type" required>
                    <option selected="selected" value="">-Select-</option>
                    <option value="1">INTERNAL SCHOOL BODY</option>
                    <option value="2">EXTERNAL BODY</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label class="required">Internal/External Body Name</label>
                  <input class="form-control" id="ebn" maxlength="249" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label class="required">Role</label>
                  <input class="form-control" id="role" maxlength="99" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label>Is Active</label>
                  <br />
                  <input class="form-control bootstrapToggle" id="is_active" checked type="checkbox" data-on="No" data-off="Yes" data-onstyle="danger" data-offstyle="success" />
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label class="required">Start Date</label>
                  <input id="start_date" class="form-control" autocomplete="off" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4" id="div_enddate">
                <div class="form-group">
                  <label class="required">End Date</label>
                  <input id="end_date" class="form-control" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row float-sm-right">
                <div class="col-6">
                  <button type="button" class="btn btn-block btn-outline-secondary" onclick="onResetAddIEBodyDetails()">RESET</button>
                </div>
                <div class="col-6">
                  <button type="submit" class="btn btn-block bg-danger">SUBMIT</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="mdlEditIEBodyDetails">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">EDIT INTERNAL/EXTERNAL BODY DETAILS</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frmEditIEBodyDetails">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label class="required">Type</label>
                  <select class="form-control select2" style="width:100%;" id="e_ie_type" required>
                    <option selected="selected" value="">-Select-</option>
                    <option value="1">INTERNAL SCHOOL BODY</option>
                    <option value="2">EXTERNAL BODY</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label class="required">Internal/External Body Name</label>
                  <input class="form-control" id="e_ebn" maxlength="249" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label class="required">Role</label>
                  <input class="form-control" id="e_role" maxlength="99" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label>Is Active</label>
                  <br />
                  <input class="form-control bootstrapToggle" id="e_is_active" checked type="checkbox" data-on="No" data-off="Yes" data-onstyle="danger" data-offstyle="success" />
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label class="required">Start Date</label>
                  <input id="e_start_date" class="form-control" autocomplete="off" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4" id="div_e_enddate">
                <div class="form-group">
                  <label class="required">End Date</label>
                  <input id="e_end_date" class="form-control" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row float-sm-right">
                <div class="col-6">
                  <button type="button" class="btn btn-block btn-outline-secondary" onclick="onResetEditIEBodyDetails()">RESET</button>
                </div>
                <div class="col-6">
                  <button type="submit" class="btn btn-block bg-danger">SUBMIT</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
 
  <!-- modal for adding  family member -->
  <div class="modal fade" id="mdlFamilyMember">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ttlFamilyMember">Add Family Member / Relative</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3">
              <div class="form-group">
                <label class="required">Relative Origin <span class="text-danger">*</span></label>
                <select class="form-control select2" id="relative_origin" required style="width:100%;">
                  <option selected="selected" value="0">Away from School</option>
                  <option value="1">Working in School</option>
                  <option value="2">Studying in School</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3">
              <div class="form-group">
                <label class="required">Relation Type <span class="text-danger">*</span></label>
                <select class="form-control select2" id="relation_type" required style="width:100%;">
                  <option selected="selected" value="">-Select-</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
              <div class="form-group">
                <label>Is Guardian <span class="text-danger">*</span> </label>
                <br />
                <input class="form-control bootstrapToggle" id="is_guardian" type="checkbox" data-on="Yes" data-off="No" data-onstyle="danger" data-offstyle="light" />
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
              <div class="form-group">
                <label>Is Staying Together <span class="text-danger">*</span></label>
                <br />
                <input class="form-control bootstrapToggle" id="is_staying_together" checked type="checkbox" data-on="Yes" data-off="No" data-onstyle="danger" data-offstyle="light" />
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3" id="div_address" style="display:none;">
              <div class="form-group">
                <label class="required">Address <span class="text-danger">*</span> </label>
                <input class="form-control" id="address" maxlength="499" />
              </div>
            </div>
          </div>
          <div class="row div_alumni">
            <div class="col-sm-6 col-md-6 col-lg-3">
              <div class="form-group">
                <label>Is School Pass-out <span class="text-danger">*</span></label>
                <br />
                <input class="form-control bootstrapToggle" id="is_school_passout" type="checkbox" data-on="Yes" data-off="No" data-onstyle="danger" data-offstyle="light" />
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 div_school_passout">
              <div class="form-group">
                <label class="required">Pass-out Year <span class="text-danger">*</span></label>
                <select class="form-control select2" id="pass_year" style="width:100%;">
                  <option selected="selected" value="">-Select-</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 div_school_passout">
              <div class="form-group">
                <label class="required">Class <span class="text-danger">*</span></label>
                <select class="form-control select2" id="passout_cls" style="width:100%;">
                  <option selected="selected" value="">-Select-</option>
                </select>
              </div>
            </div>
          </div>
          <form id="frmOutsider">
            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                  <label class="required">Name <span class="text-danger">*</span></label>
                  <div class="input-group mb-2">
                    <input id="fm_name" type="text" maxlength="249" class="form-control" required autocomplete="off" />
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="form-group">
                  <label class="required" for="contact_number">Contact Number <span class="text-danger">*</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                    </div>
                    <input id="contact_number" name="contact_number" autocomplete="off" type="text" pattern="^([6-9]{1})?\d{9}$" class="form-control" placeholder="" title="Enter valid 10-digit mobile number!" required />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="form-group">
                  <label>Working</label>
                  <br />
                  <input class="form-control bootstrapToggle" id="is_working" checked type="checkbox" data-on="Yes" data-off="No" data-onstyle="danger" data-offstyle="light" />
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-3 div_work">
                <div class="form-group">
                  <label class="required">Organisation Name <span class="text-danger">*</span></label>
                  <div class="input-group mb-2">
                    <input id="org_name" type="text" maxlength="249" class="form-control" autocomplete="off" />
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-3 div_work">
                <div class="form-group">
                  <label>Organisation Address</label>
                  <input class="form-control" id="org_address" type="text" maxlength="499" autocomplete="off" />
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-3 div_work">
                <div class="form-group">
                  <label>Designation</label>
                  <div class="input-group mb-2">
                    <input class="form-control" id="designation" type="text" maxlength="99" autocomplete="off" />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="container">
                <div class="row float-sm-right">
                  <div class="col-sm-6">
                    <button type="button" class="btn btn-block btn-outline-secondary m-1" onclick="onResetOutsider()">RESET</button>
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-block bg-danger m-1">SUBMIT</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <form id="frmStaff">
            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="form-group">
                  <label>Department</label>
                  <select class="form-control select2" id="stf_dept" style="width:100%;">
                    <option selected="selected" value="">All</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="form-group">
                  <label class="required">Name</label>
                  <select class="form-control select2" id="stf_name" required style="width:100%;">
                    <option selected="selected" value="">-Select-</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="container">
                <div class="row float-sm-right">
                  <div class="col-sm-6">
                    <button type="button" class="btn btn-block btn-outline-secondary m-1" onclick="onResetStaff()">RESET</button>
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-block bg-danger m-1">SUBMIT</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <form id="frmStudent">
            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="form-group">
                  <label>Class</label>
                  <select class="form-control select2" id="std_cls" style="width:100%;">
                    <option selected="selected" value="">All</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="form-group">
                  <label class="required">Name</label>
                  <select class="form-control select2" id="std_name" required style="width:100%;">
                    <option selected="selected" value="">-Select-</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="container">
                <div class="row float-sm-right">
                  <div class="col-sm-6">
                    <button type="button" class="btn btn-block btn-outline-secondary m-1" onclick="onResetStudent()">RESET</button>
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-block bg-danger m-1">SUBMIT</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- modal for work detail -->
  <div class="modal fade" id="mdlAddWorkDetails">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">ADD WORK DETAILS</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frmAddWorkDetails">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="form-group">
                  <label class="required">Organisation Name <span class="text-danger">*</span></label>
                  <input class="form-control" id="org" maxlength="249" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label class="required">Designation <span class="text-danger">*</span></label>
                  <input class="form-control" id="dsg" maxlength="99" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label>Is Currently Working <span class="text-danger">*</span></label>
                  <br />
                  <input class="form-control bootstrapToggle" id="is_currently_working" checked type="checkbox" data-on="No" data-off="Yes" data-onstyle="danger" data-offstyle="success" />
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label for="sdate" class="required">Start Date <span class="text-danger">*</span></label>
                  <input id="sdate" class="form-control" autocomplete="off" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4" id="div_w_enddate">
                <div class="form-group">
                  <label for="edate" class="required">End Date <span class="text-danger">*</span></label>
                  <input id="edate" class="form-control" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row float-sm-right">
                <div class="col-6">
                  <button type="button" class="btn btn-block btn-outline-secondary" onclick="onResetAddWorkDetails()">RESET</button>
                </div>
                <div class="col-6">
                  <button type="submit" class="btn btn-block bg-danger">SUBMIT</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="mdlEditWorkDetails">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">EDIT WORK DETAILS</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frmEditWorkDetails">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="form-group">
                  <label class="required">Organisation</label>
                  <input class="form-control" id="e_org" maxlength="249" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label class="required">Designation</label>
                  <input class="form-control" id="e_dsg" maxlength="99" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label>Is Currently Working</label>
                  <br />
                  <input class="form-control bootstrapToggle" id="e_is_currently_working" checked type="checkbox" data-on="No" data-off="Yes" data-onstyle="danger" data-offstyle="success" />
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="form-group">
                  <label class="required">Start Date</label>
                  <input id="e_sdate" class="form-control" autocomplete="off" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4" id="div_w_e_enddate">
                <div class="form-group">
                  <label class="required">End Date</label>
                  <input id="e_edate" class="form-control" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row float-sm-right">
                <div class="col-6">
                  <button type="button" class="btn btn-block btn-outline-secondary" onclick="onResetEditWorkDetails()">RESET</button>
                </div>
                <div class="col-6">
                  <button type="submit" class="btn btn-block bg-danger">SUBMIT</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- modal for adding vehicle -->
  <div class="modal fade" id="mdlAddVehicleInfo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">ADD VEHICLE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frmSaveVehicleDetails">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label class="required">Vehicle Type <span class="text-danger">*</span></label>
                  <select class="form-control select2" style="width:100%;" id="vehicle_type" required>
                    <option selected="selected" value="">-Select-</option>
                    <option value="1">Light Motor Vehicle</option>
                    <option value="2">Motor-Cycle</option>
                    <option value="3">Scooter</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label class="required">Make of Vehicle <span class="text-danger">*</span></label>
                  <input class="form-control" id="brand" maxlength="249" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label class="required">Vehicle Model <span class="text-danger">*</span></label>
                  <input class="form-control" id="model" maxlength="249" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label class="required">Vehicle Color <span class="text-danger">*</span></label>
                  <input class="form-control" id="color" maxlength="44" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label class="required">Vehicle Number <span class="text-danger">*</span></label>
                  <input class="form-control" id="number" maxlength="11" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label>Is Vehicle registered on your Name? <span class="text-danger">*</span></label>
                  <br/>
                  <input class="form-control bootstrapToggle" id="is_owner" checked type="checkbox" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="light" />
                </div>
              </div>

              <div class="col-sm-12 col-md-6 col-lg-6" id="divOwner" style="display:none;">
                <div class="form-group">
                  <label class="required">Registered Person Name</label>
                  <input class="form-control" id="o_name" autocomplete="off" maxlength="249" />
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row float-sm-right">
                <div class="col-6">
                  <button type="button" class="btn btn-block btn-outline-secondary" onclick="onResetAddVehicleInfo()">RESET</button>
                </div>
                <div class="col-6">
                  <button type="submit" class="btn btn-block bg-danger">SUBMIT</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="mdlEditVehicleInfo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">EDIT VEHICLE DETAILS</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frmEditVehicleDetails">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label class="required">Vehicle Type</label>
                  <select class="form-control select2" style="width:100%;" id="e_vehicle_type" required>
                    <option selected="selected" value="">-Select-</option>
                    <option value="1">Light Motor Vehicle</option>
                    <option value="2">Motor-Cycle</option>
                    <option value="3">Scooter</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label class="required">Make of Vehicle</label>
                  <input class="form-control" id="e_brand" maxlength="249" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label class="required">Vehicle Model</label>
                  <input class="form-control" id="e_model" maxlength="249" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label class="required">Vehicle Color</label>
                  <input class="form-control" id="e_color" maxlength="44" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label class="required">Vehicle Number</label>
                  <input class="form-control" id="e_number" maxlength="11" required />
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label>Is Vehicle registered on your Name?</label>
                  <br />
                  <input class="form-control bootstrapToggle" id="e_is_owner" checked type="checkbox" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="light" />
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6" id="e_divOwner" style="display:none;">
                <div class="form-group">
                  <label class="required">Registered Person Name</label>
                  <input class="form-control" id="e_o_name" autocomplete="off" maxlength="249" />
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row float-sm-right">
                <button type="submit" class="btn btn-block bg-danger">SUBMIT</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  var has_right=-1;
  var staff_id=-1;
  var personal_data, gender_list, religion_list, caste_list, community_list, nationality_list, designation_list, department_list, bloodgroups_list, work_data, iebody_data, vehicle_data, qualificationtype_list, board_list, qualification_data, relationtype_list, classsection_list, staff_list, student_list, familyrelative_data;
  var element;

  $(".select2").select2();
  $('.bootstrapToggle').bootstrapToggle();
  $('.dropify').dropify({
    messages: {
      'default': 'Drag and drop a photo here or click',
      'replace': 'Drag and drop or click to replace',
      'remove': 'Remove',
      'error': 'Ooops, something wrong happended.'
    }
  });

  var knobWidthHeight;
  var windowObj;
  windowObj = $(window);
  if (windowObj.height() > windowObj.width()) {
    knobWidthHeight = Math.round(windowObj.width() * 0.07);
  } else {
    knobWidthHeight = Math.round(windowObj.height() * 0.07);
  }

  $('.Chart').attr('data-width', knobWidthHeight).attr('data-height', knobWidthHeight);
  $(".Chart").knob({
    readOnly: true,
    fgColor: "#f5365c",
    bgColor: "#ececec",
    thickness: 0.2,
    'draw': function() {
      $(this.i).css('font-size', '1.5rem');
    }
  });

  if (localStorage.getItem("k1")) {
    staff_id = decode(localStorage.getItem("k1"));
   
    //localStorage.clear();
  }

  function encode(str) {
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
      function toSolidBytes(match, p1) {
        return String.fromCharCode('0x' + p1);
      }
    ));
  }
  function decode(str) {
    return decodeURIComponent(atob(str).split('').map(function(c) {
      return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
  }

  function populateData(item) {
    if (item['IsOptionSelected'] == 'YES') {
      element.append($("<option></option>")
        .attr('value', item['Value'])
        .prop('selected', 'selected')
        .text(item['Text'])
      );
    } else {
      element.append($("<option></option>")
        .attr("value", item['Value'])
        .text(item['Text'])
      );
    }
  }

  $('#btnDownloadProfile').on('click', function() {
    window.print();
  });

  // getStaffProfileData();
  function getStaffProfileData() 
  {
    let obj = {};
    let json = {};

    obj.Module = "Staff";
    obj.Page_key = "getStaffProfileData";

    json.StaffID = staff_id;

    obj.JSON = json;
    TransportCall(obj);
  }

  function fnHandleEdit() {
    if (has_right == "1") {
      $('.btnEdit').show();
    } else {
      $('.btnEdit').hide();
    }
  }

  $('#frmPhoto').submit(function() {
    onSubmitPhoto();
    return false;
  });
  var photodata;

  async function onSubmitPhoto() 
  {
    var files = $('#e_photo')[0].files;
    var fileData = {};
    if (files.length != 0) {
      await getBase64(files[0]).then(
        data => fileData = {
          filedata: data,
          filename: files[0]['name']
        }
      );
    } else
      fileData = null;

    let obj = {};
    let json = {};

    obj.Module = "Staff";
    obj.Page_key = "saveStaffPhoto";
    
    json.StaffID = staff_id;
    json.File = fileData;

    obj.JSON = json;
    // console.log(obj);
    TransportCall(obj);
  }



  function getBase64(file) 
    {
        return new Promise(function(resolve) {
        var reader = new FileReader();
        reader.onloadend = function() {
            resolve(reader.result)
        }
        reader.readAsDataURL(file);
        });
    }

// function getBase64(file) {
//         let reader = new FileReader();
//         reader.readAsDataURL(file);
//         reader.onload = function() {
//             photodata = reader.result;
//             return photodata;
//             // reloadImageForCrop();
//             // alert(photodata);
//         };
//         reader.onerror = function(error) {

//         };
//     }

  
  // let reader = new FileReader();
  //   reader.readAsDataURL(files[0]);
  //   reader.onload = function() {
  //       // console.log(reader.result);
  //       // callback(reader.result.split(',')[1]);
  //       d = reader.result;

  //       alert(d);
  //   };
  //   reader.onerror = function(error) {
  //       // console.log('Error: ', error);
  //   };



  $('#frmPersonalDetails').submit(function() 
  {
    let obj = {};
    let json = {};
    obj.Module = "Staff";
    // obj.Page_key = "editStaffPersonalDetails"; //we will use the same function only for updating the staff info
    obj.Page_key="updateStaff"; //Try using the same function only
    json.StaffID = staff_id;
    json.Name = $('#e_name').val();
    json.DesignationID = $('#e_designation').val();
    json.DepartmentID = $('#e_department').val(); //to update below
    json.DOJ = $('#e_doj').val(); 
    json.DOB = $('#e_dob').val();
    json.ContactNo = $('#e_contactno').val();
    json.EmailID = $('#e_emailid').val();
    json.BloodGroup = $('#e_bloodgroup').val(); //to update below
    json.GenderCode = $('#e_gender').val();
    json.ReligionID = $('#e_religion').val();
    json.CasteCode = $('#e_caste').val();
    json.CommunityID = $('#e_community').val();
    json.NationalityID = $('#e_nationality').val();
    json.Address = $('#e_address').val();
    obj.JSON = json;
   
    TransportCall(obj);
  });

  var cur_date = new Date();
  for (var i = cur_date.getFullYear(); i >= 1950; i--) {
    $('#a_yop, #e_yop, #pass_year').append($("<option></option>")
      .attr("value", i)
      .text(i)
    );
  }
  $('#a_qt').on('change', function() {
    if ($('#a_qt').val() == "8") {
      $("#a_pg").val('');
      $('.a_phd').hide();
    } else {
      $("#a_pg").val('');
      $('.a_phd').show();
    }
  });

  $("#frmAddEducationInformation").submit(function() 
  {
    sendAddEducationData();
    return false;
  });

  async function sendAddEducationData()
  {
    if ($('#a_qt').val() != '8' && $('#a_pg').val() == '') {
      toastr.warning('Percentage missing !!');
      return false;
    }

    var files = $('#a_doc')[0].files;
    var fileData = {};
    var totalFileSize = 0;

    for (var i = 0; i < files.length; i++) {
      const fsize = files[i].size;
      const file = Math.round((fsize / 1024));
      totalFileSize += file;
      if (file > (1024 * 20)) {
        toastr.error("File size cannot exceed 20 MB !!");
        return false;
      }

      await getBase64(files[i]).then(
        data => fileData[i] = {
          filedata: data,
          filename: files[i]['name']
        }
      );
    }

    var dvsn;
    if ($('#a_pg').val() >= 60) {
      dvsn = '1';
    } else if ($('#a_pg').val() >= 45 && $('#a_pg').val() < 60) {
      dvsn = '2';
    } else {
      dvsn = '3';
    }

    let obj = {};
    let json = {};

    obj.Module = "Staff";
    obj.Page_key = "addStaffEducationInformation";

    json.StaffID = staff_id;
    json.QualificationTypeID = $('#a_qt').val();
    json.YearOfPassing = $('#a_yop').val();
    json.BoardUniversityID = $('#a_bu').val();
    json.InstituteName = $('#a_in').val();
    json.Percentage = $('#a_pg').val();
    json.Division = dvsn;
    json.Specialisation = $('#a_spc').val();
    json.Document = fileData;

    obj.JSON = json;
    
    TransportCall(obj);
  }
  function onResetAddEducation() {
    $('#frmAddEducationInformation')[0].reset();
    $('#a_qt').trigger('change');
    $('#a_yop').trigger('change');
    $('#a_bu').trigger('change');
    $('.dropify-clear').click();
  } 

  var qd_id = qt = yop = bu = ins = pg = spc = doc_link = '';
  $('#div_education').on('click', 'button', function() {
    qd_id = $(this).attr("data-qd_id");
    qt = $(this).attr("data-qt");
    yop = $(this).attr("data-yop");
    bu = $(this).attr("data-bu");
    ins = $(this).attr("data-in");
    pg = $(this).attr("data-pg");
    spc = $(this).attr("data-spc");
    doc_link = $(this).attr("data-doc_link");
    onResetEditEducation();
  });

  function onResetEditEducation() {
    if (qt != null && qt != '' && qt != 'null')
      $('#e_qt option[value="' + qt + '"]').prop('selected', true).trigger('change');
    if (yop != null && yop != '' && yop != 'null')
      $('#e_yop option[value="' + yop + '"]').prop('selected', true).trigger('change');
    if (bu != null && bu != '' && bu != 'null')
      $('#e_bu option[value="' + bu + '"]').prop('selected', true).trigger('change');
    if (ins != null && ins != '' && ins != 'null')
      $("#e_in").val(ins);
    if (pg != null && pg != '' && pg != 'null')
      $("#e_pg").val(pg);
    if (spc != null && spc != '' && spc != 'null')
      $("#e_spc").val(spc);
    if (doc_link != null && doc_link != '' && doc_link != 'null') {
      var doc_name = doc_link.split('=');
      $('#e_doc').addClass('dropify');
      $('#e_doc').attr('data-default-file', "file?type=document&name="+doc_name[2]);
      $('#e_doc').dropify();
    } else {
      $('#e_doc').addClass('dropify');
      $('#e_doc').dropify();
      $('.dropify-clear').click();
    }
  }
  $('#e_qt').on('change', function() {
    if ($('#e_qt').val() == "8") {
      $("#e_pg").val('');
      $('.phd').hide();
    } else {
      $("#e_pg").val(pg);
      $('.phd').show();
    }
  });

  $("#frmEditEducationInformation").submit(function() {
    sendEditEducationData();
    return false;
  });
  async function sendEditEducationData() 
  {
    if ($('#e_qt').val() != '8' && $('#e_pg').val() == '') {
      toastr.warning('Percentage missing !!');
      return false;
    }

    var files = $('#e_doc')[0].files;
    var fileData = {};
    var totalFileSize = 0;

    for (var i = 0; i < files.length; i++) {
      const fsize = files[i].size;
      const file = Math.round((fsize / 1024));
      totalFileSize += file;
      if (file > (1024 * 20)) {
        toastr.error("File size cannot exceed 20 MB !!");
        return false;
      }

      await getBase64(files[i]).then(
        data => fileData[i] = {
          filedata: data,
          filename: files[i]['name']
        }
      );
    }

    var dvsn;
    if ($('#e_pg').val() == '') {
      dvsn = '';
    } else if ($('#e_pg').val() >= 60) {
      dvsn = '1';
    } else if ($('#e_pg').val() >= 45 && $('#e_pg').val() < 60) {
      dvsn = '2';
    } else {
      dvsn = '3';
    }

    let obj = {};
    let json = {};

    obj.Module = "Staff";
    obj.Page_key = "editStaffEducationInformation";

    json.StaffID = staff_id;
    json.QualificationDetailID = qd_id;
    json.QualificationTypeID = $('#e_qt').val();
    json.YearOfPassing = $('#e_yop').val();
    json.BoardUniversityID = $('#e_bu').val();
    json.InstituteName = $('#e_in').val();
    json.Percentage = $('#e_pg').val();
    json.Division = dvsn;
    json.Specialisation = $('#e_spc').val();
    json.DocumentLink = doc_link;
    json.Document = fileData;

    obj.JSON = json;

    TransportCall(obj);
  }


  $("#start_date, #e_start_date, #end_date, #e_end_date").datepicker({  maxDate: "+2Y", changeMonth:true, changeYear:true });
  $("#start_date").on('change', function()
  {
    $('#end_date').datepicker('option', 'minDate', new Date($("#start_date").val()));
  });

  var is_active = 0;

  $('#is_active').on('change', function() {
    if (!$('#is_active').prop('checked')) {
      is_active = 1;
      $('#div_enddate').hide();
    } else {
      is_active = 0;
      $('#div_enddate').show();
    }
  });

  $('#frmAddIEBodyDetails').submit(function() {
    if (is_active == '0' && $('#end_date').val() == '') {
      toastr.warning('End Date not selected !!');
      return false;
    }

    let obj = {};
    let json = {};

    obj.Module = "Staff";
    obj.Page_key = "addStaffInternalExternalDetails";

    json.StaffID = staff_id;
    json.Type = $('#ie_type').val();
    json.InternalExternalBodyName = $('#ebn').val();
    json.Role = $('#role').val();
    json.IsActive = is_active;
    json.StartDate = $('#start_date').val();
    json.EndDate = $('#end_date').val();

    obj.JSON = json;
    
    TransportCall(obj);

    return false;
  });

  function onResetAddIEBodyDetails() {
    $('#frmAddIEBodyDetails')[0].reset();
    $('#is_active').prop('checked', true).change();
  }

  var e_is_active = 0;
  var id = typ = title = role = sdate = edate = status = '';
  $('#div_iebody').on('click', 'button', function() {
    id = $(this).attr("data-id");
    typ = $(this).attr("data-type");
    title = $(this).attr("data-title");
    role = $(this).attr("data-role");
    sdate = $(this).attr("data-sdate");
    edate = $(this).attr("data-edate");
    status = $(this).attr("data-status");
    onResetEditIEBodyDetails();
  });
  function onResetEditIEBodyDetails(){
    $('#e_ie_type').val(typ).trigger('change');
    $('#e_ebn').val(title);
    $('#e_role').val(role);
    if(status=="1"){
      $('#e_is_active').prop('checked', false).change();
      $('#div_e_enddate').hide();
    }
    else{
      $('#e_is_active').prop('checked', true).change();
      $('#div_e_enddate').show();
      $('#e_end_date').val(edate);
    }
    $('#e_start_date').val(sdate);
    $('#e_end_date').datepicker('option', 'minDate', new Date($("#e_start_date").val()));
  }
  $("#e_start_date").on('change', function()
  {
    $('#e_end_date').datepicker('option', 'minDate', new Date($("#e_start_date").val()));
  });
  $('#e_is_active').on('change', function() {
    if (!$('#e_is_active').prop('checked')) {
      e_is_active = 1;
      $('#div_e_enddate').hide();
    } else {
      e_is_active = 0;
      $('#div_e_enddate').show();
    }
  });

  $('#frmEditIEBodyDetails').submit(function() {
    if (e_is_active == '0' && $('#e_end_date').val() == '') {
      toastr.warning('End Date not selected !!');
      return false;
    }

    let obj = {};
    let json = {};

    obj.Module = "Staff";
    obj.Page_key = "editStaffInternalExternalDetails";

    json.StaffID = staff_id;
    json.InternalExternalBodyDetailID = id;
    json.InternalExternalBodyName = $('#e_ebn').val();
    json.Role = $('#e_role').val();
    json.IsActive = e_is_active;
    json.StartDate = $('#e_start_date').val();
    json.EndDate = $('#e_end_date').val();

    obj.JSON = json;
    
    TransportCall(obj);

    return false;
  });

  
  var relative_origin=0;
  var is_staying_together = 1;
  var is_school_passout = 0;
  var is_working = 1;
  var stf_dept_id, std_cs_id;

  $('#relative_origin').on('change', function() 
  {
    relative_origin = $('#relative_origin').val();

    if (relative_origin == '1') {
      onResetOutsider();
      $('.div_alumni').show();
      $('#frmStaff').show();
      $('#frmOutsider').hide();
      $('#frmStudent').hide();
    } else if (relative_origin == '2') {
      onResetStaff();
      $('.div_alumni').hide();
      $('#frmStudent').show();
      $('#frmOutsider').hide();
      $('#frmStaff').hide();
    } else {
      onResetStudent();
      $('.div_alumni').show();
      $('#frmOutsider').show();
      $('#frmStaff').hide();
      $('#frmStudent').hide();
    }
  });

  $('#is_staying_together').on('change', function() {
    $('#address').prop('value', '');
    if ($('#is_staying_together').prop('checked')) {
      is_staying_together = 1;
      $('#div_address').hide();
    } else {
      is_staying_together = 0;
      $('#div_address').show();
    }
  });
  $('#is_school_passout').on('change', function() {
    $('#pass_year, #passout_cls').val('').trigger('change');
    if ($('#is_school_passout').prop('checked')) {
      is_school_passout = 1;
      $('.div_school_passout').show();
    } else {
      is_school_passout = 0;
      $('.div_school_passout').hide();
    }
  });
  $('#is_working').on('change', function() {
    $('#org_name').prop('value', '');
    $('#org_address').prop('value', '');
    $('#designation').prop('value', '');
    if ($('#is_working').prop('checked')) {
      is_working = 1;
      $('.div_work').show();
    } else {
      is_working = 0;
      $('.div_work').hide();
    }
  });

  $('#stf_dept').on('change', function() {
    stf_dept_id = $('#stf_dept').val();
    if (stf_dept_id == '') {
      populateFacultyList(0);
    } else {
      populateFacultyList(1);
    }
  });
  function populateFacultyList(is_stf_dept_changed) 
  {
    if(staff_list){
      $('#stf_name').find('option').remove();
      $('#stf_name').append($("<option></option>").attr("value", "").text("-Select-"));
      staff_list.forEach(function(item) {
        if (is_stf_dept_changed == 1) {
          if (item['DepartmentID'] == stf_dept_id) {
            $('#stf_name').append($("<option></option>")
              .attr("value", item['UserID'])
              .text(item['StaffName'])
            );
          }
        } else {
          $('#stf_name').append($("<option></option>")
            .attr("value", item['UserID'])
            .text(item['StaffName'])
          );
        }
      });
    }
    else{
      notify('error', "Staff not found !!");
    }
  }

  $('#std_cls').on('change', function() {
    std_cs_id = $('#std_cls').val();
    if (std_cs_id == '') {
      populateStudentList(0);
    } else {
      populateStudentList(1);
    }
  });
  function populateStudentList(is_std_cs_changed) 
  {
    if (student_list) {
      $('#std_name').find('option').remove();
      $('#std_name').append($("<option></option>").attr("value", "").text("-Select-"));
      student_list.forEach(function(item) {
        if (is_std_cs_changed == 1) {
          if (item['ClassSectionID'] == std_cs_id) {
            $('#std_name').append($("<option></option>")
              .attr("value", item['UserID'])
              .text(item['StudentName'])
            );
          }
        } else {
          $('#std_name').append($("<option></option>")
            .attr("value", item['UserID'])
            .text(item['StudentName'])
          );
        }
      });    
    }
    else{
      notify('error', "Student not found !!");
    }
  }

  $("#frmOutsider").submit(function() {
    if ($('#relation_type').val() == '') {
      toastr.warning('Kindly select the Relation Type!!');
      return false;
    }
    if (is_staying_together == 0) {
      if ($('#address').val().length == 0) {
        toastr.warning('Kindly enter the Address of the relative!!');
        return false;
      }
    }
    if ($('#is_school_passout').prop('checked')) {
      if ($('#pass_year').val() == '') {
        toastr.warning('Kindly select the Pass-out Year of the relative!!');
        return false;
      }
      if ($('#passout_cls').val() == '') {
        toastr.warning('Kindly select the Class of the relative!!');
        return false;
      }
    }
    if ($('#is_working').prop('checked')) {
      if ($('#org_name').val() == '') {
        toastr.warning('Kindly enter the Organisation Name !!');
        return false;
      }
    }

    sendOutsiderData();

    return false;
  });
  function sendOutsiderData() {
    if (document.getElementById('ttlFamilyMember').innerHTML == 'Edit Family Member / Relative') 
    {
      var allData = {
        'RelationID': relation_id,
        'RelativeOriginID': $('#relative_origin').val(),
        'RelationTypeID': $('#relation_type').val(),
        'IsStayingTogether': is_staying_together,
        'Address': $('#address').val(),
        'IsAlumni': is_school_passout,
        'PassOutYear': $('#pass_year').val(),
        'ClassSectionID': $('#passout_cls').val(),
        'Name': $('#fm_name').val(),
        'ContactNumber': $('#contact_number').val(),
        'IsWorking': is_working,
        'OrganisationName': $('#org_name').val(),
        'OrganisationAddress': $('#org_address').val(),
        'Designation': $('#designation').val()
      };
     
      //gateway('STUDENT', 'ENTRY', 'UPDATE_FAMILYMEMBER_OUTSIDER', allData, onSuccess, onError);
    } 
    else 
    {
      let obj = {};
      let json = {};

      obj.Module = "Staff";
      obj.Page_key = "addStaffFamilyRelativeOutsider";

      json.StaffID = staff_id;
      json.RelativeOriginID = $('#relative_origin').val();
      json.RelationTypeID = $('#relation_type').val();
      json.IsGuardian = ($('#is_guardian').prop('checked')?1:0);
      json.IsStayingTogether = is_staying_together;
      json.Address = $('#address').val();
      json.IsSchoolPassOut = is_school_passout;
      json.PassOutYear = $('#pass_year').val();
      json.ClassSectionID = $('#passout_cls').val();
      json.Name = $('#fm_name').val();
      json.ContactNumber = $('#contact_number').val();
      json.IsWorking = is_working;
      json.OrganisationName = $('#org_name').val();
      json.OrganisationAddress = $('#org_address').val();
      json.Designation = $('#designation').val();

      obj.JSON = json;
     
      TransportCall(obj);
    }
  }

  $("#frmStaff").submit(function() {
    if ($('#relation_type').val() == '') {
      toastr.warning('Kindly select the Relation Type!!');
      return false;
    }
    if (is_staying_together == 0) {
      if ($('#address').val().length == 0) {
        toastr.warning('Kindly enter the Address of the relative!!');
        return false;
      }
    }
    if ($('#is_school_passout').prop('checked')) {
      if ($('#pass_year').val() == '') {
        toastr.warning('Kindly select the Pass-out Year of the relative!!');
        return false;
      }
      if ($('#passout_cls').val() == '') {
        toastr.warning('Kindly select the Class of the relative!!');
        return false;
      }
    }

    sendStaffData();

    return false;
  });
  function sendStaffData() {
    if (document.getElementById('ttlFamilyMember').innerHTML == 'Edit Family Member / Relative') 
    {
      var allData = {
        'RelationID': relation_id,
        'RelativeOriginID': $('#relative_origin').val(),
        'RelationTypeID': $('#relation_type').val(),
        'IsStayingTogether': is_staying_together,
        'Address': $('#address').val(),
        'IsAlumni': is_school_passout,
        'PassOutYear': $('#pass_year').val(),
        'ClassSectionID': $('#passout_cls').val(),
        'UserID': $('#stf_name').val()
      };
      colsole.log(allData);
      //gateway('STUDENT', 'ENTRY', 'UPDATE_FAMILYMEMBER_STAFF', allData, onSuccess, onError);
    } 
    else 
    {
      let obj = {};
      let json = {};

      obj.Module = "Staff";
      obj.Page_key = "addStaffFamilyRelativeStaffStudent";

      json.StaffID = staff_id;
      json.RelativeOriginID = $('#relative_origin').val();
      json.RelationTypeID = $('#relation_type').val();
      json.IsGuardian = ($('#is_guardian').prop('checked')?1:0);
      json.IsStayingTogether = is_staying_together;
      json.Address = $('#address').val();
      json.IsSchoolPassOut = is_school_passout;
      json.PassOutYear = $('#pass_year').val();
      json.ClassSectionID = $('#passout_cls').val();
      json.Name = $('#fm_name').val();
      json.ContactNumber = $('#contact_number').val();
      json.IsWorking = is_working;
      json.OrganisationName = $('#org_name').val();
      json.OrganisationAddress = $('#org_address').val();
      json.Designation = $('#designation').val();
      json.MemberUserID = $('#stf_name').val();

      obj.JSON = json;
      
      TransportCall(obj);
    }
  }

  $("#frmStudent").submit(function() {
    if ($('#relation_type').val() == '') {
      toastr.warning('Kindly select the Relation Type!!');
      return false;
    }
    if (is_staying_together == 0) {
      if ($('#address').val().length == 0) {
        toastr.warning('Kindly enter the Address of the relative!!');
        return false;
      }
    }

    sendStudentData();

    return false;
  });
  function sendStudentData() 
  {
    alert("sendStudentData -- TODO")
    if (document.getElementById('ttlFamilyMember').innerHTML == 'Edit Family Member / Relative') 
    {
      var allData = {
        'RelationID': relation_id,
        'RelativeOriginID': $('#relative_origin').val(),
        'RelationTypeID': $('#relation_type').val(),
        'IsStayingTogether': is_staying_together,
        'Address': $('#address').val(),
        'UserID': $('#std_name').val()
      };
      
    } 
    else 
    {
      let obj = {};
      let json = {};

      obj.Module = "Staff";
      obj.Page_key = "addStaffFamilyRelativeStaffStudent";

      json.StaffID = staff_id;
      json.RelativeOriginID = $('#relative_origin').val();
      json.RelationTypeID = $('#relation_type').val();
      json.IsGuardian = ($('#is_guardian').prop('checked')?1:0);
      json.IsStayingTogether = is_staying_together;
      json.Address = $('#address').val();
      json.IsSchoolPassOut = is_school_passout;
      json.PassOutYear = $('#pass_year').val();
      json.ClassSectionID = $('#passout_cls').val();
      json.Name = $('#fm_name').val();
      json.ContactNumber = $('#contact_number').val();
      json.IsWorking = is_working;
      json.OrganisationName = $('#org_name').val();
      json.OrganisationAddress = $('#org_address').val();
      json.Designation = $('#designation').val();
      json.MemberUserID = $('#std_name').val();

      obj.JSON = json;
      TransportCall(obj);
    }
  }

  function onResetFamilyMemberForm(){
    $('#ttlFamilyMember').prop('innerHTML', 'Add Family Member / Relative');
    $('#frmOutsider')[0].reset();
    $('#relation_type').prop('disabled', false);
    $('#relative_origin option[value="0"]').prop('selected', true).trigger('change');
    $('#is_guardian').prop('checked', false).change();
    $('#is_staying_together').prop('checked', true).change();
    $('#is_school_passout').prop('checked', false).change();
    $('#is_working').prop('checked', true).change();
  }
  function onResetOutsider() {
    $('#frmOutsider')[0].reset();
    $('#relation_type option[value=""]').prop('selected', true).trigger('change');
    $('#is_guardian').prop('checked', false).change();
    $('#is_staying_together').prop('checked', true).change();
    $('#is_school_passout').prop('checked', false).change();
    $('#is_working').prop('checked', true).change();
  }
  function onResetStaff() {
    $('#frmStaff')[0].reset();
    $('#relation_type option[value=""]').prop('selected', true).trigger('change');
    $('#is_guardian').prop('checked', false).change();
    $('#is_staying_together').prop('checked', true).change();
    $('#is_school_passout').prop('checked', false).change();
    $('#stf_dept option[value=""]').prop('selected', true).trigger('change');
  }
  function onResetStudent() {
    $('#frmStudent')[0].reset();
    $('#relation_type option[value=""]').prop('selected', true).trigger('change');
    $('#is_guardian').prop('checked', false).change();
    $('#is_staying_together').prop('checked', true).change();
    $('#std_cls option[value=""]').prop('selected', true).trigger('change');
  }

  $("#sdate, #e_sdate, #edate, #e_edate").datepicker({ minDate: "-0D", maxDate: "+1Y", changeMonth:true, changeYear:true });
  $("#sdate").on('change', function()
  {
    $('#edate').datepicker('option', 'minDate', new Date($("#sdate").val()));
  });

  var is_currently_working = 0;

  $('#is_currently_working').on('change', function() {
    if (!$('#is_currently_working').prop('checked')) {
      is_currently_working = 1;
      $('#div_w_enddate').hide();
    } else {
      is_currently_working = 0;
      $('#div_w_enddate').show();
    }
  });
 
  //TODO
  $('#frmAddWorkDetails').submit(function() {
    alert("TODO");
    if (is_currently_working == '0' && $('#edate').val() == '') {
      notify('error', 'End Date not selected !!');
      return false;
    }

    let obj = {};
    let json = {};

    obj.Module = "Staff";
    obj.Page_key = "addStaffWorkDetails";

    json.StaffID = staff_id;
    json.Organisation = $('#org').val();
    json.Designation = $('#dsg').val();
    json.IsCurrentlyWorking = is_currently_working;
    json.StartDate = $('#sdate').val();
    json.EndDate = $('#edate').val();

    obj.JSON = json;
   
    // TransportCall(obj);

    return false;
  });

  function onResetAddWorkDetails() {
    $('#frmAddWorkDetails')[0].reset();
    $('#is_currently_working').prop('checked', true).change();
  }

  var e_is_currently_working = 0;
  var id = org = dsg = w_sdate = w_edate = w_status = '';
  $('#div_workdetails').on('click', 'button', function() {
    id = $(this).attr("data-id");
    org = $(this).attr("data-org");
    dsg = $(this).attr("data-dsg");
    w_sdate = $(this).attr("data-sdate");
    w_edate = $(this).attr("data-edate");
    w_status = $(this).attr("data-status");
    onResetEditWorkDetails();
  });
  function onResetEditWorkDetails(){
    $('#e_org').val(org);
    $('#e_dsg').val(dsg);
    if(w_status=="1"){
      $('#e_is_currently_working').prop('checked', false).change();
      $('#div_w_e_enddate').hide();
    }
    else{
      $('#e_is_currently_working').prop('checked', true).change();
      $('#div_w_e_enddate').show();
      $('#e_edate').val(w_edate);
    }
    $('#e_sdate').val(w_sdate);
    $('#e_edate').datepicker('option', 'minDate', new Date($("#e_sdate").val()));
  }
  $("#e_sdate").on('change', function()
  {
    $('#e_edate').datepicker('option', 'minDate', new Date($("#e_sdate").val()));
  });
  $('#e_is_currently_working').on('change', function() {
    if (!$('#e_is_currently_working').prop('checked')) {
      e_is_currently_working = 1;
      $('#div_w_e_enddate').hide();
    } else {
      e_is_currently_working = 0;
      $('#div_w_e_enddate').show();
    }
  });

  $('#frmEditWorkDetails').submit(function() {
    if (e_is_currently_working == '0' && $('#e_edate').val() == '') {
      toastr.warning('End Date not selected !!');
      return false;
    }

    let obj = {};
    let json = {};

    obj.Module = "Staff";
    obj.Page_key = "editStaffWorkDetails";

    json.StaffID = staff_id;
    json.WorkDetailID = id;
    json.Organisation = $('#e_org').val();
    json.Designation = $('#e_dsg').val();
    json.IsCurrentlyWorking = e_is_currently_working;
    json.StartDate = $('#e_sdate').val();
    json.EndDate = $('#e_edate').val();

    obj.JSON = json;
   
    TransportCall(obj);

    return false;
  });

  var is_owner=1;
  var e_is_owner=1;
  $('#btnAddVehicleInfo').on('click', function() {
    onResetAddVehicleInfo();
  });
  function onResetAddVehicleInfo() {
    $('#vehicle_type').val('').trigger('change');
    $('#brand').val('');
    $('#model').val('');
    $('#color').val('');
    $('#number').val('');
    $('.bootstrapToggle').prop('checked', true).change();
    $('#o_name').val('');
  }
  $('#is_owner').on('change', function() 
  {
    if ($('#is_owner').prop('checked')) {
      is_owner = 1;
      $('#divOwner').hide();
    } else {
      is_owner = 0;
      $('#divOwner').show();
    }
  });
  $('#e_is_owner').on('change', function() {
    if ($('#e_is_owner').prop('checked')) {
      e_is_owner = 1;
      $('#e_divOwner').hide();
    } else {
      e_is_owner = 0;
      $('#e_divOwner').show();
    }
  });

  //add vehicle info  TODO
  $('#frmSaveVehicleDetails').submit(function() {

    alert("TODO");

    if (!$('#is_owner').prop('checked')) {
      if ($('#o_name').val() == '') {
        toastr.warning('Please enter the Vehicle Registered Person Name !!');
        return false;
      }
    }

    let obj = {};
    let json = {};

    obj.Module = "Staff";
    obj.Page_key = "addVehicleInfo";

    json.StaffID = staff_id;
    json.VehicleTypeID = $('#vehicle_type').val();
    json.VehicleBrand = $('#brand').val();
    json.VehicleModel = $('#model').val();
    json.VehicleColor = $('#color').val();
    json.VehicleNumber = $('#number').val();
    json.IsVehicleOwner = is_owner;
    json.VehicleOwnerName = $('#o_name').val();

    obj.JSON = json;
    // TransportCall(obj);

    return false;
  });

  function editVehicleInfo(serial_number) {
    vehicle_details_id = $('#edit_btn' + serial_number).attr('data-vehicle_details_id');
    vehicle_type_id = $('#edit_btn' + serial_number).attr('data-vehicle_type_id');
    vehicle_brand = $('#edit_btn' + serial_number).attr('data-vehicle_brand');
    vehicle_model = $('#edit_btn' + serial_number).attr('data-vehicle_model');
    vehicle_color = $('#edit_btn' + serial_number).attr('data-vehicle_color');
    vehicle_number = $('#edit_btn' + serial_number).attr('data-vehicle_number');
    is_vehicle_owner = $('#edit_btn' + serial_number).attr('data-is_vehicle_owner');
    vehicle_owner_name = $('#edit_btn' + serial_number).attr('data-vehicle_owner_name');

    $('#e_vehicle_type').val(vehicle_type_id).trigger('change');
    $('#e_brand').val(vehicle_brand);
    $('#e_model').val(vehicle_model);
    $('#e_color').val(vehicle_color);
    $('#e_number').val(vehicle_number);
    if (is_vehicle_owner == '1') {
      $('.bootstrapToggle').prop('checked', true).change();
      $('#e_o_name').val('');
    } else {
      $('.bootstrapToggle').prop('checked', false).change();
      $('#e_o_name').val(vehicle_owner_name);
    }
  }
  $('#frmEditVehicleDetails').submit(function() 
  {
    if (!$('#e_is_owner').prop('checked')) {
      if ($('#e_o_name').val() == '') {
        toastr.warning('Please enter the Vehicle Registered Person Name !!');
        return false;
      }
    }

    var is_vehicle_number_changed;
    if ($('#e_number').val() == vehicle_number)
      is_vehicle_number_changed = 0;
    else
      is_vehicle_number_changed = 1;

      let obj = {};
    let json = {};

    obj.Module = "Staff";
    obj.Page_key = "editVehicleInfo";

    json.StaffID = staff_id;
    json.VehicleDetailsID = vehicle_details_id;
    json.VehicleTypeID = $('#e_vehicle_type').val();
    json.VehicleBrand = $('#e_brand').val();
    json.VehicleModel = $('#e_model').val();
    json.VehicleColor = $('#e_color').val();
    json.VehicleNumber = $('#e_number').val();
    json.IsVehicleNumberChanged = is_vehicle_number_changed;
    json.IsVehicleOwner = e_is_owner;
    json.VehicleOwnerName = $('#e_o_name').val();

    obj.JSON = json;
    TransportCall(obj);
    
    return false;
  });

  function onSuccess(rc) 
  {
    if (rc.return_code) 
    {
      switch (rc.Page_key) 
      {
        case "getStaffProfileData":
          console.log(rc.return_data);
          has_right = rc.return_data['has_right'];
          personal_data = rc.return_data['personal_data'];
          gender_list = rc.return_data['gender_list'];
          religion_list = rc.return_data['religion_list'];
          caste_list = rc.return_data['caste_list'];
          community_list = rc.return_data['community_list'];
          nationality_list = rc.return_data['nationality_list'];
          designation_list = rc.return_data['designation_list'];
          department_list = rc.return_data['department_list'];
          bloodgroups_list = rc.return_data['bloodgroups_list'];
          work_data = rc.return_data['work_data'];
          iebody_data = rc.return_data['iebody_data'];
          vehicle_data = rc.return_data['vehicle_data'];
          qualificationtype_list = rc.return_data['qualificationtype_list'];
          board_list = rc.return_data['board_list'];
          qualification_data = rc.return_data['qualification_data'];
          relationtype_list = rc.return_data['relationtype_list'];
          classsection_list = rc.return_data['classsection_list'];
          staff_list = rc.return_data['staff_list'];
          student_list = rc.return_data['student_list'];
          familyrelative_data = rc.return_data['familyrelative_data'];

          fnHandleEdit();

          /* Loading PERSONAL DATA section starts here */
          if(personal_data.length>0)
          {
            if (personal_data[0]["Photo"] != null && personal_data[0]["Photo"] != '') {
              $('#v_photo').prop('src', "file?type=passportphoto&name=" + personal_data[0]["Photo"]);
              $('#e_photo').addClass('dropify');
              $('#e_photo').attr('data-default-file', "file?type=passportphoto&name=" + personal_data[0]["Photo"]);
              $('#e_photo').dropify();
            }
            else{
              $('#e_photo').addClass('dropify');
              $('#e_photo').dropify();
            }

            if (personal_data[0]["StaffName"] != null && personal_data[0]["StaffName"] != '') {
              $('#v_name').prop('innerHTML', personal_data[0]["StaffName"]);
              $('#e_name').val(personal_data[0]["StaffName"]);
              document.title=personal_data[0]["StaffName"] + " Profile";
            }
            if (personal_data[0]["DesignationName"] != null && personal_data[0]["DesignationName"] != '') {
              $('#v_designation').prop('innerHTML', personal_data[0]["DesignationName"]);
              if (designation_list) {
                element = $('#e_designation');
                element.find('option').remove();
                element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
                designation_list.forEach(populateData);
              }
            }
            if (personal_data[0]["DepartmentName"] != null && personal_data[0]["DepartmentName"] != '') { 
                $('#v_department').prop('innerHTML', personal_data[0]["DepartmentName"]);
                  

              if (department_list) {
                element = $('#e_department');
                element.find('option').remove();
                element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
                department_list.forEach(populateData);
              }
            }
            if (personal_data[0]["ContactNo"] != null && personal_data[0]["ContactNo"] != '') {
              $('#v_contactno').prop('innerHTML', personal_data[0]["ContactNo"]);
              $('#e_contactno').val(personal_data[0]["ContactNo"]);
            }
            if (personal_data[0]["EmailID"] != null && personal_data[0]["EmailID"] != '') {
              $('#v_emailid').prop('innerHTML', personal_data[0]["EmailID"]);
              $('#e_emailid').val(personal_data[0]["EmailID"]);
            }
            if (personal_data[0]["JoinedDate0"] != null && personal_data[0]["JoinedDate0"] != '') {
              $('#v_doj').prop('innerHTML', personal_data[0]["JoinedDate0"]);
             
              
              $('#e_doj').val(personal_data[0]["JoinedDate"]);
              // $('#e_doj').val(personal_data[0]["JoinedDate1"]);
            }
            if (personal_data[0]["DOB0"] != null && personal_data[0]["DOB0"] != '') {
              $('#v_dob').prop('innerHTML', personal_data[0]["DOB0"]);
              
              $('#e_dob').val(personal_data[0]["DOB"]).trigger('change');
              // $('#e_dob').val(personal_data[0]["DOB1"]).trigger('change');
            }
            if (personal_data[0]["YearOfExperience"] != null && personal_data[0]["YearOfExperience"] != '') {
              $('#v_yoe').prop('innerHTML', personal_data[0]["YearOfExperience"]);
            }
            if (personal_data[0]["BloodGroup"] != null && personal_data[0]["BloodGroup"] != '') {
              $('#v_bloodgroup').prop('innerHTML', personal_data[0]["BloodGroup"]);
              if (bloodgroups_list) {
                element = $('#e_bloodgroup');
                element.find('option').remove();
                element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
                bloodgroups_list.forEach(populateData);
              }
            }
            if (personal_data[0]["Age"] != null && personal_data[0]["Age"] != '') {
              $('#v_age').prop('innerHTML', personal_data[0]["Age"]);
            }
            if (personal_data[0]["Gender"] != null && personal_data[0]["Gender"] != '') {
              $('#v_gender').prop('innerHTML', personal_data[0]["Gender"]);
              if (gender_list) {
                element = $('#e_gender');
                element.find('option').remove();
                element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
                gender_list.forEach(populateData);
              }
            }
            if (personal_data[0]["Religion"] != null && personal_data[0]["Religion"] != '') {
              $('#v_religion').prop('innerHTML', personal_data[0]["Religion"]);
              if (religion_list) {
                element = $('#e_religion');
                element.find('option').remove();
                element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
                religion_list.forEach(populateData);
              }
            }
            if (personal_data[0]["Caste"] != null && personal_data[0]["Caste"] != '') {
              $('#v_caste').prop('innerHTML', personal_data[0]["Caste"]);
              if (caste_list) {
                element = $('#e_caste');
                element.find('option').remove();
                element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
                caste_list.forEach(populateData);
              }
            }
            if (personal_data[0]["CommunityName"] != null && personal_data[0]["CommunityName"] != '') {
              $('#v_community').prop('innerHTML', personal_data[0]["CommunityName"]);
              if (community_list) {
                element = $('#e_community');
                element.find('option').remove();
                element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
                community_list.forEach(populateData);
              }
            }
            if (personal_data[0]["NationalityName"] != null && personal_data[0]["NationalityName"] != '') {
              $('#v_nationality').prop('innerHTML', personal_data[0]["NationalityName"]);
              if (nationality_list) {
                element = $('#e_nationality');
                element.find('option').remove();
                element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
                nationality_list.forEach(populateData);
              }
            }
            if (personal_data[0]["Address"] != null && personal_data[0]["Address"] != '') {
              $('#v_address').prop('innerHTML', personal_data[0]["Address"]);
              $('#e_address').val(personal_data[0]["Address"]);
            }
          }
          else{
            notify('error', 'Personal Data not found !!');
          }
          /* Loading PERSONAL DATA section ends here */

          /* Loading QUALIFICATION HISTORY section starts here */
          var div_education = '';
          if (qualification_data.length > 0) {
            $('#div_education_section').removeClass('no-media');

            qualification_data.forEach(function(item_education) {
              var board_university = institute = spc = '';
              var div_bi = '';
              var division = '-';
              var percentage = 0;

              if (item_education['YearOfPassing'] != null && item_education['YearOfPassing'] != '') {
                div_education += '<li>';
                div_education += '<div class="row">';

                div_education += '<div class="col-sm-5" style="display:flex;align-items:center;">';
                div_education += '<div>';

                if (item_education["Specialisation"] != null && item_education["Specialisation"] != '') {
                  spc = ' <em>(' + item_education["Specialisation"] + ')</em>';
                }

                div_education += '<h5>' + item_education["YearOfPassing"] + ' &mdash; ' + item_education["Qualification"] + spc + '</h5>';

                if (item_education["BoardName"] != null && item_education["BoardName"] != '') {
                  board_university = item_education["BoardName"];
                }
                if (item_education["InstituteName"] != null && item_education["InstituteName"] != '') {
                  institute = item_education["InstituteName"];
                }

                if (board_university != '' && institute != '') {
                  div_bi = institute + ' &mdash; ' + board_university;

                  div_education += '<span>';
                  div_education += '<i class="fas fa-md fa-building mr-1"></i>';
                  div_education += '<span>' + div_bi + '</span>';
                  div_education += '</span>';
                } else if (board_university == '' && institute != '') {
                  div_bi = institute;

                  div_education += '<span>';
                  div_education += '<i class="fas fa-md fa-building mr-1"></i>';
                  div_education += '<span>' + div_bi + '</span>';
                  div_education += '</span>';
                } else if (board_university != '' && institute == '') {
                  div_bi = board_university;

                  div_education += '<span>';
                  div_education += '<i class="fas fa-md fa-building mr-1"></i>';
                  div_education += '<span>' + div_bi + '</span>';
                  div_education += '</span>';
                } else {

                }

                div_education += '</div>';
                div_education += '</div>';

                if (item_education["Percentage"] != null && item_education["Percentage"] != '') {
                  percentage = Math.round(item_education['Percentage']);

                  if (percentage >= 60) {
                    division = 'FIRST DIVISION';
                  } else if (percentage >= 45 && percentage < 60) {
                    division = 'SECOND DIVISION';
                  } else if (percentage < 45) {
                    division = 'THIRD DIVISION';
                  } else {
                    division = '-';
                  }
                }
                if (item_education["QualificationTypeID"] != 8) {
                  div_education += '<div class="col-sm-3" style="display:flex; align-items:center;">';
                  div_education += '<h6 class="text-danger text-lg">' + division + '</h6>';
                  div_education += '</div>';
                } else {
                  div_education += '<div class="col-sm-3" style="display:flex; align-items:center;">';
                  div_education += '</div>';
                }

                div_education += '<div class="col-sm-1" style="display:flex; justify-content:center; align-items:center;">';
                if (item_education["DocumentLink"] != null && item_education["DocumentLink"] != '') {

                  div_education += '<div>';
                  div_education += '<a class="text-xl text-danger" href=' + item_education["DocumentLink"] + ' target="_blank" title="VIEW DOCUMENT"><i class="fas fa-file-alt"></i></a>';
                  div_education += '</div>';
                }
                div_education += '</div>';

                if (item_education["QualificationTypeID"] != 8) {
                  div_education += '<div class="col-sm-2" style="display:flex; justify-content:center; align-items:center;">';
                  div_education += '<div>';
                  div_education += '<input type="text" value="' + percentage + '" class="Chart" data-fgcolor="#red" id="q_percentage" />';
                  div_education += '</div>';
                  div_education += '</div>';
                } else {
                  div_education += '<div class="col-sm-2" style="display:flex; justify-content:center; align-items:center;">';
                  div_education += '</div>';
                }
                div_education += '<div class="col-sm-1" style="display:flex; justify-content:center; align-items:center;">';
                div_education += '<div>';
                div_education += '<button class="btn btn-default btn-block text-danger btnCustom1" data-toggle="modal" data-target="#mdlEditEducation" title="EDIT" data-qd_id="' + item_education['QualificationDetailID'] + '" data-qt="' + item_education['QualificationTypeID'] + '" data-yop="' + item_education['YearOfPassing'] + '" data-bu="' + item_education['BoardUniversityID'] + '" data-in="' + item_education['InstituteName'] + '" data-pg="' + item_education['Percentage'] + '" data-spc="' + item_education['Specialisation'] + '" data-doc_link="' + item_education['DocumentLink'] + '"><i class="fas fa-edit"></i></button>';
                div_education += '</div>';
                div_education += '</div>';


                div_education += '</div>';
                div_education += '</li>';
              }
            });

            $('#div_education').empty();
            $('#div_education').append(div_education);

            $('.Chart').attr('data-width', knobWidthHeight).attr('data-height', knobWidthHeight);
            $(".Chart").knob({
              readOnly: true,
              fgColor: "#f5365c",
              bgColor: "#ececec",
              thickness: 0.2,
              'draw': function() {
                $(this.i).css('font-size', '1.5rem');
              }
            });
          } else {
            $('#div_education_section').addClass('no-media');

            div_education += '<div class="error-page">';
            div_education += '<div class="error-content">';
            div_education += '<h3><i class="fas fa-exclamation-triangle text-danger mr-1"></i>Education Details not found !!</h3>';
            div_education += '</div>';
            div_education += '</div>';

            $('#div_education').empty();
            $('#div_education').append(div_education);
          }
          if (qualificationtype_list) {
            element = $('#a_qt');
            element.find('option').remove();
            element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
            qualificationtype_list.forEach(populateData);

            element = $('#e_qt');
            element.find('option').remove();
            element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
            qualificationtype_list.forEach(populateData);
          }

          if (board_list) {
            element = $('#a_bu');
            element.find('option').remove();
            element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
            board_list.forEach(populateData);

            element = $('#e_bu');
            element.find('option').remove();
            element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
            board_list.forEach(populateData);
          }
          /* Loading QUALIFICATION HISTORY section ends here */

          /* Loading INTERNAL/EXTERNAL BODY DETAILS section starts here */
          var div_iebody = '';
          var eb_len = iebody_data.length;
          if (eb_len > 0)
          {
            $('#div_iebd_section').removeClass('no-media');
            for(var i=0; i<eb_len; i++)
            {
              div_iebody += '<div class="row">';
              if(iebody_data[i]['Type']=='1')
              {
                if (iebody_data[i]['Status'] == '0') 
                {
                  div_iebody += '<div class="col-11"><strong class="badge badge-secondary mr-2" style="font-weight:500; font-size:small !important; text-transform:uppercase;">internal</strong><span>'+iebody_data[i]['Title']+' &mdash; <strong class="text-muted">'+iebody_data[i]['Role']+'</strong> <span class="float-sm-right" style="font-style:italic; font-size:small; font-weight:bold;">(Date: '+iebody_data[i]['StartDate1']+' - '+iebody_data[i]['EndDate1']+')</span></span></div>';
                }
                else {
                  div_iebody += '<div class="col-11"><strong class="badge badge-secondary mr-2" style="font-weight:500; font-size:small !important; text-transform:uppercase;">internal</strong><span>'+iebody_data[i]['Title']+' &mdash; <strong class="text-muted">'+iebody_data[i]['Role']+'</strong> <span class="float-sm-right" style="font-style:italic; font-size:small; font-weight:bold;">(Date: '+iebody_data[i]['StartDate1']+' - Present)</span></span></div>';
                }
              }
              else {
                if (iebody_data[i]['Status'] == '0') 
                {
                  div_iebody += '<div class="col-11"><strong class="badge badge-secondary mr-2" style="font-weight:500; font-size:small !important; text-transform:uppercase;">external</strong><span>'+iebody_data[i]['Title']+' &mdash; <strong class="text-muted">'+iebody_data[i]['Role']+'</strong> <span class="float-sm-right" style="font-style:italic; font-size:small; font-weight:bold;">(Date: '+iebody_data[i]['StartDate1']+' - '+iebody_data[i]['EndDate1']+')</span></span></div>';
                }
                else {
                  div_iebody += '<div class="col-11"><strong class="badge badge-secondary mr-2" style="font-weight:500; font-size:small !important; text-transform:uppercase;">external</strong><span>'+iebody_data[i]['Title']+' &mdash; <strong class="text-muted">'+iebody_data[i]['Role']+'</strong> <span class="float-sm-right" style="font-style:italic; font-size:small; font-weight:bold;">(Date: '+iebody_data[i]['StartDate1']+' - Present)</span></span></div>';
                }
              }
              div_iebody += '<div class="col-1"><button class="btn btn-default text-danger no-media btnCustom1 float-sm-right" data-toggle="modal" data-target="#mdlEditIEBodyDetails" title="EDIT" data-id="'+iebody_data[i]['ID']+'" data-type="'+iebody_data[i]['Type']+'" data-title="'+iebody_data[i]['Title']+'" data-role="'+iebody_data[i]['Role']+'" data-sdate="'+iebody_data[i]['StartDate']+'" data-edate="'+iebody_data[i]['EndDate']+'" data-status="'+iebody_data[i]['Status']+'"><i class="fas fa-edit"></i></button></div>';

              div_iebody += '</div>'+((i+1)==eb_len?'':'<hr>');
            }

            $('#div_iebody').empty();
            $('#div_iebody').append(div_iebody);
          }
          else {
            $('#div_iebd_section').addClass('no-media');

            div_iebody += '<div class="error-page">';
            div_iebody += '<div class="error-content">';
            div_iebody += '<h3><i class="fas fa-exclamation-triangle text-teal mr-1"></i>Internal/External Body Details not found !!</h3>';
            div_iebody += '</div>';
            div_iebody += '</div>';
          }
            
          $('#div_iebody').empty();
          $('#div_iebody').append(div_iebody);
          /* Loading INTERNAL/EXTERNAL BODY DETAILS section ends here */

          /* Loading MY FAMILY MEMBERS section starts here */
          /* MY FAMILY MEMBERS section starts here */
          var div_family = '';

          if (familyrelative_data.length > 0) {
            $('#div_family_section').removeClass('no-media');

            familyrelative_data.forEach(function(item) {
              var work = '';
              if ((item['OrganisationName'] != null && item['OrganisationName'] != '') && (item['Designation'] != null && item['Designation'] != ''))
                work = 'Working at ' + item['OrganisationName'] + ' as ' + item['Designation'];
              else if ((item['OrganisationName'] == null || item['OrganisationName'] == '') && (item['Designation'] != null && item['Designation'] != ''))
                work = 'Working as ' + item['Designation'];
              else if ((item['Designation'] == null || item['Designation'] == '') && (item['OrganisationName'] != null && item['OrganisationName'] != ''))
                work = 'Working at ' + item['OrganisationName'];
              else if ((item['Designation'] == null || item['Designation'] == '') && (item['OrganisationName'] == null || item['OrganisationName'] == ''))
                work = '';

              div_family += '<div class="col-lg-4 col-md-4 col-sm-12">';
              if (item['IsGuardian'] == '1')
                div_family += '<div class="info-box" style="background-color:#fff1f1;">';
              else
                div_family += '<div class="info-box bg-light">';
              div_family += '<div class="info-box-content">';
              div_family += '<ul class="fa-ul text-muted" style="margin-bottom:0; margin-left:1.6rem; padding:0.5rem;">';
              div_family += '<li class="large">';
              div_family += '<span class="fa-li"><i class="fas fa-user-tie"></i></span>';
              if (item['IsGuardian'] == '1')
                div_family += '<strong>' + item['Name'] + ' (Guardian)</strong>';
              else
                div_family += '<strong>' + item['Name'] + '</strong>';
              div_family += '</li>';
              if (item['ContactNumber'] != null && item['ContactNumber'] != '') {
                div_family += '<li class="large">';
                div_family += '<span class="fa-li"><i class="fas fa-sm fa-phone"></i></span>';
                div_family += '<span>' + item['ContactNumber'] + '</span>';
                div_family += '</li>';
              }
              if (work != '') {
                div_family += '<li class="large">';
                div_family += '<span class="fa-li"><i class="fas fa-briefcase"></i></span>';
                div_family += '<span>' + work + '</span>';
                div_family += '</li>';
              }
              div_family += '</ul>';
              div_family += '<a onclick="editFamilyMember(' + item['RelationID'] + ')" data-toggle="modal" data-target="#mdlFamilyMember" style="display:none;" class="btn btn-default text-danger btnCustom btnEdit no-media" title="EDIT"><i class="fas fa-edit"></i></a>';
              div_family += '<span class="info-box-icon bg-danger">' + item['RelationTitle'] + '</span>';
              div_family += '</div>';
              div_family += '</div>';
              div_family += '</div>';
            });
          } else {
            $('#div_family_section').addClass('no-media');

            div_family += '<div class="error-page">';
            div_family += '<div class="error-content">';
            div_family += '<h3><i class="fas fa-exclamation-triangle text-danger mr-1"></i>Family Members not found !!</h3>';
            div_family += '</div>';
            div_family += '</div>';
          }
          $('#div_family').empty();
          $('#div_family').append(div_family);
          /* MY FAMILY MEMBERS section ends here */

          if (relationtype_list) {
            element = $('#relation_type');
            element.find('option').remove();
            element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
            relationtype_list.forEach(populateData);
          }
          if (classsection_list) {
            element = $('#passout_cls');
            element.find('option').remove();
            element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('-Select-'));
            classsection_list.forEach(populateData);

            element = $('#std_cls');
            element.find('option').remove();
            element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('All'));
            classsection_list.forEach(populateData);
          }
          if (department_list) {
            element = $('#stf_dept');
            element.find('option').remove();
            element.append($('<option></option>').attr('value', '').prop('selected', 'selected').text('All'));
            department_list.forEach(function(item){
              element.append($("<option></option>")
                .attr("value", item['Value'])
                .text(item['Text'])
              );
            });
          }
          populateFacultyList(0);
          // populateStudentList(0);
          /* Loading MY FAMILY MEMBERS section ends here */

          /* Loading WORK DETAILS section starts here */
          var div_workdetails = '';
          var eb_len = work_data.length;
          if (eb_len > 0)
          {
            $('#div_work_section').removeClass('no-media');
            for(var i=0; i<eb_len; i++)
            {
              div_workdetails += '<div class="row">';
              if (work_data[i]['Status'] == '0') 
              {
                div_workdetails += '<div class="col-11"><strong class="lead" style="font-weight:500; font-size:medium; text-transform:uppercase;">'+work_data[i]['Organisation']+'</strong><span> &mdash; '+work_data[i]['Designation']+' <span class="float-sm-right" style="font-style:italic; font-size:small; font-weight:bold;">(Date: '+work_data[i]['StartDate1']+' - '+work_data[i]['EndDate1']+')</span></span></div>';
              }
              else {
                div_workdetails += '<div class="col-11"><strong class="lead" style="font-weight:500; font-size:medium; text-transform:uppercase;">'+work_data[i]['Organisation']+'</strong><span> &mdash; '+work_data[i]['Designation']+' <span class="float-sm-right" style="font-style:italic; font-size:small; font-weight:bold;">(Date: '+work_data[i]['StartDate1']+' - Present)</span></span></div>';
              }
              div_workdetails += '<div class="col-1"><button class="btn btn-default text-danger no-media btnCustom1 float-sm-right" data-toggle="modal" data-target="#mdlEditWorkDetails" title="EDIT" data-id="'+work_data[i]['WorkDetailID']+'" data-org="'+work_data[i]['Organisation']+'" data-dsg="'+work_data[i]['Designation']+'" data-sdate="'+work_data[i]['StartDate']+'" data-edate="'+work_data[i]['EndDate']+'" data-status="'+work_data[i]['Status']+'"><i class="fas fa-edit"></i></button></div>';
              div_workdetails += '</div>'+((i+1)==eb_len?'':'<hr>');
            }

            $('#div_workdetails').empty();
            $('#div_workdetails').append(div_workdetails);
          }
          else {
            $('#div_work_section').addClass('no-media');

            div_workdetails += '<div class="error-page">';
            div_workdetails += '<div class="error-content">';
            div_workdetails += '<h3><i class="fas fa-exclamation-triangle text-danger mr-1"></i>Work Details not found !!</h3>';
            div_workdetails += '</div>';
            div_workdetails += '</div>';
          }
            
          $('#div_workdetails').empty();
          $('#div_workdetails').append(div_workdetails);
          /* Loading WORK DETAILS section ends here */

          /* Loading MY VEHICLE(s) section starts here */
          var div_vehicle = '';
          var vehicle_owner = '';
          var serial_number;
          var action = '';

          if (vehicle_data.length > 0) {
            serial_number = 1;
            $('#div_vehicle_section').removeClass('no-media');

            vehicle_data.forEach(function(item) 
            {
              if (item['IsVehicleOwner'] == '1')
                vehicle_owner = 'Self';
              else
                vehicle_owner = item['VehicleOwnerName'];

              div_vehicle += '<div class="col-sm-6 col-md-6 col-lg-4">';
              div_vehicle += '<div class="small-box bg-danger">';
              div_vehicle += '<a id="edit_btn' + serial_number + '" onclick="editVehicleInfo(' + serial_number + ')" data-toggle="modal" data-target="#mdlEditVehicleInfo" data-vehicle_details_id="' + item['VehicleDetailsID'] + '" data-vehicle_type_id="' + item['VehicleTypeID'] + '" data-vehicle_brand="' + item['VehicleBrand'] + '" data-vehicle_model="' + item['VehicleModel'] + '" data-vehicle_color="' + item['VehicleColor'] + '" data-vehicle_number="' + item['VehicleNumber'] + '" data-is_vehicle_owner="' + item['IsVehicleOwner'] + '" data-vehicle_owner_name="' + item['VehicleOwnerName'] + '" class="btn btn-outline-dark btnCustom1 btnEdit no-media" title="UPDATE"><i class="fas fa-edit"></i></a>';
              div_vehicle += '<div class="inner">';
              div_vehicle += '<h2>' + item['VehicleNumber'] + '</h2>';
              div_vehicle += '<h5>' + item['VehicleBrand'] + ' - ' + item['VehicleModel'] + ' (' + item['VehicleColor'] + ')</h5>';
              div_vehicle += '</div>';
              if (item['VehicleTypeID'] == '1')
                div_vehicle += '<div class="icon"><i class="fas fa-car"></i></div>';
              else
                div_vehicle += '<div class="icon"><i class="fas fa-motorcycle"></i></div>';
              div_vehicle += '<a class="small-box-footer"><em>Registered on ' + vehicle_owner + ' Name</em></a>';
              div_vehicle += '</div>';
              div_vehicle += '</div>';
              serial_number++;
            });
          } else {
            $('#div_vehicle_section').addClass('no-media');

            div_vehicle += '<div class="error-page">';
            div_vehicle += '<div class="error-content">';
            div_vehicle += '<h3><i class="fas fa-exclamation-triangle text-danger mr-1"></i>Vehicle Info not found !!</h3>';
            div_vehicle += '</div>';
            div_vehicle += '</div>';
          }

          $('#div_vehicle').empty();
          $('#div_vehicle').append(div_vehicle);
          /* Loading MY VEHICLE(s) section ends here */

          break;
        case 'addStaffEducationInformation':
          notify('success', 'Added successfully !!');
          $("#mdlAddEducation").modal("hide");
          onResetAddEducation();
          getStaffProfileData();
          break;
        case 'saveStaffPhoto':
          notify('success', 'Saved successfully !!');
          $("#mdlSavePhoto").modal("hide");
          //getStaffProfileData();
          location.reload();
          break;
        case 'editStaffEducationInformation':
          notify('success', 'Edited successfully !!');
          $("#mdlEditEducation").modal("hide");
          onResetEditEducation();
          getStaffProfileData();
          break;
        case 'editStaffPersonalDetails':
          notify('success', 'Edited successfully !!');
          $("#mdlEditProfile").modal("hide");
          getStaffProfileData();
          break;
        case 'addStaffInternalExternalDetails':
          notify('success', 'Added successfully !!');
          $("#mdlAddIEBodyDetails").modal("toggle");
          onResetAddIEBodyDetails();
          getStaffProfileData();
          break;
        case 'editStaffInternalExternalDetails':
          notify('success', 'Edited successfully !!');
          $("#mdlEditIEBodyDetails").modal("toggle");
          onResetEditIEBodyDetails();
          getStaffProfileData();
          break;
        case 'addStaffFamilyRelativeOutsider':
        case 'addStaffFamilyRelativeStaffStudent':
          notify('success', 'Added successfully !!');
          $("#mdlFamilyMember").modal("hide");
          onResetFamilyMemberForm();
          getStaffProfileData();
          break;
        case 'addStaffWorkDetails':
          notify('success', 'Added successfully !!');
          $("#mdlAddWorkDetails").modal("hide");
          onResetAddWorkDetails();
          getStaffProfileData();
          break;
        case 'editStaffWorkDetails':
          notify('success', 'Edited successfully !!');
          $("#mdlEditWorkDetails").modal("hide");
          onResetEditWorkDetails();
          getStaffProfileData();
          break;
        case 'addVehicleInfo':
          notify('success', 'Added successfully !!');
          $("#mdlAddVehicleInfo").modal("hide");
          onResetAddVehicleInfo();
          getStaffProfileData();
          break;
        case 'editVehicleInfo':
          notify('success', 'Edited successfully !!');
          $("#mdlEditVehicleInfo").modal("hide");
          getStaffProfileData();
          break;
        case "updateStaff":
          notify('success', rc.return_data);
          break;

        default:
          notify('error', rc.Page_key);
      }
    } 
    else {
      notify('error', rc.return_data);
    }
  }

  function onError(rc){
    notify('info', rc.return_data);
  }

</script>

<script>
  var department_list, faculty_list, is_stf_dept_changed;
  var mphotochanged = false;
  var personalinfo;
  var gender, session, semester, department, programmegroup, std_cls, shift, country, religion, caste, community, occupation, state, district;

  var mobile, email;
  var relation_id;

  function fnViewDocument(link) {
    window.open(link, '_blank');
  }

  function editFamilyMember(id) {
    relation_id = id;

    $('#ttlFamilyMember').prop('innerHTML', 'Edit Family Member / Relative');

    var idx = '';
    for (var i = 0; i < family_data.length; i++) {
      if (family_data[i]['RelationID'] == relation_id) {
        idx = i;
      }
    }

    if (family_data[idx]['IsCollegeStudentStaff'] == '1') {
      $('#stf_dept option[value="' + family_data[idx]['DepartmentProgrammeID'] + '"]').prop('selected', true).trigger('change');
      $('#stf_name option[value="' + family_data[idx]['StudentStaffID'] + '"]').prop('selected', true).trigger('change');

      $('#relative_origin option[value="1"]').prop('selected', true).trigger('change');

    } else if (family_data[idx]['IsCollegeStudentStaff'] == '2') {
      $('#std_cls option[value="' + family_data[idx]['DepartmentProgrammeID'] + '"]').prop('selected', true).trigger('change');
      $('#std_name option[value="' + family_data[idx]['StudentStaffID'] + '"]').prop('selected', true).trigger('change');

      $('#relative_origin option[value="2"]').prop('selected', true).trigger('change');
    } else {
      $('#fm_name').val(family_data[idx]['Name'] == null ? '' : family_data[idx]['Name']);
      $('#contact_number').val(family_data[idx]['ContactNumber'] == null ? '' : family_data[idx]['ContactNumber']);
      if (family_data[idx]['IsWorking'] == '1') {
        $('#is_working').prop('checked', true).trigger('change');
        $('#org_name').val(family_data[idx]['OrganisationName'] == null ? '' : family_data[idx]['OrganisationName']);
        $('#org_address').val(family_data[idx]['OrganisationAddress'] == null ? '' : family_data[idx]['OrganisationAddress']);
        $('#designation').val(family_data[idx]['Designation'] == null ? '' : family_data[idx]['Designation']);
      } else {
        $('#is_working').prop('checked', false).trigger('change');
        $('#org_name').val('');
        $('#org_address').val('');
        $('#designation').val('');
      }

      $('#relative_origin option[value="0"]').prop('selected', true).trigger('change');
    }

    $('#relation_type option[value="' + family_data[idx]['RelationTypeID'] + '"]').prop('selected', true).trigger('change');
    $('#relation_type').prop('disabled', true);
    if (family_data[idx]['IsStayingTogether'] == '1') {
      $('#is_staying_together').prop('checked', true).trigger('change');
      $('#address').val('');
    } else {
      $('#is_staying_together').prop('checked', false).trigger('change');
      $('#address').val(family_data[idx]['Address'] == null ? '' : family_data[idx]['Address']);
    }
    if (family_data[idx]['IsAlumni'] == '1') {
      $('#is_school_passout').prop('checked', true).trigger('change');
      $('#pass_year option[value="' + family_data[idx]['PassOutYear'] + '"]').prop('selected', true).trigger('change');
      $('#passout_cls option[value="' + family_data[idx]['AlumniDepartmentID'] + '"]').prop('selected', true).trigger('change');
    } else {
      $('#is_school_passout').prop('checked', false).trigger('change');
    }
  }


  
  

</script>