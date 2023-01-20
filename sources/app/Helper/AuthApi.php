<?php

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    use App\Models\Menu as MenuModel;
    use App\Models\Role as RoleModel;
    use App\Models\MenuRole as MenuRoleModel;

    function main_menu($role_id)
    {
        $menu = DB::table('menu_role')
                ->join('menus', 'menu_role.menu_id', '=', 'menus.id')
                ->where('menus.type', 'MAIN_MENU')
                ->where('menu_role.role_id', $role_id)
                ->select('menus.id', 'menus.label', 'menus.icon', 'menus.route')
                ->orderBy('menus.short_order', 'ASC')
                ->get();

        return $menu;
    }

    function sub_menu($role_id)
    {
        $menu = DB::table('menu_role')
                ->join('menus', 'menu_role.menu_id', '=', 'menus.id')
                ->where('menus.type', 'SUB_MENU')
                ->where('menu_role.role_id', $role_id)
                ->select('menus.id', 'menus.parent_id', 'menus.label', 'menus.icon', 'menus.route')
                ->orderBy('menus.short_order', 'ASC')
                ->get();

        return $menu;
    }

    function subsub_menu($role_id)
    {
        $menu = DB::table('menu_role')
                ->join('menus', 'menu_role.menu_id', '=', 'menus.id')
                ->where('menus.type', 'ACTIONS')
                ->where('menu_role.role_id', $role_id)
                ->select('menus.id', 'menus.parent_id', 'menus.label', 'menus.icon', 'menus.route')
                ->orderBy('menus.short_order', 'ASC')
                ->get();

        return $menu;
    }

    function check_submenu($menu_id)
    {
        $menu = MenuModel::where('parent_id', $menu_id)->get();

        return count($menu);
    }

    function access_check($menu_id, $slack)
    {
        $role       = RoleModel::where('slack', $slack)->first();
        $role_id    = $role->id;

        $menu = DB::table('menu_role')->where('menu_id', $menu_id)
                                        ->where('role_id', $role_id)
                                        ->get();
        
        return count($menu);
    }

    function menu_tes($menu_id, $role_id)
    {
        $access = MenuRoleModel::with('menu')
                                ->where('role_id', $role_id)
                                ->where('menu_id', $menu_id)
                                ->get();
        return count($access);
    }