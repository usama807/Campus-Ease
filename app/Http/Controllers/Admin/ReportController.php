<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\FoundItem;
use App\Models\LostItem;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function runCleanup()
    {
        $expirationDays = (int) Setting::get('unclaimed_item_expiration_days', 60);
        $cutoff = Carbon::now()->subDays($expirationDays);

        $count = FoundItem::where('status', 'in_storage')
            ->where('date_found', '<=', $cutoff)
            ->update(['status' => 'donated']);

        return redirect()->route('admin.reports.index')
            ->with('status', "$count unclaimed item(s) older than {$expirationDays} days moved to Donated status.");
    }

    public function index()
    {
        $stats = $this->summaryStats();

        return view('admin.reports.index', $stats);
    }

    public function exportPdf()
    {
        $stats = $this->summaryStats();

        $pdf = Pdf::loadView('admin.reports.pdf', $stats);

        return $pdf->download('campus-ease-summary-report.pdf');
    }

    public function exportCsv()
    {
        $foundItems = FoundItem::with('category')->latest()->get();

        $callback = function () use ($foundItems) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Item Name', 'Category', 'Status', 'Date Found', 'Location Found', 'Storage Location']);

            foreach ($foundItems as $item) {
                fputcsv($handle, [
                    $item->item_name,
                    $item->category->name,
                    $item->status,
                    $item->date_found->format('Y-m-d'),
                    $item->location_found,
                    $item->storage_location,
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="campus-ease-found-items.csv"',
        ]);
    }

    private function summaryStats(): array
    {
        $totalClaims = Claim::count();
        $approvedClaims = Claim::where('status', 'approved')->count();

        return [
            'totalLostItems' => LostItem::count(),
            'totalFoundItems' => FoundItem::count(),
            'pendingClaims' => Claim::where('status', 'pending')->count(),
            'approvedClaims' => $approvedClaims,
            'rejectedClaims' => Claim::where('status', 'rejected')->count(),
            'resolutionRate' => $totalClaims > 0 ? round(($approvedClaims / $totalClaims) * 100) : 0,
            'frequentlyLostItems' => LostItem::selectRaw('category_id, count(*) as total')
                ->with('category')
                ->groupBy('category_id')
                ->orderByDesc('total')
                ->take(5)
                ->get(),
            'hotspotLocations' => LostItem::selectRaw('location, count(*) as total')
                ->groupBy('location')
                ->orderByDesc('total')
                ->take(5)
                ->get(),
        ];
    }
}
