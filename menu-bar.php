<?php
$USER_TYPE=$_GET['emp_design'];
if(!isset($USER_TYPE)){
?>
<div class="large-3 medium-3 columns">
  	 <div class="panel">
          <div class="row">
               <div class="large-12 medium-12 columns">
                    <p><br>
               	     <a href="/epmas/jobs/create" style="width:100%" class="small radius button">DEFAULT 1</a><br/>
                     <a href="/epmas/jobs/edit" style="width:100%" class="small radius button">DEFAULT 2</a><br/>
                     <a href="/epmas/jobs/search" style="width:100%" class="small radius button">DEFAULT 3</a><br/>
                     <a href="/epmas/leave/" style="width:100%" class="small radius button">DEFAULT 4</a>            
                  </p>
	       </div>
          </div>
 	 </div>
</div>
<?php
}
else{
	if($USER_TYPE=="P"){
?>
<div class="large-3 medium-3 columns">
  	 <div class="panel">
          <div class="row">
               <div class="large-12 medium-12 columns">
                    <p><br>
               	     <a onClick="buttonClicked('searchButton')" style="width:100%" class="small radius button">Search Job</a><br/>
                     <a onClick="buttonClicked('editButton')"   style="width:100%" class="small radius button">Edit Job</a><br/>
                     <a href="/epmas/leave/apply" style="width:100%" class="small radius button">Apply Leave Request</a><br/>
                  </p>
			   </div>
          </div>
 	 </div>
</div>
<?php
	}
	else if($USER_TYPE=="L"){
?>
<div class="large-3 medium-3 columns">
  	 <div class="panel">
          <div class="row">
               <div class="large-12 medium-12 columns">
                    <p><br>
               	     <a onClick="buttonClicked('searchButton')" style="width:100%" class="small radius button">Search Job</a><br/>
                     <a onClick="buttonClicked('editButton')"   style="width:100%" class="small radius button">Edit Job</a><br/>
                     <a href="/epmas/leave/open" style="width:100%" class="small radius button">Post Leave Request</a><br/>
                     <a href="/epmas/leave/apply" style="width:100%" class="small radius button">Apply Leave Request</a><br/>
                  </p>
			   </div>
          </div>
 	 </div>
</div>
<?php
	}
	else if($USER_TYPE=="M"){
?>
<div class="large-3 medium-3 columns">
  	 <div class="panel">
          <div class="row">
               <div class="large-12 medium-12 columns">
                    <p><br>
               	     <a onClick="buttonClicked('searchButton')" style="width:100%" class="small radius button">Search Job</a><br/>
               	     <a href="/epmas/jobs/create"               style="width:100%" class="small radius button">Open new Job</a><br/>
                     <a onClick="buttonClicked('editButton')"   style="width:100%" class="small radius button">Edit Job</a><br/>
                     <a href="/epmas/leave/approve"             style="width:100%" class="small radius button">Leave Adjudication</a><br/>
                  </p>
			   </div>
          </div>
 	 </div>
</div>
<?php
	}
}
?>
