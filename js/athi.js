$("#regSave").click(function(){
    fname   = document.forms["registerForm"].elements['fname'].value;
    lname   = document.forms["registerForm"].elements['lname'].value;
    design  = document.forms["registerForm"].elements['design'].value; //'M','P' or 'L'
    dob     = document.forms["registerForm"].elements['dob'].value;
    pno     = document.forms["registerForm"].elements['pno'].value;
    pskill  = document.forms["registerForm"].elements['pskill'].value; //'JV', 'MF', 'DN' or 'PH'
    sskill  = document.forms["registerForm"].elements['sskill'].value; //'TW', 'BL', 'GD' or 'AC'
    resaddr = document.forms["registerForm"].elements['resaddr'].value;

if(isEmpty(fname)==true){
    alert("Please enter First Name"); 
}
else if(isEmpty(lname)==true){
    alert("Please enter Last Name");
}
else if(isEmpty(design)==true){
    alert("Please enter Designation");
}
else if(isEmpty(dob)==true){
    alert("Please enter Date of Birth");
}
else if(isEmpty(pno)==true){
    alert("Please enter Phone Number");
}
else if(isEmpty(pskill)==true){
    alert("Please select Primary Skill");
}
else if(isEmpty(sskill)==true){
    alert("Please select Secondary Skill");
}
else if(isEmpty(resaddr)==true){
    alert("Please enter Residential Address");
}
else if(isTenDigitNumeric(pno)==false){
        alert("Phone number should be a 10 digit number");
}
else{
    //Perfect
    //Use Ajax to send registration values to DB
    $.post("http://localhost/epmas/register/register.php",
    {
        fname:fname,
        lname:lname,
        design:design,
        dob:dob,
        pno:pno,
        pskill:pskill,
        sskill:sskill,
        resaddr:resaddr
    },
    function(data,status){
          alert(data);
    });		    
}
});

$("#newjobSave").click(function(){
    assignto    = document.forms["newJobForm"].elements['assignTo'].value;
    jobdesc     = document.forms["newJobForm"].elements['jobDesc'].value;
    jobupdates  = document.forms["newJobForm"].elements['jobUpdates'].value;

if(isEmpty(jobdesc)==true){
    alert("Please enter Job Description");
}
else if(isEmpty(jobupdates)==true){
    alert("Please enter Job Updates");
}
else{
    $.post("http://localhost/epmas/jobs/create/create.php",
    {
        assignto:assignto,
        jobdesc:jobdesc,
        jobupdates:jobupdates
    },
    function(data,status){
        alert(data);
        document.forms["newJobForm"].reset();
    });		    
}
});

$("#editjobSave").click(function(){
    jobid         = document.forms["editJobForm"].elements['jobId'].value;
    jobstatus     = document.forms["editJobForm"].elements['jobStatus'].value;
    assignto      = document.forms["editJobForm"].elements['assignTo'].value;
    jobupdates    = document.forms["editJobForm"].elements['jobUpdates'].value;

if(isEmpty(jobid)==true||jobid==null){
    alert("Please enter Job Id"); 
}
else if(isEmpty(assignto)==true){
    alert("Please enter Assign To"); 
}
else if(isEmpty(jobupdates)==true){
    alert("Please enter Job Updates");
}
else{
    $.post("http://localhost/epmas/jobs/edit/edit.php",
    {
        jobid:jobid,
        jobstatus:jobstatus,    
        assignto:assignto,
        jobupdates:jobupdates
    },
    function(data,status){
        alert(data);
        window.location = 'http://localhost/epmas/jobs/search/index.php?job_id='+jobid+'';
    });		    
}
});

$("#sprSave").click(function(){
    empid   = document.forms["sprUpdateForm"].elements['empid'].value;
    sprid   = document.forms["sprUpdateForm"].elements['sprid'].value;

if(isEmpty(empid)==true){
    alert("Please enter Employee ID"); 
}
else if(isEmpty(sprid)==true){
    alert("Please enter Supervisor ID");
}
else{
    $.post("http://localhost/epmas/supervisor/edit.php",
    {
        empid:empid,
        sprid:sprid    
    },
    function(data,status){
        alert(data);
        document.forms["sprUpdateForm"].reset();
    });		    
}
});


$("#applyLeave").click(function(){
    lfrom   = document.forms["leaveApplyForm"].elements['from'].value;
    lto     = document.forms["leaveApplyForm"].elements['to'].value;
    ltype   = document.forms["leaveApplyForm"].elements['ltype'].value;
    lreason = document.forms["leaveApplyForm"].elements['reason'].value;

if(isEmpty(lfrom)==true){
    alert("Please select From Date"); 
}
else if(isEmpty(lto)==true){
    alert("Please select To Date"); 
}
else if(isEmpty(ltype)==true){
    alert("Please select Leave Type"); 
}
else if(isEmpty(lreason)==true){
    alert("Please provide proper reason"); 
}
else{
    $.post("http://localhost/epmas/leave/apply/apply.php",
    {
        lfrom:lfrom,
        lto:lto,
        ltype:ltype,
        lreason:lreason
    },
    function(data,status){
        alert(data);
        document.forms["leaveApplyForm"].reset();
    });		    
}
});

$("#changePass").click(function(){
oldpass     = document.forms["changePassForm"].elements['oldpass'].value;
newpass     = document.forms["changePassForm"].elements['newpass'].value;
newpassr    = document.forms["changePassForm"].elements['newpassr'].value;

if(isEmpty(oldpass)==true){
    alert("Please enter Old Password"); 
}
else if(isEmpty(newpass)==true){
    alert("Please enter New Password"); 
}
else if(isEmpty(newpassr)==true){
    alert("Please enter Re-enter New Password"); 
}
else if(newpass!=newpassr){
    alert("New Password and Re-enter New password not matching"); 
}
else{
    $.post("http://localhost/epmas/home/user/cpass.php",
    {
        oldpass:oldpass,
        newpass:newpass,
        newpassr:newpassr
    },
    function(data,status){
        alert(data);
        document.forms["changePassForm"].reset();
    });		    
}
});
