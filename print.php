<?php
// Receive a base64 image string without the `data:image/png;base64,` metadata
$imageData = $_POST['image_data'];

$imageData = str_replace(' ', '+', $imageData);

// Decode base64 image into binary image
$image = base64_decode($imageData);

// Save the image in current directory
$result = file_put_contents('image-to-print.png', $image);

// Check if the OS is Windows or Mac
if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
	// For Windows: Print the saved image via mspaint command
	echo exec('mspaint /pt image-to-print.png');
} else {
	// For OSX: Print the saved image via lpr command
	echo exec('lpr -o landscape -o fit-to-page image-to-print.png');
}

?>