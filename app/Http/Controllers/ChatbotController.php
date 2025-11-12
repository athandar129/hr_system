<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;


class ChatbotController extends Controller
{
    // Only allow authenticated users (optional)
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function handle(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $message = trim($request->input('message'));
        $lc = mb_strtolower($message, 'UTF-8');

        // Quick normalization
        $lc = preg_replace('/\s+/', ' ', $lc);

        // 1) Exact keyword: count employees
        if (preg_match('/\b(count|how many|number of employees)\b/', $lc)) {
            $count = Employee::count();
            return response()->json(['reply' => "There are $count employees."]);
        }

        // 2) List (with optional limit)
        if (preg_match('/\b(list|show)\b.*\b(employees|employee)\b/', $lc)) {
            // try to detect limit: "list 10" or "show 5 employees"
            if (preg_match('/\b(\d{1,3})\b/', $lc, $m)) {
                $limit = min(100, (int)$m[1]);
            } else {
                $limit = 10;
            }
            $employees = Employee::select('id','name','email','position')
                ->limit($limit)->get();

            if ($employees->isEmpty()) {
                return response()->json(['reply' => "No employees found."]);
            }

            $lines = $employees->map(function($e){
                return "{$e->id}. {$e->name} ({$e->position})";
            })->toArray();

            return response()->json(['reply' => "Here are some employees:\n" . implode("\n", $lines)]);
        }

        // 3) Names that start with X: "start with Aye" or "names start with Aye"
        if (preg_match('/\b(start|starts|starting)\b.*\b(with)\b.*([a-z\u00C0-\u017F]+)/i', $lc, $m)
            || preg_match('/\b(names?)\b.*\b(start|starting)\b.*([a-z\u00C0-\u017F]+)/i', $lc, $m)
        ) {
            $prefix = trim($m[count($m)] ?? '');
            $prefix = mb_substr($prefix, 0, 50);
            $employees = Employee::where('name', 'like', $prefix . '%')
                ->limit(50)->pluck('name');

            if ($employees->isEmpty()) {
                return response()->json(['reply' => "No employees found starting with \"$prefix\"."]);
            }

            return response()->json(['reply' => "Employees starting with \"$prefix\": " . $employees->implode(', ')]);
        }

        // 4) Filter by position/department: "show HR" or "list employees in HR"
        if (preg_match('/\b(in|of|from)\b.*\b([a-z\u00C0-\u017F]+)\b.*(department|position|role)?/i', $lc, $m)) {
            $position = trim($m[2]);
            // Basic mapping: allow "hr" -> "HR"
            $employees = Employee::where('position', 'like', "%{$position}%")
                ->limit(50)->get(['id','name','position']);

            if ($employees->isEmpty()) {
                return response()->json(['reply' => "No employees found for position/department \"$position\"."]);
            }

            $lines = $employees->map(fn($e) => "{$e->name} ({$e->position})")->toArray();
            return response()->json(['reply' => "Employees in \"$position\":\n" . implode("\n", $lines)]);
        }

        // 5) Get employee by email or id
        if (preg_match('/\b(id)\b.*\b(\d{1,6})\b/', $lc, $m)) {
            $id = (int)$m[2];
            $employee = Employee::find($id);
            if (!$employee) return response()->json(['reply' => "No employee found with id $id."]);
            return response()->json(['reply' => "Employee #{$employee->id}: {$employee->name} — {$employee->email} — {$employee->position}"]);
        }
        if (filter_var($message, FILTER_VALIDATE_EMAIL)) {
            $employee = Employee::where('email', $message)->first();
            if (!$employee) return response()->json(['reply' => "No employee found with email {$message}."]);
            return response()->json(['reply' => "Employee: {$employee->name} — {$employee->email} — {$employee->position}"]);
        }

        // 6) Fallback: provide help / supported commands
        $help = "I understood these commands:\n"
              . "- \"count\" or \"how many employees\"\n"
              . "- \"list\" or \"show employees\" (optionally: \"list 5 employees\")\n"
              . "- \"names start with Aye\" or \"start with Aye\"\n"
              . "- \"show employees in HR\" or \"employees in [position]\"\n"
              . "- provide an email to lookup employee by email\n\n"
              . "Try: \"How many employees?\", \"List 5 employees\", \"Names start with Aye\".";
        return response()->json(['reply' => $help]);
    }
}
