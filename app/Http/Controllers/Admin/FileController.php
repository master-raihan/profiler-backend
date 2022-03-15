<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\CsvParser;
use App\Http\Controllers\Controller;
use App\Models\Sample;
use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    public function uploadCsv(Request $request)
    {
        if($request->has('csvFile'))
        {
            $allowedFileExtension=['csv'];
            $csvFile = $request->file('csvFile');
            $extension = $csvFile->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);

            if($check){
                $name = time() . '-' .$csvFile->getClientOriginalName();
                $csvFile->move('csv-files', $name);

                $file = [
                    'user_id' => 1,
                    'file_name_location' => 'csv-files/'.$name
                ];
                $uploadedCsvFile = File::create($file);

                $file = new CsvParser();
                $csvFile = File::find($uploadedCsvFile->id);
                $file->load($csvFile->file_name_location);
                if($request->has('header'))
                {
                    $csvData = $file->read(true);
                    $headings = $file->headings();
                }else {
                    $csvData = $file->read(false);
                }

                return response()->json(['headings'=>$headings ?? null, 'csvData'=>$csvData, 'csvFile' => $uploadedCsvFile]);
            }
        }
    }

    public function processCsv(Request $request)
    {
        if($request->has('csvFileId'))
        {
            $file = new CsvParser();
            $csvFile = File::find($request->csvFileId);
            $file->load($csvFile->file_name_location);
            $response = array();

            if($request->has('header'))
            {
                $csvData = $file->read(true);
                $headings = $file->headings();
            }else {
                $csvData = $file->read(false);
            }
            foreach ($csvData as $row) {
                $sample = new Sample();

                foreach (config('csv.fields_sample') as $index => $field) {
                    if ($request->has('header')) {
                        if ($request->fields[$field] != -1)
                        {
                            $sample->$field = $row[$request->fields[$field]];
                        }
                    } else {
                        if ($request->fields[$index] != -1) {
                            $sample->$field = $row[$request->fields[$index]];
                        }
                    }
                }
                $sample->save();
                $response[] = $sample;
            }
        }

        return response()->json($response);
    }

}
