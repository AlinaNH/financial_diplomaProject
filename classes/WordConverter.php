<?php

class WordConverter // Класс для обработки файлов .doc и .docx
{
    private $filename; // Переменная, хранящая имя файла

    public function __construct($filePath) { // Конструктор класса
        $this->filename = $filePath;
    }

    private function read_doc() { // Функция для парсирования данных файла .doc в единую строку
        $fileHandle = fopen($this->filename, "r"); // Открытие файла
        $line = @fread($fileHandle, filesize($this->filename)); // Чтение файла (в качестве строки)
        $lines = explode(chr(0x0D),$line); // Деление строки по символам перевода строки
        $outtext = "";
        foreach($lines as $thisline) // Для каждой строки документа
        {
            $pos = strpos($thisline, chr(0x00)); // Вернуть первое вхождение подстроки, равное null
            if (($pos !== FALSE)||(strlen($thisline)==0))
            {
            } else {
                $outtext .= $thisline." "; // Если первое вхождение подстроки равно null и длина даннной строки равно нулю, то добавить ее к общей строке
            }
        }
        $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext); // Коррекция строки (весь документ преобразован в единую чистую строку)
        return $outtext;
    }

    private function read_docx(){ // Функция для парсирования данных файла .docx в единую строку

        $striped_content = '';
        $content = '';

        $zip = zip_open($this->filename); // Открытие файла

        if (!$zip || is_numeric($zip)) return false; // Если файл имеет числовой тип данных, то закончить процесс обработки

        while ($zip_entry = zip_read($zip)) { // Пока файл читается

            if (zip_entry_open($zip, $zip_entry) == FALSE) continue; // Если не открылась дирекция для прочтения, то продолжить обработку (обработка разметки xml)

            if (zip_entry_name($zip_entry) != "word/document.xml") continue; // Если открытая дирекция не равна word/document.xml, то продолжить обработку

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry)); // Чтение дирекция файла (преобразование в строку)

            zip_entry_close($zip_entry); // Закрыть дирекцию
        }// end while

        zip_close($zip); // Закрыть файл

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content); // Очистка строки от лишних тегов
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content); // Удаление тегов html и php из строки

        return $striped_content;
    }


    public function convertToText() { // Функция конвертирования файлов в строку

        if(isset($this->filename) && !file_exists($this->filename)) { // Если не получено имя файла, то возвращать сообщение о том, что файл не существует
            return "File Not exists";
        }

        $fileArray = pathinfo($this->filename); // Переменная, хранящая информацию о пути к файлу
        $file_ext  = $fileArray['extension']; // Переменная, хранящая расширение файла
        if($file_ext == "doc" || $file_ext == "docx") // Если расширение файла .doc или .docx
        {
            if($file_ext == "doc") { // Если расширение файла .doc
                return $this->read_doc(); // Возвращать функцию для парсирования данных файла .doc в единую строку
            } elseif($file_ext == "docx") { // Если расширение файла .docx
                return $this->read_docx(); // Возвращать функцию для парсирования данных файла .docx в единую строку
            }
            else {
                return "Invalid File Type"; // Иначе, возвращать сообщение о недействительном расширении файла
            }
        }
    }
}