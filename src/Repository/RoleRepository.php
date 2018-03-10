<?php

namespace Example\Repository;

use Example\Core\Db;

class RoleRepository extends Db {

    public function getRolePerms($roleId) {
        $permissions = [];

        $sql = "
            SELECT t2.perm_desc 
            FROM role.role_perm t1
            JOIN role.permissions t2 ON (t1.id=t2.id)
            WHERE t1.id=:role_id";

        $result = $this->query($sql, ['role_id' => $roleId]);

        while($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $permissions[$row["perm_desc"]] = true;
        }

        return $permissions;
    }
}