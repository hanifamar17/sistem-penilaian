<?php


namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\WaliKelas;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admin = Admin::all();

        return view('admin/home', compact('admin'));
    }

    public function guruIndex(Request $request)
    {
        $guru = Guru::all();

        return view('admin/guru-home', compact('guru'));
    }

    public function kelasIndex(Request $request)
    {
        $kelas = Kelas::all();

        return view('admin/kelas-home', compact('kelas'));
    }

    public function adminAdd()
    {
        return view('admin.admin-add');
    }

    public function adminInsert(Request $request){
        //Admin::create($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admin,email',
            'password' => 'required|string|min:8',
        ]);

        // Membuat user baru dengan hashing password
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            //'password' => Hash::make($request->password),
            'password' => $request->password,
            'role' =>  'Admin',
        ]);

        return redirect()->route('home')->with('success', 'Data berhasil ditambahkan!');
    }

    public function adminDelete($id)
    {
        $admin_delete = Admin::find($id);
        $admin_delete->delete();

        return redirect()->route('home')->with('delete', 'Data berhasil dihapus!');
    }

    public function adminUpdateForm($id)
    {
        //$admin = Admin::where('id', $id) -> get();
        $admin = Admin::findOrFail($id);

        return view('admin.admin-update-form', compact('admin'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('admin')->ignore($id),
            ],
            'password' => 'nullable|string|min:8',
        ]);
        
        $admin = Admin::findOrFail($id);

        $dataToUpdate = [
            'name' => $request->name ?? $admin->name, // Menggunakan nama lama jika tidak diubah
            'email' => $request->email ?? $admin->email, // Menggunakan email lama jika tidak diubah
            'password' =>  $request->password ?? $admin->password, // Menggunakan password lama
        ];

        $admin->update($dataToUpdate);

        return redirect()->route('home')->with('updated','Data Berhasil Diperbarui');
    }

    public function adminView($id)
    {
        $admin = Admin::where('id', $id) -> get();

        return view('admin.admin-view', compact('admin'));
    }

    //GURU
    public function guruAdd()
    {
        return view('admin.guru-add');
    }

    public function guruInsert(Request $request){
        //Admin::create($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:guru,email',
            'password' => 'required|string|min:8',
            'nip' =>  'required|string|max:20|unique:guru,nip',
        ]);

        // Membuat user baru dengan hashing password
        Guru::create([
            'name' => $request->name,
            'email' => $request->email,
            //'password' => Hash::make($request->password),
            'password' => $request->password,
            'nip' => $request->nip,
            'role' =>  'Guru',
        ]);

        return redirect()->route('guru-home')->with('success', 'Data berhasil ditambahkan!');
    }

    public function guruDelete($id)
    {
        $guru_delete = Guru::find($id);
        $guru_delete->delete();

        return redirect()->route('guru-home')->with('delete', 'Data berhasil dihapus!');
    }

    public function guruUpdateForm($id)
    {
        //$guru = Guru::where('id', $id) -> get();
        $guru = Guru::findOrFail($id);

        return view('admin.guru-update-form', compact('guru'));
    }

    public function guruUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('guru')->ignore($id),
            ],
            'password' => 'nullable|string|min:8',
            'nip' =>   [
                'nullable', 
                'string',
                'max:20',
                Rule::unique('guru')->ignore($id),
            ],
        ]);
        
        $guru = Guru::findOrFail($id);

        $dataToUpdate = [
            'name' => $request->name ?? $guru->name, // Menggunakan nama lama jika tidak diubah
            'email' => $request->email ?? $guru->email, // Menggunakan email lama jika tidak diubah
            'password' =>  $request->password ?? $guru->password, // Menggunakan password lama
            'nip' => $request->nip ?? $guru->nip, // Menggunakan NIP lama jika tidak diubah
        ];

        $guru->update($dataToUpdate);

        return redirect()->route('guru-home')->with('updated','Data Berhasil Diperbarui');
    }

    public function guruView($id)
    {
        $guru = Guru::where('id', $id) -> get();

        return view('admin.guru-view', compact('guru'));
    }

    //KELAS
    public function kelasAdd()
    {
        return view('admin.kelas-add');
    }

    public function kelasInsert(Request $request){
        //Admin::create($request->all());
        //dd($request->all());

        $request->validate([
            'tingkat' => 'required|string',
            'jurusan' => 'required|string|max:50',
        ]);

        // Membuat user baru dengan hashing password
        Kelas::create([
            'tingkat' => $request->tingkat,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('kelas-home')->with('success', 'Data berhasil ditambahkan!');
    }

    public function kelasDelete($id)
    {
        $kelas_delete = Kelas::find($id);
        $kelas_delete->delete();

        return redirect()->route('kelas-home')->with('delete', 'Data berhasil dihapus!');
    }

    public function kelasUpdateForm($id)
    {
        //$guru = Guru::where('id', $id) -> get();
        $kelas = Kelas::findOrFail($id);

        return view('admin.kelas-update-form', compact('kelas'));
    }

    public function kelasUpdate(Request $request, $id)
    {
        $request->validate([
            'tingkat' => 'nullable|string',
            'jurusan' => 'nullable|string',
        ]);
        
        $kelas = Kelas::findOrFail($id);

        $dataToUpdate = [
            'tingkat' => $request->tingkat ?? $kelas->tingkat, 
            'jurusan' =>  $request->jurusan ?? $kelas->jurusan,
        ];

        $kelas->update($dataToUpdate);

        return redirect()->route('kelas-home')->with('updated','Data Berhasil Diperbarui');
    }

    public function kelasView($id)
    {
        $kelas = Kelas::where('id', $id) -> get();

        return view('admin.kelas-view', compact('kelas'));
    }
}
