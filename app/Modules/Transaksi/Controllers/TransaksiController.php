<?php
namespace App\Modules\Transaksi\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Transaksi\Models\Transaksi;
use App\Modules\Users_kita\Models\Users_kita;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Transaksi";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Transaksi::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Transaksi::transaksi', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_users_kita = Users_kita::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'kode_transaksi' => ['label' => 'Kode Transaksi', 'type' => 'text', 'value' => old("kode_transaksi"), 'required' => true],
			'status' => ['label' => 'Status', 'type' => 'text', 'value' => old("status"), 'required' => true],
			'tanggal' => ['label' => 'Tanggal', 'type' => 'text', 'value' => old("tanggal"), 'required' => true, 'class' => 'datepicker'],
			'total' => ['label' => 'Total', 'type' => 'text', 'value' => old("total"), 'required' => true],
			'users_id' => ['label' => 'Users Id', 'type' => 'select', 'value' => old("users_id"), 'required' => true, 'options' => $ref_users_kita->all(), 'class' => 'select2'],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Transaksi::transaksi_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'kode_transaksi' => 'required',
			'status' => 'required',
			'tanggal' => 'required',
			'total' => 'required',
			'users_id' => 'required',
			
		]);

		$transaksi = new Transaksi();
		$transaksi->kode_transaksi = $request->input("kode_transaksi");
		$transaksi->status = $request->input("status");
		$transaksi->tanggal = $request->input("tanggal");
		$transaksi->total = $request->input("total");
		$transaksi->users_id = $request->input("users_id");
		
		$transaksi->created_by = Auth::id();
		$transaksi->save();

		$text = 'membuat '.$this->title; //' baru '.$transaksi->what;
		$this->log($request, $text, ['transaksi.id' => $transaksi->id]);
		return redirect()->route('transaksi.index')->with('message_success', 'Transaksi berhasil ditambahkan!');
	}

	public function show(Request $request, Transaksi $transaksi)
	{
		$data['transaksi'] = $transaksi;

		$text = 'melihat detail '.$this->title;//.' '.$transaksi->what;
		$this->log($request, $text, ['transaksi.id' => $transaksi->id]);
		return view('Transaksi::transaksi_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Transaksi $transaksi)
	{
		$data['transaksi'] = $transaksi;

		$ref_users_kita = Users_kita::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'kode_transaksi' => ['label' => 'Kode Transaksi', 'type' => 'text', 'value' => $transaksi->kode_transaksi, 'required' => true, 'id' => 'kode_transaksi'],
			'status' => ['label' => 'Status', 'type' => 'text', 'value' => $transaksi->status, 'required' => true, 'id' => 'status'],
			'tanggal' => ['label' => 'Tanggal', 'type' => 'text', 'value' => $transaksi->tanggal, 'required' => true, 'class' => 'datepicker', 'id' => 'tanggal'],
			'total' => ['label' => 'Total', 'type' => 'text', 'value' => $transaksi->total, 'required' => true, 'id' => 'total'],
			'users_id' => ['label' => 'Users Id', 'type' => 'select', 'value' => $transaksi->users_id, 'required' => true, 'options' => $ref_users_kita->all(), 'class' => 'select2', 'id' => 'users_id'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$transaksi->what;
		$this->log($request, $text, ['transaksi.id' => $transaksi->id]);
		return view('Transaksi::transaksi_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'kode_transaksi' => 'required',
			'status' => 'required',
			'tanggal' => 'required',
			'total' => 'required',
			'users_id' => 'required',
			
		]);

		$transaksi = Transaksi::find($id);
		$transaksi->kode_transaksi = $request->input("kode_transaksi");
		$transaksi->status = $request->input("status");
		$transaksi->tanggal = $request->input("tanggal");
		$transaksi->total = $request->input("total");
		$transaksi->users_id = $request->input("users_id");
		
		$transaksi->updated_by = Auth::id();
		$transaksi->save();


		$text = 'mengedit '.$this->title;//.' '.$transaksi->what;
		$this->log($request, $text, ['transaksi.id' => $transaksi->id]);
		return redirect()->route('transaksi.index')->with('message_success', 'Transaksi berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$transaksi = Transaksi::find($id);
		$transaksi->deleted_by = Auth::id();
		$transaksi->save();
		$transaksi->delete();

		$text = 'menghapus '.$this->title;//.' '.$transaksi->what;
		$this->log($request, $text, ['transaksi.id' => $transaksi->id]);
		return back()->with('message_success', 'Transaksi berhasil dihapus!');
	}

}
