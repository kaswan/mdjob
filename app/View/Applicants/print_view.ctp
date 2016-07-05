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
color: #000;
background: #f0f0f0;
padding: 15px;
-moz-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
-webkit-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}
/** Tables **/
table {
	border-right:0;
	clear: both;
	color: #333;
	margin-bottom: 10px;
	width: 100%;
}
th {
	border:0;
	border-bottom:2px solid #555;
	text-align: left;
	padding:4px;
}
th a {
	display: block;
	padding: 2px 4px;
	text-decoration: none;
}
th a.asc:after {
	content: ' ⇣';
}
th a.desc:after {
	content: ' ⇡';
}
table tr td {
	padding: 6px;
	text-align: left;
	vertical-align: top;
	border-bottom:1px solid #ddd;
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
</style>
<div class="users">
<?php echo $this->element('applicant/show',array('applicant' => $applicant)); ?>
</div>