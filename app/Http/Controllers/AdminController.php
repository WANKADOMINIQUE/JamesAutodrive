<?php

namespace App\Http\Controllers;

use App\Models\PaymentSubmission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginForm()
    {
        if (session('admin_auth')) {
            return redirect()->route('admin.submissions');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate(['password' => 'required|string']);

        if ($request->password !== config('app.admin_password')) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        session(['admin_auth' => true]);
        return redirect()->route('admin.submissions');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_auth');
        return redirect()->route('admin.login');
    }

    public function submissions(Request $request)
    {
        if (!session('admin_auth')) {
            return redirect()->route('admin.login');
        }

        $query = PaymentSubmission::latest();

        if ($request->filled('method')) {
            $query->where('payment_method', $request->method);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('full_name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('ref_number', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%");
            });
        }

        $submissions = $query->paginate(20)->withQueryString();

        return view('admin.submissions', compact('submissions'));
    }
}
