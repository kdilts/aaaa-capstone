<div class="container">
 <div class="row">
  <div class="col-md-12">

<form #quickProspectForm="ngForm" name="quickProspectForm" id="quickProspectForm" class="form-horizontal well"  (ngSubmit)="createProspect();" novalidate>

 <div class="form-group">
  <label for="inputName" class="col-sm-2 control-label">Name</label>
  <div class="col-sm-10">
   <input type="text" class="form-control" id="inputName" name="inputName"  placeholder="Enter Name" [(ngModel)]="prospect.name" #prospectName="ngModel" >
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
  <div class="col-sm-offset-2 col-sm-10">
   <button type="submit" class="btn btn-default">Enter</button>
  </div>
 </div>

</form>

</div>
 </div>
</div>
