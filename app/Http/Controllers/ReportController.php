<?php
namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;


use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Review;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_handphone' => 'required|string|max:20',
            'program_studi' => 'required|string',
            'lokasi_kerusakan' => 'required|string',
            'deskripsi_kerusakan' => 'required|string',
            'foto_kerusakan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ditujukan_kepada' => 'required|string', // Tambahkan validasi untuk "ditujukan_kepada"
            
        ]);
    
        $data = $request->only([
            'nama_lengkap', 'nomor_handphone', 'program_studi',
            'lokasi_kerusakan', 'deskripsi_kerusakan', 'ditujukan_kepada'
        ]);
    
        if ($request->hasFile('foto_kerusakan')) {
            $imageName = time().'.'.$request->foto_kerusakan->extension();
            $request->foto_kerusakan->move(public_path('uploads'), $imageName);
            $data['foto_kerusakan'] = $imageName;
        }
    
        Report::create($data);
    
        return redirect()->route('form')->with('success', 'Laporan telah berhasil dikirim!');
    }

    public function storeAPI(Request $request)
{
    // Validasi data request
    $validated = $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'nomor_handphone' => 'required|string|max:20',
        'program_studi' => 'required|string',
        'lokasi_kerusakan' => 'required|string',
        'deskripsi_kerusakan' => 'required|string',
        'foto_kerusakan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'ditujukan_kepada' => 'required|string',
    ]);

    try {
        // Ambil data dari request
        $data = $request->only([
            'nama_lengkap', 'nomor_handphone', 'program_studi',
            'lokasi_kerusakan', 'deskripsi_kerusakan', 'ditujukan_kepada'
        ]);

        // Jika ada file foto kerusakan
        if ($request->hasFile('foto_kerusakan')) {
            $imageName = time() . '.' . $request->foto_kerusakan->extension();
            $request->foto_kerusakan->move(public_path('uploads'), $imageName);
            $data['foto_kerusakan'] = $imageName;
        }

        // Simpan data ke database
        $report = Report::create($data);

        // Kembalikan respons JSON berhasil
        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dikirim!',
            'data' => $report
        ], 201); // HTTP 201 Created

    } catch (\Exception $e) {
        // Kembalikan respons JSON jika terjadi kesalahan
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat mengirim laporan.',
            'error' => $e->getMessage()
        ], 500); // HTTP 500 Internal Server Error
    }
}

// hateoas
    public function hateoasAPI(Request $request)
{
    // Validasi data request
    $validated = $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'nomor_handphone' => 'required|string|max:20',
        'program_studi' => 'required|string',
        'lokasi_kerusakan' => 'required|string',
        'deskripsi_kerusakan' => 'required|string',
        'foto_kerusakan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'ditujukan_kepada' => 'required|string',
    ]);

    try {
        // Ambil data dari request
        $data = $request->only([
            'nama_lengkap', 'nomor_handphone', 'program_studi',
            'lokasi_kerusakan', 'deskripsi_kerusakan', 'ditujukan_kepada'
        ]);

        // Jika ada file foto kerusakan
        if ($request->hasFile('foto_kerusakan')) {
            $imageName = time() . '.' . $request->foto_kerusakan->extension();
            $request->foto_kerusakan->move(public_path('uploads'), $imageName);
            $data['foto_kerusakan'] = $imageName;
        }

        // Simpan data ke database
        $report = Report::create($data);

        // Tambahkan HATEOAS links
        $links = [
            'self' => route('reports.show', ['id' => $report->id]),
            'all_reports' => route('api.report.get'),
        ];

        // Kembalikan respons JSON berhasil
        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dikirim!',
            'data' => $report,
            'links' => $links
        ], 201); // HTTP 201 Created

    } catch (\Exception $e) {
        // Kembalikan respons JSON jika terjadi kesalahan
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat mengirim laporan.',
            'error' => $e->getMessage()
        ], 500); // HTTP 500 Internal Server Error
    }
}

