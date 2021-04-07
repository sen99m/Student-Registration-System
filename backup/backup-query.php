SELECT student_info_master.sid, student_info_master.fname, student_info_master.mname, student_info_master.lname, student_info_master.dob, student_info_master.gender, student_info_master.mobilenumber, student_info_master.email, student_info_master.address, student_info_master.subject, district_master.dname
FROM student_info_master
LEFT JOIN district_master
ON district_master.did = student_info_master.district;

