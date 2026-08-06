<?php
namespace App\Modules\Users_kita\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Users_kita\Models\Users_kita;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Users_kitaController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Users Kita";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Users_kita::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Users_Kita::users_kita', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'email' => ['label' => 'Email', 'type' => 'text', 'value' => old("email"), 'required' => true],
			'password' => ['label' => 'Password', 'type' => 'text', 'value' => old("password"), 'required' => true],
			'role' => ['label' => 'Role', 'type' => 'text', 'value' => old("role"), 'required' => true],
			'username' => ['label' => 'Username', 'type' => 'text', 'value' => old("username"), 'required' => true],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Users_Kita::users_kita_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required',
			'role' => 'required',
			'username' => 'required',
			
		]);

		$users_kita = new Users_kita();
		$users_kita->email = $request->input("email");
		$users_kita->password = $request->input("password");
		$users_kita->role = $request->input("role");
		$users_kita->username = $request->input("username");
		
		$users_kita->created_by = Auth::id();
		$users_kita->save();

		$text = 'membuat '.$this->title; //' baru '.$users_kita->what;
		$this->log($request, $text, ['users_kita.id' => $users_kita->id]);
		return redirect()->route('users_kita.index')->with('message_success', 'Users Kita berhasil ditambahkan!');
	}

	public function show(Request $request, Users_kita $users_kita)
	{
		$data['users_kita'] = $users_kita;

		$text = 'melihat detail '.$this->title;//.' '.$users_kita->what;
		$this->log($request, $text, ['users_kita.id' => $users_kita->id]);
		return view('Users_Kita::users_kita_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Users_kita $users_kita)
	{
		$data['users_kita'] = $users_kita;

		
		$data['forms'] = array(
			'email' => ['label' => 'Email', 'type' => 'text', 'value' => $users_kita->email, 'required' => true, 'id' => 'email'],
			'password' => ['label' => 'Password', 'type' => 'text', 'value' => $users_kita->password, 'required' => true, 'id' => 'password'],
			'role' => ['label' => 'Role', 'type' => 'text', 'value' => $users_kita->role, 'required' => true, 'id' => 'role'],
			'username' => ['label' => 'Username', 'type' => 'text', 'value' => $users_kita->username, 'required' => true, 'id' => 'username'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$users_kita->what;
		$this->log($request, $text, ['users_kita.id' => $users_kita->id]);
		return view('Users_Kita::users_kita_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required',
			'role' => 'required',
			'username' => 'required',
			
		]);

		$users_kita = Users_kita::find($id);
		$users_kita->email = $request->input("email");
		$users_kita->password = $request->input("password");
		$users_kita->role = $request->input("role");
		$users_kita->username = $request->input("username");
		
		$users_kita->updated_by = Auth::id();
		$users_kita->save();


		$text = 'mengedit '.$this->title;//.' '.$users_kita->what;
		$this->log($request, $text, ['users_kita.id' => $users_kita->id]);
		return redirect()->route('users_kita.index')->with('message_success', 'Users Kita berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$users_kita = Users_kita::find($id);
		$users_kita->deleted_by = Auth::id();
		$users_kita->save();
		$users_kita->delete();

		$text = 'menghapus '.$this->title;//.' '.$users_kita->what;
		$this->log($request, $text, ['users_kita.id' => $users_kita->id]);
		return back()->with('message_success', 'Users Kita berhasil dihapus!');
	}

}
