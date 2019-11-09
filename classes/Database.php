<?php

class Database{ // Класс для работы с базой данных 

    private $db_host = "den1.mysql5.gear.host"; // Наименование хоста базы данных 
    private $db_username = "dbfinancial"; // Имя пользователя базы данных 
    private $db_password = "Lv884ZF_v!E3"; // Пароль базы данных 
    private $db_name = "dbfinancial"; // Имя базы данных 

    private $con = false; // Переменная для проверки подключения к базе данных, изначально отключено 
    private $myconn = ""; // Переменная персонального подключения к базе данных 
    private $result = array(); // Переменная, хранящая результат запроса 
    private $myQuery = ""; // Переменная, хранящая запрос с персональными параметрами 
    private $numResults = ""; // Возращает количество строк результата запроса 

    public function connect(){ // Функция подключения к базе данных 
        if(!$this->con){
            $this->myconn = new mysqli($this->db_host,$this->db_username,$this->db_password,$this->db_name);  // Персональное подключение к базе данных 
            if($this->myconn->connect_errno > 0){
                array_push($this->result,$this->myconn->connect_error);
                return false; // В случае возникновения ошибки функция возращает false 
            }
            else{
                $this->con = true;
                return true; // Соединение установлено 
            }
        }
        else{
            return true; // Соединение уже было установлено 
        }
    }

    public function disconnect(){ // Функция отключения базы данных 
        if($this->con){
            if($this->myconn->close()){ // Если соединение уже установлено, применяется функция закрытия соединения 
                $this->con = false; // Соединение отключено 
                return true;
            }
            else {
                return false; // Соединение не отключилось 
            }
        }
    }

    public function sql($sql){ // Функция работы с SQL-запросом 
        $query = $this->myconn->query($sql);
        $this->myQuery = $sql; // Возращается результат SQL-запроса 
        if($query){ // Если запрос возращает одну или больше строк, то количество этих строк помещается в NumResults 
            $this->numResults = $query->num_rows;
            for($i = 0; $i < $this->numResults; $i++){
                $r = $query->fetch_array(); // Каждая строка запроса помещается в ассоциативный массив 
                $key = array_keys($r); // Возращаются ключи, содержащиеся в массиве 
                for($x = 0; $x < count($key); $x++){
                    if(!is_int($key[$x])){
                        if($query->num_rows >= 1){
                            $this->result[$i][$key[$x]] = $r[$key[$x]]; // В случае, если из данного количества ключей один ключ имеет не целый тип данных в резульате SQL-запроса,имеющего больше одной строки результатов, то результат этого SQL-запроса попадает во вложенный массив с целыми ключами и результатами этого SQL-запроса 
                        }
                        else{
                            $this->result = null;  // В ином случае результат отсутствует 
                        }
                    }
                }
            }
            return true; // SQL-запрос успешно завершен 
        }
        else {
            array_push($this->result,$this->myconn->error);
            return false; // В случае ошибки SQL-запрос не выполняется 
        }
    }

