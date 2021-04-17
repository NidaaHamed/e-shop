<?php
$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

// If The Page Is Main Page
if ($do =='Manage') {

  echo "Welcome You Are In Manage Section";
  echo "<a href='?do=Insert'>Add New Category + </a>";

}elseif ($do == 'Add') {

  echo "Welcome You Are In Add Section";

}elseif ($do == 'Insert') {

  echo "Welcome You Are In Insert Section";

}else{

  echo "Error There\'s No Page With This Name";

}
