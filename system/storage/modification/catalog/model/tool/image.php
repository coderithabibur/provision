<?php
class ModelToolImage extends Model {
	public function resize($filename, $width, $height) {

               if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
                    $server = HTTPS_SERVER;
                } else {
                    $server = HTTP_SERVER;
                }
                if ($filename) {
                    $image_info = @getimagesize(DIR_IMAGE . $filename);
                    if (!$image_info) {
                        return $server . 'image/' . $filename;
                    }
                } else {
                    $filename = "no_image.png";
                } 
		if (!is_file(DIR_IMAGE . $filename)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$old_image = $filename;
		$new_image = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

		if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image))) {
			$path = '';

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_IMAGE . $old_image);
				$image->resize($width, $height);
				$image->save(DIR_IMAGE . $new_image);
			} else {
				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
			}
		}

        // --- FIX: Fallback if cache generation failed ---
        if (!is_file(DIR_IMAGE . $new_image)) {
            // Try to use the no_image placeholder
            if (is_file(DIR_IMAGE . 'no_image.jpg')) {
                 copy(DIR_IMAGE . 'no_image.jpg', DIR_IMAGE . $new_image);
            } elseif (is_file(DIR_IMAGE . 'no_image.png')) {
                 copy(DIR_IMAGE . 'no_image.png', DIR_IMAGE . $new_image);
            }
        }
        // --- END FIX ---
        // Fix: Disable CloudFront on local environment
        $is_local = (strpos($this->request->server['HTTP_HOST'], '.test') !== false) || (strpos($this->request->server['HTTP_HOST'], 'localhost') !== false);
        
        if (!empty($this->config->get('config_cloudfront_url')) && !$is_local) {
            if ($this->request->server['HTTPS']) {
                return $this->config->get('config_cloudfront_url') . '/image/' . $new_image;
            } else {
                return $this->config->get('config_cloudfront_url') . '/image/' . $new_image;
            }
		} else {
            if ($this->request->server['HTTPS']) {
                return $this->config->get('config_ssl') . 'image/' . $new_image;
            } else {
                return $this->config->get('config_ssl') . 'image/' . $new_image;
            }
        }
	}
}
