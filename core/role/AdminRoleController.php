<?php
    namespace App\Core\Role;

    use App\Core\Controller;

    class AdminRoleController extends Controller {
        public function __pre() {
            if ($this->getSession()->get('admin_id') === null) {
                $this->redirect(\Configuration::BASE . 'admin/login');
            }
        }
    }