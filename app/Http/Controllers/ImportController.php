<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        // $brand = new BrandController();
        // echo $brand->test();

        $dataImport = [];

        $path = $request->file('fileUpload')->getRealPath();
        $reader = new Xlsx();
        $speardshet = $reader->load($path);
        $dataInfor = $reader->listWorksheetInfo($path);
        $totalRow = $dataInfor[0]['totalRows'];

        $positions = [
            'position' => 'A1:F' . $totalRow,
        ];

        foreach ($positions as $position) {
            $data = $speardshet->getSheetByName($dataInfor[0]['worksheetName'])->rangeToArray($position);
        }

        foreach ($data as $item) {
            if (!empty($item[0]) && !empty($item[1])) {
                if ($item[0] != "username") {
                    $dataImport = [
                        'username' => $item[0],
                        'phone' => $item[1],
                        'email' => $item[2],
                        'password' => Hash::make($item[3]),
                        'permission' => $item[4],
                        'active' => $item[5],
                    ];
                    User::create($dataImport);
                }
            }
        }
    }

    public function importExportView()
    {
        return view('excel/import');
    }
}