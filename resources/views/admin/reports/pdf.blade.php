<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Campus Ease Summary Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #222; }
        h1 { font-size: 18px; margin-bottom: 0; }
        .subtitle { color: #666; margin-top: 4px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        .stats td { width: 25%; }
    </style>
</head>
<body>
    <h1>Campus Ease - Lost &amp; Found Summary Report</h1>
    <p class="subtitle">Generated {{ now()->format('M d, Y g:i A') }}</p>

    <table class="stats">
        <tr>
            <th>Lost Item Reports</th>
            <th>Found Items Logged</th>
            <th>Pending Claims</th>
            <th>Resolution Rate</th>
        </tr>
        <tr>
            <td>{{ $totalLostItems }}</td>
            <td>{{ $totalFoundItems }}</td>
            <td>{{ $pendingClaims }}</td>
            <td>{{ $resolutionRate }}%</td>
        </tr>
    </table>

    <h3>Claims Breakdown</h3>
    <table>
        <tr><th>Approved</th><th>Pending</th><th>Rejected</th></tr>
        <tr><td>{{ $approvedClaims }}</td><td>{{ $pendingClaims }}</td><td>{{ $rejectedClaims }}</td></tr>
    </table>

    <h3>Frequently Lost Categories</h3>
    <table>
        <tr><th>Category</th><th>Reports</th></tr>
        @forelse ($frequentlyLostItems as $row)
            <tr><td>{{ $row->category->name }}</td><td>{{ $row->total }}</td></tr>
        @empty
            <tr><td colspan="2">No data yet.</td></tr>
        @endforelse
    </table>

    <h3>Campus Hotspot Locations</h3>
    <table>
        <tr><th>Location</th><th>Reports</th></tr>
        @forelse ($hotspotLocations as $row)
            <tr><td>{{ $row->location }}</td><td>{{ $row->total }}</td></tr>
        @empty
            <tr><td colspan="2">No data yet.</td></tr>
        @endforelse
    </table>
</body>
</html>