// hateoas reports.show
public function show($id)
{
    try {
        // Cari laporan berdasarkan ID
        $report = Report::findOrFail($id);

        // Tambahkan HATEOAS links
        $links = [
            'self' => route('reports.show', ['id' => $report->id]),
            'update' => route('reports.update', ['id' => $report->id]),
            'delete' => route('reports.destroy', ['id' => $report->id]),
            'all_reports' => route('reports.index'),
        ];

        // Kembalikan respons JSON
        return response()->json([
            'success' => true,
            'data' => $report,
            'links' => $links
        ], 200); // HTTP 200 OK

    } catch (ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Laporan tidak ditemukan.',
        ], 404); // HTTP 404 Not Found
    }
}

public function update(Request $request, $id)
{
    try {
        // Cari laporan berdasarkan ID
        $report = Report::findOrFail($id);

        // Validasi data yang akan diperbarui
        $validated = $request->validate([
            'nama_lengkap' => 'sometimes|required|string|max:255',
            'nomor_handphone' => 'sometimes|required|string|max:20',
            'program_studi' => 'sometimes|required|string',
            'lokasi_kerusakan' => 'sometimes|required|string',
            'deskripsi_kerusakan' => 'sometimes|required|string',
            'foto_kerusakan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ditujukan_kepada' => 'sometimes|required|string',
        ]);

        // Perbarui data laporan
        $data = $request->only([
            'nama_lengkap', 'nomor_handphone', 'program_studi',
            'lokasi_kerusakan', 'deskripsi_kerusakan', 'ditujukan_kepada'
        ]);

        // Jika ada file foto kerusakan baru
        if ($request->hasFile('foto_kerusakan')) {
            $imageName = time() . '.' . $request->foto_kerusakan->extension();
            $request->foto_kerusakan->move(public_path('uploads'), $imageName);
            $data['foto_kerusakan'] = $imageName;

            // Hapus foto lama jika ada
            if ($report->foto_kerusakan) {
                unlink(public_path('uploads/' . $report->foto_kerusakan));
            }
        }

        $report->update($data);

        // Kembalikan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil diperbarui.',
            'data' => $report
        ], 200); // HTTP 200 OK

    } catch (ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Laporan tidak ditemukan.',
        ], 404); // HTTP 404 Not Found

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat memperbarui laporan.',
            'error' => $e->getMessage()
        ], 500); // HTTP 500 Internal Server Error
    }
}
public function destroy($id)
{
    $review = Review::findOrFail($id);
    $review->delete();

    return redirect()->back()->with('success', 'Review telah dihapus.');
}


    public function getAllReports(Request $request)
    {
        // Ambil semua data laporan dari database
        $reports = Report::all();

        // Jika permintaan ingin JSON, kembalikan data dalam format JSON
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Data laporan berhasil diambil',
                'data' => $reports
            ], 200);
        }

        // Jika bukan JSON, bisa mengembalikan view atau response lain
        return response()->json([
            'message' => 'Data laporan berhasil diambil',
            'data' => $reports
        ], 200);
    }
        
    public function index(Request $request)
    {
        // Jika ada ID yang diterima, tampilkan laporan tertentu
        if ($request->has('id')) {
            $reports = Report::where('id', $request->id)->get();
        } else {
            // Jika tidak, tampilkan semua laporan
            $reports = Report::all();
        }
        
        return view('duktek_form', compact('reports'));
    }

    
    
    public function lacak()
    {
        $reports = Report::select('id', 'deskripsi_kerusakan', 'lokasi_kerusakan', 'ditujukan_kepada')->get();
        return view('lacak', compact('reports'));
    }
    
    public function lacak_dm()
    {
        $reports = Report::select('id', 'deskripsi_kerusakan', 'lokasi_kerusakan', 'ditujukan_kepada', 'status', 'rejection_reason')->get();
        return view('lacak_dm', compact('reports'));
    }
    
    
public function duktek()
{
    // Ambil data dari tabel reports
    $reports = Report::select('id', 'deskripsi_kerusakan', 'lokasi_kerusakan', 'ditujukan_kepada')->get();
    
    // Kirim data ke view 'lacak'
    return view('lacak', compact('reports'));
}



