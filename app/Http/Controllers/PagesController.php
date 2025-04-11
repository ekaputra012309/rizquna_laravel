<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Visa;
use App\Models\User;
use App\Models\Role;
use App\Models\Privilage;
use App\Models\Cabang;
use App\Models\Jamaah;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Function to convert month number to Roman numeral
    private function toRoman($number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $result = '';

        foreach ($map as $roman => $value) {
            $matches = intval($number / $value);
            $result .= str_repeat($roman, $matches);
            $number = $number % $value;
        }

        return $result;
    }

    public function signin()
    {
        $pageTitle = 'Login - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.login', compact('data'));
    }

    public function dash()
    {
        $bookings = Booking::with('agent', 'hotel', 'details')->get();
        $pageTitle = 'Dashboard - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'booking' => $bookings,
        );
        return view('page.dashboard', compact('data'));
    }

    public function hotel()
    {

        $pageTitle = 'Hotel - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.hotel.hotel', compact('data'));
    }

    public function tambahHotel()
    {

        $pageTitle = 'Add Hotel - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.hotel.tambah', compact('data'));
    }

    public function editHotel($id)
    {

        $pageTitle = 'Edit Hotel - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
        );

        return view('page.hotel.edit', compact('data'));
    }

    public function room()
    {

        $pageTitle = 'Room - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.room.room', compact('data'));
    }

    public function tambahRoom()
    {

        $pageTitle = 'Add Room - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.room.tambah', compact('data'));
    }

    public function editRoom($id)
    {

        $pageTitle = 'Edit Room - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
        );

        return view('page.room.edit', compact('data'));
    }

    public function agent()
    {

        $pageTitle = 'Agent - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.agent.agent', compact('data'));
    }

    public function tambahAgent()
    {

        $pageTitle = 'Add Agent - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.agent.tambah', compact('data'));
    }

    public function editAgent($id)
    {

        $pageTitle = 'Edit Agent - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
        );

        return view('page.agent.edit', compact('data'));
    }

    public function rekening()
    {

        $pageTitle = 'Rekening - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.rekening.rekening', compact('data'));
    }

    public function tambahRekening()
    {

        $pageTitle = 'Add Rekening - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.rekening.tambah', compact('data'));
    }

    public function editRekening($id)
    {

        $pageTitle = 'Edit Rekening - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
        );

        return view('page.rekening.edit', compact('data'));
    }

    public function booking()
    {
        $pageTitle = 'Booking - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.booking.booking', compact('data'));
    }

    public function tambahBooking()
    {
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        // Find the maximum ID from existing bookings created in the current month and year
        $maxId = Booking::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->max('booking_id');

        // Extract the month from the last stored auto ID, if it exists
        $lastStoredMonth = $maxId ? explode('/', $maxId)[2] : null;
        // Convert the month number to Roman numeral
        $romanMonth = $this->toRoman($currentMonth);
        $numericPart = (int)explode('/', $maxId)[0];
        // If there are no existing bookings for the current month and year, start from 1
        if ($maxId === null || $lastStoredMonth !== $romanMonth) {
            $newNumericPart = 1;
        } else {
            // Extract the numeric part and increment by 1
            $newNumericPart = $numericPart + 1;
        }

        // Format the new ID to a 3-digit string
        $newId = str_pad($newNumericPart, 3, '0', STR_PAD_LEFT);

        // Construct the auto ID with the Roman numeral month, year, and the new numeric part
        $autoId = $newId . '/INV-HTL/' . $romanMonth . '/' . $currentYear;
        $pageTitle = 'Add Booking - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'autoId' => $autoId,
        );
        // dd($autoId);
        return view('page.booking.tambah', compact('data'));
    }

    public function editBooking($id)
    {
        $autoId = Booking::where('id_booking', base64_decode($id))->value('booking_id');
        $pageTitle = 'Edit Booking - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
            'autoId' => $autoId,
        );

        return view('page.booking.edit', compact('data'));
    }

    public function payment()
    {
        $pageTitle = 'Payment - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.payment.payment', compact('data'));
    }

    public function lihatPayment($id)
    {
        $autoId = Payment::where('id_payment', base64_decode($id))->value('id_booking');
        $pageTitle = 'Detail Payment - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
            'autoId' => $autoId,
        );

        return view('page.payment.lihat', compact('data'));
    }

    public function cetakPayment($id)
    {
        $selectedBank = request()->input('bank');
        $autoId = Payment::where('id_payment', base64_decode($id))->value('id_booking');
        $pageTitle = 'Invoice ';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
            'autoId' => $autoId,
            'bank' => $selectedBank,
        );

        return view('page.payment.cetak', compact('data'));
    }

    public function reportAgent()
    {
        $pageTitle = 'Report Agent - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.agent.reportagent', compact('data'));
    }

    public function visa()
    {
        $pageTitle = 'Visa - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.visa.visa', compact('data'));
    }

    public function tambahVisa1()
    {
        $currentYear = date('Y');

        // Find the maximum ID from existing visas
        $maxId = Visa::max('visa_id');

        // Extract the numeric part and increment by 1
        $numericPart = (int)explode('/', $maxId)[0]; // Extract "002" from "002/INV-HTL/II/2024"
        $newNumericPart = $numericPart + 1;

        // Format the new ID to a 3-digit string
        $newId = str_pad($newNumericPart, 3, '0', STR_PAD_LEFT);

        $autoId = $newId . '/INV-VISA/II/' . $currentYear;
        $pageTitle = 'Add Visa - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'autoId' => $autoId,
        );

        return view('page.visa.tambah', compact('data'));
    }

    public function tambahVisa()
    {
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        // Find the maximum ID from existing bookings created in the current month and year
        $maxId = Visa::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->max('visa_id');

        // Extract the month from the last stored auto ID, if it exists
        $lastStoredMonth = $maxId ? explode('/', $maxId)[2] : null;
        // Convert the month number to Roman numeral
        $romanMonth = $this->toRoman($currentMonth);
        $numericPart = (int)explode('/', $maxId)[0];
        // If there are no existing bookings for the current month and year, start from 1
        if ($maxId === null || $lastStoredMonth !== $romanMonth) {
            $newNumericPart = 1;
        } else {
            // Extract the numeric part and increment by 1
            $newNumericPart = $numericPart + 1;
        }

        // Format the new ID to a 3-digit string
        $newId = str_pad($newNumericPart, 3, '0', STR_PAD_LEFT);

        // Construct the auto ID with the Roman numeral month, year, and the new numeric part
        $autoId = $newId . '/INV-VISA/' . $romanMonth . '/' . $currentYear;
        $pageTitle = 'Add Visa - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'autoId' => $autoId,
        );
        // dd($autoId);
        return view('page.visa.tambah', compact('data'));
    }

    public function editVisa($id)
    {
        $autoId = Visa::where('id_visa', base64_decode($id))->value('visa_id');
        $pageTitle = 'Edit Visa - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
            'autoId' => $autoId,
        );

        return view('page.visa.edit', compact('data'));
    }

    public function lihatVisa($id)
    {
        $autoId = Visa::where('id_visa', base64_decode($id))->value('visa_id');
        $pageTitle = 'Detail Visa - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
            'autoId' => $autoId,
        );

        return view('page.visa.lihat', compact('data'));
    }

    public function cetakVisa($id)
    {
        $selectedBank = request()->input('bank');
        $autoId = Visa::where('id_visa', base64_decode($id))->value('visa_id');
        $pageTitle = 'Invoice Visa';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
            'autoId' => $autoId,
            'bank' => $selectedBank,
        );

        return view('page.visa.cetak', compact('data'));
    }

    public function role()
    {
        $pageTitle = 'Role - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.role.role', compact('data'));
    }

    public function tambahRole()
    {

        $pageTitle = 'Add Role - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.role.tambah', compact('data'));
    }

    public function editRole($id)
    {

        $pageTitle = 'Edit Role - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
        );

        return view('page.role.edit', compact('data'));
    }

    public function user()
    {
        $pageTitle = 'User Management - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.user.user', compact('data'));
    }

    public function tambahUser()
    {

        $pageTitle = 'Add User - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.user.tambah', compact('data'));
    }

    public function editUser($id)
    {

        $pageTitle = 'Edit User - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
        );

        return view('page.user.edit', compact('data'));
    }

    public function privilage()
    {
        $pageTitle = 'Privilage - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.privilage.privilage', compact('data'));
    }

    public function tambahprivilage()
    {
        $user = User::all();
        $roles = Role::all();
        $filteredRoles = $roles->reject(function ($role) {
            return $role->kode_role === 'superadmin';
        });
        $pageTitle = 'Add Privilage - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'user' => $user,
            'role' => $filteredRoles,
        );
        return view('page.privilage.tambah', compact('data'));
    }

    public function editprivilage($id)
    {
        $user = User::all();
        $roles = Role::all();
        $filteredRoles = $roles->reject(function ($role) {
            return $role->kode_role === 'superadmin';
        });
        $pageTitle = 'Edit Privilage - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
            'user' => $user,
            'role' => $filteredRoles,
        );

        return view('page.privilage.edit', compact('data'));
    }

    // 09 April 2025
    public function cabang()
    {

        $pageTitle = 'Cabang - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.cabang.cabang', compact('data'));
    }

    public function tambahCabang()
    {

        $pageTitle = 'Add Cabang - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page.cabang.tambah', compact('data'));
    }

    public function editCabang($id)
    {

        $pageTitle = 'Edit Cabang - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
            'idpage' => $id,
        );

        return view('page.cabang.edit', compact('data'));
    }

    public function bcabang(Request $request)
    {
        $cabangId = $request->input('cabang');
        $cabang = Cabang::find($cabangId);
        $pageTitle = $cabang ? 'B2C - ' . $cabang->nama_cabang : 'B2C - PT RIZQUNA MEKAH MADINAH';       
        
        // $cabangs = $cabangId ? $cabangs = Jamaah::where('cabang_id', $cabangId)->get() : Cabang::all();
        $cabangs = $cabangId
            ? Cabang::where('id', $cabangId)->withCount('jamaah')->get()
            : Cabang::withCount('jamaah')->get();

        $cabangsWithColors = $cabangs->map(function ($cabang) {
            $cabang->randomColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));  // Random color
            return $cabang;
        });
        $data = array(
            'pageTitle' => $pageTitle,
            'cabangs' => $cabangsWithColors,
            'cabangId' => $cabangId,
            'namacabang' => $cabang->nama_cabang ?? '',
        );
        return view($cabangId ? 'page.cabang.b2cabang' : 'page.cabang.b2c', $data);
    }
}
