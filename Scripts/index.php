<?php
session_start();
$request = $_SERVER['REQUEST_URI'];
$route = substr($request, strrpos($request, '/'));
if (strpos($request, 'index.php') === false) {
    header("location: " . $request . "index.php/");
}
else if (!isset($_SESSION['user_id']) && !isset($_SESSION['instructor_id'])) {  // if the user is NOT logged in
    switch ($route) {
        case '' :
            require __DIR__ . '/routes/login.php';
            break;
        case '/' :
            require __DIR__ . '/routes/login.php';
            break;
        case 'index.php' :
            require __DIR__ . '/routes/login.php';
            break;
        case '/login' :
            require __DIR__ . '/routes/login.php';
            break;
        case '/register' :
            require __DIR__ . '/routes/register.php';
            break;
        case '/verify' :
            require __DIR__ . '/routes/verify.php';
            break;
        case '/Invite' :
            require __DIR__ . '/routes/Invite.php';
            break;
        case '/leave' :
            require __DIR__ . '/routes/leave.php';
            break;
        case '/SelectGroupsPHP' :
            require __DIR__ . '/routes/SelectGroupsPHP.php';
            break;
        case '/SelectPHP' :
            require __DIR__ . '/routes/SelectPHP.php';
            break;
        case '/js_groups' :
            require __DIR__ . '/js/javascript_groups.js';
            break;
        case '/js_invite' :
            require __DIR__ . '/js/javascript_invite.js';
            break;
        case '/SelectMember' :
            require __DIR__ . '/routes/SelectMember.php';
            break;
        case '/SelectBids' :
            require __DIR__ . '/routes/SelectBids.php';
            break;
        case '/js_dashboard' :
            require __DIR__ . '/js/javascript_dashboard.js';
            break;
        case '/js_leave' :
            require __DIR__ . '/js/javascript_leave.js';
            break;
        case '/leavePHP' :
            require __DIR__ . '/routes/leavePHP.php';
            break;
        case '/invitePHP' :
            require __DIR__ . '/routes/invitePHP.php';
            break;
        case '/groupInvitations' :
            require __DIR__ . '/routes/groupInvitations.php';
            break;
        case '/refuse' :
            require __DIR__ . '/routes/refuse.php';
            break;
        case '/accept' :
            require __DIR__ . '/routes/accept.php';
            break;
        default:
            http_response_code(404);
            require __DIR__ . '/routes/404.php';
            break;
    }
}
elseif (isset($_SESSION['user_id']) && !isset($_SESSION['instructor_id'])) {       // if student is logged in
    switch ($route) {
        case '' :
            require __DIR__ . '/routes/dashboard.php';
            break;
        case '/' :
            require __DIR__ . '/routes/dashboard.php';
            break;
        case 'index.php' :
            require __DIR__ . '/routes/dashboard.php';
            break;
        case '/dashboard' :
            require __DIR__ . '/routes/dashboard.php';
            break;
        case '/groups' :
            require __DIR__ . '/routes/groups.php';
            break;
        case '/bidding' :
            require __DIR__ . '/routes/bidding.php';
            break;
        case '/logout' :
            require __DIR__ . '/routes/logout.php';
            break;
        case '/Invite' :
            require __DIR__ . '/routes/Invite.php';
            break;
        case '/leave' :
            require __DIR__ . '/routes/leave.php';
            break;
        case '/SelectGroupsPHP' :
            require __DIR__ . '/routes/SelectGroupsPHP.php';
            break;
        case '/SelectPHP' :
            require __DIR__ . '/routes/SelectPHP.php';
            break;
        case '/js_groups' :
            require __DIR__ . '/js/javascript_groups.js';
            break;
        case '/js_invite' :
            require __DIR__ . '/js/javascript_invite.js';
            break;
        case '/SelectMember' :
            require __DIR__ . '/routes/SelectMember.php';
            break;
        case '/SelectBids' :
            require __DIR__ . '/routes/SelectBids.php';
            break;
        case '/js_dashboard' :
            require __DIR__ . '/js/javascript_dashboard.js';
            break;
        case '/js_leave' :
            require __DIR__ . '/js/javascript_leave.js';
            break;
        case '/leavePHP' :
            require __DIR__ . '/routes/leavePHP.php';
            break;
        case '/invitePHP' :
            require __DIR__ . '/routes/invitePHP.php';
            break;
        case '/groupInvitations' :
            require __DIR__ . '/routes/groupInvitations.php';
            break;
        case '/refuse' :
            require __DIR__ . '/routes/refuse.php';
            break;
        case '/accept' :
            require __DIR__ . '/routes/accept.php';
            break;
        case '/drag' :
            require __DIR__ . '/js/drag.js';
            break;
        case '/drop' :
            require __DIR__ . '/routes/drop.php';
            break;
        case '/submit' :
            require __DIR__ . '/routes/submit.php';
            break;
        case '/getUserGroup' :
            require __DIR__ . '/routes/getUserGroup.php';
            break;
        default:
            http_response_code(404);
            require __DIR__ . '/routes/404.php';
            break;
    }
}
elseif (isset($_SESSION['instructor_id']) && !isset($_SESSION['user_id'])) {       // if instructor is logged in
    switch ($route) {
        case '' :
            require __DIR__ . '/routes/console.php';
            break;
        case '/' :
            require __DIR__ . '/routes/console.php';
            break;
        case '/index.php' :
            require __DIR__ . '/routes/console.php';
            break;
        case '/console' :
            require __DIR__ . '/routes/console.php';
            break;
        case '/projects' :
            require __DIR__ . '/routes/projects.php';
            break;
        case '/connect_canvas' :
            require __DIR__ . '/routes/connect_canvas.php';
            break;
        case '/logout' :
            require __DIR__ . '/routes/logout.php';
            break;
        case '/js_console' :
            require __DIR__ . '/js/js_console.js';
            break;
        case '/js_project' :
            require __DIR__ . '/js/js_project.js';
            break;
        case '/pro_selectProjects' :
            require __DIR__ . '/routes/pro_selectProjects.php';
            break;
        case '/pro_selectUsers' :
            require __DIR__ . '/routes/pro_selectUsers.php';
            break;
        case '/pro_selectGroups' :
            require __DIR__ . '/routes/pro_selectGroups.php';
            break;
        case '/canvasAPI' :
            require __DIR__ . '/routes/canvasAPI.php';
            break;
        case '/canvasInsert' :
            require __DIR__ . '/routes/canvasInsert.php';
            break;
        case '/js_canvas' :
            require __DIR__ . '/js/js_canvas.js';
            break;
        case '/algorithm' :
            require __DIR__ . '/routes/algorithm.php';
            break;
        case '/algorithmScript' :
            require __DIR__ . '/js/algorithmScript.js';
            break;
        case '/getGroupData' :
            require __DIR__ . '/routes/getGroupData.php';
            break;
        case '/getProjectData' :
            require __DIR__ . '/routes/getProjectData.php';
            break;
        case '/getBidData' :
            require __DIR__ . '/routes/getBidData.php';
            break;
        case '/getStudentData' :
            require __DIR__ . '/routes/getStudentData.php';
            break;
        case '/bulkInsertProjects' :
            require __DIR__ . '/routes/bulkInsertProjects.php';
            break;
        default:
            http_response_code(404);
            require __DIR__ . '/routes/404.php';
            break;
    }
}
else {      // if both user and instructor are logged in - this should never happen
    require __DIR__ . '/routes/logout.php';
}

?>