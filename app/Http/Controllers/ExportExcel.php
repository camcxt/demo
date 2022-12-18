<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExportExcel extends Controller
{
    public function exportExcel()
    {
        $user = User::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $i = 3;

        $column = 0;

        $styleArrayTitle = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => array('rgb' => '1c1e21'),
                ],
            ],
        ];

        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => array('rgb' => '1c1e21'),
                ],
            ],
        ];

        $rowColor = [
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'color' => array('rgb' => '2ed87a')
            )
        ];

        $sheet->setCellValue("D3", "User Name");
        $sheet->setCellValue("E3", "Phone");
        $sheet->setCellValue("F3", "Email");
        $sheet->setCellValue("G3", "Permission");
        $sheet->setCellValue("H3", "Active");
        foreach ($user as $item) {
            $i++;

            $column = $i;

            $sheet->setCellValue("D" . $i, $item->username);
            $sheet->setCellValue("E" . $i, $item->phone);
            $sheet->setCellValue("F" . $i, $item->email);
            $sheet->setCellValue("G" . $i, $item->permission);
            $sheet->setCellValue("H" . $i, $item->active);
        }

        $sheet->getStyle('D3:H3')->applyFromArray($styleArrayTitle);
        $sheet->getStyle('D4:H' . $column)->applyFromArray($styleArray);

        for ($row = 3; $row <= $column; $row++) {
            if ($row % 2 == 1) {
                $sheet->getStyle('D' . $row . ':H' . $row)->applyFromArray($rowColor);
            }
        }

        $writer = new Xlsx($spreadsheet);
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"user_12-9.xlsx\"");
        header("Cache-Control: max-age=0");
        header("Expires: Fri, 11 Nov 2011 11:11:11 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: cache, must-revalidate");
        header("Pragma: public");
        $writer->save("php://output");
    }
}