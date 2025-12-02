<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\Ustadz;
use App\Models\Kelas;
use App\Models\Pelajaran;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'totalSantri' => Santri::count(),
            'totalUstadz' => Ustadz::count(),
            'totalKelas' => Kelas::count(),
            'totalPelajaran' => Kelas::count(),
        ]);
    }

    /**
     * ✅ Export semua data ke Excel
     */
    public function exportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Pondok');

        // Judul utama
        $sheet->setCellValue('A1', 'Laporan Data Pondok Pesantren');
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // === SANTRI ===
        $row = 3;
        $sheet->setCellValue("A{$row}", '=== Data Santri ===');
        $sheet->getStyle("A{$row}")->getFont()->setBold(true);
        $row++;

        $headers = ['A' => 'No', 'B' => 'Nama', 'C' => 'Alamat', 'D' => 'No HP'];
        foreach ($headers as $col => $val) {
            $sheet->setCellValue("{$col}{$row}", $val);
        }
        $sheet->getStyle("A{$row}:D{$row}")->getFont()->setBold(true);
        $row++;

        $no = 1;
        foreach (Santri::all() as $santri) {
            $sheet->setCellValue("A{$row}", $no++);
            $sheet->setCellValue("B{$row}", $santri->nama);
            $sheet->setCellValue("C{$row}", $santri->alamat);
            $sheet->setCellValue("D{$row}", $santri->no_hp);
            $row++;
        }

        // === USTADZ ===
        $row += 2;
        $sheet->setCellValue("A{$row}", '=== Data Ustadz ===');
        $sheet->getStyle("A{$row}")->getFont()->setBold(true);
        $row++;

        foreach ($headers as $col => $val) {
            $sheet->setCellValue("{$col}{$row}", $val);
        }
        $sheet->getStyle("A{$row}:D{$row}")->getFont()->setBold(true);
        $row++;

        $no = 1;
        foreach (Ustadz::all() as $ustadz) {
            $sheet->setCellValue("A{$row}", $no++);
            $sheet->setCellValue("B{$row}", $ustadz->nama);
            $sheet->setCellValue("C{$row}", $ustadz->alamat);
            $sheet->setCellValue("D{$row}", $ustadz->no_hp);
            $row++;
        }

        // === KELAS ===
        $row += 2;
        $sheet->setCellValue("A{$row}", '=== Data Kelas ===');
        $sheet->getStyle("A{$row}")->getFont()->setBold(true);
        $row++;

        $sheet->setCellValue("A{$row}", 'No');
        $sheet->setCellValue("B{$row}", 'Nama Kelas');
        $sheet->getStyle("A{$row}:B{$row}")->getFont()->setBold(true);
        $row++;

        $no = 1;
        foreach (Kelas::all() as $kelas) {
            $sheet->setCellValue("A{$row}", $no++);
            $sheet->setCellValue("B{$row}", $kelas->nama_kelas ?? '-');
            $row++;
        }

        // === PELAJARAN ===
        $row += 2;
        $sheet->setCellValue("A{$row}", '=== Data Pelajaran ===');
        $sheet->getStyle("A{$row}")->getFont()->setBold(true);
        $row++;

        $sheet->setCellValue("A{$row}", 'No');
        $sheet->setCellValue("B{$row}", 'Nama Pelajaran');
        $sheet->getStyle("A{$row}:B{$row}")->getFont()->setBold(true);
        $row++;

        $no = 1;
        foreach (Kelas::all() as $pelajaran) {
            $sheet->setCellValue("A{$row}", $no++);
            $sheet->setCellValue("B{$row}", $pelajaran->nama_pelajaran ?? '-');
            $row++;
        }

        // Auto width kolom
        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Simpan & download
        $fileName = 'Laporan_Pondok.xlsx';
        $filePath = storage_path('app/public/' . $fileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
