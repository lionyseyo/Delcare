<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Route;

class ReviewController extends Controller
{
    // API untuk melihat semua ulasan
    public function getAllReviews()
    {
        $reviews = Review::with('report')->get();

        return response()->json([
            'data' => $reviews,
            'links' => [
                'self' => route('reviews.index'),
            ],
        ]);
    }

    // API untuk melihat ulasan berdasarkan id report
    public function getReviewsByReport($report_id)
    {
        $report = Report::with('reviews')->findOrFail($report_id);
        $reviews = $report->reviews;

        return response()->json([
            'data' => $reviews,
            'links' => [
                'self' => route('reviews.report', ['report' => $report_id]),
                'create_review' => route('reviews.store'),
            ],
        ]);
    }

    // API untuk membuat ulasan
    public function storeReviewAPI(Request $request)
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

        return response()->json([
            'message' => 'Ulasan berhasil disimpan.',
            'data' => $review,
            'links' => [
                'self' => route('reviews.show', ['review' => $review->id]),
                'all_reviews' => route('reviews.index'),
            ],
        ], 201);
    }

    // API untuk menghapus ulasan berdasarkan ID review
    public function deleteReviewAPI($id)
    {
        try {
            $review = Review::findOrFail($id);
            $review->delete();

            return response()->json([
                'message' => 'Ulasan berhasil dihapus.',
                'links' => [
                    'all_reviews' => route('reviews.index'),
                ],
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Ulasan tidak ditemukan.',
                'links' => [
                    'all_reviews' => route('reviews.index'),
                ],
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus ulasan.',
                'links' => [
                    'all_reviews' => route('reviews.index'),
                ],
            ], 500);
        }
    }
}
