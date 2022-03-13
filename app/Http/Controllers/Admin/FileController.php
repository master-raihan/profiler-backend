<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\CsvParser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function parseCsv(Request $request)
    {
        $file = new CsvParser();

        $file->load('/home/raihanul/Downloads/data.csv');
        return $file->read();
    }
}
