<?php

namespace App\Http\Controllers;

use App\Models\Household;
use App\Models\Zone;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HouseholdController extends Controller
{
    /**
     * Display a listing of households
     */
    public function index(Request $request)
    {
        $query = Household::with(['zone', 'members']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('household_number', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        // Filter by zone
        if ($request->filled('zone_id')) {
            $query->where('zone_id', $request->zone_id);
        }

        // Filter by income range
        if ($request->filled('income_range')) {
            $query->where('income_range', $request->income_range);
        }

        $households = $query->withCount('members')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $zones = Zone::active()->get();

        return view('households.index', compact('households', 'zones'));
    }

    /**
     * Show the form for creating a new household
     */
    public function create()
    {
        $zones = Zone::active()->get();
        $members = Member::active()->get();
        
        // Generate next household number
        $lastHousehold = Household::latest('id')->first();
        $nextNumber = $lastHousehold ? (int)substr($lastHousehold->household_number, 2) + 1 : 1;
        $householdNumber = 'KK' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return view('households.create', compact('zones', 'members', 'householdNumber'));
    }

    /**
     * Store a newly created household
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'household_number' => 'required|unique:households',
            'zone_id' => 'required|exists:zones,id',
            'address' => 'required|string',
            'postcode' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'income_range' => 'nullable|in:below_2000,2000_3999,4000_5999,6000_7999,8000_9999,above_10000',
            'pemilikan_rumah' => 'required|in:rumah_sendiri,rumah_sewa',
            'notes' => 'nullable|string',
        ]);

        $household = Household::create($validated);

        return redirect()->route('households.show', $household)
            ->with('success', 'Keluarga berjaya didaftarkan!');
    }

    /**
     * Display the specified household
     */
    public function show(Household $household)
    {
        $household->load(['zone', 'members']);
        
        // Available members not in this household
        $availableMembers = Member::active()
            ->whereDoesntHave('households', function($query) use ($household) {
                $query->where('household_id', $household->id);
            })
            ->get();

        return view('households.show', compact('household', 'availableMembers'));
    }

    /**
     * Show the form for editing the specified household
     */
    public function edit(Household $household)
    {
        $zones = Zone::active()->get();
        
        return view('households.edit', compact('household', 'zones'));
    }

    /**
     * Update the specified household
     */
    public function update(Request $request, Household $household)
    {
        $validated = $request->validate([
            'household_number' => ['required', Rule::unique('households')->ignore($household->id)],
            'zone_id' => 'required|exists:zones,id',
            'address' => 'required|string',
            'postcode' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'income_range' => 'nullable|in:below_2000,2000_3999,4000_5999,6000_7999,8000_9999,above_10000',
            'pemilikan_rumah' => 'required|in:rumah_sendiri,rumah_sewa',
            'notes' => 'nullable|string',
        ]);

        $household->update($validated);

        return redirect()->route('households.show', $household)
            ->with('success', 'Maklumat keluarga berjaya dikemaskini!');
    }

    /**
     * Remove the specified household
     */
    public function destroy(Household $household)
    {
        // Detach all members first
        $household->members()->detach();
        
        $household->delete();

        return redirect()->route('households.index')
            ->with('success', 'Keluarga berjaya dipadamkan!');
    }

    /**
     * Add member to household
     */
    public function addMember(Request $request, Household $household)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'relationship' => 'required|in:head,spouse,child,parent,sibling,other',
            'is_head' => 'boolean',
        ]);

        // Check if member already in household
        if ($household->members()->where('member_id', $validated['member_id'])->exists()) {
            return back()->with('error', 'Ahli ini sudah berada dalam keluarga!');
        }

        // If this member is head, remove head status from others
        if ($request->is_head) {
            $household->members()->updateExistingPivot(
                $household->members()->pluck('members.id')->toArray(),
                ['is_head' => false]
            );
        }

        $household->members()->attach($validated['member_id'], [
            'relationship' => $validated['relationship'],
            'is_head' => $validated['is_head'] ?? false,
        ]);

        return back()->with('success', 'Ahli berjaya ditambah ke dalam keluarga!');
    }

    /**
     * Remove member from household
     */
    public function removeMember(Household $household, Member $member)
    {
        $household->members()->detach($member->id);

        return back()->with('success', 'Ahli berjaya dikeluarkan dari keluarga!');
    }

    /**
     * Update member relationship in household
     */
    public function updateMember(Request $request, Household $household, Member $member)
    {
        $validated = $request->validate([
            'relationship' => 'required|in:head,spouse,child,parent,sibling,other',
            'is_head' => 'boolean',
        ]);

        // If this member is head, remove head status from others
        if ($request->is_head) {
            $household->members()->updateExistingPivot(
                $household->members()->where('members.id', '!=', $member->id)->pluck('members.id')->toArray(),
                ['is_head' => false]
            );
        }

        $household->members()->updateExistingPivot($member->id, [
            'relationship' => $validated['relationship'],
            'is_head' => $validated['is_head'] ?? false,
        ]);

        return back()->with('success', 'Maklumat ahli dalam keluarga berjaya dikemaskini!');
    }
}