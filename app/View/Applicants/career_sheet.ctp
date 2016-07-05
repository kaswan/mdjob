<style>

kbd {
padding: 2px 4px;
font-size: 100%;
color: #fff;
background-color: #333;
border-radius: 3px;
box-shadow: inset 0 -1px 0 rgba(0,0,0,.25);
}

pre {
text-align: center;
font-size: 125%;
font-weight: bold;
color: #fff;
background: #333;
padding: 10px;
margin-top: 5px;
-moz-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
-webkit-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.serial {
  float: right;
  font-size: 70%;
  text-align: right;
  
  margin-top: 5px;
  margin-right: 5px;
}
/** Tables **/
table {	
    border: 1px solid #ddd;
	clear: both;
	color: #333;
	margin-bottom: 10px;
	width: 100%;
}
th {
	border: 1px solid #ddd;
	text-align: center;
	padding:4px;
}

table tr td {
    border: 1px solid #ddd;
	text-align: left;
	vertical-align: top;	
}
table tr:nth-child(even) {
	background: #f9f9f9;
}
td.actions {
	text-align: center;
	white-space: nowrap;
}
table td.actions a {
	margin: 0px 6px;
	padding:2px 5px;
}

table tr:nth-child(even) {
	background: #f9f9f9;
}
.unread {
    background: #FBEFF5;
}

.table-bordered {
  border: 1px solid #ddd;
}

.no-border {
  border: 0px;
  clear: both;
  color: #333;
  margin-bottom: 10px;
  width: 100%;
}
.no-border tr td {
  border: 0px;
}

</style>

<?php echo $this->element('applicant/career_sheet',array('applicant' => $applicant)); ?>
