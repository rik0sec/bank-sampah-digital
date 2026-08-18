<?php

namespace App\Controllers;

class Laporan extends BaseController
{
    private function buildData($dari, $sampai, $petugas_id)
    {
        $db = db_connect();

        $whereClauses = ["penyetoran.status = 'disetujui'"];
        $params = [];

        if (!empty($dari)) {
            $whereClauses[] = "penyetoran.tanggal >= ?";
            $params[] = $dari;
        }
        if (!empty($sampai)) {
            $whereClauses[] = "penyetoran.tanggal <= ?";
            $params[] = $sampai;
        }
        if (!empty($petugas_id)) {
            $whereClauses[] = "penyetoran.petugas_id = ?";
            $params[] = $petugas_id;
        }
        $whereSql = implode(' AND ', $whereClauses);

        $data['total_penyetoran'] = $db->query("SELECT COUNT(*) AS total FROM penyetoran WHERE $whereSql", $params)->getRow()->total;
        $data['total_berat']      = $db->query("SELECT COALESCE(SUM(total_berat),0) AS total FROM penyetoran WHERE $whereSql", $params)->getRow()->total;
        $data['total_uang']       = $db->query("SELECT COALESCE(SUM(total_harga),0) AS total FROM penyetoran WHERE $whereSql", $params)->getRow()->total;

        $data['rekap_petugas'] = $db->query("
            SELECT
                users.nama_lengkap AS nama_petugas,
                COUNT(*) AS jumlah_transaksi,
                COALESCE(SUM(penyetoran.total_berat),0) AS total_berat,
                COALESCE(SUM(penyetoran.total_harga),0) AS total_nilai
            FROM penyetoran
            LEFT JOIN users ON users.id = penyetoran.petugas_id
            WHERE $whereSql
            GROUP BY penyetoran.petugas_id, users.nama_lengkap
            ORDER BY total_nilai DESC
        ", $params)->getResult();

        $data['laporan'] = $db->query("
            SELECT
                penyetoran.*,
                nasabah.nama,
                users.nama_lengkap AS nama_petugas
            FROM penyetoran
            JOIN nasabah ON nasabah.id = penyetoran.nasabah_id
            LEFT JOIN users ON users.id = penyetoran.petugas_id
            WHERE $whereSql
            ORDER BY tanggal DESC
        ", $params)->getResult();

        return $data;
    }

    public function index()
    {
        $db = db_connect();

        $dari       = $this->request->getGet('dari');
        $sampai     = $this->request->getGet('sampai');
        $petugas_id = $this->request->getGet('petugas_id');

        $data = $this->buildData($dari, $sampai, $petugas_id);
        $data['dari']       = $dari;
        $data['sampai']     = $sampai;
        $data['petugas_id'] = $petugas_id;

        $data['total_nasabah'] = $db->table('nasabah')->countAll();
        $data['total_jenis']   = $db->table('jenis_sampah')->countAll();

        $data['daftar_petugas'] = $db->query("
            SELECT id, nama_lengkap FROM users WHERE role = 'petugas' ORDER BY nama_lengkap ASC
        ")->getResult();

        return view('laporan/index', $data);
    }

    public function exportPdf()
    {
        $dari       = $this->request->getGet('dari');
        $sampai     = $this->request->getGet('sampai');
        $petugas_id = $this->request->getGet('petugas_id');

        $data = $this->buildData($dari, $sampai, $petugas_id);
        $data['dari']   = $dari;
        $data['sampai'] = $sampai;

        $html = view('laporan/export_pdf', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan-BankSampah-' . date('Ymd_His') . '.pdf', ['Attachment' => true]);
        exit;
    }

    public function exportExcel()
    {
        $dari       = $this->request->getGet('dari');
        $sampai     = $this->request->getGet('sampai');
        $petugas_id = $this->request->getGet('petugas_id');

        $data = $this->buildData($dari, $sampai, $petugas_id);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan');

        $sheet->setCellValue('A1', 'Kode Transaksi');
        $sheet->setCellValue('B1', 'Nasabah');
        $sheet->setCellValue('C1', 'Petugas');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Total Berat (kg)');
        $sheet->setCellValue('F1', 'Total Harga (Rp)');
        $sheet->setCellValue('G1', 'Status');
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);

        $row = 2;
        foreach ($data['laporan'] as $r) {
            $sheet->setCellValue('A' . $row, $r->kode_transaksi);
            $sheet->setCellValue('B' . $row, $r->nama);
            $sheet->setCellValue('C' . $row, $r->nama_petugas ?? '-');
            $sheet->setCellValue('D' . $row, $r->tanggal);
            $sheet->setCellValue('E' . $row, $r->total_berat);
            $sheet->setCellValue('F' . $row, $r->total_harga);
            $sheet->setCellValue('G' . $row, $r->status);
            $row++;
        }

        $sheet->setCellValue('D' . $row, 'TOTAL');
        $sheet->setCellValue('E' . $row, $data['total_berat']);
        $sheet->setCellValue('F' . $row, $data['total_uang']);
        $sheet->getStyle('D' . $row . ':F' . $row)->getFont()->setBold(true);

        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'Laporan-BankSampah-' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}