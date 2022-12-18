<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBuku;
use Illuminate\Support\Facades\DB;

use Auth;
use DataTables;
use Exception;
use Throwable;
use Error;
use Alert;
use Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Response;

class DataBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        $data_buku = DataBuku::all();
        return view('data_buku.index', [
            'data_buku' => $data_buku
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function create()
    {
        return view("data_buku.create");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function store(Request $request)
    {
        $kategori_list = ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6', 'Umum'];
        $topik_list = ['Matematika', 'Seni Budaya', 'IPA', 'IPS', 'PJOK', 'Bahasa Inggris', 'Bahasa Indonesia', 'Novel', 'Sains', 'Sejarah']; 
        
        $judul_buku = $request->judul_buku;
        $penerbit_buku = $request->penerbit_buku;
        $penulis_buku = $request->penulis_buku;
        $kategori = $request->kategori;
        $topik = $request->topik;
        $jumlah_stok = $request->jumlah_stok;
        $jumlah_tersedia = $jumlah_stok;

        try {
            /*
            $validated = $request->validate([
                'id_buku' => 'required',
                'judul_buku' => 'required',
                'penerbit_buku' => 'required',
                'penulis_buku' => 'required',
                'kategori' => 'required',
                'topik' => 'required',
                'jumlah_stok' => 'required',
            ]);*/
            
            $id = IdGenerator::generate([
                'table' => 'data_buku', 
                'field'=> 'id_buku',
                'length' => 15, 
                //'prefix' => 'BK',
                'reset_on_prefix_change' => true,
                'prefix' => $this->prefixGenerator(array_search($kategori, $kategori_list), array_search($topik, $topik_list)) . date('y') . '-'
            ]);
            $id_buku = $id;

            $data_buku = DataBuku::create([
                'id_buku' => $id_buku,
                'judul_buku' => $judul_buku,
                'penerbit_buku' => $penerbit_buku,
                'penulis_buku' => $penulis_buku,
                'kategori' => $kategori,
                'topik' => $topik,
                'jumlah_stok' => $jumlah_stok,
                'jumlah_tersedia' => $jumlah_tersedia
            ]);

            return redirect('data_buku/create');

        } catch (Exception $th) {
            return response()->json([
                'message' => $th
            ], 400);
        }

        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //$value = $request->session()->get('key', 'default');
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_buku = DataBuku::find($id);
        
        try{
            return view('data_buku.edit', compact('data_buku'));
        } catch (\Throwable $th){
            return response()->json([
                'message' => 'Page Not Found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data_buku = DataBuku::find($id);
            $data_buku->judul_buku = $request->judul_buku;
            $data_buku->penerbit_buku = $request->penerbit_buku;
            $data_buku->penulis_buku = $request->penulis_buku;
            $data_buku->kategori = $request->kategori;
            $data_buku->topik = $request->topik; 
            $data_buku->jumlah_stok = $request->jumlah_stok;
            $data_buku->jumlah_tersedia = $request->jumlah_stok;
            $data_buku->save();

            return redirect('/data_buku');
            
        } catch (Exception $th) {
            return response()->json([
                'message' => $th
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data_buku = DataBuku::find($id);
            $data_buku->delete();
            return redirect('/data_buku');
        } catch (Extection $th) {
            return response()->json([
                'message' => $th
            ], 400);
        }
    }

    public function search(Request $request, $id){
        if($request->ajax()){
            
            $output="";
                if($id != null){
                    $buku = DataBuku::where('id_buku', 'like', '%' . $id . '%')->get();
                    if($buku)
                    {
                        foreach($buku as $buku){
                            $output .= '
                            <tr>
                            <td>'  . 'Kode Buku' . '</td>
                            <td>'  . $buku->id_buku . '</td>
                            </tr>
                            <tr>
                            <td>'  . 'Judul Buku' . '</td>
                            <td>'  . $buku->judul_buku . '</td>
                            <td><input type="hidden" name="kode_buku" value="'. $buku->id_buku .'"</input> </td>
                            </tr>
                            ';
                        }
                        $data = array(
                            'table_data' => $output
                        );
                        return Response::json($data);
                    }else{
                        $output .= '
                        <tr>
                            <td>' . 'data not found' . '</td>
                        </tr>
                        ';
                        $data = array(
                            'table_data' => $output
                        );
                        return Response::json($data);
                    }
                }else{
                    $output .= '
                        <tr>
                        <td>' . '' . '</td>
                        </tr>
                        ';
                        $data = array(
                            'table_data' => $output
                        );
                        return Response::json($data);
                
    public function prefixGenerator($category_id, $topic_id){
        
        $kategori_tag = ['01', '02', '03', '04', '05', '06', 'UM'];
        $topic_tag = ['MTK', 'SBD', 'IPA', 'IPS', 'OLG', 'ING', 'IND', 'NOV', 'SAI', 'SEJ'];

        $prefix = 'BK' . '-' . $kategori_tag[$category_id] . '-'. $topic_tag[$topic_id] . '-'; 

        return $prefix;
    }
}
