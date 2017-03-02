<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:'.DS.'wamp64'.DS.'www'.DS.'photo_gallery');
defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');

require_once(INC_PATH.DS."config.php");
require_once(INC_PATH.DS."functions.php");
require_once(INC_PATH.DS."session.php");
require_once(INC_PATH.DS."database.php");
require_once(INC_PATH.DS."database_object.php");
require_once(INC_PATH.DS."user.php");
require_once(INC_PATH.DS."user2.php");
require_once(INC_PATH.DS."Credential.php");
require_once(INC_PATH.DS."contact_information.php");
require_once(INC_PATH.DS."DieticianUser.php");
require_once(INC_PATH.DS."Dietician.php");
require_once(INC_PATH.DS."daily_intake.php");

?>