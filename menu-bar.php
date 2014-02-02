<?php
//session_start();
//$USER_TYPE=$_SESSION['USER_TYPE'];
if(!isset($USER_TYPE)){
// default memnu to be removed once sesion is set.............
?>
<div class="large-3 medium-3 columns">
  	 <div class="panel">
          <div class="row">
               <div class="large-12 medium-12 columns">
                    <p><br>
               	     <a href="/epmas/jobs/create" style="width:100%" class="small radius button">Create New Job</a><br/>
                     <a href="/epmas/jobs/edit" style="width:100%" class="small radius button">Edit Job</a><br/>
                     <a href="/epmas/jobs/search" style="width:100%" class="small radius button">Search a Job</a><br/>
                     <a href="/epmas/leave/" style="width:100%" class="small radius button">Review Leave Application</a>            
                  </p>
			   </div>
          </div>
 	 </div>
</div>
<?php
}
else{
	if($USER_TYPE=="PA"){
?>
<div class="large-3 medium-3 columns">
  	 <div class="panel">
          <div class="row">
               <div class="large-12 medium-12 columns">
                    <p><br>
               	     <a href="/epmas/jobs/search" style="width:100%" class="small radius button">Search Job</a><br/>
                     <a href="/epmas/jobs/edit" style="width:100%" class="small radius button">Edit Job</a><br/>
                     <a href="/epmas/leave/open" style="width:100%" class="small radius button">Post Leave Request</a><br/>
                  </p>
			   </div>
          </div>
 	 </div>
</div>
<?php
	}
	else if($USER_TYPE=="TL"){
?>
<div class="large-3 medium-3 columns">
  	 <div class="panel">
          <div class="row">
               <div class="large-12 medium-12 columns">
                    <p><br>
               	     <a href="/epmas/jobs/search" style="width:100%" class="small radius button">Search Job</a><br/>
                     <a href="/epmas/jobs/edit" style="width:100%" class="small radius button">Edit Job</a><br/>
                     <a href="/epmas/leave/open" style="width:100%" class="small radius button">Post Leave Request</a><br/>
                     <a href="/epmas/leave/Approve" style="width:100%" class="small radius button">Approve Leave Request</a><br/>
                  </p>
			   </div>
          </div>
 	 </div>
</div>
<?php
	}
	else if($USER_TYPE=="MGR"){
?>
<div class="large-3 medium-3 columns">
  	 <div class="panel">
          <div class="row">
               <div class="large-12 medium-12 columns">
                    <p><br>
               	     <a href="/epmas/jobs/search" style="width:100%" class="small radius button">Search Job</a><br/>
               	     <a href="/epmas/jobs/search" style="width:100%" class="small radius button">Open new Job</a><br/>
                     <a href="/epmas/jobs/edit" style="width:100%" class="small radius button">Edit Job</a><br/>
                     <a href="/epmas/leave/Approve" style="width:100%" class="small radius button">Approve Leave Request</a><br/>
                  </p>
			   </div>
          </div>
 	 </div>
</div>
<?php
	}
}
?>