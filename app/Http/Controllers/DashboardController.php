<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\FoundItem;
use App\Models\LostItem;
use App\Models\SystemLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function user()
    {
        $myLostItems = LostItem::where('user_id', Auth::id())->count();
        $myClaims = Claim::where('user_id', Auth::id())->count();

        return view('dashboard.user', compact('myLostItems', 'myClaims'));
    }

    public function admin()
    {
        $foundItemsInStorage = FoundItem::where('status', 'in_storage')->count();
        $pendingClaims = Claim::where('status', 'pending')->count();
        $activeLostItems = LostItem::where('status', 'pending')->count();

        $totalClaims = Claim::count();
        $approvedClaims = Claim::where('status', 'approved')->count();
        $resolutionRate = $totalClaims > 0 ? round(($approvedClaims / $totalClaims) * 100) : 0;

        $frequentlyLostItems = LostItem::selectRaw('category_id, count(*) as total')
            ->with('category')
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $hotspotLocations = LostItem::selectRaw('location, count(*) as total')
            ->groupBy('location')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('dashboard.admin', compact(
            'foundItemsInStorage',
            'pendingClaims',
            'activeLostItems',
            'resolutionRate',
            'frequentlyLostItems',
            'hotspotLocations'
        ));
    }

    public function superAdmin()
    {
        $totalUsers = User::count();
        $totalItems = LostItem::count() + FoundItem::count();
        $systemLogs = SystemLog::count();

        return view('dashboard.super-admin', compact('totalUsers', 'totalItems', 'systemLogs'));
    }
}
