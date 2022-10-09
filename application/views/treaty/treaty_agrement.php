<?php $this->load->view('includes/header', $this->data);?>

<div class="br-section-wrapper">
    <div class="bg-gray-100 bd pd-x-20 pd-t-20-force pd-b-10-force">
      <div class="row">
        <div class="col-lg-3">
          <div class="form-group form-validate mg-b-10-force">
            <label class="form-control-label">Policy #</label>
            <input class="form-control" type="text" name="" value="" placeholder="">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group form-validate mg-b-10-force">
            <label class="form-control-label">Ceding Company Name :</label>
            <input class="form-control" type="text" name="" value="" placeholder="">
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group form-validate mg-b-10-force">
            <label class="form-control-label">Type Of Business </label>
            <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
              <option>Marine</option>
              <option>Fire</option>
              <option>Accident</option>
            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 279px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-vtz7-container"><span class="select2-selection__rendered" id="select2-vtz7-container" title="Marine">Marine</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="pd-t-30-force">
            <button class="btn btn-dark tx-12 tx-uppercase tx-spacing-2">Search</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="br-section-wrapper mg-t-20">
    <h3>General</h3>
    <div class="row mg-b-25">
      <div class="col-lg-4">
        <div class="form-group form-validate">
          <label class="form-control-label">Agr. Code <span class="tx-danger">*</span></label>
          <select class="form-control select2 select2-hidden-accessible" data-placeholder="Choose Option" tabindex="-1" aria-hidden="true">
            <option label="Choose Option"></option>
            <option value="Option">ADJ/2020/HO/0001</option>
            <option value="Option">JUB/2020/NZO/0002</option>
            <option value="Option">EFU/2020/HO/0003</option>
            <option value="Option">CRS/2020/HO/0004</option>
          </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 396px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-2uwa-container"><span class="select2-selection__rendered" id="select2-2uwa-container"><span class="select2-selection__placeholder">Choose Option</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group form-validate">
          <label class="form-control-label">Agreement Date</label>
          <div class="input-group"> <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
            <input type="text" class="form-control fc-datepicker hasDatepicker" placeholder="MM/DD/YYYY" id="dp1581054448223">
          </div>
        </div>
      </div>
      <!-- col-4 -->
      <div class="col-lg-4">
        <div class="form-group form-validate">
          <label class="form-control-label">Fresh/Renewal <span class="tx-danger">*</span></label>
          <select class="form-control select2 select2-hidden-accessible" data-placeholder="Choose Option" tabindex="-1" aria-hidden="true">
            <option label="Choose Option"></option>
            <option value="Option">Fresh</option>
            <option value="Option">Renewal</option>
          </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 396px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-stn0-container"><span class="select2-selection__rendered" id="select2-stn0-container"><span class="select2-selection__placeholder">Choose Option</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group form-validate">
          <label class="form-control-label">Cedent Name <span class="tx-danger">*</span></label>
          <select class="form-control select2 select2-hidden-accessible" data-placeholder="Choose Option" tabindex="-1" aria-hidden="true">
            <option label="Choose Option"></option>
            <option value="Option">Atlas Insurance</option>
            <option value="Option">Adam Jee Insurance</option>
            <option value="Option">New Jubilee Insurance</option>
            <option value="Option">EFU Insurance</option>
          </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 396px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-l1sj-container"><span class="select2-selection__rendered" id="select2-l1sj-container"><span class="select2-selection__placeholder">Choose Option</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group form-validate">
          <label class="form-control-label">Meeting Date</label>
          <div class="input-group"> <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
            <input type="text" class="form-control fc-datepicker hasDatepicker" placeholder="MM/DD/YYYY" id="dp1581054448224">
          </div>
        </div>
      </div>
      <!-- col-4 -->
      <div class="col-lg-4">
        <div class="form-group form-validate mg-b-10-force">
          <label class="form-control-label">Meeting Point </label>
          <input class="form-control" type="text" name="address" value="User input" placeholder="">
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group form-validate mg-b-10-force">
          <label class="form-control-label">PRCL Officials </label>
          <input class="form-control" type="text" name="address" value="User input" placeholder="">
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group form-validate mg-b-10-force">
          <label class="form-control-label">Cedent Officials </label>
          <input class="form-control" type="text" name="address" value="User input" placeholder="">
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group form-validate">
          <label class="form-control-label">Treaty Type <span class="tx-danger">*</span></label>
          <select class="form-control select2 select2-hidden-accessible" data-placeholder="Choose Option" tabindex="-1" aria-hidden="true">
            <option label="Choose Option"></option>
            <option value="Option">Option 1</option>
            <option>Choose Treaty</option>
            <option>Fire 1st Surplus</option>
            <option>Marine Surplus</option>
            <option>Terrorism Quota Share</option>
            <option>---</option>
          </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 396px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-worh-container"><span class="select2-selection__rendered" id="select2-worh-container"><span class="select2-selection__placeholder">Choose Option</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
        </div>
      </div>
      <!-- col-4 -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group form-validate">
          <label class="control-label col-md-12 col-sm-12 col-xs-12" for="TenderNumber">User Remarks<span class="required" style="color:red">*</span> </label>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <input type="text" id="TenderNumber" name="TenderNumber" class="form-control col-md-12 col-xs-12">
          </div>
        </div>
      </div>
      <!-- Right -->
    </div>
    <!-- form-layout -->
  </div>


  <div class="br-section-wrapper mg-t-20">
    <h3>Import</h3>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">S #</th>
          <th scope="col">Type of Treaty</th>
          <th scope="col">PRCL Share Previous Year</th>
          <th scope="col">Proposed PRCL Share </th>
          <th scope="col">Approved PRCL Share </th>
          <th scope="col">Currency </th>
          <th scope="col">Accept</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Fire &amp; General Accident Q/S &amp; Surplus</td>
          <td>27.50%</td>
          <td>Discontinue</td>
          <td></td>
          <td></td>
          <td><input type="checkbox"></td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Marine &amp; Cargo Surplus</td>
          <td>27.50%</td>
          <td>50%</td>
          <td>35%</td>
          <td>PKR</td>
          <td><input type="checkbox"></td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Fire &amp; Engineering Risk and Cat XOL</td>
          <td>27.50%</td>
          <td>50%</td>
          <td>20%</td>
          <td>PKR</td>
          <td><input type="checkbox"></td>
        </tr>
      </tbody>
    </table>
  </div>

<?php $this->load->view('includes/footer', $this->data);?>