<?php

namespace App\Filament\Imports;

use App\Models\Lhp;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class LhpImporter extends Importer
{
    protected static ?string $model = Lhp::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('no')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('nomor')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('tahapan')
                ->relationship(),
            ImportColumn::make('user')
                ->relationship(),
            ImportColumn::make('spt')
                ->relationship(),
            ImportColumn::make('bentuk')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('tujuan')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('sasaran')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('waktem')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('uraian')
                ->requiredMapping()
                ->rules(['required', 'max:65535']),
            ImportColumn::make('peristiwa_pel')
                ->rules(['max:255']),
            ImportColumn::make('tem_kejadian_pel')
                ->rules(['max:255']),
            ImportColumn::make('wak_kejadian_pel')
                ->rules(['date']),
            ImportColumn::make('pelaku_pel')
                ->rules(['max:255']),
            ImportColumn::make('alamat_pel')
                ->rules(['max:255']),
            ImportColumn::make('nama_saksi_1')
                ->rules(['max:255']),
            ImportColumn::make('alamat_saksi_1')
                ->rules(['max:255']),
            ImportColumn::make('nama_saksi_2')
                ->rules(['max:255']),
            ImportColumn::make('alamat_saksi_2')
                ->rules(['max:255']),
            ImportColumn::make('alat_bukti_1')
                ->rules(['max:255']),
            ImportColumn::make('alat_bukti_2')
                ->rules(['max:255']),
            ImportColumn::make('alat_bukti_3')
                ->rules(['max:255']),
            ImportColumn::make('bb_1')
                ->rules(['max:255']),
            ImportColumn::make('bb_2')
                ->rules(['max:255']),
            ImportColumn::make('bb_3')
                ->rules(['max:255']),
            ImportColumn::make('uraian_pel')
                ->rules(['max:65535']),
            ImportColumn::make('fakta_pel')
                ->rules(['max:65535']),
            ImportColumn::make('analisa_pel')
                ->rules(['max:65535']),
            ImportColumn::make('peserta_pemilu_seng')
                ->rules(['max:255']),
            ImportColumn::make('tempat_seng')
                ->rules(['max:255']),
            ImportColumn::make('waktu_kejadian_seng')
                ->rules(['max:255']),
            ImportColumn::make('bentuk_seng')
                ->rules(['max:255']),
            ImportColumn::make('identitas_seng')
                ->rules(['max:255']),
            ImportColumn::make('hari_seng')
                ->rules(['max:255']),
            ImportColumn::make('kerugian_seng')
                ->rules(['max:255']),
            ImportColumn::make('uraian_seng')
                ->rules(['max:65535']),
            ImportColumn::make('tanggal_lap_seng')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('dok1')
                ->rules(['max:255']),
            ImportColumn::make('dok2')
                ->rules(['max:255']),
            ImportColumn::make('dok3')
                ->rules(['max:255']),
            ImportColumn::make('dok4')
                ->rules(['max:255']),
            ImportColumn::make('kel')
                ->relationship(),
            ImportColumn::make('kec')
                ->relationship(),
        ];
    }

    public function resolveRecord(): ?Lhp
    {
        // return Lhp::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Lhp();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your lhp import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
