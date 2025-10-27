<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Household;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    /**
     * Display a listing of members
     */
    public function index(Request $request)
    {
        $query = Member::with('households.zone');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('ic_number', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('membership_number', 'like', "%{$search}%");
            });
        }

        // Filter by gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Filter by marital status
        if ($request->filled('marital_status')) {
            $query->where('marital_status', $request->marital_status);
        }

        // Filter by active status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $members = $query->latest()->paginate(10)->withQueryString();

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member
     */
    public function create()
    {
        $households = Household::with('zone')->get();
        $zones = Zone::active()->get();
        
        // Generate next membership number
        $lastMember = Member::latest('id')->first();
        $nextNumber = $lastMember ? (int)substr($lastMember->membership_number, 3) + 1 : 1;
        $membershipNumber = 'AHM' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return view('members.create', compact('households', 'zones', 'membershipNumber'));
    }

    /**
     * Store a newly created member
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'membership_number' => 'required|unique:members',
            'ic_number' => 'required|digits:12|unique:members',
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female',
            'bangsa' => 'required|in:melayu,china,india,lain-lain',
            'marital_status' => 'nullable|in:single,married,divorced,widowed',
            'phone_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'postcode' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'education_level' => 'nullable|in:no_formal,primary,secondary,diploma,degree,master,phd',
            'notes' => 'nullable|string',
            'household_id' => 'nullable|exists:households,id',
            'relationship' => 'nullable|in:head,spouse,child,parent,sibling,other',
            'is_head' => 'nullable|boolean',
        ]);

        // Create member
        $member = Member::create($validated);

        // Attach to household if provided
        if ($request->filled('household_id')) {
            $member->households()->attach($request->household_id, [
                'relationship' => $request->relationship ?? 'other',
                'is_head' => $request->is_head ?? false,
            ]);
        }

        return redirect()->route('members.index')
            ->with('success', 'Ahli berjaya didaftarkan!');
    }

    /**
     * Display the specified member
     */
    public function show(Member $member)
    {
        $member->load(['households.zone', 'households.members']);

        // dd($member);
        
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified member
     */
    public function edit(Member $member)
    {
        $households = Household::with('zone')->get();
        $zones = Zone::active()->get();
        $currentHousehold = $member->households()->first();

        return view('members.edit', compact('member', 'households', 'zones', 'currentHousehold'));
    }

    /**
     * Update the specified member
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'membership_number' => ['required', Rule::unique('members')->ignore($member->id)],
            'ic_number' => ['required', 'digits:12', Rule::unique('members')->ignore($member->id)],
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female',
            'bangsa' => 'required|in:melayu,china,india,lain-lain',
            'marital_status' => 'nullable|in:single,married,divorced,widowed',
            'phone_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'postcode' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'education_level' => 'nullable|in:no_formal,primary,secondary,diploma,degree,master,phd',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
            'household_id' => 'nullable|exists:households,id',
            'relationship' => 'nullable|in:head,spouse,child,parent,sibling,other',
            'is_head' => 'nullable|boolean',
        ]);

        // Update member
        $member->update($validated);

        // Update household relationship
        if ($request->filled('household_id')) {
            $member->households()->sync([
                $request->household_id => [
                    'relationship' => $request->relationship ?? 'other',
                    'is_head' => $request->is_head ?? false,
                ]
            ]);
        }

        return redirect()->route('members.show', $member)
            ->with('success', 'Maklumat ahli berjaya dikemaskini!');
    }

    /**
     * Remove the specified member
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Ahli berjaya dipadamkan!');
    }
}