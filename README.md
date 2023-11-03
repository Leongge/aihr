# smarthr
Peninsula College Computer Science student project for Google DevHack Competition 


FRONT END
//short form 
$p=$_POST ( im lazy )
f_... is for table form(f_id,f_name,f_job,attachment), f_name is applicant name, attachment store file name.
j_... is for table job(j_id,j_name,j_requirement), for database side please change the datatype for j_requirement from varchar(255) to suitable data type.

FEATURE PATH
upload pdf -> hr/index.php
applicant list -> hr/record_list.php //don't panic why the name is blank, expecting auto retrieve name from pdf while uploading
joblist -> hr/job.php @ edit=hr/job_edit.php @ add=hr/job_add.php


usually coding start with $id=$_get['id'], please do not touch. 

ISSUES 
downloading file problem, file fail to open after downloaded @hr/download_file.php

