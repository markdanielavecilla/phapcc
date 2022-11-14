<?php
    $viewPdf = $_GET['v'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $viewPdf ?></title>
</head>
<body>
    

    <div id="adobe-dc-view"></div>
    <script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
    <script type="text/javascript">
        document.addEventListener("adobe_dc_view_sdk.ready", function(){ 
            var adobeDCView = new AdobeDC.View({clientId: "8b2d65e068d049a69502ee79e7c11d96", divId: "adobe-dc-view"});
            adobeDCView.previewFile({
                content:{location: {url: "files/<?= $viewPdf ?>"}},
                metaData:{fileName: "<?= $viewPdf ?>"}
            }, {});
        });
</script>
</body>
</html>