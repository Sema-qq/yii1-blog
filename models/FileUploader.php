<?php

namespace models;

use base\BaseModel;
use SplFileInfo;

/**
 * Class PhotoUploader
 */
class FileUploader extends BaseModel
{
    const MAX_FILE_SIZE = 2097152;

    // свойство для формы
    public $file;

    // данные из массива $_FILES
    public $name;
    public $type;
    public $tmp_name;
    public $error;
    public $size;

    // массив с разрешенными расширениями файла
    private $extensions = [];
    // конечное имя файла
    private $filename;
    /** @var SplFileInfo для удобства работы с файлом */
    private $SFI;

    public function __construct(array $extensions)
    {
        $this->extensions = $extensions;
    }

    public function labels()
    {
        return [
            'file' => 'Файл'
        ];
    }

    public function validate()
    {
        if ($this->error) {
            switch ($this->error) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $message = "Размер превысил максимально допустимый - 2 мегабайта.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $message = "Был получен частично.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $message = "Не был загружен.";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $message = "Отсутствует временная папка.";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $message = "Не удалось записать на диск.";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $message = "Расширение нам не подошло.";
                    break;
                default:
                    $message = "Неизвестная ошибка.";
                    break;
            }
            $this->setError('file', "Ошибка при загрузке: {$message}");
        } elseif (!$this->name) {
            $this->setError('file', 'Не удалось получить имя.');
        } elseif ($this->SFI && !in_array($this->SFI->getExtension(), $this->extensions)) {
            $this->setError('file', 'Может быть только "png" или "jpg".');
        } elseif ($this->size > self::MAX_FILE_SIZE) {
            $this->setError('file', 'Размер не больше двух мегабайт.');
        }

        return !$this->hasErrors();
    }

    public function upload()
    {
        $this->SFI = new SplFileInfo($this->name);

        if ($this->validate()) {
            return $this->saveFile();
        }

        return false;
    }

    private function saveFile()
    {
        $this->setFileName();

        if (copy($this->tmp_name, UPLOAD_DIR . $this->filename) && file_exists(UPLOAD_DIR . $this->filename)) {
            return $this->filename;
        }

        $this->setError('file', 'Не удалось скопировать из временной директории в постоянную.');

        return false;
    }

    private function setFileName()
    {
        $extension = $this->SFI->getExtension();
        $this->filename =  strtolower(md5(uniqid(basename($this->name, $extension))) . '.' . $extension);
    }
}
