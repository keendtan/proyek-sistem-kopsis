<?php
namespace App\Modules\Detail_pemesanan\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Detail_pemesanan\Models\Detail_pemesanan;
use App\Modules\Barang\Models\Barang;
use App\Modules\Transaksi\Models\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Detail_pemesananController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Detail Pemesanan";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Detail_pemesanan::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Detail_pemesanan::detail_pemesanan', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_barang = Barang::all()->pluck('created_by','id');
		$ref_transaksi = Transaksi::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'barang_id' => ['label' => 'Barang Id', 'type' => 'select', 'value' => old("barang_id"), 'required' => true, 'options' => $ref_barang->all(), 'class' => 'select2'],
			'harga_satuan' => ['label' => 'Harga Satuan', 'type' => 'text', 'value' => old("harga_satuan"), 'required' => true],
			'jumlah' => ['label' => 'Jumlah', 'type' => 'text', 'value' => old("jumlah"), 'required' => true],
			'subtotal' => ['label' => 'Subtotal', 'type' => 'text', 'value' => old("subtotal"), 'required' => true],
			'transaksi_id' => ['label' => 'Transaksi Id', 'type' => 'select', 'value' => old("transaksi_id"), 'required' => true, 'options' => $ref_transaksi->all(), 'class' => 'select2'],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Detail_pemesanan::detail_pemesanan_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'barang_id' => 'required',
			'harga_satuan' => 'required',
			'jumlah' => 'required',
			'subtotal' => 'required',
			'transaksi_id' => 'required',
			
		]);

		$detail_pemesanan = new Detail_pemesanan();
		$detail_pemesanan->barang_id = $request->input("barang_id");
		$detail_pemesanan->harga_satuan = $request->input("harga_satuan");
		$detail_pemesanan->jumlah = $request->input("jumlah");
		$detail_pemesanan->subtotal = $request->input("subtotal");
		$detail_pemesanan->transaksi_id = $request->input("transaksi_id");
		
		$detail_pemesanan->created_by = Auth::id();
		$detail_pemesanan->save();

		$text = 'membuat '.$this->title; //' baru '.$detail_pemesanan->what;
		$this->log($request, $text, ['detail_pemesanan.id' => $detail_pemesanan->id]);
		return redirect()->route('detail_pemesanan.index')->with('message_success', 'Detail Pemesanan berhasil ditambahkan!');
	}

	public function show(Request $request, Detail_pemesanan $detail_pemesanan)
	{
		$data['detail_pemesanan'] = $detail_pemesanan;

		$text = 'melihat detail '.$this->title;//.' '.$detail_pemesanan->what;
		$this->log($request, $text, ['detail_pemesanan.id' => $detail_pemesanan->id]);
		return view('Detail_pemesanan::detail_pemesanan_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Detail_pemesanan $detail_pemesanan)
	{
		$data['detail_pemesanan'] = $detail_pemesanan;

		$ref_barang = Barang::all()->pluck('created_by','id');
		$ref_transaksi = Transaksi::all()->pluck('created_by','id');
		
		$data['forms'] = array(
			'barang_id' => ['label' => 'Barang Id', 'type' => 'select', 'value' => $detail_pemesanan->barang_id, 'required' => true, 'options' => $ref_barang->all(), 'class' => 'select2', 'id' => 'barang_id'],
			'harga_satuan' => ['label' => 'Harga Satuan', 'type' => 'text', 'value' => $detail_pemesanan->harga_satuan, 'required' => true, 'id' => 'harga_satuan'],
			'jumlah' => ['label' => 'Jumlah', 'type' => 'text', 'value' => $detail_pemesanan->jumlah, 'required' => true, 'id' => 'jumlah'],
			'subtotal' => ['label' => 'Subtotal', 'type' => 'text', 'value' => $detail_pemesanan->subtotal, 'required' => true, 'id' => 'subtotal'],
			'transaksi_id' => ['label' => 'Transaksi Id', 'type' => 'select', 'value' => $detail_pemesanan->transaksi_id, 'required' => true, 'options' => $ref_transaksi->all(), 'class' => 'select2', 'id' => 'transaksi_id'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$detail_pemesanan->what;
		$this->log($request, $text, ['detail_pemesanan.id' => $detail_pemesanan->id]);
		return view('Detail_pemesanan::detail_pemesanan_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'barang_id' => 'required',
			'harga_satuan' => 'required',
			'jumlah' => 'required',
			'subtotal' => 'required',
			'transaksi_id' => 'required',
			
		]);

		$detail_pemesanan = Detail_pemesanan::find($id);
		$detail_pemesanan->barang_id = $request->input("barang_id");
		$detail_pemesanan->harga_satuan = $request->input("harga_satuan");
		$detail_pemesanan->jumlah = $request->input("jumlah");
		$detail_pemesanan->subtotal = $request->input("subtotal");
		$detail_pemesanan->transaksi_id = $request->input("transaksi_id");
		
		$detail_pemesanan->updated_by = Auth::id();
		$detail_pemesanan->save();


		$text = 'mengedit '.$this->title;//.' '.$detail_pemesanan->what;
		$this->log($request, $text, ['detail_pemesanan.id' => $detail_pemesanan->id]);
		return redirect()->route('detail_pemesanan.index')->with('message_success', 'Detail Pemesanan berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$detail_pemesanan = Detail_pemesanan::find($id);
		$detail_pemesanan->deleted_by = Auth::id();
		$detail_pemesanan->save();
		$detail_pemesanan->delete();

		$text = 'menghapus '.$this->title;//.' '.$detail_pemesanan->what;
		$this->log($request, $text, ['detail_pemesanan.id' => $detail_pemesanan->id]);
		return back()->with('message_success', 'Detail Pemesanan berhasil dihapus!');
	}

}
