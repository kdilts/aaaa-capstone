<?php require_once(dirname(__DIR__) . "/php/partials/navbar.php"); ?>

<form class="form-horizontal">
 <div class="form-group">
  <label for="inputName" class="col-sm-2 control-label">Name</label>
  <div class="col-sm-10">
   <input type="text" class="form-control" id="inputName" placeholder="Enter Name">
  </div>
 </div>
 <div class="form-group">
  <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
  <div class="col-sm-10">
   <input type="tel" class="form-control" id="inputPhone" placeholder="Phone Number">
  </div>
 </div>
 <div class="form-group">
  <label for="inputEmail" class="col-sm-2 control-label">Email</label>
  <div class="col-sm-10">
   <input type="email" class="form-control" id="inputEmail" placeholder="Email">
  </div>
 </div>

 <div class="form-group">
 <label for="inputNote" class="col-sm-2 control-label">Notes</label>
  <textarea class="form-control" rows="5">Enter Notes</textarea>
 </div>

 <div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
   <div class="checkbox">
    <label>
     <input type="checkbox"> Remember me
    </label>
   </div>
  </div>
 </div>
 <div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
   <button type="submit" class="btn btn-default">Sign in</button>
  </div>
 </div>
</form>
