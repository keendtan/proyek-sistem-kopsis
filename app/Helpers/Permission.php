<?php
namespace App\Helpers;

use App\Modules\Menu\Models\Menu;
use App\Modules\Role\Models\Role;
use App\Modules\Users\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Modules\Privilege\Models\Privilege;

class Permission
{
	public static function can($route)
	{
		if(empty($route)) return true;

		$elm = explode('.', $route);
		$menu = reset($elm);
		$action = end($elm);

		$exceptions = config('laralag.module_exception');
		if(in_array($menu, $exceptions)) return true;

		$action = config('laralag.translate_action')[$action] ?? null;
		$privileges = session('privileges');
		return $privileges[$menu][$action] ?? true;
	}

	public static function getMenu($id_role)
	{
		// Ambil semua menu dari privilege dengan distinct untuk menghindari duplikasi
		$privilegeMenus = Menu::whereExists(function ($query) use ($id_role) {
				$query->select(DB::raw(1))
					->from('privilege')
					->whereColumn('privilege.id_menu', 'menu.id')
					->where('privilege.id_role', $id_role)
					->where('privilege.show_menu', 1)
					->where('menu.is_tampil', 1);
			})
			->orderBy('menu.urutan')
			->get(['menu.id', 'icon', 'menu', 'routing', 'level', 'urutan', 'parent_id'])
			->unique('id')
			->values()
			->all();
		
		$privilegeMenuIds = array_column($privilegeMenus, 'id');

		// Ambil menu level 0 yang TIDAK ada di privilege (untuk menghindari duplikasi)
		$groups = Menu::where('level', 0)
			->where('is_tampil', 1)
			->whereNotIn('id', $privilegeMenuIds)
			->orderBy('urutan')
			->get(['menu.id', 'icon', 'menu', 'routing', 'level', 'urutan', 'parent_id'])
			->all();

		return array_merge($groups, $privilegeMenus);
	}

	public static function getRole($id_user)
	{
		return Users::with('roleuser')->find($id_user)->roleuser()->orderByDesc('level')->get();
	}

	public static function getPrivilege($id_role)
	{
		return Privilege::leftJoin('menu as m', 'm.id', 'id_menu')->where('id_role', $id_role)->get(['module', 'create', 'read', 'show', 'update', 'delete', 'show_menu']);
	}
}
