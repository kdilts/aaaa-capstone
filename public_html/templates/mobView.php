<div class="container">
 <div class="row">
  <div class="col-md-12">

<form #quickProspectForm="ngForm" name="quickProspectForm" id="quickProspectForm" class="form-horizontal well"  (ngSubmit)="createProspect();" novalidate>

 <div class="form-group">
  <label for="inputName" class="col-sm-2 control-label">Last Name</label>
  <div class="col-sm-10">
   <input type="text" class="form-control" id="inputName" name="inputName"  placeholder="Enter Name" [(ngModel)]="prospect.LastName" #prospectName="ngModel" >
  </div>
 </div>

	<div class="form-group">
		<label for="inputName" class="col-sm-2 control-label">First Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputName" name="inputName"  placeholder="Enter First Name" [(ngModel)]="prospect.FirstName" #prospectName="ngModel" >
		</div>
	</div>

 <div class="form-group">
  <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
  <div class="col-sm-10">
   <input type="tel" class="form-control" id="inputPhone" name="inputPhone" placeholder="Phone Number" [(ngModel)]="prospect.phone" #prospectPhone="ngModel">
  </div>
 </div>

 <div class="form-group">
  <label for="inputEmail" class="col-sm-2 control-label">Email</label>
  <div class="col-sm-10">
   <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" [(ngModel)]="prospect.email" #prospectEmail="ngModel">
  </div>
 </div>

	<div class="form-group">
		<label for="inputCohort" class="col-sm-2 control-label">Cohort</label>
		<div class="col-sm-10">
       <select>
        <option value="1">Cohort 1</option>
        <option value="2">Cohort 2</option>
        <option value="3">Cohort 3</option>
       </select>
<!--			<input type="text" class="form-control" id="inputCohort" name="inputCohort"  placeholder="Cohort" [(ngModel)]="prospect.cohort" #prospectName="ngModel" >-->
		</div>
	</div>


 <div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
   <button type="submit" class="btn btn-default">Enter</button>
  </div>
 </div>

</form>

</div>
 </div>
</div>
