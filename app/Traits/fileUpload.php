<?php

namespace App\Traits;


    use Illuminate\Http\Request;
    use Illuminate\Support\Str;

    trait fileUpload
    {
        public function FileUpload(Request $request ,$directory,$fileName,$sub_directory = null)
        {

            $filePathName = Str::random(6).$request->file($fileName)
                ->getClientOriginalName();

          return  $request->file($fileName)
                ->storeAs('public/'.$directory.'/'.$sub_directory,
                    $filePathName);
        }
    }