    public function select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null){ // Функция выбора данных из таблицы базы данных 
        $q = 'SELECT '.$rows.' FROM '.$table; // Если были введены дополнительные параметры SQL-запроса, то они добавляются к ее формулировке 
        if($join != null){
            $q .= ' JOIN '.$join;
        }
        if($where != null){
            $q .= ' WHERE '.$where;
        }
        if($order != null){
            $q .= ' ORDER BY '.$order;
        }
        if($limit != null){
            $q .= ' LIMIT '.$limit;
        }
        $this->myQuery = $q; // Возращается результат SQL-запроса 
        if($this->tableExists($table)){
            $query = $this->myconn->query($q); // Если введенная таблица существует, то запускается запрос 
            if($query){ // Если запрос возращает одну или больше строк, то количество этих строк помещается в NumResults 
                $this->numResults = $query->num_rows;
                for($i = 0; $i < $this->numResults; $i++){
                    $r = $query->fetch_array(); // Каждая строка запроса помещается в ассоциативный массив 
                    $key = array_keys($r); // Возращаются ключи, содержащиеся в массиве 
                    for($x = 0; $x < count($key); $x++){
                        if(!is_int($key[$x])){
                            if($query->num_rows >= 1){
                                $this->result[$i][$key[$x]] = $r[$key[$x]]; // В случае, если из данного количества ключей один ключ имеет не целый тип данных в резульате SQL-запроса,имеющего больше одной строки результатов, то результат этого SQL-запроса попадает во вложенный массив с целыми ключами и результатами этого SQL-запроса 
                            }
                            else{
                                $this->result[$i][$key[$x]] = null; // В ином случае результат отсутствует 
                            }
                        }
                    }
                }
                return true; // SQL-запрос успешно завершен 
            }
            else{
                array_push($this->result,$this->myconn->error);
                return false; // В случае ошибки SQL-запрос не выполняется (возращается 0 строк) 
            }
        }
        else{
            return false; // Введенная таблица не существует 
        }
    }

    public function insert($table,$params=array()){ // Функция добавления данных в таблицу базы данных
        if($this->tableExists($table)){
            $sql='INSERT INTO `'.$table.'` (`'.implode('`, `',array_keys($params)).'`) VALUES ("' . implode('", "', $params) . '")'; //В случае, если введенная таблица существует, введенные данные добавляются в формулировке операции и обрабатываются в последующем в качестве массива данных 
            $this->myQuery = $sql; // Возращается результат SQL-запроса 
            if($ins = $this->myconn->query($sql)){
                array_push($this->result,$this->myconn->insert_id);
                return true; // Операция успешно выполнена 
            }
            else{
                array_push($this->result,$this->myconn->error);
                return false; // Операция не выполнена 
            }
        }
        else{
            return false; // Введенная таблица не существует 
        }
    }

    public function delete($table,$where = null){ // Функция удаления данных из таблицы базы данных 
        if($this->tableExists($table)){ // Проверка существования введеного имени таблицы в базе данных 
            if($where == null){
                $delete = 'DROP TABLE '.$table; // Если нет параметра where, формируется операция удаления таблицы 
            }
            else{
                $delete = 'DELETE FROM '.$table.' WHERE '.$where; // Если есть параметр where, формируется операция удаления строк из таблицы 
            }
            if($del = $this->myconn->query($delete)){
                array_push($this->result,$this->myconn->affected_rows);
                $this->myQuery = $delete; // Выполнение операции удаления данных из таблицы базы данных 
                return true; // Операция успешно выполнена 
            }
            else{
                array_push($this->result,$this->myconn->error);
                return false; // Операция не выполнена 
            }
        }
        else{
            return false; // Введенная таблица не существует 
        }
    }

    public function update($table,$params=array(),$where){ // Функция обновления данных в базе данных 
        if($this->tableExists($table)){ // Проверка существования введеного имени таблицы в базе данных 
            $args=array(); // Создается массив, который будет хранить данные, которые нужно обновить в базе данных 
            foreach($params as $field=>$value){
                $args[]=$field.'="'.$value.'"'; // Каждый введенный параметр добавляется в массив 
            }
            $sql='UPDATE '.$table.' SET '.implode(',',$args).' WHERE '.$where; // Создается операция обновления данных в базе данных 
            $this->myQuery = $sql; // Возращается результат SQL-запроса 
            if($query = $this->myconn->query($sql)){
                array_push($this->result,$this->myconn->affected_rows);
                return true; // Операция успешно выполнена 
            }
            else{
                array_push($this->result,$this->myconn->error);
                return false; // Операция не выполнена 
            }
        }
        else{
            return false; // Введенная таблица не существует 
        }
    }

    private function tableExists($table){ // Функция проверки существования введенного имени таблицы в базе данных 
        $tablesInDb = $this->myconn->query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"'); // Запрос, который показывает все таблицы в базе данных с похожим именем 
        if($tablesInDb){
            if($tablesInDb->num_rows == 1){
                return true; // Введенная таблица существует 
            }
            else{
                array_push($this->result,$table." does not exist in this database");
                return false; // Введенная таблица не существует 
            }
        }
    }

    public function getResult(){ // Функция, которая возращает пользователю результат SQL-запроса 
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    public function getSql(){ // Функция, которая возращает пользователю SQL-запрос 
        $val = $this->myQuery;
        $this->myQuery = array();
        return $val;
    }

    public function numRows(){ // Функция, которая возращает пользователю количество строк в запросе 
        $val = $this->numResults;
        $this->numResults = array();
        return $val;
    }

    public function escapeString($data){ // Функция, преобразующая данные в строковый тип данных 
        return $this->myconn->real_escape_string($data);
    }
}