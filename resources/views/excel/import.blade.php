<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('submitImport') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="fileUpload">
        <button type="submit">Save</button>
    </form>
    <form action="{{ route('submitExport') }}" method="get">
        <button type="submit">Export</button>
    </form>
</body>

</html>