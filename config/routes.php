<?php

return [
    'security/registration' => ['Example\Controller\SecurityController', 'registrationAction'],
    'security/logout' => ['Example\Controller\SecurityController', 'logoutAction'],
    'security/login' => ['Example\Controller\SecurityController', 'loginAction'],
    'message/show' => ['Example\Controller\MessageController', 'showAction'],
    'message/showAjax' => ['Example\Controller\MessageController', 'showAjaxAction'],
    'message/add' => ['Example\Controller\MessageController', 'addAction'],
    'message/sort' => ['Example\Controller\MessageController', 'sortAction'],
    'admin/update' => ['Example\Controller\AdminController', 'updateAction'],
    'admin/addImage/([0-9]+)' => ['Example\Controller\AdminController', 'addImageAction'],
    'admin/delete/([0-9]+)' => ['Example\Controller\AdminController', 'deleteAction'],
    'admin/isAdmin' => ['Example\Controller\AdminController', 'isAdminAction'],
    'admin/show/([0-9]+)' => ['Example\Controller\AdminController', 'showAction'],
    '' => ['Example\Controller\SecurityController', 'registrationAction']
];