<?php
namespace App\Controllers;
use App\Models\M_penyetoran;

class Penyetoran extends BaseController
{
    protected $mpenyetoran;

    function __construct()
    {
        $this->mpenyetoran = new M_penyetoran();
    }

    public function index(): string
{
    $dari   = $this->request->getGet('dari');
    $sampai = $this->request->getGet('sampai');

    if ($dari || $sampai) {
        $data['penyetoran'] = $this->mpenyetoran->filterPeriode($dari, $sampai);
    } else {
        $data['penyetoran'] = $this->mpenyetoran->list_all();
    }

    $data['dari']   = $dari;
    $data['sampai'] = $sampai;

    $totalBerat = 0;
    $totalHarga = 0;
    foreach ($data['penyetoran'] as $p) {
        $totalBerat += $p->total_berat;
        $totalHarga += $p->total_harga;
    }
    $data['total_berat_periode'] = $totalBerat;
    $data['total_harga_periode'] = $totalHarga;

    return view('penyetoran/list_penyetoran', $data);
}

public function exportPdf()
{
    $dari   = $this->request->getGet('dari');
    $sampai = $this->request->getGet('sampai');

    $penyetoran = ($dari || $sampai)
        ? $this->mpenyetoran->filterPeriode($dari, $sampai)
        : $this->mpenyetoran->list_all();

    $totalBerat = 0;
    $totalHarga = 0;
    foreach ($penyetoran as $p) {
        $totalBerat += $p->total_berat;
        $totalHarga += $p->total_harga;
    }

    $html = view('penyetoran/export_pdf', [
        'penyetoran'  => $penyetoran,
        'dari'        => $dari,
        'sampai'      => $sampai,
        'total_berat' => $totalBerat,
        'total_harga' => $totalHarga,
    ]);

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('Laporan-Penyetoran-' . date('Ymd_His') . '.pdf', ['Attachment' => true]);
    exit;
}

public function exportExcel()
{
    $dari   = $this->request->getGet('dari');
    $sampai = $this->request->getGet('sampai');

    $penyetoran = ($dari || $sampai)
        ? $this->mpenyetoran->filterPeriode($dari, $sampai)
        : $this->mpenyetoran->list_all();

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Penyetoran');

    $sheet->setCellValue('A1', 'Kode Transaksi');
    $sheet->setCellValue('B1', 'Nasabah');
    $sheet->setCellValue('C1', 'Tanggal');
    $sheet->setCellValue('D1', 'Total Berat (kg)');
    $sheet->setCellValue('E1', 'Total Harga (Rp)');
    $sheet->setCellValue('F1', 'Status');
    $sheet->getStyle('A1:F1')->getFont()->setBold(true);

    $row = 2;
    $totalBerat = 0;
    $totalHarga = 0;
    foreach ($penyetoran as $p) {
        $sheet->setCellValue('A' . $row, $p->kode_transaksi);
        $sheet->setCellValue('B' . $row, $p->nama_nasabah);
        $sheet->setCellValue('C' . $row, $p->tanggal);
        $sheet->setCellValue('D' . $row, $p->total_berat);
        $sheet->setCellValue('E' . $row, $p->total_harga);
        $sheet->setCellValue('F' . $row, $p->status);
        $totalBerat += $p->total_berat;
        $totalHarga += $p->total_harga;
        $row++;
    }

    $sheet->setCellValue('C' . $row, 'TOTAL');
    $sheet->setCellValue('D' . $row, $totalBerat);
    $sheet->setCellValue('E' . $row, $totalHarga);
    $sheet->getStyle('C' . $row . ':E' . $row)->getFont()->setBold(true);

    foreach (range('A', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $filename = 'Laporan-Penyetoran-' . date('Ymd_His') . '.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

    public function tambah()
    {
        $data['nasabah'] = $this->mpenyetoran->getNasabah();

        if ($_POST) {
            $dataPost["kode_transaksi"] = $this->request->getVar("kode_transaksi");
            $dataPost["nasabah_id"]     = $this->request->getVar("nasabah_id");
            $dataPost["tanggal"]        = $this->request->getVar("tanggal");
            $dataPost["total_berat"]    = $this->request->getVar("total_berat");
            $dataPost["total_harga"]    = $this->request->getVar("total_harga");
            $dataPost["status"]         = $this->request->getVar("status");

            $tambah = $this->mpenyetoran->add($dataPost);

            if ($tambah == "success") {
                session()->setFlashdata('success', 'Data penyetoran berhasil ditambahkan!');
            } else {
                session()->setFlashdata('error', 'Gagal menambahkan data penyetoran!');
            }
            return redirect()->to(base_url("penyetoran"));
        }

        return view('penyetoran/tambah_penyetoran', $data);
    }

    public function edit($id)
    {
        $data['nasabah'] = $this->mpenyetoran->getNasabah();

        if ($_POST) {
            $kode_transaksi = $this->request->getVar("kode_transaksi");
            $nasabah_id     = $this->request->getVar("nasabah_id");
            $tanggal        = $this->request->getVar("tanggal");
            $total_berat    = $this->request->getVar("total_berat");
            $total_harga    = $this->request->getVar("total_harga");
            $status         = $this->request->getVar("status");

            $update = $this->mpenyetoran->updateData(
                $id, $kode_transaksi, $nasabah_id,
                $tanggal, $total_berat, $total_harga, $status
            );

            if ($update == "success") {
                session()->setFlashdata('success', 'Data penyetoran berhasil diperbarui!');
            } else {
                session()->setFlashdata('error', 'Gagal memperbarui data penyetoran!');
            }
            return redirect()->to(base_url("penyetoran"));
        }

        $data["penyetoran"] = $this->mpenyetoran->getData($id);
        return view('penyetoran/edit_penyetoran', $data);
    }

    public function detail($id)
{
    $data["penyetoran"] = $this->mpenyetoran->getData($id);
    $data["detail"]     = $this->mpenyetoran->getDetail($id);

    $db = db_connect();
    $nasabah = $db->query(
        "SELECT nama FROM nasabah WHERE id = ?",
        [$data["penyetoran"]->nasabah_id]
    )->getRow();
    $data["nama_nasabah"] = $nasabah->nama ?? '-';

    return view('penyetoran/detail_penyetoran', $data);
}

    public function delete($id)
    {
        $this->mpenyetoran->deleteData($id);
        session()->setFlashdata('success', 'Data penyetoran berhasil dihapus!');
        return redirect()->to(base_url("penyetoran"));
    }
}