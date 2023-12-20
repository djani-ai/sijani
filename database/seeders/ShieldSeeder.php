<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
class ShieldSeeder extends Seeder
{

    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_kec","view_any_kec","create_kec","update_kec","restore_kec","restore_any_kec","replicate_kec","reorder_kec","delete_kec","delete_any_kec","force_delete_kec","force_delete_any_kec","view_kel","view_any_kel","create_kel","update_kel","restore_kel","restore_any_kel","replicate_kel","reorder_kel","delete_kel","delete_any_kel","force_delete_kel","force_delete_any_kel","view_lhp","view_any_lhp","create_lhp","update_lhp","restore_lhp","restore_any_lhp","replicate_lhp","reorder_lhp","delete_lhp","delete_any_lhp","force_delete_lhp","force_delete_any_lhp","view_shield::role","view_any_shield::role","create_shield::role","update_shield::role","delete_shield::role","delete_any_shield::role","view_spt","view_any_spt","create_spt","update_spt","restore_spt","restore_any_spt","replicate_spt","reorder_spt","delete_spt","delete_any_spt","force_delete_spt","force_delete_any_spt","view_tahapan","view_any_tahapan","create_tahapan","update_tahapan","restore_tahapan","restore_any_tahapan","replicate_tahapan","reorder_tahapan","delete_tahapan","delete_any_tahapan","force_delete_tahapan","force_delete_any_tahapan","view_tps","view_any_tps","create_tps","update_tps","restore_tps","restore_any_tps","replicate_tps","reorder_tps","delete_tps","delete_any_tps","force_delete_tps","force_delete_any_tps","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user"]},{"name":"Panwascam","guard_name":"web","permissions":["view_kec","view_any_kec","create_kec","update_kec","restore_kec","restore_any_kec","replicate_kec","reorder_kec","delete_kec","delete_any_kec","force_delete_kec","force_delete_any_kec","view_kel","view_any_kel","create_kel","update_kel","restore_kel","restore_any_kel","replicate_kel","reorder_kel","delete_kel","delete_any_kel","force_delete_kel","force_delete_any_kel","view_lhp","view_any_lhp","create_lhp","update_lhp","restore_lhp","restore_any_lhp","replicate_lhp","reorder_lhp","delete_lhp","delete_any_lhp","force_delete_lhp","force_delete_any_lhp","view_spt","view_any_spt","create_spt","update_spt","restore_spt","restore_any_spt","replicate_spt","reorder_spt","delete_spt","delete_any_spt","force_delete_spt","force_delete_any_spt","view_tahapan","view_any_tahapan","create_tahapan","update_tahapan","restore_tahapan","restore_any_tahapan","replicate_tahapan","reorder_tahapan","delete_tahapan","delete_any_tahapan","force_delete_tahapan","force_delete_any_tahapan","view_tps","view_any_tps","create_tps","update_tps","restore_tps","restore_any_tps","replicate_tps","reorder_tps","delete_tps","delete_any_tps","force_delete_tps","force_delete_any_tps","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user"]},{"name":"pkd","guard_name":"web","permissions":["view_lhp","view_any_lhp","create_lhp","update_lhp","restore_lhp","restore_any_lhp","replicate_lhp","reorder_lhp","delete_lhp","delete_any_lhp","force_delete_lhp","force_delete_any_lhp","view_tps","view_any_tps","create_tps","update_tps","restore_tps","restore_any_tps","replicate_tps","reorder_tps","delete_tps","delete_any_tps","force_delete_tps","force_delete_any_tps","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user"]},{"name":"Ptps","guard_name":"web","permissions":[]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions,true))) {

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = Utils::getRoleModel()::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name']
                ]);

                if (! blank($rolePlusPermission['permissions'])) {

                    $permissionModels = collect();

                    collect($rolePlusPermission['permissions'])
                        ->each(function ($permission) use($permissionModels) {
                            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate([
                                'name' => $permission,
                                'guard_name' => 'web'
                            ]));
                        });
                    $role->syncPermissions($permissionModels);

                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions,true))) {

            foreach($permissions as $permission) {

                if (Utils::getPermissionModel()::whereName($permission)->doesntExist()) {
                    Utils::getPermissionModel()::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
