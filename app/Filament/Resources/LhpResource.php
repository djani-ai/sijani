<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LhpResource\Pages;
use App\Filament\Resources\LhpResource\RelationManagers;
use App\Models\Lhp;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;

class LhpResource extends Resource
{
    protected static ?string $model = Lhp::class;
    protected static ?string $navigationGroup = 'Form A';
    protected static ?string $navigationLabel = 'Form A LHP';
    protected static ?string $label = 'Form A';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        $maxValuepkd = Lhp::where('kel_id', Auth::getUser()->kel_id)->max('no')+1;
        $kodepkd = Auth::getUser()->kel->kode;
        $namadesa = Auth::getUser()->kel->nama;
        $noreg = str_pad($maxValuepkd, 3, '0', STR_PAD_LEFT) . '/LHP/PM.01.02/JI-11.07.' . $kodepkd . '/' . date('d/m/Y') ;

        return $form
        ->schema([
            Wizard::make([
                Wizard\Step::make('Uraian Pengawasan')
                    ->schema([
                        Fieldset::make('Nomor Registrasi')
                        ->schema([
                            Forms\Components\TextInput::make('no')
                                ->default($maxValuepkd)
                                ->numeric(),
                            Forms\Components\TextInput::make('nomor')
                                ->default($noreg)
                                ->required()
                                ->maxLength(255),
                        ]),
                        Fieldset::make('Uraian')
                        ->schema([
                            Forms\Components\Select::make('user_id')
                                ->relationship('user', 'name')
                                ->label('Nama Petugas Pengawasan')
                                ->options([
                                    Auth::getUser()->id => Auth::getUser()->name,
                                ])
                                ->default(Auth::getUser()->id)
                                ->required()
                                ->selectablePlaceholder(false),
                            Forms\Components\Select::make('kec_id')
                                ->relationship('kec', 'name')
                                ->label('Kecamatan')
                                ->options([
                                    Auth::getUser()->kec->id => Auth::getUser()->kec->name,
                                ])
                                ->default(Auth::getUser()->kec->id)
                                ->required()
                                ->selectablePlaceholder(false),
                            Forms\Components\Select::make('kel_id')
                                ->relationship('kel', 'name')
                                ->label('Desa/Kelurahan')
                                ->options([
                                    Auth::getUser()->kel->id => Auth::getUser()->kel->name,
                                ])
                                ->default(Auth::getUser()->kel->id)
                                ->required()
                                ->selectablePlaceholder(false),
                            Forms\Components\Select::make('tahapan_id')
                                ->required()
                                ->relationship('tahapan', 'name'),
                            Forms\Components\Select::make('spt_id')
                                ->label('Surat Perintah Tugas')
                                ->required()
                                ->relationship('spt', 'nama'),
                            Forms\Components\TextInput::make('bentuk')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('tujuan')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('sasaran')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('waktem')
                                ->label('Waktu dan Tempat')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('uraian')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                        ])
                ]),
                Wizard\Step::make('Dugaan Pelanggaran')
                    ->schema([
                        Forms\Components\TextInput::make('peristiwa_pel')
                            ->label('Peristiwa Pelanggaran')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tem_kejadian_pel')
                            ->label('Tempat Kejadian Pelanggaran')
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('wak_kejadian_pel')
                            ->label('Waktu Kejadian Pelanggaran')
                            ->format('dd-mm-YYYY'),
                        Forms\Components\TextInput::make('pelaku_pel')
                            ->label('Pelaku Pelanggaran')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('alamat_pel')
                            ->label('Alamat Pelanggaran')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nama_saksi_1')
                            ->label('Nama Saksi 1')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('alamat_saksi_1')
                            ->label('Alamat Saksi 1')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nama_saksi_2')
                            ->label('Nama Saksi 2')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('alamat_saksi_2')
                            ->label('Alamat Saksi 2')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('alat_bukti_1')
                            ->label('Alat Bukti 1')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('alat_bukti_2')
                            ->label('Alat Bukti 2')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('alat_bukti_3')
                            ->label('Alat Bukti 3')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bb_1')
                            ->label('Barang Bukti 1')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bb_2')
                            ->label('Barang Bukti 2')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bb_3')
                            ->label('Barang Bukti 3')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('uraian_pel')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('fakta_pel')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('analisa_pel')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(2),
                Wizard\Step::make('Informasi Sengketa')
                    ->schema([
                        Forms\Components\TextInput::make('tempat_seng')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('waktu_kejadian_seng')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bentuk_seng')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('identitas_seng')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('hari_seng')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('kerugian_seng')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('uraian_seng')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('tanggal_lap_seng')
                            ->required(),
                    ])->columns(3),
                Wizard\Step::make('Dokumentasi')
                    ->schema([
                        Forms\Components\FileUpload::make('dok1')
                        ->optimize('jpg'),
                        Forms\Components\FileUpload::make('dok2')
                        ->optimize('jpg'),
                        Forms\Components\FileUpload::make('dok3')
                        ->optimize('jpg'),
                        Forms\Components\FileUpload::make('dok4')
                        ->optimize('jpg')
                    ])->columns(2),
            ])->columnSpanFull()
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nomor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahapan.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kel.name')
                    ->label('Desa/Kelurahan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Petugas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('spt.nama')
                    ->label('Nomor SPT')
                    ->sortable(),
                Tables\Columns\TextColumn::make('bentuk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tujuan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sasaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('waktem')
                    ->label('Waktu & Tempat Kejadian')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('dok1')
                    ->label('Dokumentasi 1'),
                Tables\Columns\ImageColumn::make('dok2')
                    ->label('Dokumentasi 2'),
                Tables\Columns\ImageColumn::make('dok3')
                    ->label('Dokumentasi 3'),
                Tables\Columns\ImageColumn::make('dok4')
                    ->label('Dokumentasi 4'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                // EXPORT
                Tables\Actions\Action::make('Cetak')
                    ->icon('heroicon-o-printer')
                    ->action(function (Lhp $lhp, array $data) {
                        $templateProcessor = new TemplateProcessor('word-template/lhp.docx');
                        $templateProcessor->setValue('noreg', $lhp->nomor);
                        $templateProcessor->setValue('tahapan', $lhp->tahapan->name);
                        $templateProcessor->setValue('namapkd', $lhp->user->name);
                        $templateProcessor->setValue('jabatan', 'PKD' .' '. $lhp->user->kel->name);
                        $templateProcessor->setValue('nospt', $lhp->spt->kode);
                        $templateProcessor->setValue('alamat', $lhp->user->alamat);
                        $templateProcessor->setValue('bentuk', $lhp->bentuk);
                        $templateProcessor->setValue('tujuan', $lhp->tujuan);
                        $templateProcessor->setValue('sasaran', $lhp->sasaran);
                        $templateProcessor->setValue('waktem', $lhp->waktem);
                        $templateProcessor->setValue('uraian', strip_tags($lhp->uraian));
                        $templateProcessor->setValue('peristiwa_pel', $lhp->peristiwa_pel);
                        $templateProcessor->setValue('tem_kejadian_pel', $lhp->tem_kejadian_pel);
                        $templateProcessor->setValue('wak_kejadian_pel', $lhp->wak_kejadian_pel);
                        $templateProcessor->setValue('pelaku_pel', $lhp->pelaku_pel);
                        $templateProcessor->setValue('alamat_pel', $lhp->alamat_pel);
                        $templateProcessor->setValue('nama_saksi_1', $lhp->nama_saksi_1);
                        $templateProcessor->setValue('alamat_saksi', $lhp->alamat_saksi_1);
                        $templateProcessor->setValue('nama_saksi_2', $lhp->nama_saksi_2);
                        $templateProcessor->setValue('alamat_saksi_2', $lhp->alamat_saksi_2);
                        $templateProcessor->setValue('alat_bukti_1', $lhp->alat_bukti_1);
                        $templateProcessor->setValue('alat_bukti_2', $lhp->alat_bukti_2);
                        $templateProcessor->setValue('alat_bukti_3', $lhp->alat_bukti_3);
                        $templateProcessor->setValue('bb_1', $lhp->bb_1);
                        $templateProcessor->setValue('bb_2', $lhp->bb_2);
                        $templateProcessor->setValue('bb_3', $lhp->bb_3);
                        $templateProcessor->setValue('uraian_pel', $lhp->uraian_pel);
                        $templateProcessor->setValue('fakta_pel', $lhp->fakta_pel);
                        $templateProcessor->setValue('analisa_pel', $lhp->analisa_pel);
                        $templateProcessor->setValue('peserta_pemilu_seng', $lhp->peserta_pemilu_seng);
                        $templateProcessor->setValue('tempat_seng', $lhp->tempat_seng);
                        $templateProcessor->setValue('waktu_kejadian_seng', $lhp->waktu_kejadian_seng);
                        $templateProcessor->setValue('bentuk_seng', $lhp->bentuk_seng);
                        $templateProcessor->setValue('identitas_seng', $lhp->identitas_seng);
                        $templateProcessor->setValue('hari_seng', $lhp->hari_seng);
                        $templateProcessor->setValue('kerugian_seng', $lhp->kerugian_seng);
                        $templateProcessor->setValue('uraian_seng', $lhp->uraian_seng);
                        $bulanIndonesia = [
                            "01" => "Januari",
                            "02" => "Februari",
                            "03" => "Maret",
                            "04" => "April",
                            "05" => "Mei",
                            "06" => "Juni",
                            "07" => "Juli",
                            "08" => "Agustus",
                            "09" => "September",
                            "10" => "Oktober",
                            "11" => "November",
                            "12" => "Desember"
                        ];
                        list($tahun, $bulan, $tanggal) = explode("-", $lhp->tanggal_lap_seng);
                        $namaBulan = $bulanIndonesia[$bulan];
                        $tanggalDalamBahasaIndonesia = "$tanggal $namaBulan $tahun";
                        $templateProcessor->setValue('tanggal_lap_seng', $tanggalDalamBahasaIndonesia);
                        $templateProcessor->setImageValue('ttd', 'storage/'.$lhp->user->ttd);
                        //Proses Dokumentasi
                        if (($lhp->dok1)) {
                            $templateProcessor->setImageValue('dok1', 'storage/'.$lhp->dok1);
                        } else {
                            $templateProcessor->setValue('dok1', '');
                        }
                        if (($lhp->dok2)) {
                            $templateProcessor->setImageValue('dok2', 'storage/'.$lhp->dok2);
                        } else {
                            $templateProcessor->setValue('dok2', '');
                        }
                        if (($lhp->dok3)) {
                            $templateProcessor->setImageValue('dok3', 'storage/'.$lhp->dok3);
                        } else {
                            $templateProcessor->setValue('dok3', '');
                        }
                        if (($lhp->dok4)) {
                            $templateProcessor->setImageValue('dok4', 'storage/'.$lhp->dok4);
                        } else {
                            $templateProcessor->setValue('dok4', '');
                        }
                        $fileName= str_replace("/", "-", $lhp->nomor);
                        $templateProcessor->saveAs($fileName . '.docx');
                        return response()
                            ->download($fileName . '.docx')
                            ->deleteFileAfterSend(true);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLhps::route('/'),
            'create' => Pages\CreateLhp::route('/create'),
            'edit' => Pages\EditLhp::route('/{record}/edit'),
        ];
    }
}
