<?php
namespace App\Exports;

use App\Models\RkVendorOrderModal;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class RkSalesExport implements FromQuery, WithMapping, WithHeadings, WithEvents, ShouldAutoSize
{
    use Exportable;

    protected $startDate, $endDate;
    protected $rowNumber = 1;

    public function __construct( $startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }

    public function query()
    {
        return RkVendorOrderModal::with(['vendor.city.state'])
            ->whereBetween('invoice_date', [$this->startDate, $this->endDate])
            ->orderBy('invoice_date', 'asc');
    }

    public function headings(): array
    {
        return [
            ['R K FASHIONS'],
            ['C-275, VAISHALI NAGAR, BEHIND TPS SCHOOL, JAIPUR'],
            ['Sales Register (Bill-wise)'],
            ['(From: ' . \Carbon\Carbon::parse($this->startDate)->format('d-m-Y') . ' To ' . \Carbon\Carbon::parse($this->endDate)->format('d-m-Y') . ')'],
            [], // Empty row before table headings
            [
                'S.No.', 'Bill No', 'Date', 'Name & Address of Dealer', 'GSTIN', 'Sale Type',
                'Bill Amount', 'IGST Txbl. Amt @ 5%', 'IGST Tax Amt @ 5%',
                'CGST Txbl. Amt @ 2.5%', 'CGST Tax Amt @ 2.5%',
                'SGST Txbl. Amt @ 2.5%', 'SGST Tax Amt @ 2.5%',
                'Other Amt.',
            ],
        ];
    }

    public function map($order): array
    {
        $stateName   = $order->vendor->city->state->name ?? '';
        $isRajasthan = $stateName === 'Rajasthan [RJ]';

        $cgstTxbl = $isRajasthan ? $order->sub_total : 0;
        $sgstTxbl = $isRajasthan ? $order->sub_total : 0;
        $igstTxbl = ! $isRajasthan ? $order->sub_total : 0;

        $cgst        = $isRajasthan ? $order->gst_amount / 2 : 0;
        $sgst        = $isRajasthan ? $order->gst_amount / 2 : 0;
        $igst        = ! $isRajasthan ? $order->gst_amount : 0;
        $invoiceDate = Carbon::parse($order->invoice_date);
        $invoiceNo   = $order->invoice_no ?? $order->bill_no ?? '-';

        // Financial year logic
        if ($invoiceDate->month >= 4) {
            $fy = $invoiceDate->year . '-' . substr($invoiceDate->year + 1, -2);
        } else {
            $fy = ($invoiceDate->year - 1) . '-' . substr($invoiceDate->year, -2);
        }

        $formattedInvoice = "{$fy}/{$invoiceNo}/GST";
        $otherAmount = number_format(abs($order->sub_total + $order->gst_amount - round($order->total_amount)), 2, '.', ',') ;

        return [
            $this->rowNumber++,
            $formattedInvoice,
            Carbon::parse($order->invoice_date)->format('d-m-y'),
            $order->vendor->business_name,
            $order->vendor->gst,
            'GST (L) - 5%',
            number_format($order->total_amount, 2, '.', ''),
            number_format($igstTxbl, 2, '.', ''),
            number_format($igst, 2, '.', ''),
            number_format($cgstTxbl, 2, '.', ''),
            number_format($cgst, 2, '.', ''),
            number_format($sgstTxbl, 2, '.', ''),
            number_format($sgst, 2, '.', ''),
            number_format($otherAmount ?? 0.50, 2, '.', ''),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Merge title rows
                $sheet->mergeCells('A1:N1');
                $sheet->mergeCells('A2:N2');
                $sheet->mergeCells('A3:N3');
                $sheet->mergeCells('A4:N4');

                // Row 1: R K FASHIONS (Big + Bold + Centered)
                $sheet->getStyle('A1')->applyFromArray([
                    'font'      => [
                        'bold' => true,
                        'size' => 20,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Row 2: Address (Normal + Centered)
                $sheet->getStyle('A2')->applyFromArray([
                    'font'      => [
                        'bold' => false,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                // Row 3-4: other info (Big + Bold + Centered)
                $sheet->getStyle('A3:A4')->applyFromArray([
                    'font'      => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Row 5: Actual table headers
                $sheet->getStyle('A6:N6')->applyFromArray([
                    'font'      => [
                        'bold'      => true,
                        'underline' => true,
                        'size'      => 11,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders'   => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Freeze row 6 (column headings)
                $sheet->freezePane('A7');
            },
        ];
    }

}
