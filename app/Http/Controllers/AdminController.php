<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Lead;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer;

class AdminController extends Controller
{

    public function admin_dashboard()
    {
        $pendingCount = Lead::where('lead_status', 0)->count();
        $activeCount = Lead::where('lead_status', 1)->count();
        $closedCount = Lead::where('lead_status', 2)->count();
        $notClosedCount = Lead::where('lead_status', 3)->count();

        return view('admin.admin_dashboard', compact('pendingCount', 'activeCount', 'closedCount', 'notClosedCount'));
    }
    public function admin_conversation_index()
    {
        $conversations = Conversation::all();

        return view('admin.conversation_index', get_defined_vars());
    }
    public function admin_conversation_edit(Request $request)
    {
        $id = $request->id;


        $conversation = Conversation::findOrFail($id);


        return response()->json([
            'conversation' => $conversation
        ]);
    }
    public function admin_conversation_update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:conversations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $conversation = Conversation::find($request->id);

        $conversation->title = $request->title;
        $conversation->description = $request->description;
        $conversation->date_time = $request->date_time;

        // Handle file upload
        if ($request->hasFile('attachment')) {
            // Delete the previous attachment if it exists
            if ($conversation->attachment && file_exists(public_path($conversation->attachment))) {
                unlink(public_path($conversation->attachment));
            }

            // Save the new attachment
            $attachment = $request->file('attachment');
            $fileName = time() . '_' . $attachment->getClientOriginalName();
            $filePath = 'uploads/conversation';
            $attachment->move(public_path($filePath), $fileName);

            $conversation->attachment = $filePath . '/' . $fileName;
        }

        $conversation->save();

        return response()->json(['success' => true, 'message' => 'Conversation updated successfully']);
    }



    public function admin_conversation_destroy($id)
    {
        $conversation = Conversation::findOrFail($id);
        $conversation->delete();

        // Optionally, return a response or redirect
        return redirect()->route('admin.conversation.index')->with('success', 'Conversation deleted successfully.');
    }
    public function notifications()
    {
        $today = Carbon::today();
        $startDate = $today->copy()->subDays(2);
        $endDate = $today->copy()->addDays(7);

        $customers = Customer::whereBetween('dob', [$startDate, $endDate])->paginate(10);
        return view('notifications.dob_notification',get_defined_vars());
    }
    public function customer_show(Request $request)
    {
        $customer = Customer::where('id', $request->customerId)->first();

        return response()->json([
            'customer' => $customer
        ]);
    }


    public function filter(Request $request)
{
    $status = $request->input('status');

    // Fetch leads based on the status
    $leads = Lead::where('lead_status', $status)->with('customer')->get();

    return response()->json($leads);
}

}
