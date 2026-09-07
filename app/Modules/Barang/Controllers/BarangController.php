<?php
namespace App\Modules\Barang\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Barang\Models\Barang;
use App\Modules\Kategori\Models\Kategori;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BarangController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Barang";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Barang::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Barang::barang', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_kategori = Kategori::all()->pluck('nama_kategori', 'id');
		
		$data['forms'] = array(
			'gambar' => ['label' => 'Gambar', 'type' => 'file', 'value' => old("gambar"), 'required' => false],
			'harga' => ['label' => 'Harga', 'type' => 'text', 'value' => old("harga"), 'required' => true],
			'kategori_id' => ['label' => 'Kategori Id', 'type' => 'select', 'value' => old("kategori_id"), 'required' => true, 'options' => $ref_kategori->all(), 'class' => 'select2'],
			'nama' => ['label' => 'Nama', 'type' => 'text', 'value' => old("nama"), 'required' => true],
			'stok' => ['label' => 'Stok', 'type' => 'text', 'value' => old("stok"), 'required' => true],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Barang::barang_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validateGambarUpload($request);
		$this->validate($request, [
			'gambar' => 'nullable|file|image|mimes:jpg,jpeg,png|max:10240',
			'harga' => 'required',
			'kategori_id' => 'required',
			'nama' => 'required',
			'stok' => 'required',
			
		]);

		$barang = new Barang();
		if ($request->hasFile('gambar')) {
			$path = $request->file('gambar')->store('barang', 'public');
			$barang->gambar = basename($path);
		} else {
			$barang->gambar = $request->input('gambar');
		}
		$barang->harga = $request->input("harga");
		$barang->kategori_id = $request->input("kategori_id");
		$barang->nama = $request->input("nama");
		$barang->stok = $request->input("stok");
		
		$barang->created_by = Auth::id();
		$barang->save();

		$text = 'membuat '.$this->title; //' baru '.$barang->what;
		$this->log($request, $text, ['barang.id' => $barang->id]);
		return redirect()->route('barang.index')->with('message_success', 'Barang berhasil ditambahkan!');
	}

	public function show(Request $request, Barang $barang)
	{
		$data['barang'] = $barang;

		$text = 'melihat detail '.$this->title;//.' '.$barang->what;
		$this->log($request, $text, ['barang.id' => $barang->id]);
		return view('Barang::barang_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Barang $barang)
	{
		$data['barang'] = $barang;

		$ref_kategori = Kategori::all()->pluck('nama_kategori', 'id');
		
		$data['forms'] = array(
			'gambar' => ['label' => 'Gambar', 'type' => 'file', 'value' => $barang->gambar, 'required' => false, 'id' => 'gambar'],
			'harga' => ['label' => 'Harga', 'type' => 'text', 'value' => $barang->harga, 'required' => true, 'id' => 'harga'],
			'kategori_id' => ['label' => 'Kategori Id', 'type' => 'select', 'value' => $barang->kategori_id, 'required' => true, 'options' => $ref_kategori->all(), 'class' => 'select2', 'id' => 'kategori_id'],
			'nama' => ['label' => 'Nama', 'type' => 'text', 'value' => $barang->nama, 'required' => true, 'id' => 'nama'],
			'stok' => ['label' => 'Stok', 'type' => 'text', 'value' => $barang->stok, 'required' => true, 'id' => 'stok'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$barang->what;
		$this->log($request, $text, ['barang.id' => $barang->id]);
		return view('Barang::barang_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validateGambarUpload($request);
		$this->validate($request, [
			'gambar' => 'nullable|file|image|mimes:jpg,jpeg,png|max:10240',
			'harga' => 'required',
			'kategori_id' => 'required',
			'nama' => 'required',
			'stok' => 'required',
			
		]);

		$barang = Barang::findOrFail($id);
		if ($request->hasFile('gambar')) {
			$path = $request->file('gambar')->store('barang', 'public');
			$barang->gambar = basename($path);
		}
		$barang->harga = $request->input("harga");
		$barang->kategori_id = $request->input("kategori_id");
		$barang->nama = $request->input("nama");
		$barang->stok = $request->input("stok");
		
		$barang->updated_by = Auth::id();
		$barang->save();


		$text = 'mengedit '.$this->title;//.' '.$barang->what;
		$this->log($request, $text, ['barang.id' => $barang->id]);
		return redirect()->route('barang.index')->with('message_success', 'Barang berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$barang = Barang::find($id);
		$barang->deleted_by = Auth::id();
		$barang->save();
		$barang->delete();

		$text = 'menghapus '.$this->title;//.' '.$barang->what;
		$this->log($request, $text, ['barang.id' => $barang->id]);
		return back()->with('message_success', 'Barang berhasil dihapus!');
	}

	private function validateGambarUpload(Request $request): void
	{
		$file = $request->file('gambar');
		if (!$file || $file->isValid()) {
			return;
		}

		$message = match ($file->getError()) {
			UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'Ukuran gambar melebihi batas upload server (maksimal 10 MB).',
			UPLOAD_ERR_PARTIAL => 'Upload gambar tidak selesai. Silakan coba lagi.',
			UPLOAD_ERR_NO_TMP_DIR => 'Folder temporary upload PHP tidak tersedia.',
			UPLOAD_ERR_CANT_WRITE => 'PHP tidak dapat menulis file upload ke disk.',
			UPLOAD_ERR_EXTENSION => 'Upload gambar dihentikan oleh ekstensi PHP.',
			default => 'Upload gambar gagal (kode PHP: '.$file->getError().').',
		};

		throw ValidationException::withMessages(['gambar' => $message]);
	}

}