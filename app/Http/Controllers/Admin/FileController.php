<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\CsvParser;
use App\Http\Controllers\Controller;
use App\Models\Sample;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\CsvTemp;

class FileController extends Controller
{

    public function parseCsv(Request $request)
    {
        $file = new CsvParser();
        $file->load($request->file('csv_file'));

        if($request->has('header'))
        {
            $data = $file->read(true);
            $headings = $file->headings();
        }else {
            $data = $file->read(false);
        }

        if(count($data) > 0)
        {
            $tempCsvData = CsvTemp::create([
                "filename" => $request->file('csv_file')->getClientOriginalName(),
                "header" => $request->has('header'),
                "data" => json_encode($data)
            ]);
        }
        return response()->json(["headings"=>$headings ?? null, "data"=>$data, "tempCsvDataId"=>$tempCsvData->id]);
    }

    public function processCsv(Request $request)
    {
        $tempData = CsvTemp::find($request->tempDataId);
        $csv_data = json_decode($tempData->data, true);

        foreach ($csv_data as $row) {
//            $contact = new Contact();
//
//            foreach (config('csv.fields') as $index => $field) {
//                if ($tempData->header) {
//                    $contact->$field = $row[$request->fields[$field]];
//                } else {
//                    if($request->fields[$index] != -1) {
//                        $contact->$field = $row[$request->fields[$index]];
//                    }
//                }
//            }
//            $contact->save();

            $sample = new Sample();
            $response = array();

            foreach (config('csv.fields_sample') as $index => $field) {
                if ($tempData->header) {
                    $sample->$field = $row[$request->fields[$field]];
                } else {
                    if($request->fields[$index] != -1){
                        $sample->$field = $row[$request->fields[$index]];
                    }
                }
            }
            $sample->save();
        }

        return response()->json($sample);
    }
}
