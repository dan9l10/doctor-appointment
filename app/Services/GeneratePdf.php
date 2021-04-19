<?php

namespace App\Services;

use PDF;
use File;


class GeneratePdf
{
    protected $style = array(
        'position' => '',
        'align' => 'C',
        'stretch' => false,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => true,
        'hpadding' => 'auto',
        'vpadding' => 'auto',
        'fgcolor' => array(0,0,0),
        'bgcolor' => false, //array(255,255,255),
        'text' => true,
        'font' => 'helvetica',
        'fontsize' => 8,
        'stretchtext' => 4
    );

    public function generateTicket($userId,$data){

        $savePath = storage_path('app/public/files/tickets/user/'.$userId.'/');

        $fileName = str_replace([' ',':'],'_',date("Y-m-d H:i:s")).'.pdf';
        $pathToFile = $savePath.$fileName;

        File::makeDirectory($savePath, $mode = 0755, true, true);
        PDF::SetTitle('Ticket');
        PDF::SetFont('freesans', '', 8, '', true);
        PDF::AddPage();
        PDF::setBarcode(date('Y-m-d H:i:s'));
        PDF::write1DBarcode('CODE 39', 'C39', '', '', '', 18, 0.4, $this->style, 'N');
        PDF::writeHTML(view('mail.layouts.ticket',compact('data'))->render());
        PDF::Output($pathToFile, 'F');
        PDF::reset();
        return $pathToFile;
    }

}
