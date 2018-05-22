 <?php    

 if (!file_exists('upload/003')) {
    mkdir('upload/003', 0777, true);
}
                          $dir = glob("upload/001/*.*");
                        for ($i=0; $i<count($dir); $i++)
                          {
                            $image_name = $dir[$i];
                            $supported_format = array('gif','jpg','jpeg','png');
                            $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                            if (in_array($ext, $supported_format))
                                {
                                  echo '<img src="'.$image_name .'" alt="'.$image_name.'" data-big="'.$image_name.'" />'."<br /><br />";
                                } else {
                                    continue;
                                }                         
                 } ?>