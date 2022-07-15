<?php

    class DB
    {
        private static $conexao;
        
        public function getInstance(){
            if(!isset(self::$conexao)){
                try {
                    self::$conexao= new PDO("mysql:host=Nome do host;dbname=Nome da database","Usuario","Senha");
                    self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                } catch (PDOExeption $e) {
                    $e->getMessage();
                }
            }
            return self::$conexao;
        }
    
        public function prepare($sql){
            return self::getInstance()->prepare($sql);
        }
    }
    
