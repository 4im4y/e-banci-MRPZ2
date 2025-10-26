<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Household;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard
     */
    public function index()
    {
        // Get statistics
        $stats = [
            'total_members' => Member::count(),
            'active_members' => Member::where('is_active', true)->count(),
            'total_households' => Household::count(),
            'total_zones' => Zone::where('is_active', true)->count(),
            'male_members' => Member::where('gender', 'male')->count(),
            'female_members' => Member::where('gender', 'female')->count(),
        ];

        // Get recent members (last 5)
        $recentMembers = Member::with('households')
            ->latest()
            ->take(5)
            ->get();

        // Get members by zone
        $membersByZone = Zone::withCount(['households', 'households as members_count' => function ($query) {
            $query->join('household_members', 'households.id', '=', 'household_members.household_id');
        }])
            ->where('is_active', true)
            ->get();

        // Get members by gender for chart
        $genderData = [
            'labels' => ['Lelaki', 'Perempuan'],
            'data' => [$stats['male_members'], $stats['female_members']],
        ];

        // Get members by marital status
        $maritalStatusData = Member::select('marital_status', DB::raw('count(*) as count'))
            ->groupBy('marital_status')
            ->get();

        return view('dashboard', compact(
            'stats',
            'recentMembers',
            'membersByZone',
            'genderData',
            'maritalStatusData'
        ));
    }
}