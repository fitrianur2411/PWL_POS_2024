<?php

namespace App\Http\Controllers;

use App\Models\kategorimodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    // Menampilkan halaman awal kategori
    public function index(){
            $breadcrumb = (object)[
                'title'=>'Daftar kategori barang',
                'list'=>['Home','kategori']
            ];
            $page = (object)[
                'title'=>'Daftar kategori barang yang terdaftar dalam sistem '
            ];
            $activeMenu ='kategori';
            $kategori = kategorimodel::all();
            return view('kategori.index',['breadcrumb'=>$breadcrumb,'page'=>$page,'activeMenu'=>$activeMenu,'kategori'=>$kategori]);
    }

    // Ambil data kategori dalam bentuk json untuk datatables
    public function list(Request $request){
        $kategori = kategorimodel::select('kategori_id','kategori_kode','kategori_nama');
        if($request->kategori_id){
            $kategori->where('kategori_id',$request->kategori_id);
        }
        return DataTables::of($kategori)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) { // menambahkan kolom aksi
                // $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btnsm">Detail</a> ';
                // $btn .= '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                $btn  = '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> '; 
                $btn .= '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> '; 
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan halaman form tambah kategori
    public function create(){
        $breadcrumb = (object)[
            'title'=>'Tambah kategori barang',
            'list'=>['Home','kategori','tambah']
        ];
        $page = (object)[
            'title'=>'Tambah kategori barang baru'
        ];
        $activeMenu = 'kategori';
        $kategori = kategorimodel::all();
        return view('kategori.create',['breadcrumb'=>$breadcrumb,'page'=>$page,'activeMenu'=>$activeMenu,'kategori'=>$kategori]);
    }

    // Menyimpan data kategori baru
    public function store(Request $request){
        $request->validate([
            'kategori_kode'=>'required|string|min:3|unique:m_kategori,kategori_kode',
            'kategori_nama'=>'required|string|max:100'
        ]);
        kategorimodel::create([
            'kategori_kode'=>$request->kategori_kode,
            'kategori_nama'=>$request->kategori_nama,
        ]);
        return redirect('/kategori')->with('success','Data kategori berhasil disimpan');
    }

    // Menampilkan detail kategori
    public function show(string $kategori_id){
        $kategori = kategorimodel::find($kategori_id);
        $breadcrumb = (object)[
            'title'=>'Detail Kategori',
            'list'=>['Home','kategori','detail']
        ];
        $page = (object)[
            'title'=>'Detail kategori'
        ];
        $activeMenu ='kategori';
        return view('kategori.show',['breadcrumb'=>$breadcrumb,'page'=>$page,'activeMenu'=>$activeMenu,'kategori'=>$kategori]);
    }

    // Menampilkan halaman form edit kategori
    public function edit(string $kategori_id){
        $kategori = kategorimodel::find($kategori_id);

        $breadcrumb = (object)[
            'title'=>'Edit kategori',
            'list'=>['Home','kategori','edit']
        ];
        $page = (object)[
            'title'=>'Edit kategori'
        ];
        $activeMenu ='kategori';
        return view('kategori.edit',['breadcrumb'=>$breadcrumb,'page'=>$page,'activeMenu'=>$activeMenu,'kategori'=>$kategori]);
    }

     // Menyimpan perubahan data kategori
    public function update(Request $request, string $kategori_id){
        $request->validate([
            'kategori_kode'=>'required|string|min:3|unique:m_kategori,kategori_kode',
            'kategori_nama'=>'required|string|max:100'
        ]);
        $kategori = kategorimodel::find($kategori_id);
        $kategori->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama'=>$request->kategori_nama
        ]);
        return redirect('/kategori')->with('success','Data kategori berhasil diperbarui');
    }

    // Menghapus data kategori
    public function destroy(string $kategori_id){
        $check = kategorimodel::find($kategori_id);
        if (!$check) {
            return redirect('/kategori')->with('error', 'Data level tidak ditemukan');
        }
        try {
            kategorimodel::destroy($kategori_id);
            return redirect('/kategori')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kategori')->with('error', 'Data level gagal dhapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax() {
        return view('kategori.create_ajax');
    }
    
    // Storing new Kategori via AJAX
    public function store_ajax(Request $request) {
        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_nama' => 'required|string|min:3|unique:m_kategori,kategori_nama',
                'kategori_kode' => 'required|string|min:2|unique:m_kategori,kategori_kode'
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
    
            KategoriModel::create($request->all());
    
            return response()->json([
                'status' => true,
                'message' => 'Data kategori berhasil disimpan'
            ]);
        }
    
        return redirect('/');
    }
    
    // Displaying edit form for Kategori via AJAX
    public function edit_ajax(string $id) {
        $kategori = KategoriModel::find($id);
    
        return view('kategori.edit_ajax', ['kategori' => $kategori]);
    }
    
    // Updating Kategori via AJAX
    public function update_ajax(Request $request, $id) {
        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_nama' => 'required|string|max:100|unique:m_kategori,kategori_nama,'.$id.',kategori_id',
                'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
    
            $kategori = KategoriModel::find($id);
            if($kategori) {
                $kategori->update($request->all());
    
                return response()->json([
                    'status' => true,
                    'message' => 'Data kategori berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
    
        return redirect('/');
    }
    
    // Confirming Kategori deletion via AJAX
    public function confirm_ajax(string $id) {
        $kategori = KategoriModel::find($id);
    
        return view('kategori.confirm_ajax', ['kategori' => $kategori]);
    }
    
    // Deleting Kategori via AJAX
    public function delete_ajax(Request $request, $id) {
        if($request->ajax() || $request->wantsJson()) {
            $kategori = KategoriModel::find($id);
    
            if($kategori) {
                $kategori->delete();
    
                return response()->json([
                    'status' => true,
                    'message' => 'Data kategori berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
    
        return redirect('/');
    }
}
