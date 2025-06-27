
<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {http_response_code(400); echo json_encode(['error' => 'Invalid data']); exit;}
$excelFile = '/xampp/htdocs/DailyGreen-Project/DATABASE/lixeira_inteligente.xlsx';
if (file_exists($excelFile)) {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($excelFile);
    $sheet = $spreadsheet->getActiveSheet();
    $row = $sheet->getHighestRow() + 1;
} else {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Horário');
    $sheet->setCellValue('B1', 'Distância Interna (cm)');
    $sheet->setCellValue('C1', 'Distância Externa (cm)');
    $sheet->setCellValue('D1', 'Pessoas Passaram');
    $sheet->setCellValue('E1', 'Peso (g)');
    $sheet->setCellValue('F1', 'Gás Detectado');
}

$sheet->setCellValue('A' . $row, $data['horario']);
$sheet->setCellValue('B' . $row, $data['distanciaInterna']);
$sheet->setCellValue('C' . $row, $data['distanciaExterna']);
$sheet->setCellValue('D' . $row, $data['pessoasPassaram']);
$sheet->setCellValue('E' . $row, $data['peso']);
$sheet->setCellValue('F' . $row, $data['gasDetectado']);

$writer = new Xlsx($spreadsheet);
$writer->save($excelFile);
