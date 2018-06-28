<?php 

/**
* Strong Blur
*
* @param resource $gdImageResource 
* @param int $blurFactor optional 
*  This is the strength of the blur
*  0 = no blur, 3 = default, anything over 5 is extremely blurred
* @return GD image resource
* @author Martijn Frazer, idea based on http://stackoverflow.com/a/20264482
*/
function blur($gdImageResource, $blurFactor = 3)
{
  // blurFactor has to be an integer
  $blurFactor = round($blurFactor);
  
  $originalWidth = imagesx($gdImageResource);
  $originalHeight = imagesy($gdImageResource);

  $smallestWidth = ceil($originalWidth * pow(0.5, $blurFactor));
  $smallestHeight = ceil($originalHeight * pow(0.5, $blurFactor));

  // for the first run, the previous image is the original input
  $prevImage = $gdImageResource;
  $prevWidth = $originalWidth;
  $prevHeight = $originalHeight;

  // scale way down and gradually scale back up, blurring all the way
  for($i = 0; $i < $blurFactor; $i += 1)
  {    
    // determine dimensions of next image
    $nextWidth = $smallestWidth * pow(2, $i);
    $nextHeight = $smallestHeight * pow(2, $i);

    // resize previous image to next size
    $nextImage = imagecreatetruecolor($nextWidth, $nextHeight);
    imagecopyresized($nextImage, $prevImage, 0, 0, 0, 0, 
      $nextWidth, $nextHeight, $prevWidth, $prevHeight);

    // apply blur filter
    imagefilter($nextImage, IMG_FILTER_GAUSSIAN_BLUR);

    // now the new image becomes the previous image for the next step
    $prevImage = $nextImage;
    $prevWidth = $nextWidth;
      $prevHeight = $nextHeight;
  }

  // scale back to original size and blur one more time
  imagecopyresized($gdImageResource, $nextImage, 
    0, 0, 0, 0, $originalWidth, $originalHeight, $nextWidth, $nextHeight);
  imagefilter($gdImageResource, IMG_FILTER_GAUSSIAN_BLUR);

  // clean up
  imagedestroy($prevImage);

  // return result
  return $gdImageResource;
}
?>
up
down
12 yoann at yoone dot eu ¶4 years ago
Here is an alternative to IMG_FILTER_COLORIZE filter, but taking the alpha parameter of each pixel in account. 

<?php 
function rgba_colorize($img, $color) 
{ 
    imagesavealpha($img, true); 
    imagealphablending($img, true); 

    $img_x = imagesx($img); 
    $img_y = imagesy($img); 
    for ($x = 0; $x < $img_x; ++$x) 
    { 
        for ($y = 0; $y < $img_y; ++$y) 
        { 
            $rgba = imagecolorsforindex($img, imagecolorat($img, $x, $y)); 
            $color_alpha = imagecolorallocatealpha($img, $color[0], $color[1], $color[2], $rgba['alpha']); 
            imagesetpixel($img, $x, $y, $color_alpha); 
            imagecolordeallocate($img, $color_alpha); 
        } 
    } 
} 
?>

