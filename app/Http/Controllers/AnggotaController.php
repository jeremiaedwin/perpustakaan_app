<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\User;
use App\Models\LogAnggotaSuccess;
use App\Jobs\createAnggotaJob;
use Auth;
use Carbon;
use DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $anggota = Anggota::all();
        try {
            $anggota = Anggota::all();
            if ($request->ajax()){
                
                return Datatables::of($anggota)->addIndexColumn()
                    ->addColumn('action', function($anggota){
                        
                        $updateButton = '<a href="/anggota/'.$anggota->nis_anggota.'/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                        $deleteButton = '<form action="/anggota/'.$anggota->nis_anggota.'" id="delete-form" method="post">
                                        '. method_field('delete') . csrf_field() .'
                                        <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                                        </form>';
                        return $updateButton." ".$deleteButton;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            //$logging = LogAnggotaSuccess::create([
            //    'id_anggota'=> 'ALL',
            //    'user_id' => Auth::id(),
            //    'activity' => 'Get All Data'
            //]);
            return view('anggota.index');
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function create()
    {
        try {
            $job = new createAnggotaJob();
            $this->dispatch($job);
            return view('anggota.index');
            //return  view('anggota.create');
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Page Not Found'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nis_anggota = $request->nis_anggota;
        $nama_anggota = $request->nama_anggota;
        $alamat_anggota = $request->alamat_anggota;
        $nomor_telepon_anggota = $request->nomor_telepon_anggota;
        $email_anggota = $request->email_anggota;

        try {
            $user = User::create([
                'name' => $nama_anggota,
                'password' => bcrypt('12345678')
            ]);
            $user->assignRole('anggota');

            $anggota = Anggota::create([
                'nis_anggota'=> $nis_anggota,
                'id_user'=> $user->id,
                'nama_anggota'=> $nama_anggota,
                'alamat_anggota'=> $alamat_anggota,
                'nomor_telepon_anggota'=> $nomor_telepon_anggota,
                'email_anggota'=> $user->email
            ]);
            //$logging = LogAnggotaSuccess::create([
            //   'id_anggota'=> $id_anggota,
            //    'user_id'=> Auth::id(),
            //    'activity' => 'Create Data'
            //]);

            return view('anggota.create');
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
    public function show($id)
    {
        //
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anggota = Anggota::find($id);
        try{
            
            return view('anggota.edit', compact('anggota'));
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
            $anggota = Anggota::find($id);
            $anggota->nis_anggota = $anggota->nis_anggota;
            $anggota->nama_anggota = $request->nama_anggota;
            $anggota->alamat_anggota = $request->alamat_anggota;
            $anggota->nomor_telepon_anggota = $request->nomor_telepon_anggota;
            $anggota->email_anggota = $request->email_anggota;
            $anggota->tahun_ajaran = $request->tahun_ajaran;
            $anggota->save();
            //$logging = LogAnggotaSuccess::create([
            //    'id_anggota'=> $id_anggota,
            //    'user_id' => Auth::id(),
            //    'activity' => 'Update Data'
            //]);
            return view('anggota.edit', compact('anggota'));
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
            $anggota = Anggota::find($id);
            //$logging = LogAnggotaSuccess::create([
            //    'id_anggota'=> $anggota->id_anggota,
            //   'user_id' => Auth::id(),
            //    'activity' => 'Delete Data'
            //]);
            $anggota->delete();
            return redirect('/anggota');
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
                    $anggota = Anggota::where('nis_anggota', 'like', '%' . $id . '%')->where('status_anggota', '=', 'aktif')->get();
                    if($anggota)
                    {
                        foreach($anggota as $anggota){
                            $output .= '
                            <tr>
                            <td>'  . 'Nis Anggota' . '</td>
                            <td>'  . $anggota->nis_anggota . '</td>
                            </tr>
                            <tr>
                            <td>'  . 'Nama Anggota' . '</td>
                            <td>'  . $anggota->nama_anggota . '</td>
                            <td><input type="hidden" name="kode_anggota" value="'. $anggota->nis_anggota .'"</input> </td>
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
                }

            
        }
    }
}
