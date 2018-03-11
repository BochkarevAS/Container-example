<?php

namespace Example\Controller;

use Example\Core\Controller;
use Example\Core\Request;
use Example\Repository\AdminRepository;

class AdminController extends Controller {

    public function updateAction(Request $request) {
        $message = $request->post('message');
        $id = $request->post('id');

        $adminRepository = $this->container->make(AdminRepository::class);
        $adminRepository->updateAction($message, $id);

        header('Location: /message/show');
    }

    public function deleteAction($id) {
        $adminRepository = $this->container->make(AdminRepository::class);
        $adminRepository->deleteAction($id);

        header('Location: /message/show');
    }

    public function addImageAction($id) {
        list ($usec, $sec) = explode(' ', microtime());
        $makeSeed = $sec . (int)($usec * 100000);

        $adminRepository = $this->container->make(AdminRepository::class);
        $adminRepository->addImageAction($id, $makeSeed);

        header('Location: /message/show');
    }

    public function isAdminAction(Request $request) {
        $id = $request->post('id');

        $adminRepository = $this->container->make(AdminRepository::class);
        $adminRepository->isAdminAction($id);

        header('Location: /message/show');
    }
}