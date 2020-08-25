<?php
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.24;	
 * -D- Класс library_files отвечает за файловую библиотеку
*/
class library_files {
    private $dir_uploads = '/uploads/',
            $max_size = 2097152;
    public function upload($FILE, $access_mimes = array('jpg' => 'image/jpeg', 'png' => 'image/png')) {
        try {
            if (
                !isset($FILE['error']) ||
                is_array($FILE['error'])
            ) {
                throw new RuntimeException('Неправильный формат файла');
            }
            switch ($FILE['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('Файл не отправлен');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Превышен размер файла');
                default:
                    throw new RuntimeException('Неизвестная ошибка');
            }
        
            if ($FILE['size'] > $this->max_size) {
                throw new RuntimeException('Превышен размер файла');
            }
        
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($FILE['tmp_name']),
                $access_mimes,
                true
            )) {
                throw new RuntimeException('Неправильный формат файла');
            }
            $tmp = sprintf(CONSTRUCTOR_PATH . $this->dir_uploads . '/%s.%s',
                sha1_file($FILE['tmp_name']),
                $ext
            );
            if (!move_uploaded_file(
                $FILE['tmp_name'],
                $tmp
            )) {
                throw new RuntimeException('Проблема загрузки файла');
            }
        
            return array(
                'upload'    => true,
                'error'     => NULL,
                'tmp'       => $this->dir_uploads . basename($tmp)
            );
        
        } catch (RuntimeException $e) {
        
            return array(
                'upload'    => false,
                'error'     => $e->getMessage()
            );
        
        }
    }
}
?>