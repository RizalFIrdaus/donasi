<?php

namespace App\Service\Imp;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Service\PhotoService;
use Illuminate\Support\Facades\Auth;
use Google\Cloud\Storage\StorageClient;

class StoreServiceImp implements PhotoService
{
    public function storePhoto(Request $request, $obj, $name)
    {
        if ($request->file($name)) {
            $storage = new StorageClient([
                "project_id" => "donasi-a8c3d",
                "keyFilePath" => base_path("config/credential-firebase.json")
            ]);
            $bucket = $storage->bucket("donasi-a8c3d.appspot.com");
            $fileContent = file_get_contents($request->file($name)->getPathname());
            $objectName = uniqid() . "." . $request->file($name)->getClientOriginalName();
            if ($obj->donation_photo) {
                $bucket->object('campaign/medical/' . $obj->donation_photo_file)->delete();
            }
            $object = $bucket->upload($fileContent, [
                'name' => 'campaign/medical/' . $objectName
            ]);
            $obj->donation_photo = $object->signedUrl(Carbon::now()->addYears(50));
            $obj->donation_photo_file = $objectName;
        }
    }
}
