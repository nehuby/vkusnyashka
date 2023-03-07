<?
function getRandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < 10; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

function uploadImage()
{
    $upload_folder = "../uploads/";
    $upload_file = substr(strrchr($_FILES["photo"]["name"], "."), 1);
    $upload = getRandomString() . ".$upload_file";
    $upload_name = $upload_folder . $upload;
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $upload_name)) {
        return $upload;
    }
    return null;
}
