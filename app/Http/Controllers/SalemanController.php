<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Lead;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SalemanController extends Controller
{
    public function index()
    {
        $leads = Lead::with('customer')->where('saleman_id', Auth::id())->where('lead_status', 0)->paginate(10);

        return view('saleman.saleman_dashboard', get_defined_vars());
    }
    public function create(Request $request, $id)
    {
        $lead_id = $id;
        return view('saleman.lead_accept', get_defined_vars());
    }

    public function make_sale(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'vehicle' => 'required|string|max:255',
            'vehicle_brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|numeric|digits:4',
            'mileage' => 'required|string|max:255',
            'date_of_sale' => 'required|date',
            'sale_rep' => 'required|string|max:255',

        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $lead_saleman_id = Lead::findOrFail($request->input('lead_id'));

        $vehicle = new Vehicle();
        $vehicle->vehicle = $request->input('vehicle');
        $vehicle->vehicle_brand = $request->input('vehicle_brand');
        $vehicle->model = $request->input('model');
        $vehicle->year = $request->input('year');
        $vehicle->mileage = $request->input('mileage');
        $vehicle->date_of_sale = $request->input('date_of_sale');
        $vehicle->sale_rep = $request->input('sale_rep');
        $vehicle->saleman_id = $lead_saleman_id->saleman_id;






        $vehicle->save();

        $lead_status = Lead::findOrFail($request->input('lead_id'));
        $lead_status->lead_status = 2;
        $lead_status->vehicle_id = $vehicle->id;
        $lead_status->save();
        return redirect()->route('salesman.leads')->with('success', 'Lead Closed and vehicle information saved successfully.');
    }




    public function lead_accept(Request $request)
    {
        try {
            $lead = Lead::findOrFail($request->lead_id);
            $lead->lead_status = 1;
            $lead->save();

            return response()->json([
                'success' => true,
                'message' => 'Lead accepted successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to accept the lead. Please try again.'
            ], 500);
        }
    }
    public function salesman_leads()
    {
        $leads = Lead::with('customer')->where('saleman_id', Auth::id())
            ->whereIn('lead_status', [1, 2])
            ->paginate(10);
        return view('saleman.saleman_leads', compact('leads'));
    }
    public function salesman_accepted_leads(Request $request)
    {
        $leads = Lead::where('saleman_id', Auth::id())
            ->whereIn('lead_status', [1])
            ->with('customer')
            ->get();

        return response()->json($leads);
    }

    public function salesman_closed_leads()
    {
        // Example query to fetch closed leads
        $closedLeads = Lead::where('lead_status', [2])->with('customer')->get();

        // Return the data as JSON
        return response()->json($closedLeads);
    }
    public function saleman_conversation($id)
    {
        $lead = Lead::with(['customer', 'vehicle', 'conversations'])->findOrFail($id);


        return view('conversation.lead_conversation', compact('lead'));
    }
    public function saleman_conversation_store(Request $request, $id)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
        ]);


        $fileName = null;
        $filePath = null;
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $fileName = time() . '_' . $attachment->getClientOriginalName();
            $filePath = 'uploads/conversation';

            // Save the file in the specified path
            $attachment->move(public_path($filePath), $fileName);
        }

        // Create a new conversation instance and assign values
        $conversation = new Conversation();
        $conversation->title = $request->title;
        $conversation->description = $request->description;
        $conversation->attachment = $filePath . '/' . $fileName;
        $conversation->date_time = $request->date_time;
        $conversation->user_id = Auth::id();
        $conversation->lead_id = $id;
        $conversation->save();


        return redirect()->route('saleman.conversation.index')->with('success', 'Conversation saved successfully!');
    }
    public function saleman_conversation_index()
    {


        $conversations = Conversation::where('user_id', Auth::id())->get();
        return view('conversation.conversation_index', get_defined_vars());
    }
}
