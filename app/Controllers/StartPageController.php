<?php

namespace App\Controllers;
use App\Models\LocationRegisterModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class StartPageController extends BaseController
{
    public function index(){
        $data['noValid']=false;
        return view('Excel_view',$data);
    }

    public function exportExcel(){
        $session = \Config\Services::session();
        try {
            $fileType =$_FILES['files']['name'];
            $file =  $_FILES['files']['tmp_name'];
            $arr_file = explode('.', $_FILES['files']['name']);
            $extension = end($arr_file);
            if($extension == 'csv'){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            }else{
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['files']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $LocationRegisterModel = new LocationRegisterModel();
            foreach($sheetData as $key=>$exldata){
                if($key==0){
                    continue;
                }
                $data = [
                    'register_id'=>$exldata[0], // need to upload unique id from excel.
                    'location_title' => $exldata[1],
                    'location_description'  => $exldata[2],
                    'room_no'  => $exldata[3],
                    'contract_id'  => $exldata[4],
                    'site_id'  => $exldata[5],
                    'building_id'  => $exldata[6],
                    'floor_id'  => $exldata[7],
                    'zone_id'  => $exldata[8],
                    'register_status'  => $exldata[9],
                    'created_by'  => $exldata[10],
                    'updated_by'  => $exldata[11],
                    'created_date'  => $exldata[12],
                    'updated_date'  => $exldata[13],
                    'loc_type'  => $exldata[14]
                ];
                $testing =  $LocationRegisterModel->insert($data);
            }
            $session->setFlashdata('success', 'Excel uploaded successfully !');
            return redirect()->to('/'); 
            
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $session->setFlashdata('error', $error);
            return redirect()->to('/'); 
            // die($e->getMessage());
        }
    }
}
