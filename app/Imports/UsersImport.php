<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'username' => $row['username'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'permission' => $row['permission'],
            'active' => $row['active']
        ]);
    }
}