public function reject(Request $request, $id)
{
    $report = Report::findOrFail($id);
    $report->status = 'rejected';
    $report->rejection_reason = $request->input('rejection_reason');
    $report->save();

    // Kirim notifikasi ke mahasiswa
    return redirect()->back()->with('success', 'Laporan berhasil ditolak.');
}

public function dashboard()
{
    // Hitung laporan berdasarkan status
    $totalReports = Report::count();
    $acceptedReports = Report::where('status', 'accepted')->count();
    $rejectedReports = Report::where('status', 'rejected')->count();

    // Kirim data ke view
    return view('dashboard', compact('totalReports', 'acceptedReports', 'rejectedReports'));
}

public function accept($id)
{
    $report = Report::findOrFail($id);
    $report->status = 'accepted';
    $report->save();

    return redirect()->back()->with('success', 'Laporan berhasil diterima.');
}

public function complete($id)
{
    $report = Report::findOrFail($id);

    if ($report->status !== 'accepted') {
        return redirect()->back()->with('error', 'Hanya laporan yang telah diterima dapat diselesaikan.');
    }

    $report->status = 'completed';  // Tandai laporan sebagai selesai
    $report->save();

    return redirect()->back()->with('success', 'Laporan telah diselesaikan.');
}
public function submitReview(Request $request, $id)
{
    $request->validate([
        'review' => 'required|string|max:1000',
        'rating' => 'nullable|integer|min:1|max:5',
    ]);

    try {
        $report = Report::findOrFail($id);

        if ($report->status !== 'completed') {
            return redirect()->back()->with('error', 'Ulasan hanya dapat diberikan jika laporan telah selesai.');
        }

        Review::create([
            'report_id' => $id,
            'review' => $request->input('review'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->route('lacak_dm')->with('success', 'Ulasan berhasil disimpan.');
    } catch (ModelNotFoundException $e) {
        return redirect()->route('lacak_dm')->with('error', 'Laporan tidak ditemukan.');
    }
}
public function showReview($id)
{
    $report = Report::with('reviews')->findOrFail($id);

    return view('isi_ulasan', compact('report'));
}

public function lacak_ulasan()
{
    $reports = Report::with('reviews') // Mengambil relasi review dari tabel report
        ->whereHas('reviews') // Hanya laporan yang memiliki review
        ->select('id', 'deskripsi_kerusakan', 'lokasi_kerusakan', 'ditujukan_kepada')
        ->get();

    return view('lacak_ulasan', compact('reports'));
}
public function markAsCompleted($id)
{
    $report = Report::findOrFail($id);
    $report->status = 'completed'; // Mengubah status menjadi 'Selesai'
    $report->save();

    return redirect()->back()->with('success', 'Laporan berhasil diselesaikan.');
}
public function storeReview(Request $request)
{
    $request->validate([
        'report_id' => 'required|exists:reports,id',
        'review' => 'required|string|max:1000',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $review = new Review();
    $review->report_id = $request->input('report_id');
    $review->review = $request->input('review');
    $review->rating = $request->input('rating');
    $review->save();

    // Kembali ke halaman sebelumnya
    return redirect()->back()->with('success', 'Ulasan berhasil disimpan.');
}

public function deleteReviewAPI($id)
{
    try {
        $review = Review::findOrFail($id);

        // Menghapus review dari database
        $review->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    } catch (ModelNotFoundException $e) {
        return redirect()->back()->with('error', 'Ulasan tidak ditemukan.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus ulasan.');
    }
}



    // Hapus foto dari folder uploads jika ada
    // if ($report->foto_kerusakan && file_exists(public_path('uploads/' . $report->foto_kerusakan))) {
    //     unlink(public_path('uploads/' . $report->foto_kerusakan));
    // }

    // $report->delete();

    // return redirect()->route('duktek_form');



    // Hapus foto dari folder uploads jika ada
    // if ($report->foto_kerusakan && file_exists(public_path('uploads/' . $report->foto_kerusakan))) {
    //     unlink(public_path('uploads/' . $report->foto_kerusakan));
    // }

    // $report->delete();

    // return redirect()->route('duktek_form');
}



//UNTUK API