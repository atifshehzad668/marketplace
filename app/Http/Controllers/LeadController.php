<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::with('customer')->paginate();

        return view('leads.index', get_defined_vars());
    }
    public function create()
    {
        $salemans = User::role('Salesman')->get();

        $customers = Customer::all();
        return view('leads.create', get_defined_vars());
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'lead_date' => 'required|date',
            'lead_number' => 'required|numeric',
            'lead_vehicle' => 'required|string|max:255',
            'lead_source' => 'required|string|max:255',
            'customer_id' => 'nullable', // If customer exists
            'saleman_id' => 'required', // If customer exists
            'name' => 'required_if:customer_id,0|string|max:255',
            'email' => 'required_if:customer_id,0|email|max:255',
            'phone' => 'required_if:customer_id,0|regex:/^[0-9\+\-\(\)\s]{7,20}$/',
            'address' => 'required_if:customer_id,0|string|max:255',
            'occupation' => 'required_if:customer_id,0|string|max:255', // Required if customer_id is 0
            'dob' => 'required_if:customer_id,0|date',

        ]);

        // If a new customer is being added (customer_id is 0), create a new customer
        if ($request->customer_id == 0) {
            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'occupation' => $request->occupation,
                'dob' => $request->dob,
            ]);
        } else {
            // Find the existing customer
            $customer = Customer::find($request->customer_id);
        }

        // Create a new lead
        $lead = Lead::create([
            'lead_date' => $request->lead_date,
            'lead_number' => $request->lead_number,
            'lead_vehicle' => $request->lead_vehicle,
            'lead_source' => $request->lead_source,
            'customer_id' => $customer->id,
            'saleman_id' => $request->saleman_id,
        ]);

        // Check if the checkbox 'stay_on_page' was checked
        if ($request->stay_on_page) {
            // Redirect back to the lead creation page
            return redirect()->route('leads.create')->with('success', 'Lead saved successfully.');
        } else {
            // Redirect to the leads index page
            return redirect()->route('leads.index')->with('success', 'Lead saved successfully.');
        }
    }

    public function get_customer_data(Request $request)
    {
        $customer_id = $request->input('customer_id');
        $customer = Customer::find($customer_id);

        if ($customer) {
            return response()->json([
                'customer' => $customer
            ]);
        }

        return response()->json([
            'error' => 'Customer not found'
        ]);
    }


    public function destroy(Request $request, $id)
    {
        $lead = Lead::find($id);
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully');
    }
    public function show(Request $request)
    {
        $lead_id = $request->lead_id;

        // Fetch the specific lead and include the customer relation
        $lead_details = Lead::with('customer')->find($lead_id);

        if (!$lead_details) {
            return response()->json(['error' => 'Lead not found'], 404);
        }

        return response()->json([
            'lead_details' => $lead_details
        ]);
    }




    // LeadController.php

    public function edit($id)
    {
        $salemans = User::role('Salesman')->get();


        $lead = Lead::findOrFail($id);
        $customers = Customer::all();


        return view('leads.create', compact('lead', 'customers', 'salemans'));
    }

    public function update(Request $request, $id)
    {
        // Vali


        // Find the lead to update
        $lead = Lead::with('customer')->findOrFail($id);

        // Find and update the associated customer
        $customer = Customer::find($request->customer_id);
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'occupation' => $request->occupation,
            'dob' => $request->dob,
        ]);

        // Update the lead information
        $lead->update([
            'lead_date' => $request->lead_date,
            'lead_number' => $request->lead_number,
            'lead_vehicle' => $request->lead_vehicle,
            'lead_source' => $request->lead_source,
            'customer_id' => $customer->id, // Ensure the lead is linked to the updated customer
            'saleman_id' => $request->saleman_id,

        ]);

        return redirect()->route('leads.index')->with('success', 'Lead and customer updated successfully.');
    }
}