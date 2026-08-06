<?php
namespace App\Modules\Keranjang\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Keranjang\Models\Keranjang;
use App\Modules\Barang\Models\Barang;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Keranjang";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Keranjang::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Keranjang::keranjang', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_barang = Barang::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'barang_id' => ['label' => 'Barang Id', 'type' => 'select', 'value' => old("barang_id"), 'required' => true, 'options' => $ref_barang->all(), 'class' => 'select2'],
			'barang_nama' => ['label' => 'Barang Nama', 'type' => 'text', 'value' => old("barang_nama"), 'required' => true],
			'catatan_item' => ['label' => 'Catatan Item', 'type' => 'textarea', 'value' => old("catatan_item"), 'required' => false],
			'jumlah_barang' => ['label' => 'Jumlah Barang', 'type' => 'text', 'value' => old("jumlah_barang"), 'required' => true],
			'total' => ['label' => 'Total', 'type' => 'text', 'value' => old("total"), 'required' => true],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Keranjang::keranjang_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'barang_id' => 'required',
			'barang_nama' => 'required',
			'catatan_item' => 'required',
			'jumlah_barang' => 'required',
			'total' => 'required',
			
		]);

		$keranjang = new Keranjang();
		$keranjang->barang_id = $request->input("barang_id");
		$keranjang->barang_nama = $request->input("barang_nama");
		$keranjang->catatan_item = $request->input("catatan_item");
		$keranjang->jumlah_barang = $request->input("jumlah_barang");
		$keranjang->total = $request->input("total");
		
		$keranjang->created_by = Auth::id();
		$keranjang->save();

		$text = 'membuat '.$this->title; //' baru '.$keranjang->what;
		$this->log($request, $text, ['keranjang.id' => $keranjang->id]);
		return redirect()->route('keranjang.index')->with('message_success', 'Keranjang berhasil ditambahkan!');
	}

	public function show(Request $request, Keranjang $keranjang)
	{
		$data['keranjang'] = $keranjang;

		$text = 'melihat detail '.$this->title;//.' '.$keranjang->what;
		$this->log($request, $text, ['keranjang.id' => $keranjang->id]);
		return view('Keranjang::keranjang_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Keranjang $keranjang)
	{
		$data['keranjang'] = $keranjang;

		$ref_barang = Barang::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'barang_id' => ['label' => 'Barang Id', 'type' => 'select', 'value' => $keranjang->barang_id, 'required' => true, 'options' => $ref_barang->all(), 'class' => 'select2', 'id' => 'barang_id'],
			'barang_nama' => ['label' => 'Barang Nama', 'type' => 'text', 'value' => $keranjang->barang_nama, 'required' => true, 'id' => 'barang_nama'],
			'catatan_item' => ['label' => 'Catatan Item', 'type' => 'textarea', 'value' => $keranjang->catatan_item, 'required' => false, 'id' => 'catatan_item'],
			'jumlah_barang' => ['label' => 'Jumlah Barang', 'type' => 'text', 'value' => $keranjang->jumlah_barang, 'required' => true, 'id' => 'jumlah_barang'],
			'total' => ['label' => 'Total', 'type' => 'text', 'value' => $keranjang->total, 'required' => true, 'id' => 'total'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$keranjang->what;
		$this->log($request, $text, ['keranjang.id' => $keranjang->id]);
		return view('Keranjang::keranjang_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'barang_id' => 'required',
			'barang_nama' => 'required',
			'catatan_item' => 'required',
			'jumlah_barang' => 'required',
			'total' => 'required',
			
		]);

		$keranjang = Keranjang::find($id);
		$keranjang->barang_id = $request->input("barang_id");
		$keranjang->barang_nama = $request->input("barang_nama");
		$keranjang->catatan_item = $request->input("catatan_item");
		$keranjang->jumlah_barang = $request->input("jumlah_barang");
		$keranjang->total = $request->input("total");
		
		$keranjang->updated_by = Auth::id();
		$keranjang->save();


		$text = 'mengedit '.$this->title;//.' '.$keranjang->what;
		$this->log($request, $text, ['keranjang.id' => $keranjang->id]);
		return redirect()->route('keranjang.index')->with('message_success', 'Keranjang berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$keranjang = Keranjang::find($id);
		$keranjang->deleted_by = Auth::id();
		$keranjang->save();
		$keranjang->delete();

		$text = 'menghapus '.$this->title;//.' '.$keranjang->what;
		$this->log($request, $text, ['keranjang.id' => $keranjang->id]);
		return back()->with('message_success', 'Keranjang berhasil dihapus!');
	}

}
